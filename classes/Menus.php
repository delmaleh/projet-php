<?php

require_once 'Connection.php';

class Menus {
    

    
    public function createMenu($menu) {
        $dbCon= new Connection();
        $conn=$dbCon->OpenCon();
        
        $sql = "Insert into menus(parent,link,label) values('{$menu['parent']}','{$menu['link']}','{$menu['label']}')";
        $result = mysqli_query($conn, $sql);
       
        $dbCon->CloseCon($conn);
        
    }
    public function getMenu($id) {
        $menu=array();
        $dbCon= new Connection();
        $conn=$dbCon->OpenCon();
        $sql= "select * from menus where id='".$id."'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) 
            $menu= mysqli_fetch_assoc($result); 
        $dbCon->CloseCon($conn);
        return $menu;
    }

    public function getMenus($parentid) {
        $menu=array();
        $dbCon= new Connection();
        $conn=$dbCon->OpenCon();
        $sql= "select * from menus where parent='".$parentid."'";
        $result = mysqli_query($conn, $sql);
        $idx=0;
        if (mysqli_num_rows($result) > 0) {
        
            while($row = mysqli_fetch_assoc($result)) {
                $menu[$idx]["parent"]=$row["parent"];
                $menu[$idx]["link"]=$row["link"];
                $menu[$idx]["label"]=$row["label"];
                $menu[$idx]["id"]=$row["id"];
                $idx++;
            }
        } 
        $dbCon->CloseCon($conn);
        return $menu;
    }


    public function setMenu($menu) {
        $dbCon= new Connection();
        $conn=$dbCon->OpenCon();
        $sql= "update menus set label='{$menu['label']}',link='{$menu['link']}' where id='".$menu['id']."' and parent='".$menu['parent']."'";
        $result = mysqli_query($conn, $sql);
        $dbCon->CloseCon($conn);
    }

    

    
   
}