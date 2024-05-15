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
    $category = Category::getCategoryByName($db, $newCategoryName);
    $condition = Condition::getConditionByName($db, $newConditionName);
    $size = Size::getSizeByName($db, $newSizeName);

    if(true){//validar brand model price description name
        $editName = Item::editName($db, $item, $newName);
        $editCategory = Item::editCategory($db, $item, $category->categoryID);
        $editCondition = Item::editCondition($db, $item, $condition->conditionID);
        $editSize = Item::editSize($db, $item,$size->sizeID);
        $editPrice = Item::editPrice($db, $item,$newPrice);
        $editBrand = Item::editBrand($db, $item, $newBrand);
        $editModel = Item::editModel($db, $item, $newModel);
        $editDescription = Item::editDescription($db, $item, $newDescription);
        //$editImage = Item::editImage($db, $item, $newImageID);
        if($editName || $editCategory || $editCondition || $editSize || $editPrice
        || $editBrand || $editModel || $editDescription 
        //|| $editImage
        ){
        $session->addMessage('success', 'Edit Item successful!');
        }
        header('Location: /../pages/home.php');
    }
    else{
        $session->addMessage('error', 'Item not edited!');
        header('Location: /../pages/home.php');
    }







?>