<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    
    <!--For Plugins css-->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/animate.css">
    <link rel="stylesheet" href="../assets/css/sina-nav.css">
   <style>
    .nav-link {
        color: #007bff;
    }

    .nav-link:hover {
        color: #0a4a7e;x
    }   
    </style>
    <title>Dynamic bootstrap sticky navbar</title>
</head>

<body>
<style>


</style>
<div width="100%"  align="center">
<table witdh="100%" style="margin-top:20px" border="0" cellspacing="0" cellpadding="0">
<tr><td>
    <nav class="sina-nav mobile-sidebar navbar-fixed" data-top="0" >


            <div class="collapse navbar-collapse" id="navbar-menu" >
            <ul class="sina-menu sina-menu-left" data-in="fadeInLeft" data-out="fadeInOut">
                <li class='dropdown'>
                <a class='dropdown-toggle' data-toggle='dropdown' href='#'>Category</a><ul class="dropdown-menu">
                
                    <li >
                         <a  href='cat.php?cat=5'>Ordinateur tablette</a>
                     </li><li class='dropdown'>
                  <a  href='cat.php?cat=6'>PC gamer</a><ul class="dropdown-menu"><li >
                         <a  href='cat.php?cat=12'>test</a>
                     </li></ul></li>                </ul>
            </div>
           
</td><td>      
 <form class="d-flex" role="search" action="productSearch.php" >
        
 &nbsp;<input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search">
        &nbsp;&nbsp;<button class="btn btn-outline-success" type="submit">Search</button>

    </form>
    </td><td>
    <a class="nav-link" href="basket.php" style="position:relative;"><div style="position:absolute;font-size:25px;"><i class="bi bi-cart"></i></div><div class="circle" style="align-items:center;height: 30px;display: flex;justify-content: center;"></div></a>
    </td><td>
  <a class="nav-link" href="login.php"><i class="bi bi-person-circle"></i> my Account</a>
 </td><td>
  <a class="nav-link" href="accountClient.php"><div style="font-size:20px;"><i class="bi bi-person-circle" ></i></div> Hello </a> 
</td><td>
  <a class="nav-link" href="?deco">logout</a>
 
  
    </nav>
</td></tr></table>
    <div class="container" style="padding-top: 70px; padding-bottom:40px;">
        <div class="row">
            
        </div>
    </div>

   


    <!-- JS files -->
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/wow.min.js"></script>
    <script src="../assets/js/sina-nav.js"></script>

    <!-- For All Plug-in Activation & Others -->
   
</body>