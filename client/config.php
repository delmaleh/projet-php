<?php
//session_start();
require_once('../vendor/autoload.php');

use Omnipay\Omnipay;
DEFINE ('STRIPE_PUBLISHABLE_KEY','pk_test_51LXPfFDbZrNxvWip4QGWl7JlVaoOkGSfuWzAFw03shYq5ZtQhAxI9W2as5yIaHwkiSlcXtbwUKy8A07xfdQ5HJqm00CkBn7ed9');
DEFINE ('STRIPE_SECRET_KEY','sk_test_51LXPfFDbZrNxvWipQaXolJMscCKXOWe67U7rJLOn4bq6m5h50GuiK1XyqTEluBrY0Ghpq1n9yMxP2HHvuzlmOZ7y00aJbka2Bs');
DEFINE ('RETURN_URL','http://localhost/projet/client/confirm.php'); 
DEFINE ('PAYMENT_CURRENCY','EUR');

$gateway = Omnipay::create('Stripe\PaymentIntents');
$gateway->setApiKey(STRIPE_SECRET_KEY);