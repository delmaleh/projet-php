<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    <title>Document</title>
</head>

	<style>
    
      .circle {
        width: 30px;
        line-height: 10px;
        border-radius: 50%;
        color:white;
		    background-color:red;
        text-align: center;
        font-size: 10px;
		    font-family:Arial Black;
        position:relative;
        display:inline-block;
        
      }
    
</style>	
<body>
    
</body>
</html>
<div class="dropdown">
	  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
		Dropdown button
	  </button>
	  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
		<li><a class="dropdown-item" href="#">Action</a></li>
		<li><a class="dropdown-item" href="#">Another action</a></li>
		<li><a class="dropdown-item" href="#">Something else here</a></li>
	  </ul>
	</div>



	<div class="circle">15</div>
<?php
 spl_autoload_register(function($className){
    include '../classes/'.$className.'.php';
});
$login = new Customer();
if(isset($_GET["deco"])) {
    $login->deco();    
}
//$basket= new Basket();
//$basket->clearBasket();
//$basket->addBasket('3','7');
//$basket->addBasket('1234','20');
//$basket->addBasket('12346','16');
//$basket->removeBasket('12346');
//print_r($basket->getBasket());
$header = [
  'typ' => 'JWT',
  'alg' => 'HS256'
];

// On crée le contenu (payload)
$payload = [
  'customer_email' => 'delmalehfr@yahoo.fr'
  
];


$jwt = new JWT();

$token = $jwt->generate($header, $payload, SECRET);
print_r($token);
$token='eyJhbGciOiJSUzI1NiIsImtpZCI6IjE3MjdiNmI0OTQwMmI5Y2Y5NWJlNGU4ZmQzOGFhN2U3YzExNjQ0YjEiLCJ0eXAiOiJKV1QifQ.eyJpc3MiOiJodHRwczovL2FjY291bnRzLmdvb2dsZS5jb20iLCJhenAiOiI2Mjg5NDI1MjI3OTYtcTR2NWhkMjMzdmI4dHNuazR0aDdpZmZhZnZjN2VudDguYXBwcy5nb29nbGV1c2VyY29udGVudC5jb20iLCJhdWQiOiI2Mjg5NDI1MjI3OTYtcTR2NWhkMjMzdmI4dHNuazR0aDdpZmZhZnZjN2VudDguYXBwcy5nb29nbGV1c2VyY29udGVudC5jb20iLCJzdWIiOiIxMTU5Mjk1ODUwMjkxNjE1NzgyNjAiLCJlbWFpbCI6ImRlbG1hbGVoZnJAZ21haWwuY29tIiwiZW1haWxfdmVyaWZpZWQiOnRydWUsImF0X2hhc2giOiJ6d094WUtMbjVHQi1IQ3ZaeWFva1p3IiwibmFtZSI6IkRhbmllbCBFbG1hbGVoIiwicGljdHVyZSI6Imh0dHBzOi8vbGgzLmdvb2dsZXVzZXJjb250ZW50LmNvbS9hL0FJdGJ2bW4tMDFVYXlBdHVKTDd6N2p0Ym02YzZrS1piY2tJcmRYaHhIdWdfPXM5Ni1jIiwiZ2l2ZW5fbmFtZSI6IkRhbmllbCIsImZhbWlseV9uYW1lIjoiRWxtYWxlaCIsImxvY2FsZSI6ImZyIiwiaWF0IjoxNjYxMjUyNjcyLCJleHAiOjE2NjEyNTYyNzJ9.wGV4VYBH16VTtVyFx2GLwZmDjJ9NQrdQWiHRI1vJVKTpLzWtPc1IaoKRmeERa3KJoP8M13PA1DnDLlu27gw3x2Y1uDnqQouRUnhp5T5VgMQNeN0kx_6WL_bMWDiW4b5IDZ667uuCf9SHIwnZ1CAU5WvVRGN0jDBnoszA0J3JNxm_Zw9gnhsIl9K0RcuDRvF2Q8ADaAWTLBhtMQn-VhIgxMhRsTEW4PT9jInzTaSGmJ6bofNIb6FVTLasjGzad8gEMeDjYJUgmMzYLc-xX7XUiJVq6-QkHI0_4Ho7rJY5X0RQOwMUR5bwDUyA-7mNDg4m40nfuw5l8N5kJI63J_vUYw';
print_r('test'.var_dump($jwt->check($token,clientSecret)));
?>