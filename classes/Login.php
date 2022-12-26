<?php
require_once 'configJWT.php';
require_once 'Connection.php';
require_once 'JWT.php';

class login {
    var $userId = 0;
    var $user= null;
    var $users= array();
    var $erroMsg=null;

    
    private function getUsers() {
        $users=array();
        $dbCon= new Connection();
        $conn=$dbCon->OpenCon();
        
        $sql = "SELECT * FROM users";
        $result = mysqli_query($conn, $sql);
        $idx=0;
        if (mysqli_num_rows($result) > 0) {
        
            while($row = mysqli_fetch_assoc($result)) {
                $users[$idx]["User_id"]=$row["User_id"];
                $users[$idx]["User_Name"]=$row["User_Name"];
                $users[$idx]["Password"]=$row["Password"];
                $idx++;
            }
        }
        $dbCon->CloseCon($conn);
        return $users;
    }
    private function getUser($userId) {
        $user=array();
        $dbCon= new Connection();
        $conn=$dbCon->OpenCon();
        $sql = "SELECT * FROM users where User_id=".$userId;
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
       
            $row = mysqli_fetch_assoc($result); 
                $user["User_id"]=$row["User_id"];
                $user["User_Name"]=$row["User_Name"];
                $user["Password"]=$row["Password"];
                
            
        }
        $dbCon->CloseCon($conn);
        return $user;
    }
    private function getUserByEmail($email) {
        $user=array();
        $dbCon= new Connection();
        $conn=$dbCon->OpenCon();
        $sql = "SELECT * FROM users where User_Name='".$email."'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
       
            $row = mysqli_fetch_assoc($result); 
                $user["User_id"]=$row["User_id"];
                $user["User_Name"]=$row["User_Name"];
                $user["Password"]=$row["Password"];
                
            
        }
        $dbCon->CloseCon($conn);
        return $user;
    }
    

    function login(){
        if ($this->userId)
            return $this->user["User_Name"];
        return null;
    }
    function __construct() {
        //ini_set( "session.gc_maxlifetime",5);
        session_start();
        //google auth
        
        if(isset($_SESSION["userId"])) {
            $this->userId = intval($_SESSION["userId"]);
            $this->user = $this->getUser($this->userId);
 
        } elseif (isset($_COOKIE["token"])) {
            // on recupere le token
            $jwt = new JWT();
            //si bonne signature et pas expire
            if ($jwt->check($_COOKIE["token"],SECRET)&&!$jwt->isExpired($_COOKIE["token"])) {
                $this->user=$jwt->getPayload($_COOKIE["token"]);
                $this->userId = $_SESSION["userId"] = $this->user["User_id"];
            }  
        }   
        if($this->userId == 0) {
            if(isset($_POST["sendLogin"])) {
                $login      = stripcslashes($_POST["login"]);
                $password   = stripcslashes($_POST["password"]);
                $this->user = $this->getUserByEmail($login);
                if (count($this->user)>0) {
                    if(password_verify($password, $this->user["Password"])) {
                        
                        $this->userId = $_SESSION["userId"] = $this->user["User_id"];
                        
                       
                    }
                    else { 
                        $this->errorMsg="password not found";
                        $this->user=null;
                    }    
                }
                else $this->errorMsg="email not found";
                if (isset($_POST["remember"])) {
                    if ($this->userId) {   
                     //on genere le token
                    
                     $header = [
                        'typ' => 'JWT',
                        'alg' => 'HS256'
                    ];
                    
                    // On crée le contenu (payload)
                    $payload = $this->user;
                    
                    $jwt = new JWT();
                    
                    $token = $jwt->generate($header, $payload, SECRET);   
                    setcookie("token",$token,time()+60*60*24);
                    
                    
                    }
                }    
            }
        }   
    }
    function deco() {
        session_destroy();
        $this->userId = 0;
        $this->user=null;
        setcookie("token","");
        header("Location: login.php");
    }
}

?>


