<?php
spl_autoload_register(function($className){
    include 'classes/'.$className.'.php';
});
$login = new login();
//if(isset($_GET["deco"])) {
//    $login->deco();    
//}
//if($login->userId == 0) { 
//    $login->deco();
//} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <title>Category</title>
    <script>
    function setCategory() {
            var select = document.getElementById("cat");
            var value = select.options[select.selectedIndex].value;
            
            var url="?cat="+value;
            document.location.href=url;
    }
    function addSubcategory() {
            var select = document.getElementById("cat");
            var value = select.options[select.selectedIndex].value;
            if (value==0){
              alert("Please select a category");
            }else {
                var url="addCategory.php?parent="+value;
                document.location.href=url;
            }
    }
    function removeCategory(id){
            var select = document.getElementById(id);
            var value = select.options[select.selectedIndex].value;
            
            if (value==0){
              alert("Please select a "+id+"egory");
            }else {
                var selectSub = document.getElementById('subcat');
                if (selectSub.options.length>1&&id=='cat') {
                    var bconf=confirm("you are about to remove a category with subcategories,are you sure? ");
                    if (bconf) {
                        var url="deleteCategory.php?cat="+value;
                        document.location.href=url;
                    }
                }
                else {
                    var url="deleteCategory.php?cat="+value;
                    document.location.href=url;
                }
                
            }
    }
    function updateCategory(id){
            var select = document.getElementById(id);
            var value = select.options[select.selectedIndex].value;
            
            if (value==0){
              alert("Please select a "+id+"egory");
            }else {
                
                    var url="addCategory.php?cat="+value;
                    document.location.href=url;
                
                
            }
    }
    function addProduct() {
            var select = document.getElementById('subcat');
            var value = select.options[select.selectedIndex].value;
            if (value==0){
              alert("Please select a subcategory");
            }else {
                
                    var url="product.php?cat="+value;
                    document.location.href=url;
                
                
            }
    }
            
    </script>    
</head>
<body>
    
<div align="center" width="100%">

<div  style="width:400px;">


        <table class="table table-borderless" width="100%">
        <tr><td colspan="2"><h4>Category</h4></td></tr>
        <tr>
            <td> Category: <br><a href="addCategory.php?parent=0">Add a category</a></td>
             
            <td>        <select name="cat" id="cat"  class="form-select" onChange="setCategory();"> <option value="0">Please select a category</option>
    <?php
$catid=-1;

if (isset($_GET["cat"])) $catid=$_GET["cat"];
$cat = new Categories();
$categories=$cat->getParentCategories(0);
  
         foreach ($categories as $value){

    ?>
                <option value="<?=$value["Category_id"]?>"  <?=$value["Category_id"]==$catid?"selected":""?> ><?=$value["Category_Name"]?></option>
    <?php } ?> 
            </select></td>
        </tr> 
        <tr>
            <td colspan="2" style="vertical-align: text-top;text-align:right;">
                <div align="right">
                <table >
                    <tr>
                    <td><button type="button" class="btn btn-secondary" onClick="removeCategory('cat');">Remove</button></td>    
                    <td width="70px">
                    <button type="button" class="btn btn-secondary" onClick="updateCategory('cat');">Update</button>
                    </td></tr> 
                </table> 
            </div>      
            </td>
        </tr>    
        <tr>
            <td> Subcategory: <br><a href="#" onClick="addSubcategory();">Add a subcategory</a></td>
            <td>        <select name="subcat" id="subcat"  class="form-select" > <option value="0">Please select a subcategory</option>
    <?php

$categories=$cat->getParentCategories($catid);
  
         foreach ($categories as $value){

    ?>
                <option value="<?=$value["Category_id"]?>"   ><?=$value["Category_Name"]?></option>
    <?php } ?> 
            </select></td>
        </tr> 
        <tr>
            <td colspan="2" style="vertical-align: text-top;text-align:right;">
                <div align="right">
                <table >
                    <tr>
                    <td><button type="button" class="btn btn-secondary" onClick="removeCategory('subcat');">Remove</button></td>    
                    <td >
                    <button type="button" class="btn btn-secondary" onClick="updateCategory('subcat');">Update</button>
                    </td></tr> 
                </table> 
            </div>      
            </td>
        </tr> 
        <tr>
            <td colspan="2">
            <div align="right">
            <button type="button" class="btn btn-primary" onClick="addProduct();">Add Products</button>
            </div>    
         </td>    
         </tr>       
        </table>
</div>  
</div>      
</body>
</html>