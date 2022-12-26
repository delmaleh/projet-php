<?php
include '../inc/menu.php';
?>
  <script>
        
        
        function validateForm() {
            var title = document.getElementById("title").value;
            var firstname = document.getElementById("firstname").value;
            var lastname = document.getElementById("lastname").value;
            var address = document.getElementById("address").value;
            var postcode = document.getElementById("postcode").value;
            var city = document.getElementById("city").value;
            var phone = document.getElementById("phone").value;
            
            var bValid=true;
        if (firstname.trim()==""){
                document.getElementById("title").focus();
                document.getElementById("errorMsg").innerHTML="please enter a title";
                bValid=false;
        }
        else if (firstname.trim()==""){
                document.getElementById("firstname").focus();
                document.getElementById("errorMsg").innerHTML="please fill your first name";
                bValid=false;
        }
        else if (lastname.trim()==""){
                document.getElementById("lastname").focus();
                document.getElementById("errorMsg").innerHTML="please fill your last name";
                bValid=false;
        }
        else if (address.trim()==""){
                document.getElementById("address").focus();
                document.getElementById("errorMsg").innerHTML="please fill your address";
                bValid=false;
        }
        else if (postcode.trim()==""){
                document.getElementById("postcode").focus();
                document.getElementById("errorMsg").innerHTML="please fill your postcode";
                bValid=false;
        }
        else if (city.trim()==""){
                document.getElementById("city").focus();
                document.getElementById("errorMsg").innerHTML="please fill your city";
                bValid=false;
        }
        else if (phone.trim()==""){
                document.getElementById("phone").focus();
                document.getElementById("errorMsg").innerHTML="please fill your phone";
                bValid=false;
        }
         
 
        return bValid;
        }
        function setAddress() {
            var select = document.getElementById("addressid");
            var value = select.options[select.selectedIndex].value;
            var url="orderAddress.php?addressid="+value;
            document.location.href=url;
        }
    </script>    
