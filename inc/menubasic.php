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
                         <a  href='category.php?cat=".$itemId."'>" . $menu['items'][$itemId]['Category_Name'] . "</a>
                     </li>";
            }
            if (isset($menu['parents'][$itemId])) {
                //class='dropdown-toggle' data-toggle='dropdown'
                $html .= "<li class='dropdown'>
                  <a  href='category.php?parent=".$itemId."'>" . $menu['items'][$itemId]['Category_Name'] .  "</a>";
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



$login = new Customer();
if(isset($_GET["deco"])) {
    $login->deco();    
}
if($login->userId==0) {
  
  header("Location: login.php");    
  
}
$basket = new Basket();
    
$artCount= $basket->getArticleCount();
?>