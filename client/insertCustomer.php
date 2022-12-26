<?php
 spl_autoload_register(function($className){
    include '../classes/'.$className.'.php';
    //include ''
});

//print_r($_POST);
//Array ( [email] => daniel@dd.fr [firstname] => daniel [lastname] => elmaleh [phone] => 06999999 [password] => 1234 [sendLogin] => Sign in )
//on hash password
$password=password_hash($_POST["password"],PASSWORD_DEFAULT);
$sql= "INSERT INTO CUSTOMER(customer_email,first_name,last_name,password,phone) VALUES('";
$sql.=str_replace("'","\'",$_POST["email"])."','";
$sql.=str_replace("'","\'",$_POST["firstname"])."','";
$sql.=str_replace("'","\'",$_POST["lastname"])."','";
$sql.=str_replace("'","\'",$password)."','";
$sql.=str_replace("'","\'",$_POST["phone"])."')";
//print_r($sql);
$dbCon= new Connection();
$conn=$dbCon->OpenCon();
$result = mysqli_query($conn, $sql);
$dbCon->CloseCon($conn);
//on cree la session
$login = new Customer();
header("Location: home.php");

