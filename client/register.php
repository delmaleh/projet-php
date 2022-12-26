<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <title>register</title>   
    <style>
        .myForm {
            width:100%;
            max-width: 300px;
            margin:auto;
        }
        .myForm input {
            width:95%;
            margin:auto;
        }
        .myForm table {
            width:95%;
            margin:auto;
            
        }
        .myForm span {
            width:95%;
            margin:auto;
            color:red;
        }
        .myForm p {
          width:60%;
            margin:auto;
            
        }
        .myForm input[type=checkbox] {
            width:auto;
            margin:auto;
            
        }
    </style>
    <script>
        function validateForm() {
            var email = document.getElementById("email").value;
            var pwd=document.getElementById("password").value;
            var firstname=document.getElementById("firstname").value;
            var lastname=document.getElementById("lastname").value;
            var phone=document.getElementById("phone").value;
            var bValid=true;
        if (!String(email)
            .toLowerCase()
            .match(
            /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
            )){
                document.getElementById("errorMsg").innerHTML="please enter a valid email";
                document.getElementById("email").focus();
                bValid=false;
            }
        
        else if (firstname.trim()=="") {
            document.getElementById("firstname").focus();   
            document.getElementById("errorMsg").innerHTML="please fill your First Name";
            bValid=false; 
        }   
        else if (lastname.trim()=="") {   
            document.getElementById("lastname").focus();
            document.getElementById("errorMsg").innerHTML="please fill your Last Name";
            bValid=false; 
        }   
        else if (phone.trim()=="") {
            document.getElementById("phone").focus();   
            document.getElementById("errorMsg").innerHTML="please fill your phone";
            bValid=false; 
        }   
        else if (pwd.trim()=="") {   
            document.getElementById("password").focus();
            document.getElementById("errorMsg").innerHTML="please fill your password";
            bValid=false; 
        }     
        return bValid;
        }
    </script>    
    
</head>
<body>
<div class="myForm">
    <form method="post" action="insertCustomer.php">
        <label>Email</label>
        <input type="text" name="email" id="email" value=""/>
        <label>First Name</label>
        <input type="text" name="firstname" id="firstname" value=""/>
        <label>Last Name</label>
        <input type="text" name="lastname" id="lastname" value=""/>
        <label>Phone Number</label>
        <input type="text" name="phone" id="phone" value=""/>
        
        <label>Password</label>
        <input type="password" name="password" id="password" value=""/>
    </br>
        <span id="errorMsg"></span>
        </br>
        <input type="submit" class="btn btn-primary btn-block mb-4" value="Sign in" name="sendLogin" onClick="return validateForm();" />
         
    </form>
   
</div>    
 

</body>
</html>