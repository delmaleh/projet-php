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
//print_r($_POST);
//Array ( [name] => test [img1] => img1 [img2] => img2 [img3] => img3 [price] => 15 [stock] => 20 [description] => test [cat] => 2 [product] => 0 [sendProduct] => Send )
$sql= "INSERT INTO PRODUCT(Product_Name,Product_Description,Image1,Image2,Image3,Price,Stock,Category_id) VALUES('";
$sql.=str_replace("'","\'",$_POST["name"])."','";
$sql.=str_replace("'","\'",$_POST["description"])."','";
$sql.=str_replace("'","\'",$_POST["img1"])."','";
$sql.=str_replace("'","\'",$_POST["img2"])."','";
$sql.=str_replace("'","\'",$_POST["img3"])."','";
$sql.=str_replace("'","\'",$_POST["price"])."','";
$sql.=str_replace("'","\'",$_POST["stock"])."','";
$sql.=str_replace("'","\'",$_POST["cat"])."')";
print_r($sql);
$dbCon= new Connection();
$conn=$dbCon->OpenCon();
$result = mysqli_query($conn, $sql);
$dbCon->CloseCon($conn);
header("Location: product.php?cat=".$_POST["cat"]);

?>