<?php
require_once 'Connection.php';
class Payment {
    
    

    public function create($pay) {
       
        $dbCon= new Connection();
        $conn=$dbCon->OpenCon();
        $sql= "INSERT INTO payment(Payment_id,Amount,Currency,Status) VALUES('";
        $sql.=$pay['payment_id']."','";
        $sql.=$pay['amount']."','";
        $sql.=$pay['currency']."','";
        $sql.=$pay['payment_status']."')";
        $result = mysqli_query($conn, $sql);    
        $dbCon->CloseCon($conn);   
         
    }
   
}

?>