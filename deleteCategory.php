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


$cat = new Categories();
$dbCon= new Connection();
$conn=$dbCon->OpenCon();

$categories=$cat->getParentCategories($_GET["cat"]);
foreach ($categories as $value){
        $sql= "DELETE FROM Product";
        $sql.=" where Category_id=".$value['Category_id'];
        $result = mysqli_query($conn, $sql);
}    
$sql= "DELETE FROM CATEGORY";
$sql.=" where Parent_id=".$_GET["cat"];
$result = mysqli_query($conn, $sql);

$sql= "DELETE FROM Product";
$sql.=" where Category_id=".$_GET["cat"];
$result = mysqli_query($conn, $sql);

$sql= "DELETE FROM CATEGORY";
$sql.=" where Category_id=".$_GET["cat"];
$result = mysqli_query($conn, $sql);




$dbCon->CloseCon($conn);
header("Location: addcat.php");
?>