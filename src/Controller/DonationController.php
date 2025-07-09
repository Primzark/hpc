<?php
session_start();
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../Model/model-donation.php';
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../PayPalCheckoutSdk/Core/SandboxEnvironment.php';
require_once __DIR__ . '/../PayPalCheckoutSdk/Core/PayPalHttpClient.php';
require_once __DIR__ . '/../PayPalCheckoutSdk/Orders/OrdersCreateRequest.php';

use Stripe\Stripe;
use Stripe\PaymentIntent;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;

if (!isset($_GET['donation']) || !is_numeric($_GET['donation'])) {
    echo json_encode(['error' => 'Invalid donation']);
    exit;
}

$donation = Donation::getById((int)$_GET['donation']);
if (!$donation) {
    echo json_encode(['error' => 'Donation not found']);
    exit;
}

if (isset($_GET['provider'])) {
    header('Content-Type: application/json');
    if ($_GET['provider'] === 'stripe') {
        Stripe::setApiKey(STRIPE_SECRET_KEY);
        $intent = PaymentIntent::create([
            'amount' => (int)($donation['amount'] * 100),
            'currency' => 'eur',
            'metadata' => ['donation_id' => $donation['id']]
        ]);
        echo json_encode(['clientSecret' => $intent->client_secret]);
        exit;
    }
    if ($_GET['provider'] === 'paypal') {
        $env = new SandboxEnvironment(PAYPAL_CLIENT_ID, PAYPAL_CLIENT_SECRET);
        $client = new PayPalHttpClient($env);
        $request = new OrdersCreateRequest();
        $request->prefer('return=representation');
        $request->body = [
            'intent' => 'CAPTURE',
            'purchase_units' => [[
                'amount' => [
                    'currency_code' => 'EUR',
                    'value' => number_format($donation['amount'], 2, '.', '')
                ]
            ]],
            'application_context' => [
                'return_url' => '/donation/success?id=' . $donation['id'],
                'cancel_url' => '/donation/success?id=' . $donation['id']
            ]
        ];
        $response = $client->execute($request);
        foreach ($response->result->links as $link) {
            if ($link->rel === 'approve') {
                echo json_encode(['approvalUrl' => $link->href]);
                exit;
            }
        }
    }
} else {
    $donationId = $donation['id'];
    include_once __DIR__ . '/../View/view_donation_pay.php';
}
