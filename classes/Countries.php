<?php
require_once 'Connection.php';

class Countries {
    

    
    public function getCountries() {
        $countries=array();
        $dbCon= new Connection();
        $conn=$dbCon->OpenCon();
        
        $sql = "SELECT * FROM Country ";
        $result = mysqli_query($conn, $sql);
        $idx=0;
        if (mysqli_num_rows($result) > 0) {
        
            while($row = mysqli_fetch_assoc($result)) {
                $countries[$idx]["Country_id"]=$row["Country_id"];
                $countries[$idx]["Name"]=$row["Name"];
                $idx++;
            }
        }
        $dbCon->CloseCon($conn);
        return $countries;
    }
    

    
   
}

?>