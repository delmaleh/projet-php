<?php

require_once 'Connection.php';

class Civilities {
    

    
    public function getCivilities() {
        $civilities=array();
        $dbCon= new Connection();
        $conn=$dbCon->OpenCon();
        
        $sql = "SELECT * FROM Civility ";
        $result = mysqli_query($conn, $sql);
        $idx=0;
        if (mysqli_num_rows($result) > 0) {
        
            while($row = mysqli_fetch_assoc($result)) {
                $civilities[$idx]["Civility_id"]=$row["Civility_id"];
                $civilities[$idx]["Name"]=$row["Name"];
                $idx++;
            }
        }
        $dbCon->CloseCon($conn);
        return $civilities;
    }
    

    
   
}

?>