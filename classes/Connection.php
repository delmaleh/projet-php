<?php
class Connection {
    
function OpenCon() {
    $dbhost="localhost";
    $dbuser="daniel";
    $dbpass="daniel6090";
    $db="projet";

 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
 
 return $conn;
}
 
function CloseCon($conn){
 $conn -> close();
 }
}