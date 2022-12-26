    
<?php
include '../inc/menu.php';
    $products= new Products();
    $cat=new Categories();
    
    if (isset($_GET["cat"])) {
        $catid= $_GET["cat"];
        $category=$cat->getCategory($catid);
        $prods=$products->getProducts($catid);
    }
    else if (isset($_GET["parent"])) {
        $catid= $_GET["parent"];
        $category=$cat->getCategory($catid);
        $prods=$products->getParentProducts($catid);
    }

 ?>  
  <script>
      function submitForm(id) {
        
        var form = document.getElementById("form");
        var prod = document.getElementById("prod");
        prod.value=id;
        
        form.submit();
      }
    </script> 
<table><tr><td style="vertical-align:top">
<div class="vertical-menu">
  <a href="#" class="active"><?=$category["Category_Name"]?></a>
  <IMG src="../assets/<?=$category["Category_Image"]?>" width="100%" />
  
</div>
    </td><td style="vertical-align: text-top;text-align:left;width: 750px; padding: 10px 15px 10px 15px; color: #000000;">
    <span style="Font-size:15;font-family: 'Arial'"><?=$category["Category_Description"]?> </span>
    <table class="table">
    <?php   
         foreach ($prods as $value){

    ?>
    <tr>
        <td> <a href="product.php?cat=<?=$catid?>&prod=<?=$value["Product_id"]?>"><IMG src="../assets/<?=$value["Image1"]?>" width="100px" /></a> </td>
        <td> <a href="product.php?cat=<?=$catid?>&prod=<?=$value["Product_id"]?>"><?=$value["Product_Name"]?></a></br><?=$value["Product_Description"]?></td>
        <td > <div style="width:150px;Font-size:40;color:red"><?=number_format($value["Price"],2)?>&nbsp;€</div><button type="button" class="btn btn-primary btn-success mb-4" onClick="submitForm('<?=$value["Product_id"]?>');">Add to basket</button></td>
    </tr> 
    <?php }?>
    </table>

    </td></tr>
    </table>
    
    <form name="form" id="form" method="post" action="basket.php">
      <input type="hidden" name="prod" id="prod">
    </form>        
    <?php include '../inc/footer.php';?>