<?php
spl_autoload_register(function($className){
    include '../classes/'.$className.'.php';
});
$login = new login();
/*if(isset($_GET["deco"])) {
    $login->deco();    
}
if($login->userId == 0) { 
    $login->deco();
} */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">

    <title>add product</title>
    <style>
        .myForm {
            width:100%;
            max-width: 300px;
           
        }
        .myForm input {
            width:95%;
            
        }
        
    </style>

</head>
<body>
    
<div align="left" style="display:inline-block;width:10%">
<img src="assets/logo.jpg" width="100%"/>
  </div>
  <div align="center" style="display:inline-block;width:74%">     
  </div> 
  <div align="right" style="display:inline-block;width:10%">
Hello  <?=$login->login()?> <a href="?deco">logout</a>

  </div> 
 <div class="container">
    <br/>
	<div class="row justify-content-center">
                        <div class="col-12 col-md-10 col-lg-8">
                            <form class="card card-sm" action="searchCatProd.php">
                                <div class="card-body row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <i class="fas fa-search h4 text-body"></i>
                                    </div>
                                    <!--end of col-->
                                    <div class="col">
                                        <input class="form-control form-control-lg form-control-borderless" type="search" placeholder="Search categories,products" name="search">
                                    </div>
                                    <!--end of col-->
                                    <div class="col-auto">
                                        <button class="btn btn-lg btn-success" type="submit">Search</button>
                                    </div>
                                    <!--end of col-->
                                </div>
                            </form>
                        </div>
                        <!--end of col-->
                    </div>
</div>
  <?php 
  $productid=0;
  if (isset($_GET["product"])) $productid=$_GET["product"];
  ?>
  <H1><?=($productid==0)?"Add":"Update"?> a Product</h1>
   <?php
   $sql= "SELECT * from Product  where Product_id=".$productid;
   
   
   $dbCon= new Connection();
   $conn=$dbCon->OpenCon();
   $result = mysqli_query($conn, $sql);
   if (mysqli_num_rows($result) > 0) {
    // output data of each row
        $row = mysqli_fetch_assoc($result); 
        $productName=$row["Product_Name"];
        $img1=$row["Image1"];
        $img2=$row["Image2"];
        $img3=$row["Image3"];
        $prodDesc=$row["Product_Description"];
        $price=$row["Price"];
        $stock=$row["Stock"];
        
    }
    

  $dbCon->CloseCon($conn);
?>   

  <div class="myForm">
    <form method="post" action="<?=($productid==0)?"insertProduct.php":"updateProduct.php"?>">
        <label>Name</label>
        <input type="text" name="name" value="<?=isset($productName)?$productName:""?>" />
        <label>Image1</label>
        <input type="text" name="img1" value="<?=isset($img1)?$img1:""?>"/>
        <label>Image2</label>
        <input type="text" name="img2" value="<?=isset($img2)?$img2:""?>"/>
        <label>Image3</label>
        <input type="text" name="img3" value="<?=isset($img3)?$img3:""?>"/>
        <label>Price</label>
        <input type="text" name="price" value="<?=isset($price)?$price:""?>"/>
        <label>Stock</label>
        <input type="text" name="stock" value="<?=isset($stock)?$stock:""?>"/>
        
        <label>Description</label>
        <textarea name="description" rows="4" cols="50"/><?=isset($prodDesc)?$prodDesc:""?></textarea>
        <input type="hidden" name="cat" value="<?=$_GET["cat"]?>">
        <input type="hidden" name="product" value="<?=$productid?>">
        <input type="submit" value="Send" name="sendProduct" />
         
    </form>
</div> 
</body>
</html> 