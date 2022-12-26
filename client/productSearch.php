<?php
include '../inc/menu.php';
?>
    <script>
      function submitForm(id) {
        
        var form = document.getElementById("form");
        var prod = document.getElementById("prod");
        prod.value=id;
        //alert(prod.value);
        form.submit();
      }
    </script> 
<?php
    //$catid= $_GET["cat"];
    $search=$_GET["search"];
    //$category=$cat->getCategory($catid);
    $products= new Products();
    $prods=$products->getProductsByName($search);

 ?>  
<table><tr><td style="vertical-align: text-top;text-align:left;width: 750px; padding: 10px 15px 10px 15px; color: #000000;">
    
    <table class="table">
    <?php   
         foreach ($prods as $value){

    ?>
    <tr>
        <td> <a href="product.php?cat=<?=$value["Category_id"]?>&prod=<?=$value["Product_id"]?>"><IMG src="../assets/<?=$value["Image1"]?>" width="100px" /></a> </td>
        <td> <a href="product.php?cat=<?=$value["Category_id"]?>&prod=<?=$value["Product_id"]?>"><?=$value["Product_Name"]?></a></br><?=$value["Product_Description"]?></td>
        <td > <div style="width:150px;Font-size:40;color:red"><?=number_format($value["Price"],2)?>&nbsp;€</div><button type="button" class="btn btn-primary btn-success mb-4" onClick="submitForm('<?=$value["Product_id"]?>');">Add to basket</button></td>
    </tr> 
    <?php }?>
    </table>

    </td></tr>
    </table>
    </div>
    <form name="form" id="form" method="post" action="basket.php">
      <input type="hidden" name="prod" id="prod">
    </form>        
    <?php include '../inc/footer.php';?>