<?php
namespace PayPalCheckoutSdk\Core;

class SandboxEnvironment
{
    private string $clientId;
    private string $clientSecret;

    public function __construct(string $clientId, string $clientSecret)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
    }

    public function getClientId(): string
    {
        return $this->clientId;
    }

    public function getClientSecret(): string
    {
        return $this->clientSecret;
    }

    public function baseUrl(): string
    {
        return 'https://api-m.sandbox.paypal.com';
    }
}
