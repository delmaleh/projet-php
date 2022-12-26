<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
   
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/animate.css">
    <link rel="stylesheet" href="../assets/css/sina-nav.css">
      
    <title>home</title>
    <style>
    .nav-link {
        color: #007bff;
    }

    .nav-link:hover {
        color: #0a4a7e;x
    }
    .circle {
        width: 20px;
        border-radius: 50%;
        color:white;
		background-color:red;
        font-size: 10px;
		font-family:Arial Black;
        position:absolute;
        right:0;
        top:-10;
        <?=$artCount==0?"visibility:hidden;":""?>
        
      }
      .vertical-menu {
    width: 200px; /* Set a width if you like */
    
  }
  
  .vertical-menu a {
    background-color: #eee; /* Grey background color */
    color: black; /* Black text color */
    display: block; /* Make the links appear below each other */
    padding: 12px; /* Add some padding */
    text-decoration: none!important;  /* Remove underline from links */
  }
  
  .vertical-menu a:hover {
    background-color: #ccc; /* Dark grey background on mouse-over */
  }
  
  .vertical-menu a.active {
    background-color: #04AA6D; /* Add a green color to the "active/current" link */
    color: white;
  }
  
    </style>
     
</head>


<body>

<div width="100%"  align="center">
<div  style="width:700px;">
<table  style="margin-top:20px" border="0" cellspacing="0" cellpadding="0">
<tr><td style="padding-top: 10px;">

<nav class="sina-nav mobile-sidebar navbar-fixed" data-top="0" >


            <div class="collapse navbar-collapse" id="navbar-menu" >
            <ul class="sina-menu sina-menu-left" data-in="fadeInLeft" data-out="fadeInOut">
                <li class='dropdown'>
                <a class='dropdown-toggle' data-toggle='dropdown' href='#'>Category</a><ul class="dropdown-menu">
                
                    <?php echo createMenu(0, $menus); ?>
                </ul>
            </div>
    
            </nav>        

   &nbsp; </td><td >
<form class="d-flex" role="search" action="productSearch.php">
          
 <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search">
  <button class="btn btn-outline-success" type="submit">Search</button>

    </form>
    </td><td style="padding-bottom: 30px;">
    <a class="nav-link" href="basket.php" style="position:relative;"><div style="position:absolute;font-size:25;"><i class="bi bi-cart"></i></div><div class="circle" style="align-items:center;height: 20px;display: flex;justify-content: center;"><?=$artCount==0?"":$artCount?></div></a>
    </td><td style="padding-bottom: 10px;">
    <?php
  if ($login->userId==0) { 
    ?>
  <a class="nav-link" href="login.php"><i class="bi bi-person-circle"></i> my Account</a>
  
  <?php
    } else { 
        ?>
  <a class="nav-link" href="accountClient.php"><div style="font-size:20;display:inline-block;"><i class="bi bi-person-circle" ></i></div> Hello  <?=$login->login()?></a> 
  </td><td style="padding-bottom: 10px;">
  <a class="nav-link" href="?deco">logout</a>
  
  <?php } ?>
  

    </td>
    </tr>
    </table>
