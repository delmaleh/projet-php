<?php

require_once 'configJWT.php';
require_once 'Connection.php';
require_once 'JWT.php';
require_once 'configGoogle.php';


class Customer {
    var $userId = 0;
    var $user= null;
    var $users= array();
    var $erroMsg=null;

    public function createGoogleUser($user){
        $dbCon= new Connection();
        $conn=$dbCon->OpenCon();
        $sql= "INSERT INTO CUSTOMER(customer_email,first_name,last_name,google_id) VALUES('";
        
        $sql.=$user["email"]."','";
        $sql.=$user["givenName"]."','";
        $sql.=$user["familyName"]."','";
        $sql.=$user["id"]."')";
        
        $result = mysqli_query($conn, $sql);
        $dbCon->CloseCon($conn);
    }
    public function getUserAddress($customerId) {
        $user=array();
        $dbCon= new Connection();
        $conn=$dbCon->OpenCon();
        $sql = "SELECT * FROM customer where customer_id=".$customerId;
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
       
            $row = mysqli_fetch_assoc($result); 
               
                $user["first_name"]=$row["First_Name"];
                $user["last_name"]=$row["Last_Name"];
                $user["address"]=$row["Address"];
                $user["postcode"]=$row["Postcode"];
                $user["title"]=$row["Title"];
                $user["default_address"]=$row["Default_Address"];
                $user["city"]=$row["City"];
                $user["country_id"]=$row["Country_id"];
                $user["civility_id"]=$row["Civility_id"];
                $user["phone"]=$row["Phone"];
        }
        $dbCon->CloseCon($conn);
        return $user;
    }
    
    private function getUser($customerId) {
        $user=array();
        $dbCon= new Connection();
        $conn=$dbCon->OpenCon();
        $sql = "SELECT * FROM customer where customer_id=".$customerId;
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
       
            $row = mysqli_fetch_assoc($result); 
                $user["customer_id"]=$row["customer_id"];
                $user["customer_email"]=$row["Customer_Email"];
                $user["password"]=$row["Password"];
                $user["first_name"]=$row["First_Name"];
                $user["last_name"]=$row["Last_Name"];
                $user["phone"]=$row["Phone"];
                $user["google_id"]=$row["Google_id"];
                
        }
        $dbCon->CloseCon($conn);
        return $user;
    }
    private function getUserByEmail($email) {
        $user=array();
        $dbCon= new Connection();
        $conn=$dbCon->OpenCon();
        $sql = "SELECT * FROM customer where customer_email='".$email."'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
       
            $row = mysqli_fetch_assoc($result); 
                $user["customer_id"]=$row["customer_id"];
                $user["customer_email"]=$row["Customer_Email"];
                $user["password"]=$row["Password"];
                $user["first_name"]=$row["First_Name"];
                $user["last_name"]=$row["Last_Name"];
                $user["phone"]=$row["Phone"];
                $user["google_id"]=$row["Google_id"];            
            
        }
        $dbCon->CloseCon($conn);
        return $user;
    }
    

    function login(){
        if ($this->userId)
            return $this->user["first_name"];
        return null;
    }
    function __construct() {
        //ini_set( "session.gc_maxlifetime",5);
        session_start();
        //google
        if (isset($_GET['code'])) {
            // create Client Request to access Google API
            $client = new Google_Client();
            $client->setClientId(clientID);
            $client->setClientSecret(clientSecret);
            $client->setRedirectUri(redirectUri);
            $client->addScope("email");
            $client->addScope("profile");
            $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
            $client->setAccessToken($token['access_token']);
            //print_r("accesstoken:".$token['access_token']);
            //print_r("idtoken:".$token['id_token']);
            // get profile info
            $google_oauth = new Google_Service_Oauth2($client);
            $google_account_info = $google_oauth->userinfo->get();
            $this->user = $this->getUserByEmail($google_account_info['email']);
            print_r("gender:".$google_account_info['gender']);  
            if (!$this->user) {
                $this->createGoogleUser($google_account_info);
                $this->user = $this->getUserByEmail($google_account_info['email']);
                $this->userId = $_SESSION["CustomerId"] = $this->user["customer_id"];
            } 
            else {
                $this->userId = $_SESSION["CustomerId"] = $this->user["customer_id"];
            }        
            //on genere le token   
            $header = [
                   'typ' => 'JWT',
                   'alg' => 'HS256'
            ];   
            // On crée le contenu (payload)
            $payload = [
                   'customer_email' => $this->user['customer_email']
                   
            ];   
            $jwt = new JWT();
            $token = $jwt->generate($header, $payload, SECRET,60*60*24);   
            $_SESSION["tokenG"]=$token;
        }  
        elseif (isset($_SESSION["tokenG"])){
            $jwt = new JWT();
            //si bonne signature et pas expire
            //print_r($_SESSION["tokenG"]);
            if ($jwt->check($_SESSION["tokenG"],SECRET)&&!$jwt->isExpired($_SESSION["tokenG"])) {
                
                $payload=$jwt->getPayload($_SESSION["tokenG"]);
                $this->user = $this->getUserByEmail($payload["customer_email"]);
                $this->userId = $_SESSION["CustomerId"] = $this->user["customer_id"];
            }  
        } 
        
        elseif(isset($_SESSION["CustomerId"])) {
            $this->userId = intval($_SESSION["CustomerId"]);
            $this->user = $this->getUser($this->userId);
 
        } elseif (isset($_COOKIE["tokenC"])) {
            // on recupere le token
            $jwt = new JWT();
            //si bonne signature et pas expire
            if ($jwt->check($_COOKIE["tokenC"],SECRET)&&!$jwt->isExpired($_COOKIE["tokenC"])) {
                
                $payload=$jwt->getPayload($_COOKIE["tokenC"]);
                $this->user = $this->getUserByEmail($payload["customer_email"]);
                $this->userId = $_SESSION["CustomerId"] = $this->user["customer_id"];
            }  
        }   
        if($this->userId == 0) {
            if(isset($_POST["sendLogin"])) {
                $login      = stripcslashes($_POST["email"]);
                $password   = stripcslashes($_POST["password"]);
                $this->user = $this->getUserByEmail($login);
                if (count($this->user)>0) {
                    if(password_verify($password, $this->user["password"])) {
                        
                        $this->userId = $_SESSION["CustomerId"] = $this->user["customer_id"];
                        
                       
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
                    $payload = [
                        'customer_email' => $this->user['customer_email']
                        
                    ];
                    
                    
                    $jwt = new JWT();
                    
                    $token = $jwt->generate($header, $payload, SECRET);   
                    setcookie("token",$tokenC,time()+60*60*24);
                    
                    
                    }
                }    
            }
        }   
    }
    function deco() {
        session_destroy();
        $_SESSION["CustomerId"]=null;
        $this->userId = 0;
        $this->user=null;
        setcookie("token","");
        header("Location: login.php");
    }
}

?>
