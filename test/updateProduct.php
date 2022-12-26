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
//Array ( [name] => test [img1] => img1 [img2] => img2 [img3] => img3 [price] => 15 [stock] => 20 [description] => test [cat] => 2 [product] => 1 [sendProduct] => Send )
$sql= "UPDATE PRODUCT SET Product_Name='".str_replace("'","\'",$_POST["name"]);
$sql.="',Image1='".str_replace("'","\'",$_POST["img1"]);
$sql.="',Image2='".str_replace("'","\'",$_POST["img2"]);
$sql.="',Image3='".str_replace("'","\'",$_POST["img3"]);
$sql.="',Price='".str_replace("'","\'",$_POST["price"]);
$sql.="',Stock='".str_replace("'","\'",$_POST["stock"]);
$sql.="',Product_Description='".str_replace("'","\'",$_POST["description"])."'";
$sql.=" where Product_id=".$_POST["product"];
//print_r($sql);

$dbCon= new Connection();
$conn=$dbCon->OpenCon();
$result = mysqli_query($conn, $sql);
$dbCon->CloseCon($conn);
header("Location: product.php?cat=".$_POST["cat"]);

?>