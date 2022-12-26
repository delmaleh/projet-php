
    <?php
include '../inc/menubasic.php';
 $errorMsg=null;
if (isset($_POST["sendName"])) {
    if(password_verify($_POST["password"], $login->user["password"])) {
        $sql="UPDATE CUSTOMER SET First_Name='".str_replace("'","\'",$_POST["firstname"])."',Last_Name='".str_replace("'","\'",$_POST["lastname"])."' WHERE Customer_id='".$login->user["customer_id"]."'";
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
            var firstname = document.getElementById("firstname").value;
            var lastname = document.getElementById("lastname").value;
            var password= document.getElementById("password").value;
            var bValid=true;
       
        if (firstname.trim()==""){
                document.getElementById("firstname").focus();
                document.getElementById("errorMsg").innerHTML="please fill your first name";
                bValid=false;
        }
        if (lastname.trim()==""){
                document.getElementById("lastname").focus();
                document.getElementById("errorMsg").innerHTML="please fill your last name";
                bValid=false;
            }
        else if (password.trim()==""){
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
    <td style="text-align:left;width: 700px; padding: 10px 15px 10px 15px; color: #000000;"><h2>Modify Name</h2>
       
  <form method="post">
  <table  class="table table-borderless">
    <tr>
        <td> First Name:</td>
        <td> <input type="text" class="form-control" name="firstname" id="firstname" value="<?=isset($_POST["firstname"])?$_POST["firstname"]:""?>"/></td>
        
    </tr>
    
    <tr>
        <td> Last Name:</td>
        <td> <input type="text" class="form-control" name="lastname" id="lastname" value="<?=isset($_POST["lastname"])?$_POST["lastname"]:""?>"/></td>
        
    </tr>
    <tr>
        <td> Password:</td>
        <td> <input type="password" class="form-control"  name="password" id="password" value="<?=isset($_POST["password"])?$_POST["password"]:""?>"/></td>
        
    </tr>    
    
    <tr>
        <td></td>
        <td> <span id="errorMsg" style="color:red;"><?=isset($errorMsg)?$errorMsg:""?></span></td>
        
    </tr>
    
    <tr>
        <td> </td>
        <td> <input type="submit" class="btn btn-primary btn-block mb-4" value="Apply" name="sendName" onClick="return validateForm();" /></td>
        
    </tr>
      
    </table>  
    </form>


    </td></tr>
    </table>
    <?php include '../inc/footer.php';?>