<table><tr>
    <td style="text-align:left;width: 700px; padding: 10px 15px 10px 15px; color: #000000;"><h2>My Addresses</h2>
  <?php
  $addressId=0;
  if (isset($_POST["addressid"])) {
    $addressId=$_POST["addressid"];
  }
  else if (isset($_GET["addressid"])) {
    $addressId=$_GET["addressid"];
  }
  $addresses=new Addresses();
  $dbCon= new Connection();
  $address=null;
  $message=null;

 // print_r("addressId".$addressId);
  if ($addressId==-1) {
    $address=$addresses->getAddressEmpty();
    if (isset($_POST["sendAddress"])) {
        //print_r($_POST);
        $conn=$dbCon->OpenCon();
        if ($_POST["default"]==1) {
            $sql="UPDATE ADDRESS SET Default_Address=0 where Customer_id=".$login->userId;
            $result = mysqli_query($conn, $sql);
            $sql=" UPDATE CUSTOMER SET Default_Address=0 where Customer_id=".$login->userId;
            $result = mysqli_query($conn, $sql);
        }
        $sql="INSERT INTO ADDRESS(Address,Postcode,City,First_Name,Last_Name,Title,Default_Address,Customer_id,Country_id,Civility_id,Phone) VALUES('";
        $sql.=str_replace("'","\'",$_POST["address"])."','";
        $sql.=str_replace("'","\'",$_POST["postcode"])."','";
        $sql.=str_replace("'","\'",$_POST["city"])."','";
        $sql.=str_replace("'","\'",$_POST["firstname"])."','";
        $sql.=str_replace("'","\'",$_POST["lastname"])."','";
        $sql.=str_replace("'","\'",$_POST["title"])."','";
        $sql.=str_replace("'","\'",$_POST["default"])."','";
        $sql.=str_replace("'","\'",$login->userId)."','";
        $sql.=str_replace("'","\'",$_POST["countryid"])."','";
        $sql.=str_replace("'","\'",$_POST["civilityid"])."','";
        $sql.=str_replace("'","\'",$_POST["phone"])."')";
        //print_r($sql);
        
        
        $result = mysqli_query($conn, $sql);
        $addressId=mysqli_insert_id($conn);
        $dbCon->CloseCon($conn);
        
        $message="Data updated successfully";
        $address=$addresses->getAddress($addressId);
    }
  }
  else if ($addressId==0) { 
        //on update laddresse principale
//Array ( [addressid] => -1 [title] => [default] => 0 [civilityid] => [firstname] => firstname [lastname] => lastname [address] => [postcode] => [city] => [countryid] => [phone] => [sendAddress] => Apply )

    if (isset($_POST["sendAddress"])) {
        $conn=$dbCon->OpenCon();
        if (isset($_POST["default"])) {
            if ($_POST["default"]==1) {
                $sql="UPDATE ADDRESS SET Default_Address=0 where Customer_id=".$login->userId;
                $result = mysqli_query($conn, $sql);
                $sql=" UPDATE CUSTOMER SET Default_Address=0 where Customer_id=".$login->userId;
                $result = mysqli_query($conn, $sql);
            }
        }
        $sql=" UPDATE CUSTOMER SET First_Name='".str_replace("'","\'",$_POST["firstname"]);
        $sql.="',Last_Name='".str_replace("'","\'",$_POST["lastname"]);
        $sql.="',Phone='".str_replace("'","\'",$_POST["phone"]);
        $sql.="',Address='".str_replace("'","\'",$_POST["address"]);
        $sql.="',City='".str_replace("'","\'",$_POST["city"]);
        $sql.="',Postcode='".str_replace("'","\'",$_POST["postcode"]);
        if (isset($_POST["default"]))
            $sql.="',Default_Address='".str_replace("'","\'",$_POST["default"]);
        $sql.="',Title='".str_replace("'","\'",$_POST["title"]);
        $sql.="',Civility_id='".str_replace("'","\'",$_POST["civilityid"]);
        $sql.="',Country_id='".str_replace("'","\'",$_POST["countryid"])."'";
        $sql.=" where Customer_id=".$login->userId;
        

        $result = mysqli_query($conn, $sql);
        
        $dbCon->CloseCon($conn);
        
        $message="Data updated successfully";
    }
    if (isset($_POST["deleteAddress"])) {
        $sql= "UPDATE CUSTOMER SET First_Name='";
        $sql.="',Last_Name='";
        $sql.="',Phone='";
        $sql.="',Address='";
        $sql.="',City='";
        $sql.="',Postcode='";
        $sql.="',Default_Address='";
        $sql.="',Civility_id='";
        $sql.="',Country_id=''";
        $sql.=" where Customer_id=".$login->userId;
        
        $conn=$dbCon->OpenCon();
        $result = mysqli_query($conn, $sql);
        
        $dbCon->CloseCon($conn);
        
        $message="Data updated successfully";
        
    }     
    $address=$login->getUserAddress($login->userId);
   
  } else {
    if (isset($_POST["sendAddress"])) {
        $conn=$dbCon->OpenCon();
        if (isset($_POST["default"])) {
            if ($_POST["default"]==1) {
                $sql="UPDATE ADDRESS SET Default_Address=0 where Customer_id=".$login->userId;
                $result = mysqli_query($conn, $sql);
                $sql=" UPDATE CUSTOMER SET Default_Address=0 where Customer_id=".$login->userId;
                $result = mysqli_query($conn, $sql);
            }
        }
        $sql= "UPDATE ADDRESS SET First_Name='".str_replace("'","\'",$_POST["firstname"]);
        $sql.="',Last_Name='".str_replace("'","\'",$_POST["lastname"]);
        $sql.="',Phone='".str_replace("'","\'",$_POST["phone"]);
        $sql.="',Address='".str_replace("'","\'",$_POST["address"]);
        $sql.="',City='".str_replace("'","\'",$_POST["city"]);
        $sql.="',Postcode='".str_replace("'","\'",$_POST["postcode"]);
        if (isset($_POST["default"]))
            $sql.="',Default_Address='".str_replace("'","\'",$_POST["default"]);
        $sql.="',Title='".str_replace("'","\'",$_POST["title"]);
        $sql.="',Civility_id='".str_replace("'","\'",$_POST["civilityid"]);
        $sql.="',Country_id='".str_replace("'","\'",$_POST["countryid"])."'";
        $sql.=" where Address_id=".$addressId;
        
        $result = mysqli_query($conn, $sql);
        //$addressId=mysqli_insert_id($conn);
        $dbCon->CloseCon($conn);
        
        $message="Data updated successfully";
        
    }
    if (isset($_POST["deleteAddress"])) {
        $sql= "DELETE FROM ADDRESS";
        $sql.=" where Address_id=".$addressId;
        $conn=$dbCon->OpenCon();
        $result = mysqli_query($conn, $sql);
        //$addressId=mysqli_insert_id($conn);
        $dbCon->CloseCon($conn);
        
        $message="Data updated successfully";
        $addressId=0;
        $address=$login->getUserAddress($login->userId);
    }    
    else
        $address=$addresses->getAddress($addressId);
        
}
  //on recupere toutes les addresses
  $adrs=$addresses->getAddresses($login->userId);
  $civ=new Civilities();
  $civilities=$civ->getCivilities();
  $cty=new Countries();
  $countries=$cty->getCountries();
  
  ?>     
  <form method="post">
  <table  class="table table-borderless">
    <?php if ($addressId!=-1) {?>
    <tr>
        <td> <h4>Address List:</h4></td>
        <td> <select name="addressid" id="addressid"  class="form-select" onChange="setAddress();">
                <option value="0">billing address</option>
    <?php   
         foreach ($adrs as $value){

    ?>
                <option value="<?=$value["address_id"]?>"  <?=$value["address_id"]==$addressId?"selected":""?> ><?=$value["title"]?></option>
    <?php } ?> 
            </select></td>
        
    </tr>
    <tr>
        <td> </td>
        <td style="text-align:right"> <a href="orderAddress.php?addressid=-1">Add an Address</td>
        
    </tr>
    <tr>
    <?php } else { ?>
        <tr>
        <td> </td>
        <td > <input type="hidden" name="addressid" value="-1"/></td>
        
    </tr>
    <?php }?>       
        <td> Title:</td>
        <td> <input type="text" class="form-control" name="title" id="title" value="<?=$address["title"]?>" <?=$addressId==0?"readonly":""?>/></td>
        
    </tr>
    <tr>
        <td> </td>
        <td style="text-align:right"> Choose this address as Default</br><input type="radio"  name="default" id="title" value="1" <?=$address["default_address"]==1?"checked":""?> <?=$address["default_address"]==1?"disabled":""?>/> Oui <input type="radio"  name="default" id="title" value="0" <?=$address["default_address"]==0?"checked":""?> <?=$address["default_address"]==1?"disabled":""?>/> Non</td>
        
    </tr>
    
    <tr>
        <td> Civility:</td>
        <td> <select name="civilityid"   class="form-select">
    <?php   
         foreach ($civilities as $value){

    ?>
                <option value="<?=$value["Civility_id"]?>" <?=$value["Civility_id"]==$address["civility_id"]?"selected":""?> ><?=$value["Name"]?></option>
    <?php } ?>        
            </select>
        </td>
        
    </tr>
    <tr>
        <td> First Name:</td>
        <td> <input type="text" class="form-control" name="firstname" id="firstname" value="<?=$address["first_name"]?>"/></td>
        
    </tr>
    <tr>
        <td> Last Name:</td>
        <td> <input type="text" class="form-control" name="lastname" id="lastname" value="<?=$address["last_name"]?>"/></td>
        
    </tr>
    <tr>
        <td> Address:</td>
        <td> <input type="text" class="form-control" name="address" id="address" value="<?=$address["address"]?>"/></td>
        
    </tr>
    <tr>
        <td> Postcode:</td>
        <td> <input type="text" class="form-control" name="postcode" id="postcode" value="<?=$address["postcode"]?>"/></td>
        
    </tr> 
    <tr>
        <td> City:</td>
        <td> <input type="text" class="form-control" name="city" id="city" value="<?=$address["city"]?>"/></td>
        
    </tr>     
    <tr>
        <td> Country:</td>
        <td> <select name="countryid"   class="form-select">
    <?php   
         foreach ($countries as $value){

    ?>
                <option value="<?=$value["Country_id"]?>" <?=$value["Country_id"]==$address["country_id"]?"selected":""?> ><?=$value["Name"]?></option>
    <?php } ?>        
            </select>
        </td>
        
    </tr>
    <tr>
        <td> Phone:</td>
        <td> <input type="text" class="form-control" name="phone" id="phone" value="<?=$address["phone"]?>"/></td>
        
    </tr> 
    <tr>
        <td></td>
        <td> <span id="errorMsg" style="color:red;"><?=isset($errorMsg)?$errorMsg:""?></span><span id="message" style="color:green;"><?=isset($message)?$message:""?></span></td>
        
    </tr>
    
    <tr>
        <td> </td>
        <td>
        <?php if ($addressId==-1) {?>    
        <input type="button"  value="Back" class="btn btn-primary" onClick="document.location.href='orderAddress.php'" /> 
        <?php } else if ($addressId!=0){?>
        <input type="submit" value="Delete" class="btn btn-primary" name="deleteAddress"  /> 
        <?php }?>
        <input type="submit"  value="Apply" class="btn btn-primary" name="sendAddress" onClick="return validateForm();" />
        <input type="button"  value="Back to Payment"  class="btn btn-primary" onClick="document.location.href='orderDelivery.php'" />
        
        </td>
        
    </tr>
      
    </table>  
    </form>


    </td></tr>
    </table>
    <?php include '../inc/footer.php';?>