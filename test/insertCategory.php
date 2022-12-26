<?php
spl_autoload_register(function($className){
    include '../classes/'.$className.'.php';
});
$login = new login();
if(isset($_GET["deco"])) {
    $login->deco();    
}
if($login->userId == 0) { 
    $login->deco();
} 

$sql= "INSERT INTO CATEGORY(Category_Name,Category_Image,Category_Description,Parent_id) VALUES('";
$sql.=str_replace("'","\'",$_POST["name"])."','".str_replace("'","\'",$_POST["file"])."','".str_replace("'","\'",$_POST["description"])."','".$_POST["parent"]."')";

$dbCon= new Connection();
$conn=$dbCon->OpenCon();
$result = mysqli_query($conn, $sql);
$dbCon->CloseCon($conn);
header("Location: category.php");
?>