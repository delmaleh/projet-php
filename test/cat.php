<?php
 spl_autoload_register(function($className){
    include '../classes/'.$className.'.php';
});
$login = new Customer();
/*if(isset($_GET["deco"])) {
    $login->deco();    
}
if($login->userId==0) {
  
  header("Location: login.php");    
  
}*/
$basket = new Basket();
$artCount= $basket->getArticleCount();

?>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <link rel="stylesheet" href="home.css" >
    
    
    <title>home</title>
    <style>
      .circle {
        width: 20px;
        border-radius: 50%;
        color:white;
		background-color:red;
        font-size: 10px;
		font-family:Arial Black;
        position:absolute;
        right:0;
        top:-10;
        <?=$artCount==0?"visibility:hidden;":""?>
        
      }
      
    </style>
    <script>
      function submitForm(id) {
        
        var form = document.getElementById("form");
        var prod = document.getElementById("prod");
        prod.value=id;
        //alert(prod.value);
        form.submit();
      }
    </script> 
</head>


<body>
<?php
$cat = new Categories();
$categories=$cat->getCategories();

?>
<div width="100%" style="color:green;" align="center">
<table witdh="100%" style="margin-top:20px">
<tr><td>

<nav class="nav navbar-right">

<div class="dropdown">
	  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
		Category
	  </button>
	  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
		<?php   
         foreach ($categories as $value){

    ?>
                <li><a class="dropdown-item" href="category.php?cat=<?=$value["Category_id"]?>"><?=$value["Category_Name"]?></a></li>
    <?php } ?>
    </ul>
	</div>
          
&nbsp;&nbsp;
<form class="d-flex" role="search" action="productSearch.php">
        
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search">
        <button class="btn btn-outline-success" type="submit">Search</button>

    </form>
    <a class="nav-link" href="basket.php" style="position:relative;"><div style="position:absolute;font-size:25;"><i class="bi bi-cart"></i></div><div class="circle" style="align-items:center;height: 20px;display: flex;justify-content: center;"><?=$artCount==0?"":$artCount?></div></a>
    <?php
  if ($login->userId==0) { 
    ?>
  <a class="nav-link" href="login.php"><i class="bi bi-person-circle"></i> my Account</a>
  <?php
    } else { 
        ?>
  <a class="nav-link" href="accountClient.php"><div style="font-size:20;display:inline-block;"><i class="bi bi-person-circle" ></i></div> Hello  <?=$login->login()?></a> <a class="nav-link" href="?deco">logout</a>
  <?php } ?>
  
</nav>
    </td>
    </tr>
    </table>
    
<?php
    $products= new Products();
 
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
    </div>
    <form name="form" id="form" method="post" action="basket.php">
      <input type="hidden" name="prod" id="prod">
    </form>        
    </body>
    </html>