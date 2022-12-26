<?php
 spl_autoload_register(function($className){
    include '../classes/'.$className.'.php';
});

$parent_id=-1;
$id=-1;
$cats= new Menus();
if (isset($_POST['sendCat'])) {
    
    $parent_id=$_POST['parent_id'];
    if ($parent_id==-1)
        $cats->createMenu(array(
            'parent' => $_POST['id'],
            'link' => $_POST['link'],
            'label' => $_POST['label'],
        ));
    else 
        $cats->setMenu(array(
            'parent' => $_POST['parent_id'],
            'link' => $_POST['link'],
            'label' => $_POST['label'],
            'id' => $_POST['id'],
        ));    
}


if (isset($_GET['parent_id']))
    $parent_id=$_GET['parent_id'];
if (isset($_GET['id']))
    $id=$_GET['id'];
if ($parent_id!=-1)    
    $cats->getMenu($id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" >
    <title>Document</title>
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

</head>
<body>
<?php
 spl_autoload_register(function($className){
    include '../classes/'.$className.'.php';
});

// function to create dynamic treeview menus
function createTreeView($parent, $menu) {
   $html = "";
   if ($parent==0) {
    $html .= "
    <ol class='tree'>";
    $html .= "<li><label for='subfolder2'><a href='?id=0'>Category</a></label> <input type='checkbox' name='subfolder2'/></li>";
            
   }
   if (isset($menu['parents'][$parent])) {
      $html .= "
      <ol class='tree'>";
       foreach ($menu['parents'][$parent] as $itemId) {
          if(!isset($menu['parents'][$itemId])) {
             $html .= "<li><label for='subfolder2'><a href='test.php?parent_id=".$parent."&id=".$itemId."'>".$menu['items'][$itemId]['label']."</a></label> <input type='checkbox' name='subfolder2'/></li>";
             //$html .= "<li><label for='subfolder2'><a href='test.php?id=".$itemId."'>"."?"."</a></label> <input type='checkbox' name='subfolder2'/></li>";
         
            }
          if(isset($menu['parents'][$itemId])) {
             $html .= "<li><label for='subfolder2'><a href='test.php?parent_id=".$parent."&id=".$itemId."'>".$menu['items'][$itemId]['label']."</a></label> <input type='checkbox' name='subfolder2'/>";
             //$html .= "<li><label for='subfolder2'><a href='test.php?id=".$itemId."'>"."?"."</a></label> <input type='checkbox' name='subfolder2'/>";
             $html .= createTreeView($itemId, $menu);
             $html .= "</li>";
          }
       }
       $html .= "</ol>";
   }
   return $html;
}


$dbCon= new Connection();
$conn=$dbCon->OpenCon();
        

$sql = "SELECT id, label, link, parent FROM menus ORDER BY parent, sort, label";
$result = mysqli_query($conn, $sql); 
// Create an array to conatin a list of items and parents
$menus = array(
	'items' => array(),
	'parents' => array()
);
// Builds the array lists with data from the SQL result
while ($items = mysqli_fetch_assoc($result)) {
	// Create current menus item id into array
	$menus['items'][$items['id']] = $items;
	// Creates list of all items with children
	$menus['parents'][$items['parent']][] = $items['id'];
}

//print_r($menus);
// Print all tree view menus 
echo "<div style='display:inline-block;overflow-y:auto;height:100%;'>".createTreeView(0, $menus)."</div>";

$menuList=$cats->getMenus($id);
?>
<div style='display:inline-block;'>
    <a href='?id=<?=$id?>'>Add a category</a>
    <table>
        <tr>
            <td>Label</td>
            <td>Link</td>
        </tr> 
        <?php foreach ($menuList as $value){ ?>
            <tr>
            <td><?=$value['label']?></td>
            <td><?=$value['link']?></td>
        </tr> 
        <?php } ?>
    </table>       
</div>    
 <div class="myForm" style="display:inline-block;position:relative">
    <?=$parent_id==-1?'Add a category':''?>        
    <form method="post">
        <label>Label</label>
        <input type="text" name="label" id="label" value="<?=isset($menu['label'])?$menu['label']:''?>"/>
        <label>Link</label>
        <input type="text" name="link" id="link" value="<?=isset($menu['link'])?$menu['link']:''?>"/>
        <span id="errorMsg"></span>
        <input type="hidden" name="id" id="id" value="<?=$id?>"/>
        <input type="hidden" name="parent_id" id="parent_id" value="<?=$parent_id?>"/>
        <input type="submit" class="btn btn-primary btn-block mb-4"  value="Apply" name="sendCat" onClick="return validateForm();" />
        
    </form>
    
</div>    
   
</body>
</html>