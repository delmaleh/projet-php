<?php
require_once('vendor/autoload.php');
\Stripe\Stripe::setApiKey('sk_test_51LXPfFDbZrNxvWipQaXolJMscCKXOWe67U7rJLOn4bq6m5h50GuiK1XyqTEluBrY0Ghpq1n9yMxP2HHvuzlmOZ7y00aJbka2Bs');
$session = \Stripe\Checkout\Session::create([
    'line_items' => [[
      'price_data' => [
        'currency' => 'eur',
        'product_data' => [
            'name'=> 'tee shirt',
            ],
        'unit_amount' => 2000,
        ],
       'quantity' => 2,

    ]],
    
    'mode' => 'payment',
    'success_url' => 'https://localhost/projet/test.php',
    'cancel_url' => 'https://localhost/projet/test.php',
  ]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <title>Document</title>
     
</head>
<body>
<script>
    function checkOut(){
        
        var stripe= Stripe('pk_test_51LXPfFDbZrNxvWip4QGWl7JlVaoOkGSfuWzAFw03shYq5ZtQhAxI9W2as5yIaHwkiSlcXtbwUKy8A07xfdQ5HJqm00CkBn7ed9');
        stripe.redirectToCheckout({ sessionId: '<?=$session->id?>'});
    }
    </script>  
<input type="button" value="checkout" onclick="checkOut();">    
</body>
</html>
<?php
/*$login = new Customer();
if(isset($_GET["deco"])) {
    $login->deco();    
}*/
//$basket= new Basket();

/*$stripe = new \Stripe\StripeClient('sk_test_BQokikJOvBiI2HlWgH4olfQ2');
$customer = $stripe->customers->create([
    'description' => 'example customer',
    'email' => 'email@example.com',
    'payment_method' => 'pm_card_visa',
]);
echo $customer;
  $stripe->paymentIntents->create([
    'amount' => 2000,
    'currency' => 'eur',
    'payment_method_types' => ['card'],
  ]);
 */
//require_once('vendor/autoload.php');
//$stripe = new \Stripe\StripeClient('sk_test_51LXPfFDbZrNxvWipQaXolJMscCKXOWe67U7rJLOn4bq6m5h50GuiK1XyqTEluBrY0Ghpq1n9yMxP2HHvuzlmOZ7y00aJbka2Bs');

/*$stripe->prices->create(
  [
    'currency' => 'usd',
    'unit_amount' => 1000,
    'product' => '{{PRODUCT_ID}}',
  ]
);*/
//$stripe = new \Stripe\StripeClient('sk_test_51LXPfFDbZrNxvWipQaXolJMscCKXOWe67U7rJLOn4bq6m5h50GuiK1XyqTEluBrY0Ghpq1n9yMxP2HHvuzlmOZ7y00aJbka2Bs');
/*$stripe->tokens->create([
    'card' => [
      'number' => '4242424242424242',
      'exp_month' => 8,
      'exp_year' => 2023,
      'cvc' => '314',
    ],
  ]);
  */
//print_r($stripe->tokens); 
  /*
$stripe = new \Stripe\StripeClient("sk_test_51LXPfFDbZrNxvWipQaXolJMscCKXOWe67U7rJLOn4bq6m5h50GuiK1XyqTEluBrY0Ghpq1n9yMxP2HHvuzlmOZ7y00aJbka2Bs");

$product = $stripe->products->create([
  'name' => 'Starter Subscription',
  'description' => '$12/Month subscription',
]);
echo "Success! Here is your starter subscription product id: " . $product->id . "\n";

$price = $stripe->prices->create([
  'unit_amount' => 1200,
  'currency' => 'usd',
  'recurring' => ['interval' => 'month'],
  'product' => $product['id'],
]);
echo "Success! Here is your premium subscription price id: " . $price->id . "\n";
*/

//$basket->clearBasket();
//$basket->addBasket('3','7');
//$basket->addBasket('1234','20');
//$basket->addBasket('12346','16');
//$basket->removeBasket('12346');
//print_r($basket->getBasket());
/*use Omnipay\Omnipay;

$gateway = Omnipay::create('Stripe');
$gateway->setApiKey('sk_test_51LXPfFDbZrNxvWipQaXolJMscCKXOWe67U7rJLOn4bq6m5h50GuiK1XyqTEluBrY0Ghpq1n9yMxP2HHvuzlmOZ7y00aJbka2Bs');

$formData = array('number' => '4242424242424242', 'expiryMonth' => '12', 'expiryYear' => '2034', 'cvv' => '123');

$response = $gateway->purchase(array('amount' => '10.00', 'currency' => 'USD', 'card' => $formData))->send();

if ($response->isRedirect()) {
    // redirect to offsite payment gateway
    $response->redirect();
} elseif ($response->isSuccessful()) {
    // payment was successful: update database
    print_r($response);
} else {
    // payment failed: display message to customer
    echo $response->getMessage();
}*/
?>