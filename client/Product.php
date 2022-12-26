<?php

include '../inc/menu.php';
 
?>     <script>
        function changeImg(id) {
            
            var img = document.getElementById("main");
            img.src=id.src;
        }
    </script>
<?php
    $cat= new Categories();
    $catid= $_GET["cat"];
    $prodid= $_GET["prod"];
    $category=$cat->getCategory($catid);
    $products= new Products();
    $product=$products->getProduct($prodid);

 ?>  
<table><tr><td style="vertical-align:top">
<div class="vertical-menu">
  <a href="#" class="active"><?=$category["Category_Name"]?></a>
  <IMG src="../assets/<?=$category["Category_Image"]?>" width="100%" />
  
</div>
    </td><td style="vertical-align: text-top;text-align:left;width: 700px; padding: 10px 15px 10px 15px; color: #000000;">
    <form name="form" method="post" action="basket.php">
    <table class="table">
   
    <tr>
        <td> <IMG id="main" src="../assets/<?=$product["Image1"]?>" width="100%" /> </br>
        
        <table>
            <tr>
                <td><a href="#"><IMG  src="../assets/<?=$product["Image1"]?>" onclick="changeImg(this);" width="50px"/></a></td><td><a href="#"><IMG src="../assets/<?=$product["Image2"]?>" onclick="changeImg(this);" width="50px"/></a></td><td><a href="#"><IMG src="../assets/<?=$product["Image3"]?>" onclick="changeImg(this);" width="50px"/></a></td>
            </tr>    
        </table>    
        
    </td>
        <td> <?=$product["Product_Name"]?></br></br><?=$product["Product_Description"]?></br></br>
        <div style="width:150px;Font-size:40;color:red"><?=number_format($product["Price"],2)?>&nbsp;€</div>
        
        <div style="width:100px; align=center;display:inline:block">
        
        <table width="100%">
            <tr><td>Qty:</td><td>
        <select name="qty" id="qty"  class="form-select">
                     <option value="1" >1</option>
                     <option value="2" >2</option>
                     <option value="3" >3</option>
                     <option value="4" >4</option>
                     <option value="5" >5</option>
                     
        </select>
    </td></tr>
    </table>
    </div>
        <input type="hidden" name="prod" value="<?=$product["Product_id"]?>" />       
        <button type="submit" class="btn btn-primary btn-success mb-4">Add to basket</button></td>
    </tr> 
       </table>

    </td></tr>
    </table>
    <?php include '../inc/footer.php';?>