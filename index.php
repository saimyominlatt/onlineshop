<?php

require 'config.php';
$directoryURL = $_SERVER['REQUEST_URI'];
$path = parse_url($directoryURL,PHP_URL_PATH);
$components = explode('/',$path);


//-------------------------------------------------//-------------------------------------
$router = $components[3];
//Category
require $GLOBALS['controller_file_path']."Category_ctrl.php";
$category = new Category_ctrl();

//Brand
require $GLOBALS['controller_file_path']."Brand_ctrl.php";
$brand = new Brand_ctrl();

//subcategory
require $GLOBALS['controller_file_path']."Subcategory_ctrl.php";
$subcategory= new Subcategory_ctrl();

//item
require $GLOBALS['controller_file_path']."Item_ctrl.php";
$item= new Item_ctrl();

//-------------------------------------------------//-------------------------------------
//category
if ($router =='category_list'){
    $categories =$category->read();
    require $GLOBALS['view_file_path']."category_list.php";
}
elseif ($router == 'category_new'){
    require $GLOBALS['view_file_path']."category_new.php";
}
elseif ($router == 'category_add'){
    $category->insert();
}
elseif ($router == 'category_edit'){
    $id = $_GET['id'];
    $categoryedit = $category->edit($id);
    require $GLOBALS['view_file_path']."category_edit.php";
}
elseif ($router == 'category_update') {
    $category->update();
}

//-------------------------------------------------//-------------------------------------
//brand
elseif ($router == 'brand_list') {
    $brands = $brand->read();
    require $GLOBALS['view_file_path']."brand_list.php";
}
elseif ($router == 'brand_new'){
    require $GLOBALS['view_file_path']."brand_new.php";
}
elseif ($router == 'brand_add'){
    $brand->insert();
}
elseif ($router == 'brand_edit'){
    $id = $_GET['id'];
    $brandedit = $brand->edit($id);
    require $GLOBALS['view_file_path']."brand_edit.php";
}
elseif ($router == 'brand_update') {
    $brand->update();
}


//-------------------------------------------------//-------------------------------------
//sub category
elseif ($router == 'subcategory_list'){
   $subcategories = $subcategory->read();
    require $GLOBALS['view_file_path']."subcategory_list.php";
}
elseif ($router == 'subcategory_new'){
    $categories =$category->read();
    require $GLOBALS['view_file_path']."subcategory_new.php";
}
elseif ($router == 'subcategory_add'){
    $subcategory->insert();
}
elseif ($router == 'subcategory_edit'){
    $id = $_GET['id'];
    $categories =$category->read();
    $subcategoryedit = $subcategory->edit($id);
    require $GLOBALS['view_file_path']."subcategory_edit.php";
}
elseif ($router == 'subcategory_update') {
    $subcategory->update();
}

//-------------------------------------------------//-------------------------------------
//item
elseif ($router == 'item_list') {
    $items= $item->read();
    require $GLOBALS['view_file_path']."item_list.php";
}
elseif ($router == 'item_new'){
    $subcategories =$subcategory->read();
    $brands =$brand->read();
    require $GLOBALS['view_file_path']."item_new.php";
}
elseif ($router == 'item_add') {
    $item->insert();
}
elseif ($router == 'item_edit'){
    $subcategories =$subcategory->read();
    $brands =$brand->read();
    $id = $_GET['id'];
    $itemedit = $item->edit($id);
    require $GLOBALS['view_file_path']."item_edit.php";
}

//-------------------------------------------------//-------------------------------------
//root

elseif ($router == '') {
    $brands =$brand->read();
    $categories =$category->read();

    $randomcategories = $category->randomcategories();

    $discountitem = $item->discountitem();
    $newitem = $item->newitems();
    $randomitems = $item->randomitem();
//    var_dump($randomitems);die();

    require $GLOBALS['view_file_path']."home.php";
}