<?php


class Basket {
    
    public function getBasket() {
        $basket=array();
        if (isset($_SESSION["basket"])) 
            $basket=$_SESSION["basket"];
        return $basket;
    }
    public function getArticleCount() {
        $articles=0;
        if (isset($_SESSION["basket"])) {
            $basket=$_SESSION["basket"];
            foreach ($basket as $value) 
             $articles+=$value["qty"];
        }
        return $articles;    
    }

    public function clearBasket(){
        $_SESSION["basket"]=null;
    }

    public function addBasket($prodid,$qty,$bReset) {
        if (isset($_SESSION["basket"])) {
            $basket=$_SESSION["basket"];
            //$basket=array(array('1234','567'),array('12345','5678'));
            //$prodid=1234;
            $idx=array_search($prodid,array_column($basket, "productid"));
            //print_r("test:".var_dump($idx));
            if ($idx===false) {
                $basket[]=array("productid"=>$prodid,"qty"=>$qty);
            }
            else {
                //print_r($basket[$idx]["qty"]);
                if ($bReset)
                    $basket[$idx]["qty"]=$qty;
                else
                    $basket[$idx]["qty"]+=$qty;
            }
            $_SESSION["basket"]=$basket;
        }
        else {
            $basket[0]=array("productid"=>$prodid,"qty"=>$qty);
            $_SESSION["basket"]=$basket;
        }
        
    }
    public function removeBasket($prodid){
        if (isset($_SESSION["basket"])) {
            $basket=$_SESSION["basket"];
            $idx=array_search($prodid,array_column($basket, "productid"));
            
            if ($idx!==false) {
                //print_r("test:".var_dump($idx));
                \array_splice($basket,$idx,1);
                $_SESSION["basket"]=$basket;
            }
        }    
    }

    
   
}

?>