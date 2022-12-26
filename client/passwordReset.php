<?php
spl_autoload_register(function($className){
    include '../classes/'.$className.'.php';
    
});
require_once '../classes/config.php';
$bExist=false;
$message=null;
$email=null;
if (isset($_GET["id"])) {
    $jwt = new JWT();
    //si bonne signature et pas expire
    try {
        
    if ($jwt->check($_GET["id"],SECRET)&&!$jwt->isExpired($_GET["id"])) {
        $user=$jwt->getPayload($_GET["id"]);
        $email=$user["customer_email"];
    }else {
        $message="The reset link you received was usable for 1 hour. This link is now expired.";
    }
    }catch (\Throwable $e) { // For PHP 7
        $message="The reset link you received was usable for 1 hour. This link is now expired.";
      }
    
    
}
//on update
if (isset($_POST["sendPassword"])) {
    $password=password_hash($_POST["password1"],PASSWORD_DEFAULT);
    $sql="UPDATE CUSTOMER SET Password='".str_replace("'","\'",$password)."'"." WHERE Customer_email='".$_POST["email"]."'";
    $dbCon= new Connection();
    $conn=$dbCon->OpenCon();
    $result = mysqli_query($conn, $sql);
    $dbCon->CloseCon($conn);
    $message="Password successfully updated";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <title>Lost password</title>
    <script>
        function showForm(){
            var password1 = document.getElementById("password1");
            var password2 = document.getElementById("password2");
            if (password1.type=="password"&&password2.type=="password"){
                password1.type="text";
                password2.type="text";
            }
            else {
                password1.type="password";
                password2.type="password";
                
            }

        }
        
        function validateForm() {
            var password1 = document.getElementById("password1").value;
            var password2 = document.getElementById("password2").value;
            var bValid=true;
       if (password1.trim()==""){
                document.getElementById("password1").focus();
                document.getElementById("errorMsg").innerHTML="please your password";
                bValid=false;
            }
        else if (password1.trim()==""){
                document.getElementById("password1").focus();
                document.getElementById("errorMsg").innerHTML="please your password";
                bValid=false;
            }
        else if (password1.trim()!=password2.trim()) {
            document.getElementById("errorMsg").innerHTML="please fill password correctly";
            bValid=false;
        }   
 
        return bValid;
        }
    </script>    
</head>
<body>
<style>
        .myForm {
            width:100%;
            max-width: 300px;
            margin:auto;
        }
        .myForm input {
            width:95%;
            margin:auto;
        }
        .myForm span {
            width:100%;
            margin:auto;
            color:red;
            
        }
        .toLog  {
          width:50%;
            margin:auto;
            
        }
        .myForm input[type=checkbox] {
            width:auto;
            margin:auto;
            
        }
        
    </style>

</head>
<body>


 
<div class="myForm">
    <form method="post" action="passwordReset.php">
    <?php    if (!isset($message)) {?>
       <p><h2>Password Reset</h2>
        Enter the passord twice to reset your password<br>
        </p>
        <label>New Password</label>
        <input type="password" name="password1" id="password1" value=""/>
        </br>
        <label>Retype Password</label>
        <input type="password" name="password2" id="password2" value=""/>
        </br>
        <span id="errorMsg"></span>
        <table border="0" cellspacing="0" cellpadding="0">
        <tr><td>
        <input type="checkbox" onClick="showForm();"/>ShowPassword
        </td>
      
      </tr>
        </table>
        
        

        <input type="hidden" name="email" value="<?=$email?>"> 
        <input type="submit" class="btn btn-primary btn-block mb-4" value="Send" name="sendPassword" onClick="return validateForm();" />
        
    </form>
     <?php } else {
        ?>
        <p><?=$message?></br>
      <input type="button" class="btn btn-primary btn-block mb-4" value="Sign in"  onClick="window.location.href='login.php'" />
    </p>
        <?php
    }
    
    ?>
</div>    
    </body>
</html>
