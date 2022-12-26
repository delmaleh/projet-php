<?php
require_once('config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    
    <title>Stripe payment</title>
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>
    <?php if (isset($_SESSION["payment_id"])) { ?>
        <div class="success">
            <strong><?php echo 'Payment is successfull.Payment ID is:'.$_SESSION["payment_id"]; ?></strong>
        </div>
        <?php unset($_SESSION["payment_id"]);?>
        <?php } elseif (isset($_SESSION["payment_error"])) { ?>
        <div class="error">
        <strong><?php echo $_SESSION["payment_error"]; ?></strong>
        </div>
        <?php unset($_SESSION["payment_error"]);?> 
        <?php } ?>
    <form action="charge.php" method="post" id="payment-form">
        <div class="form-row"> 
            <input type="text" name="amount"/>
            <p> <label for="card-element">Credit or debit card</label></p>
            <div id="card-element" style="width:300px">
            </div>
            <div id="card-errors" role="alert"></div>
        </div>
        <p><button>Submit payment</button></p>
    </form>        
    <script>
        var publishable_key='<?=STRIPE_PUBLISHABLE_KEY?>';
    </script>
    <script src="card.js"></script>    
</body>
</html>