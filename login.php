<?php
spl_autoload_register(function($className){
    include 'classes/'.$className.'.php';
});

$login = new login();
if(isset($_GET["deco"])) {
    $login->deco();    
}

//print_r($_SESSION);
?><!DOCTYPE html>
<html lang="en">
<head>
    <script>
        function validateForm() {
            var email = document.getElementById("login").value;
            var pwd=document.getElementById("password").value;
            var bValid=true;
        if (pwd.trim()=="") {   
            document.getElementById("errorMsg").innerHTML="please fill your passord";
            bValid=false; 
        }     
        else if (!String(email)
            .toLowerCase()
            .match(
            /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
            )){
                document.getElementById("errorMsg").innerHTML="please write a correct email";
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
        .myForm table {
            width:95%;
            margin:auto;
            
        }
        .myForm span {
            width:95%;
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
    if($login->userId == 0) { ?>
<div class="myForm">
    <form method="post">
        <label>Login</label>
        <input type="text" name="login" id="login" value="<?=isset($_POST["login"])?$_POST['login']:""?>"/>
        <label>Password</label>
        <input type="password" name="password" id="password" value="<?=isset($_POST["password"])?$_POST['password']:""?>"/>
        <span id="errorMsg"><?=isset($login->errorMsg)?$login->errorMsg:""?></span>
        
        <table border="0" cellspacing="0" cellpadding="0">
        <tr><td>
        <input type="checkbox" name="remember"/>
        <label>Remember me</label>
        </td></tr>
        </table>
        <input type="submit" value="Send" name="sendLogin" onClick="return validateForm();" />
         
    </form>
</div>    
<?php    } else {
    header("Location: category.php");
 } ?>
</body>
</html>