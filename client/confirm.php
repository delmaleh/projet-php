<?php
require_once('config.php');
spl_autoload_register(function($className){
    include '../classes/'.$className.'.php';
});
$login = new Customer();
$response = $gateway->confirm([
    'paymentIntentReference' => $_GET['payment_intent'],
    'returnUrl' => RETURN_URL
    
])->send();

if ($response->isSuccessful()) {
    $response = $gateway->capture([
        'amount' => $_SESSION['amount'],
        'currency' => PAYMENT_CURRENCY,
        'paymentIntentReference' => $_GET['payment_intent']
    ])->send();

    $arr_payment_data=$response->getData();
    $arrIns= array(
        'payment_id'=>$arr_payment_data['id'],
        'amount'=>$_SESSION['amount'],
        'currency' => PAYMENT_CURRENCY,
        'payment_status' => $arr_payment_data['status']

    ); 
    $payment= new Payment();
    $payment->create($arrIns);

    //$_SESSION['payment_id']=$arr_payment_data['id'];
    $order= new Order();
    $order->create($login->userId);
    $msg = (new Email())->createMailOrder();
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From: <webmaster@test.com>' . "\r\n";
    //$msg = wordwrap($msg,70);
    $email=$login->user["customer_email"];
    // send email
    mail($email,"your Order from test",$msg,$headers);

    unset($_SESSION['basket']);
    header('Location: orderPayment.php');
}
else {
    $_SESSION['payment_error']=$response->getMessage();
    header('Location: orderPayment.php');
   
}
?>