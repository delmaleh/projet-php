<?php
require_once 'Basket.php';
require_once 'Products.php';
class Email {
    
    

    public function createMailOrder() {
       
        $basket = new Basket();
        $articles=$basket->getBasket();
        $html=`<html><body>`;
        $html.=`<table  width="100%">`;
        $total=0;
        foreach ($articles as $value){
            $products= new Products();
            $product=$products->getProduct($value["productid"]);
            $totalProd=$product["Price"]*$value["qty"];
            $total+=$totalProd;
            
            $html.=`<tr>`;
            $html.=`<td>`.$value["qty"]."x".$product["Product_Name"].`</td>`;
            $html.=`<td style="text-align:right;" >`.number_format($totalProd,2).`&nbsp;€</div></td>`;
            $html.=`</tr>`; 
        } 
        $html.=`<tr>`;
        $html.=`<td><b>Total amount</b></td>`;
        $html.=`<td style="text-align:right;"><span style="color:red">`.number_format($total,2).`&nbsp;€</span></td>`;
        $html.=`</tr>`; 
        $html.=`</table>`;   
        $html.=`</body></html>`;   
        return $html; 
    }
   
}

?>