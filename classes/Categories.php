<?php
require_once 'Connection.php';

class Categories {
    

    
    public function getCategories() {
        $cats=array();
        $dbCon= new Connection();
        $conn=$dbCon->OpenCon();
        
        $sql = "SELECT * FROM Category ";
        $result = mysqli_query($conn, $sql);
        $idx=0;
        if (mysqli_num_rows($result) > 0) {
        
            while($row = mysqli_fetch_assoc($result)) {
                $cats[$idx]["Category_id"]=$row["Category_id"];
                $cats[$idx]["Category_Name"]=$row["Category_Name"];
                $cats[$idx]["Category_Image"]=$row["Category_Image"];
                $cats[$idx]["Category_Description"]=$row["Category_Description"];
                $cats[$idx]["Parent_id"]=$row["Parent_id"];
                $idx++;
            }
        }
        $dbCon->CloseCon($conn);
        return $cats;
    }

    
    
    public function getParentCategories($parent) {
        $cats=array();
        $dbCon= new Connection();
        $conn=$dbCon->OpenCon();
        
        $sql = "SELECT * FROM Category where Parent_id=".$parent;
        $result = mysqli_query($conn, $sql);
        $idx=0;
        if (mysqli_num_rows($result) > 0) {
        
            while($row = mysqli_fetch_assoc($result)) {
                $cats[$idx]["Category_id"]=$row["Category_id"];
                $cats[$idx]["Category_Name"]=$row["Category_Name"];
                $cats[$idx]["Category_Image"]=$row["Category_Image"];
                $cats[$idx]["Category_Description"]=$row["Category_Description"];
                $cats[$idx]["Parent_id"]=$row["Parent_id"];
                $idx++;
            }
        }
        $dbCon->CloseCon($conn);
        return $cats;
    }
    
    public function getCategory($catid) {
        $cats=array();
        $dbCon= new Connection();
        $conn=$dbCon->OpenCon();
        
        $sql = "SELECT * FROM Category Where Category_id=".$catid;
        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result) > 0) {
        
            $row = mysqli_fetch_assoc($result); 
                $cats["Category_id"]=$row["Category_id"];
                $cats["Category_Name"]=$row["Category_Name"];
                $cats["Category_Image"]=$row["Category_Image"];
                $cats["Category_Description"]=$row["Category_Description"];
                
            
        }
        $dbCon->CloseCon($conn);
        return $cats;
    }

    
   
}

?>