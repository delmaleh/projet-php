<?php
require_once 'Basket.php';
require_once 'Products.php';
require_once 'Connection.php';
class Order {
    
    

    public function create($custid) {
        $basket = new Basket();
        $articles=$basket->getBasket();
        $total=0;
        $dbCon= new Connection();
        $conn=$dbCon->OpenCon();
        $sql= "INSERT INTO orders(Customer_id) values('".$custid."')";
        $result = mysqli_query($conn, $sql);
        $orderId=mysqli_insert_id($conn);
        foreach ($articles as $value){
            $products= new Products();
            $product=$products->getProduct($value["productid"]);
            $totalProd=$product["Price"]*$value["qty"];
            $stock=$product["Stock"]-$value["qty"];
            $sql= "UPDATE product SET Stock='".$stock."' where Product_id=".$value["productid"];    
            $result = mysqli_query($conn, $sql);
            $sql= "INSERT INTO order_details(Order_id,Product_id,Product_qty,Product_Price,Subtotal) VALUES('";
            $sql.=$orderId."','";
            $sql.=$value["productid"]."','";
            $sql.=$value["qty"]."','";
            $sql.=$product["Price"]."','";
            $sql.=$totalProd."')";
            $result = mysqli_query($conn, $sql);    
            $total+=$totalProd;
        }
        $sql= "UPDATE orders SET Order_Total='".$total."' where Order_id=".$orderId;
        $result = mysqli_query($conn, $sql);
        $dbCon->CloseCon($conn);   
        return $orderId; 
    }
   
}

?>