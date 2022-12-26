<?php
 
 
 include '../inc/menubasic.php';
 
 
   
 
$basket = new Basket();
    //$basket->clearBasket();
    
    if (isset($_POST["prod"])) {
        $prodid= trim($_POST["prod"]);
        //on check la quantite par defaut 1
        $qty=1;
        if (isset($_POST["qty"]))
            $qty=$_POST["qty"];
        if (isset($_POST["from"])) 
            if ($_POST["from"]=="removeProduct") {
                //print_r($prodid);
                //print_r($_POST["from"]);
                $basket->removeBasket($prodid);
            }
                else
                $basket->addBasket($prodid,$qty,true);
        else 
            $basket->addBasket($prodid,$qty,false);
        
        
    }
    $artCount= $basket->getArticleCount();
    $articles=$basket->getBasket();

    include '../inc/menumedium.php';
?>
    <script>
       function setQty(qty,id){
            var value = qty.options[qty.selectedIndex].value;
            var form = document.getElementById("form");
            var prod = document.getElementById("prod");
            var qty = document.getElementById("qty");
            prod.value=id;
            qty.value=value;
            form.submit();
           
        }
        function removeProduct(id){
            
            var form = document.getElementById("form");
            var prod = document.getElementById("prod");
            var from = document.getElementById("from");
            prod.value=id;
            from.value='removeProduct';
            
            form.submit();
           
        }
        
    </script> 
 <table border=0>
    <tr>
        <td style="vertical-align: text-top;text-align:left;width: 750px; padding: 10px 15px 10px 15px; color: #000000;">
        <h4>Order Detail</h4>
        <table class="table table-borderless">
        <?php   
            $total=0;
            foreach ($articles as $value){
                $products= new Products();
                //print_r($value["productid"]);
                $product=$products->getProduct($value["productid"]);
                $total+=$product["Price"]*$value["qty"];
        ?>
        <tr>
            <td> <a href="product.php?cat=<?=$product["Category_id"]?>&prod=<?=$product["Product_id"]?>"><IMG src="../assets/<?=$product["Image1"]?>" width="100%" /></a> </td>
            <td> <a href="product.php?cat=<?=$product["Category_id"]?>&prod=<?=$product["Product_id"]?>"><?=$product["Product_Name"]?></a></br><?=$product["Product_Description"]?></td>
            <td style="text-align:right;" > <div style="width:100px;Font-size:30;color:red"><?=number_format($product["Price"],2)?>&nbsp;€</div></td>
        </tr> 
        <tr>
            <td colspan="3" style="vertical-align: text-top;text-align:right">
            <div align="right">
                <div  style="width:40%;display:flex">
                
                    <button type="button" class="btn btn-secondary" onClick="removeProduct('<?=$product["Product_id"]?>');">Remove</button>    
                     <select name="qty0" id="qty0"  class="form-select" onChange="setQty(this,'<?=$product["Product_id"]?>');">
                     <option value="1" <?=$value["qty"]==1?"selected":""?>>1</option>
                     <option value="2" <?=$value["qty"]==2?"selected":""?>>2</option>
                     <option value="3" <?=$value["qty"]==3?"selected":""?>>3</option>
                     <option value="4" <?=$value["qty"]==4?"selected":""?>>4</option>
                     <option value="5" <?=$value["qty"]==5?"selected":""?>>5</option>
                     <option value="6" <?=$value["qty"]==6?"selected":""?>>6</option>
                     <option value="7" <?=$value["qty"]==7?"selected":""?>>7</option>
                     <option value="8" <?=$value["qty"]==8?"selected":""?>>8</option>
                     <option value="9" <?=$value["qty"]==9?"selected":""?>>9</option>
                     <option value="10" <?=$value["qty"]==10?"selected":""?>>10</option>
                </select>
                 
            </div>
            </div>      
            </td>
        </tr>    
        <?php }?>
        </table>

        </td>
        <td style="vertical-align: text-top;text-align:right;padding: 10px 15px 10px 15px;"><div >Total:&nbsp;&nbsp;<span style="Font-size:30;color:red;text-align:right"><?=number_format($total,2)?>&nbsp;€</span ></div><button type="button" class="btn btn-primary btn-success mb-4" onclick="document.location.href='orderDelivery.php';">Pay Order</button></td>
    </tr>
    </table>
</div>

<form name="form" id="form" method="post" action="basket.php">
      <input type="hidden" name="prod" id="prod">
      <input type="hidden" name="qty" id="qty">
      <input type="hidden" name="from" id="from" >
</form>
<?php include '../inc/footer.php';?>