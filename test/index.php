<?php
spl_autoload_register(function($className){
    include '../classes/'.$className.'.php';
});
function createMenu($parent, $menu)
{
    $html = "";
    if (isset($menu['parents'][$parent])) {
        foreach ($menu['parents'][$parent] as $itemId) {
            if (!isset($menu['parents'][$itemId])) {
                $html .= "<li >
                         <a  href='cat.php?cat=".$itemId."'>" . $menu['items'][$itemId]['Category_Name'] . "</a>
                     </li>";
            }
            if (isset($menu['parents'][$itemId])) {
                //class='dropdown-toggle' data-toggle='dropdown'
                $html .= "<li class='dropdown'>
                  <a  href='cat.php?parent=".$itemId."'>" . $menu['items'][$itemId]['Category_Name'] .  "</a>";
                $html .= '<ul class="dropdown-menu">';
                $html .= createMenu($itemId, $menu);
                $html .= '</ul>';

                $html .= "</li>";
            }
        }
        
    }
    return $html;
}

$dbCon= new Connection();
$conn=$dbCon->OpenCon();
        


$sql = "SELECT * FROM category ORDER BY parent_id, category_name";
$result = mysqli_query($conn, $sql); 
// Create an array to conatin a list of items and parents
$menus = array(
	'items' => array(),
	'parents' => array()
);
// Builds the array lists with data from the SQL result
while ($items = mysqli_fetch_assoc($result)) {
	// Create current menus item id into array
	$menus['items'][$items['Category_id']] = $items;
	// Creates list of all items with children
	$menus['parents'][$items['Parent_id']][] = $items['Category_id'];
}


?>

<!doctype html>
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
                
                    <?php echo createMenu(0, $menus); ?>
                </ul>
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
   

   


    <!-- JS files -->
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/wow.min.js"></script>
    <script src="../assets/js/sina-nav.js"></script>

    <!-- For All Plug-in Activation & Others -->
   
</body>

</html>