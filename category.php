<?php
spl_autoload_register(function($className){
    include 'classes/'.$className.'.php';
});
$login = new login();
if(isset($_GET["deco"])) {
    $login->deco();    
}
if($login->userId == 0) { 
    $login->deco();
} 
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

    <title>Category</title>
  

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
  <div>
  <a href="addcat.php">Add a Category</a>
</div>
<?php 
  $dbCon= new Connection();
  $conn=$dbCon->OpenCon();
  $sql = "SELECT c.*,p.Category_Name parent FROM `category` c LEFT JOIN category p ON p.Category_id=c.Parent_id" ;
  $result = mysqli_query($conn, $sql);
 ?>      
  <table class="table">
    <tr>
        <td> Name</td>
        <td> Image</td>
        <td> Description</td>
        <td> Update</td>
        <td> Delete</td>
        <td> Products</td>
</tr>    
   <?php if (mysqli_num_rows($result) > 0) {
        // output data of each row
            while($row = mysqli_fetch_assoc($result)) {?>
                <tr>
                <td><?=$row["Category_Name"]?></td>
                <td> <?=$row["Category_Image"]?></td>
                <td> <?=$row["Category_Description"]?></td>
                <td> <a href="addCategory.php?cat=<?=$row["Category_id"]?>"><i class="bi bi-pencil-fill"></i></a></td>
                <td> <a href="deleteCategory.php?cat=<?=$row["Category_id"]?>"><i class="bi bi-trash"></i></a></td>
                <td> <a href="product.php?cat=<?=$row["Category_id"]?>"><i class="bi bi-box"></i></a></td>
            </tr>
            <?php }
        }
        $dbCon->CloseCon($conn);
?>
  
    </table>  


</body>
</html>