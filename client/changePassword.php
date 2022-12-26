<?php
include '../inc/menubasic.php';
$errorMsg=null;
if (isset($_POST["sendPassword"])) {
    if(password_verify($_POST["password"], $login->user["password"])) {
        $password=password_hash($_POST["password1"],PASSWORD_DEFAULT);
        $sql="UPDATE CUSTOMER SET Password='".$password."'"." WHERE Customer_id='".$login->user["customer_id"]."'";
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
        function showForm(){
            var password1 = document.getElementById("password1");
            var password2 = document.getElementById("password2");
            var password = document.getElementById("password");
            if (password1.type=="password"&&password2.type=="password"&&password.type=="password"){
                password1.type="text";
                password2.type="text";
                password.type="text";
            }
            else {
                password1.type="password";
                password2.type="password";
                password.type="password";
            }

        }
        
        function validateForm() {
            var password1 = document.getElementById("password1").value;
            var password2 = document.getElementById("password2").value;
            var password= document.getElementById("password").value;
            var bValid=true;
       
        if (password.trim()==""){
                document.getElementById("password").focus();
                document.getElementById("errorMsg").innerHTML="please fill your password";
                bValid=false;
        }
        if (password1.trim()==""){
                document.getElementById("password1").focus();
                document.getElementById("errorMsg").innerHTML="please fill your password";
                bValid=false;
            }
        else if (password1.trim()==""){
                document.getElementById("password1").focus();
                document.getElementById("errorMsg").innerHTML="please fill your password";
                bValid=false;
            }
        else if (password1.trim()!=password2.trim()) {
            document.getElementById("errorMsg").innerHTML="please fill your password correctly";
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
    <td style="text-align:left;width: 700px; padding: 10px 15px 10px 15px; color: #000000;"><h2>Modify Password</h2>
        
  <form method="post">
  <table  class="table table-borderless">
    <tr>
        <td> Password:</td>
        <td> <input type="password" class="form-control" name="password" id="password" value="<?=isset($_POST["password"])?$_POST["password"]:""?>"/></td>
        
    </tr>    
    <tr>
        <td> your new Password:</td>
        <td> <input type="password" class="form-control" name="password1" id="password1" value="<?=isset($_POST["password1"])?$_POST["password1"]:""?>"/></td>
        
    </tr>
    
    <tr>
        <td> Retype your new Password:</td>
        <td> <input type="password" class="form-control" name="password2" id="password2" value="<?=isset($_POST["password2"])?$_POST["password2"]:""?>"/></td>
        
    </tr>
    <tr>
        <td></td>
        <td> <span id="errorMsg" style="color:red;"><?=isset($errorMsg)?$errorMsg:""?></span></td>
        
    </tr>
    <tr>
        <td></td>
        <td> <input type="checkbox" onClick="showForm();"/>ShowPassword</td>
        
    </tr>
    
    <tr>
        <td> </td>
        <td> <input type="submit" class="btn btn-primary btn-block mb-4" value="Apply" name="sendPassword" onClick="return validateForm();" /></td>
        
    </tr>
      
    </table>  
    </form>


    </td></tr>
    </table>
    <?php include '../inc/footer.php';?>