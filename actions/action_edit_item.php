<?php
	require_once(__DIR__ . '/../classes/session.class.php');
	require_once(__DIR__ . '/../database/connectdb.php');
    require_once(__DIR__ . '/../classes/item.class.php');
    require_once(__DIR__ . '/../classes/category.class.php');
    require_once(__DIR__ . '/../classes/condition.class.php');
    require_once(__DIR__ . '/../classes/size.class.php');

	$db = getDatabaseConnection();
    $session = new Session();

	if (!$session->isLoggedIn()) {
        header('Location: /../pages/signIn.php');
        exit;
    }

    if ($_SESSION['csrf'] !== $_POST['csrf']) { header('Location: /../pages/error.php'); }



    $itemID = $_POST['itemID'];
    $newName = $_POST['newName'];
    $newCategoryName = $_POST['newCategoryName'];
    $newConditionName = $_POST['newConditionName'];
    $newSizeName = $_POST['newSizeName'];
    $newPrice = $_POST['newPrice'];
    $newBrand = $_POST['newBrand'];
    $newModel = $_POST['newModel'];
    $newDescription = $_POST['newDescription'];
    //$newImageID = $_POST['itemID']; // nao sei como é que isto funciona Costinha

    $item = Item::getItem($db, $itemID);
    if($newCategoryName!= null)$category = Category::getCategoryByName($db, $newCategoryName);
    if($newConditionName!= null)$condition = Condition::getConditionByName($db, $newConditionName);
    if($newSizeName!= null)$size = Size::getSizeByName($db, $newSizeName);

    if($newName!= null && validTitle($newName)) $editName = Item::editName($db, $item, $newName);
    if($category!= null)$editCategory = Item::editCategory($db, $item, $category->categoryID);
    if($condition!= null)$editCondition = Item::editCondition($db, $item, $condition->conditionID);
    if($size!= null)$editSize = Item::editSize($db, $item,$size->sizeID);
    if($newPrice!= null && validPrice($newPrice))$editPrice = Item::editPrice($db, $item,$newPrice);
    if($newBrand!= null)$editBrand = Item::editBrand($db, $item, $newBrand);
    if($newModel!= null)$editModel = Item::editModel($db, $item, $newModel);
    if($newDescription!= null)$editDescription = Item::editDescription($db, $item, $newDescription);
    //if($newImageID!= null)$editImage = Item::editImage($db, $item, $newImageID);


    if($editName || $editCategory || $editCondition || $editSize || $editPrice
    || $editBrand || $editModel || $editDescription 
    //|| $editImage
    ){
    $session->addMessage('success', 'Edit Item successful!');
    header('Location: /../pages/home.php');
    }
    else{
        $session->addMessage('error', 'Item not edited! Title can only contain letters, digits and . - _ with a max of 35 chars. Price can only contain . and numbers.');
        header('Location: /../pages/editItem.php?itemID=' . $itemID);
    }










?>