<?php
spl_autoload_register(function($className){
    include '../classes/'.$className.'.php';
    
});
require_once '../classes/configJWT.php';
$bExist=false;
$errorMsg=null;
$email=null;
if (isset($_POST["email"])) {
    $email=$_POST["email"];
    $dbCon= new Connection();
    $conn=$dbCon->OpenCon();
    $sql = "SELECT * FROM customer where customer_email='".$email."'";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        //send email
        $bExist=true;
        $user=array();
        $header = [
            'typ' => 'JWT',
            'alg' => 'HS256'
        ];
        
        // On crée le contenu (payload)
        $payload = [
            'customer_email' => $email
            
        ];
        
        $jwt = new JWT();
        
        $token = $jwt->generate($header, $payload, SECRET,3600);  
        $msg = "<html><a href='http://localhost/projet/client/passwordReset.php?id=$token'>RESET YOUR PASSWORD</a></html>";
        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= 'From: <webmaster@example.com>' . "\r\n";
                // use wordwrap() if lines are longer than 70 characters
        $msg = wordwrap($msg,70);

        // send email
        mail($email,"Reset your password",$msg,$headers);
    }
    else {
        $errorMsg="this email does no exist";
    }
    $dbCon->CloseCon($conn);
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
        function validateForm() {
            var email = document.getElementById("email").value;
            var bValid=true;
      if (!String(email)
            .toLowerCase()
            .match(
            /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
            )){
                document.getElementById("email").focus();
                document.getElementById("errorMsg").innerHTML="please enter a valid email";
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
            width:95%;
            margin:auto;
            color:red;
            
        }
        .toLog  {
          width:50%;
            margin:auto;
            
        }
        
    </style>

</head>
<body>


 
<div class="myForm">
    <form method="post" action="password.php">
    <?php    if (!$bExist) {?>
       <p><h2>Password lost?</h2>
        Enter the email address associated with your account.<br>
We will send a link to this address allowing you to easily reset your password.</p>
        <label>Email</label>
        <input type="text" name="email" id="email" value=""/>
        </br>
        <span id="errorMsg"><?=isset($errorMsg)?$errorMsg:""?></span>
        </br>
        <input type="submit" class="btn btn-primary btn-block mb-4" value="Send" name="sendLogin" onClick="return validateForm();" />
        
    </form>
    <p class="toLog"> <a href="login.php">Return to login</a></p>
    <?php } else {
        ?>
        <p>A mail has been sent to your address email</br>
        <?=$email?>
        <input type="button" class="btn btn-primary btn-block mb-4" value="Sign in"  onClick="window.location.href='login.php'" />
    </p>
        <?php
    }
    
    ?>
</div>    
    </body>
</html>
