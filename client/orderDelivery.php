<?php
include '../inc/menubasic.php';
 if ($artCount==0)
    header("Location: index.php");

$articles=$basket->getBasket();
include '../inc/menumedium.php';
?>


 <table border=0>
    <tr>
        <td style="vertical-align: text-top;text-align:left;width: 700px; padding: 10px 15px 10px 15px; color: #000000;">
        <h4>Order Delivery</h4>
        <table >
        
        <tr>
        <?php   
            
            foreach ($articles as $value){
                $products= new Products();
                //print_r($value["productid"]);
                $product=$products->getProduct($value["productid"]);
    ?>
            <td > <IMG src="../assets/<?=$product["Image1"]?>" width="100px" /> </td>
            <?php }?>
         </tr> 
        </table >
         <?php
         $addresses= new addresses();
         $address= $addresses->getDefaultAddress($login->userId);
         
        ?>
        <table width="100%">
         <tr>
            <td  style="vertical-align: text-top;">
                    Your Address:    
            </td>        
            <td > <?=$address["first_name"]?> <?=$address["last_name"]?> </br>
            <?=$address["address"]?> </br>
            <?=$address["postcode"]?> <?=$address["city"]?></br>
            <?=$address["phone"]?>
            </td>      
            <td  style="vertical-align: text-top;">
            <div align="right">
                <a href="orderAddress.php" >Change Address</a>    
            </div>
            </td>
        </tr>    
        <tr>
            <td colspan="3">
                <div align="right">
                <input type="submit" class="btn btn-success"  <?=$address["address"]==""?"DISABLED":""?> value="Order Payment" onclick="document.location.href='orderPayment.php';">
            </div>
            </td>
        </tr>       
        </table>

        </td>
        
    </tr>
    </table>
</div>
<?php include '../inc/footer.php';?>