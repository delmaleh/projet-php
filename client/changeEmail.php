<?php
include '../inc/menubasic.php';
    $errorMsg=null;
if (isset($_POST["sendEmail"])) {
    if(password_verify($_POST["password"], $login->user["password"])) {
        $sql="UPDATE CUSTOMER SET Customer_Email='".$_POST["email1"]."'"." WHERE Customer_id='".$login->user["customer_id"]."'";
        $dbCon= new Connection();
        $conn=$dbCon->OpenCon();
        $result = mysqli_query($conn, $sql);
        $dbCon->CloseCon($conn);
        header("Location: accountParameters.php");
    }
    else $errorMsg="password incorrect";    
}
include '../inc/menumedium.php';
?>

    <script>
    function validateForm() {
            var email1 = document.getElementById("email1").value;
            var email2 = document.getElementById("email2").value;
            var password=document.getElementById("password").value;
            var bValid=true;
            //alert('ok');
       if (!String(email1)
            .toLowerCase()
            .match(
            /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
            )){
                document.getElementById("email1").focus();
                document.getElementById("errorMsg").innerHTML="please fill your email";
                bValid=false;
            }
        else if (!String(email2)
            .toLowerCase()
            .match(
            /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
            )){
                document.getElementById("email2").focus();
                document.getElementById("errorMsg").innerHTML="please fill your email";
                bValid=false;
            }
        else if (email2.trim()!=email1.trim()) {
            document.getElementById("errorMsg").innerHTML="please fill your email correctly";
            bValid=false;
        }   
        else if (password.trim()=="") {
            document.getElementById("password").focus();
                document.getElementById("errorMsg").innerHTML="please fill your password";
                bValid=false;
        }
        return bValid;
        }
        </script>
   
<table><tr><td style="vertical-align:top">
<div class="vertical-menu">
  <a href="#" class="active">Home</a>
  <a href="ordered.php"><i class="bi bi-cart3"></i>   Ordered</a>
  <a href="accountParameters.php"><i class="bi bi-gear"></i>   Account Parameters</a>
  <a href="#"><i class="bi bi-chat-left-text"></i>   Messages</a>
  <a href="addresses.php"><i class="bi bi-envelope"></i>   Addresses</a>
</div>
    </td>
    <td style="vertical-align:top;text-align:left;width: 700px; padding: 10px 15px 10px 15px; color: #000000;"><h2>Modify Email</h2>
  Old e-mail:<?=$login->user["customer_email"]?>      
  <form method="post">
  <table  class="table table-borderless">
    <tr>
        <td> Email:</td>
        <td> <input type="txt" class="form-control" name="email1" id="email1" value="<?=isset($_POST["email1"])?$_POST["email1"]:""?>"/></td>
        
    </tr>    
    <tr>
        <td> Retype your email:</td>
        <td> <input type="txt" class="form-control" name="email2" id="email2" value="<?=isset($_POST["email2"])?$_POST["email2"]:""?>"/></td>
        
    </tr>
    
    <tr>
        <td> Password:</td>
        <td> <input type="password" class="form-control" name="password" id="password" value="<?=isset($_POST["password"])?$_POST["password"]:""?>"/></td>
        
    </tr>
    <tr>
        <td></td>
        <td> <span id="errorMsg" style="color:red;"><?=isset($errorMsg)?$errorMsg:""?></span></td>
        
    </tr>
    
    
    <tr>
        <td> </td>
        <td> <input type="submit" class="btn btn-primary btn-block mb-4" value="Apply" name="sendEmail" onClick="return validateForm();" /></td>
        
    </tr>
      
    </table>  
    </form>


    </td></tr>
    </table>
    <?php include '../inc/footer.php';?>