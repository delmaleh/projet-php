<?php
require_once 'Connection.php';
class Products {
    

    
    
    
    public function getProductsByName($search) {
        $products=array();
        $dbCon= new Connection();
        $conn=$dbCon->OpenCon();
        
        $sql = "SELECT * FROM product WHERE Product_Name LIKE '%".$search."%' and Stock>0";
        $result = mysqli_query($conn, $sql);
        $idx=0;
        if (mysqli_num_rows($result) > 0) {
        
            while($row = mysqli_fetch_assoc($result)) {
                $products[$idx]["Product_id"]=$row["Product_id"];
                $products[$idx]["Product_Name"]=$row["Product_Name"];
                $products[$idx]["Image1"]=$row["Image1"];
                $products[$idx]["Image2"]=$row["Image2"];
                $products[$idx]["Image3"]=$row["Image3"];
                $products[$idx]["Price"]=$row["Price"];
                $products[$idx]["Stock"]=$row["Stock"];
                $products[$idx]["Product_Description"]=$row["Product_Description"];
                $products[$idx]["Category_id"]=$row["Category_id"];
                
                $idx++;
            }
        }
        $dbCon->CloseCon($conn);
        return $products;
    }
    
    
public function getParentProducts($parentcatid) {
    $products=array();
    $dbCon= new Connection();
    $conn=$dbCon->OpenCon();
    
    $sql = "SELECT * FROM Product,Category 
        where Category.Category_id=Product.Category_id and Stock>0 and Parent_id=".$parentcatid;
    $result = mysqli_query($conn, $sql);
    $idx=0;
    if (mysqli_num_rows($result) > 0) {
    
        while($row = mysqli_fetch_assoc($result)) {
            $products[$idx]["Product_id"]=$row["Product_id"];
            $products[$idx]["Product_Name"]=$row["Product_Name"];
            $products[$idx]["Image1"]=$row["Image1"];
            $products[$idx]["Image2"]=$row["Image2"];
            $products[$idx]["Image3"]=$row["Image3"];
            $products[$idx]["Price"]=$row["Price"];
            $products[$idx]["Stock"]=$row["Stock"];
            $products[$idx]["Product_Description"]=$row["Product_Description"];
            $products[$idx]["Category_id"]=$row["Category_id"];
            
            $idx++;
        }
    }
    $dbCon->CloseCon($conn);
    return $products;
}
    public function getProducts($catid) {
        $products=array();
        $dbCon= new Connection();
        $conn=$dbCon->OpenCon();
        
        $sql = "SELECT * FROM Product where Category_id=".$catid." and Stock>0";
        $result = mysqli_query($conn, $sql);
        $idx=0;
        if (mysqli_num_rows($result) > 0) {
        
            while($row = mysqli_fetch_assoc($result)) {
                $products[$idx]["Product_id"]=$row["Product_id"];
                $products[$idx]["Product_Name"]=$row["Product_Name"];
                $products[$idx]["Image1"]=$row["Image1"];
                $products[$idx]["Image2"]=$row["Image2"];
                $products[$idx]["Image3"]=$row["Image3"];
                $products[$idx]["Price"]=$row["Price"];
                $products[$idx]["Stock"]=$row["Stock"];
                $products[$idx]["Product_Description"]=$row["Product_Description"];
                $products[$idx]["Category_id"]=$row["Category_id"];
                
                $idx++;
            }
        }
        $dbCon->CloseCon($conn);
        return $products;
    }
    
    public function getProduct($prodid) {
        $product=array();
        $dbCon= new Connection();
        $conn=$dbCon->OpenCon();
        
        $sql = "SELECT * FROM Product Where Product_id=".$prodid;
        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result) > 0) {
        
            $row = mysqli_fetch_assoc($result); 
            $product["Product_id"]=$row["Product_id"];
            $product["Product_Name"]=$row["Product_Name"];
            $product["Image1"]=$row["Image1"];
            $product["Image2"]=$row["Image2"];
            $product["Image3"]=$row["Image3"];
            $product["Price"]=$row["Price"];
            $product["Stock"]=$row["Stock"];
            $product["Product_Description"]=$row["Product_Description"];
            $product["Category_id"]=$row["Category_id"];
            
                
            
        }
        $dbCon->CloseCon($conn);
        return $product;
    }

    
   
}

?>