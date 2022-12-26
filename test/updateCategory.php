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

$sql= "UPDATE CATEGORY SET Category_Name='".str_replace("'","\'",$_POST["name"])."',Category_Image='".str_replace("'","\'",$_POST["file"])."',Category_Description='".str_replace("'","\'",$_POST["description"])."'";
$sql.=" where Category_id=".$_POST["cat"];
//print_r($sql);

$dbCon= new Connection();
$conn=$dbCon->OpenCon();
$result = mysqli_query($conn, $sql);
$dbCon->CloseCon($conn);
header("Location: category.php");
?>