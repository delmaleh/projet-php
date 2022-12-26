<?php
 spl_autoload_register(function($className){
    include '../classes/'.$className.'.php';
});
require_once '../classes/configGoogle.php';

// create Client Request to access Google API
$client = new Google_Client();
$client->setClientId(clientID);
$client->setClientSecret(clientSecret);
$client->setRedirectUri(redirectUri);
$client->addScope("email");
$client->addScope("profile");



$login = new Customer();
if(isset($_GET["deco"])) {
    $login->deco();    
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <title>login</title>
    <script>
        function validateForm() {
            var email = document.getElementById("email").value;
            var pwd=document.getElementById("password").value;
            var bValid=true;
      if (!String(email)
            .toLowerCase()
            .match(
            /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
            )){
                document.getElementById("email").focus();
                document.getElementById("errorMsg").innerHTML="please write a correct email";
                bValid=false;
            }
            
       else if (pwd.trim()=="") {   
            document.getElementById("password").focus();
            document.getElementById("errorMsg").innerHTML="please fill your passord";
            bValid=false; 
        }     
        return bValid;
        }
    </script>    
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
            width:95%;
            margin:auto;
            color:red;
            
        }
        .myForm p {
          width:60%;
            margin:auto;
            
        }
        .myForm input[type=checkbox] {
            width:auto;
            margin:auto;
            
        }
    </style>

</head>
<body>
<?php
if ($login->userId==0) {
  ?>   
<div class="myForm">
    <form method="post">
        <label>Email</label>
        <input type="text" name="email" id="email" value="<?=isset($_POST["email"])?$_POST["email"]:""?>"/>
        <label>Password</label>
        <input type="password" name="password" id="password" value="<?=isset($_POST["password"])?$_POST["password"]:""?>"/>
        <span id="errorMsg"><?=isset($login->errorMsg)?$login->errorMsg:""?></span>
        
        <table border="0" cellspacing="0" cellpadding="0" width="95%">
        <tr><td>
        <input type="checkbox" name="remember"/>
        <label>Remember me</label>
        </td>
      <td style="text-align: right;"><a href="password.php">Password lost?</a></td>
      </tr>
        </table>
         
        <input type="submit" class="btn btn-primary btn-block mb-4"  value="SIGN IN" name="sendLogin" onClick="return validateForm();" />
        
    </form>
    <p>Not a customer? <a href="register.php">Register</a></p></br>
    <input type="button" class="btn btn-primary btn-block mb-4"  value="CONTINUE WITH GOOGLE"  onClick="document.location.href='<?=$client->createAuthUrl()?>'" />
 
</div>    
 <?php
  } else {
    $redirect="index.php";
    
    header("Location: ".$redirect);
 } ?>

</body>
</html>