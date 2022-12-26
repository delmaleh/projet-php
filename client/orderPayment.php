<?php
require_once('config.php');

include '../inc/menubasic.php';
 if ($artCount==0)
    header("Location: index.php");

$articles=$basket->getBasket();
include '../inc/menumedium.php';


?>
<script src="https://js.stripe.com/v3/"></script>
 <table border=0>
    <tr>
        <td style="vertical-align: text-top;text-align:left;width: 700px; color: #000000;">
            <h5><b>Payment Details</b></h5>
            <table  width="100%">
            <?php   
                $total=0;
                foreach ($articles as $value){
                    $products= new Products();
                    $product=$products->getProduct($value["productid"]);
                    $totalProd=$product["Price"]*$value["qty"];
                    $total+=$totalProd;
            ?>
            <tr>
                <td><?=$value["qty"]?>x<?=$product["Product_Name"]?></td>
                <td style="text-align:right;" ><?=number_format($totalProd,2)?>&nbsp;€</div></td>
            </tr> 
            <?php } 
            
            
            $addresses= new addresses();
            $address= $addresses->getDefaultAddress($login->userId);
            
           
            ?>
            <tr>
                <td><b>Total amount</b></td>
                <td style="text-align:right;"><span style="color:red"><?=number_format($total,2)?>&nbsp;€</span></td>
            </tr> 
            
            </table >
            <p></p>
            <h5><b>Secure payment by card</b></h5>
            <form action="charge.php" method="post" id="payment-form">
            <table >
            <tr>
                <td  style="vertical-align: text-top;width:300px;padding-left: 10px;">
                <div class="form-row"> 
                <input type="hidden" name="amount" value="<?=$total?>"/>
                <p> <label >Card Holder</label></p>
                <input type="text" name="name" value="<?=$address["first_name"]?> <?=$address["last_name"]?>" class="form-control"/>
                <p> <label for="card-element">Card Number</label></p>
                <div id="card-element" style="width:300px">
                </div>
                <div id="card-errors" role="alert"></div>
                </div>
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
            <input type="submit" class="btn btn-success" value="Order Payment">
                </td>
            </tr>    
                
            </table>
                    
            <script>
                var publishable_key='<?=STRIPE_PUBLISHABLE_KEY?>';
            </script>
            <script src="card.js"></script>      
            </form>  
        </td>
        
    </tr>
    </table>
</div>
<?php include '../inc/footer.php';?>