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
} 
*/

$sql= "DELETE FROM Product";
$sql.=" where Product_id=".$_GET["product"];
$dbCon= new Connection();
$conn=$dbCon->OpenCon();
$result = mysqli_query($conn, $sql);

$dbCon->CloseCon($conn);
header("Location: product.php?cat=".$_GET["cat"]);
?>