<?php include_once(__DIR__ . '/../../templates/head.php'); ?>
<?php include_once(__DIR__ . '/../../templates/navbar.php'); ?>
<div class="custom-bg min-vh-100 d-flex align-items-center">
    <div class="container py-5 text-light">
        <h1 class="display-6 text-center mb-4">Paiement du don</h1>
        <div id="donation-form" data-donation-id="<?php echo htmlspecialchars($donationId); ?>">
            <div class="text-center mb-3">
                <button id="pay-stripe" class="btn btn-warning">Payer par carte</button>
            </div>
            <div id="paypal-button" class="text-center"></div>
        </div>
    </div>
    <?php include_once(__DIR__ . '/../../templates/footer.php'); ?>
    <script>window.STRIPE_PUBLISHABLE_KEY = '<?php echo STRIPE_PUBLISHABLE_KEY; ?>';</script>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="/asset/js/donation.js"></script>
</div>
