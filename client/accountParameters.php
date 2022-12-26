<?php
 
include '../inc/menu.php';


?>     
    
   
<table><tr><td style="vertical-align:top">
<div class="vertical-menu">
  <a href="#" class="active">Home</a>
  <a href="ordered.php"><i class="bi bi-cart3"></i>   Ordered</a>
  <a href="accountParameters.php"><i class="bi bi-gear"></i>   Account Parameters</a>
  <a href="#"><i class="bi bi-chat-left-text"></i>   Messages</a>
  <a href="addresses.php"><i class="bi bi-envelope"></i>   Addresses</a>
</div>
    </td>
    <td style="vertical-align:top;text-align:left;width: 700px; padding: 10px 15px 10px 15px; color: #000000;"><h2>Parameters</h2>
        
  <table class="table">
    <tr>
        <td> Email:</br><?=$login->user["customer_email"]?></td>
        <td> <input type="button" class="btn btn-primary btn-block mb-4" <?=$login->user["password"]==""?"DISABLED":""?> value="Modify" onClick="window.location.href='changeEmail.php'"  /></td>
        
    </tr>    
    <tr>
        <td> Password:</br>*************</td>
        <td> <input type="button" class="btn btn-primary btn-block mb-4" <?=$login->user["password"]==""?"DISABLED":""?> value="Modify" onClick="window.location.href='changePassword.php'"  /></td>
        
    </tr>
    <tr>
        <td> Full Name:</br><?=$login->user["first_name"]?> <?=$login->user["last_name"]?></td>
        <td> <input type="button" class="btn btn-primary btn-block mb-4" <?=$login->user["password"]==""?"DISABLED":""?> value="Modify" onClick="window.location.href='changeName.php'"  /></td>
        
    </tr>
      
    </table>  



    </td></tr>
    </table>
    <?php include '../inc/footer.php';?>