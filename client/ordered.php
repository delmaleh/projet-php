<?php

include '../inc/menubasic.php';
 

include '../inc/menumedium.php';


?>    
<table><tr><td style="vertical-align: text-top;">
<div class="vertical-menu">
  <a href="#" class="active">Home</a>
  <a href="ordered.php"><i class="bi bi-cart3"></i>   Ordered</a>
  <a href="accountParameters.php"><i class="bi bi-gear"></i>   Account Parameters</a>
  <a href="#"><i class="bi bi-chat-left-text"></i>   Messages</a>
  <a href="addresses.php"><i class="bi bi-envelope"></i>   Addresses</a>
</div>
    </td>
    <td style="vertical-align: text-top;text-align:left;width: 700px; padding: 10px 15px 10px 15px; color: #000000;"><h2>Ordered</h2>
    <?php 
  $dbCon= new Connection();
  $conn=$dbCon->OpenCon();
  $sql = "SELECT * FROM `orders` WHERE orders.Customer_id=".$login->userId;
  $result = mysqli_query($conn, $sql);
 ?>      
  <table class="table">
    <tr>
        <td> Order</td>
        <td> Date</td>
        <td> Total Price</td>
        <td> Shipping Date</td>
        <td> Delivered</td>
        
</tr>    
   <?php if (mysqli_num_rows($result) > 0) {
        // output data of each row
            while($row = mysqli_fetch_assoc($result)) {?>
                <tr>
                <td><?=$row["Order_id"]?></td>
                <td> <?=$row["Order_Date"]?></td>
                <td style="text-align:right"> <?=$row["Order_Total"]?>&nbsp;€</td>
                <td> <?=$row["Shipping_Date"]=="0000-00-00 00:00:00"?"not shipped":""?></td>
                <td> <?=$row["is_Delivered"]==0?"no":"yes"?></td>
                
            </tr>
            <?php }
        }
        $dbCon->CloseCon($conn);
?>
  
    </table>  



    </td></tr>
    </table>
    <?php include '../inc/footer.php';?>