<?php
require_once 'Connection.php';

class Addresses {
    

    
    public function getAddresses($custId) {
        $addresses=array();
        $dbCon= new Connection();
        $conn=$dbCon->OpenCon();
        
        $sql = "SELECT * FROM Address where Customer_id=".$custId;
        $result = mysqli_query($conn, $sql);
        $idx=0;
        if (mysqli_num_rows($result) > 0) {
        
            while($row = mysqli_fetch_assoc($result)) {
                $addresses[$idx]["address"]=$row["Address"];
                $addresses[$idx]["postcode"]=$row["Postcode"];
                $addresses[$idx]["city"]=$row["City"];
                $addresses[$idx]["first_Name"]=$row["First_Name"];
                $addresses[$idx]["last_Name"]=$row["Last_Name"];
                $addresses[$idx]["title"]=$row["Title"];
                $addresses[$idx]["default_address"]=$row["Default_Address"];
                $addresses[$idx]["address_id"]=$row["Address_id"];
                $addresses[$idx]["country_id"]=$row["Country_id"];
                $addresses[$idx]["civility_id"]=$row["Civility_id"];
                $addresses[$idx]["customer_id"]=$row["Customer_id"];
                $addresses[$idx]["phone"]=$row["Phone"];
                $idx++;
            }
        }
        $dbCon->CloseCon($conn);
        return $addresses;
    }
    //recupere un array address vide nouvelle address 
    public function getAddressEmpty() {
        $address=array();
        $address["address"]="";
        $address["postcode"]="";
        $address["title"]="";
        $address["default_address"]=0;
        $address["city"]="";
        $address["first_name"]="";
        $address["last_name"]="";
        $address["phone"]="";
        $address["address_id"]=-1;
        $address["country_id"]=-1;
        $address["civility_id"]=-1;   
            
        return $address;
    }
    public function getAddress($addressId) {
        $address=array();
        $dbCon= new Connection();
        $conn=$dbCon->OpenCon();
        
        $sql = "SELECT * FROM Address where Address_id=".$addressId;
        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result) > 0) {
        
            $row = mysqli_fetch_assoc($result);
            $address["address"]=$row["Address"];
            $address["postcode"]=$row["Postcode"];
            $address["title"]=$row["Title"];
            $address["default_address"]=$row["Default_Address"];
            $address["city"]=$row["City"];
            $address["first_name"]=$row["First_Name"];
            $address["last_name"]=$row["Last_Name"];
            $address["phone"]=$row["Phone"];
            $address["address_id"]=$row["Address_id"];
            $address["customer_id"]=$row["Customer_id"];
            $address["country_id"]=$row["Country_id"];
            $address["civility_id"]=$row["Civility_id"];   
            
        }
        $dbCon->CloseCon($conn);
        return $address;
    }
    public function getDefaultAddress($custId) {
        $address=array();
        $dbCon= new Connection();
        $conn=$dbCon->OpenCon();
        
        $sql = "SELECT * FROM Customer where Customer_id=".$custId." And Default_Address=1";
        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result) > 0) {
        
            $row = mysqli_fetch_assoc($result);
            $address["address"]=$row["Address"];
            $address["postcode"]=$row["Postcode"];
            $address["title"]=$row["Title"];
            $address["default_address"]=$row["Default_Address"];
            $address["city"]=$row["City"];
            $address["first_name"]=$row["First_Name"];
            $address["last_name"]=$row["Last_Name"];
            $address["phone"]=$row["Phone"];
            $address["customer_id"]=$row["customer_id"];
            $address["country_id"]=$row["Country_id"];
            $address["civility_id"]=$row["Civility_id"];   
            
        } else {
            $sql = "SELECT * FROM Address where Customer_id=".$custId." And Default_Address=1";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
        
                $row = mysqli_fetch_assoc($result);
                $address["address"]=$row["Address"];
                $address["postcode"]=$row["Postcode"];
                $address["title"]=$row["Title"];
                $address["default_address"]=$row["Default_Address"];
                $address["city"]=$row["City"];
                $address["first_name"]=$row["First_Name"];
                $address["last_name"]=$row["Last_Name"];
                $address["phone"]=$row["Phone"];
                $address["address_id"]=$row["Address_id"];
                $address["customer_id"]=$row["Customer_id"];
                $address["country_id"]=$row["Country_id"];
                $address["civility_id"]=$row["Civility_id"];   
                
            } 
        }


        $dbCon->CloseCon($conn);
        return $address;
    }

    
   
}

?>