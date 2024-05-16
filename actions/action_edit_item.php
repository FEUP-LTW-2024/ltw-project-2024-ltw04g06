<?php
	require_once(__DIR__ . '/../classes/session.class.php');
	require_once(__DIR__ . '/../database/connectdb.php');
    require_once(__DIR__ . '/../classes/item.class.php');

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
    $newBrand = $_POST['itemID'];
    $newModel = $_POST['itemID'];
    $newDescription = $_POST['itemID'];
    $newImageID = $_POST['itemID']; // nao sei como é que isto funciona Costinha

    $item = Item::getItem($db, $itemID);
    $categoryID = Category::getCategoryByName($db, $categoryName);
    $conditionID = Condition::getConditionByName($db, $conditionName);
    $sizeID = Size::getSizeByName($db, $sizeName);

    if(true){//validar brand model price description name
        $editName = Item::editName($db, $item, $newName);
        $editCategory = Item::editCategory($db, $item, $newCategoryID);
        $editCondition = Item::editCondition($db, $item, $newConditionID);
        $editSize = Item::editSize($db, $item,$newSizeID);
        $editPrice = Item::editPrice($db, $item,$newPrice);
        $editBrand = Item::editBrand($db, $item, $newBrand);
        $editModel = Item::editModel($db, $item, $newModel);
        $editDescription = Item::editDescription($db, $item, $newDescription);
        $editImage = Item::editImage($db, $item, $newImageID);
        if($editName || $editCategory || $editCondition || $editSize || $editPrice
        || $editBrand || $editModel || $editDescription || $editImage){
        $session->addMessage('success', 'Edit Item successful!');
        }
        header('Location: /../pages/editItem.php');
    }
    else{
        $session->addMessage('error', 'Item not edited!');
        header('Location: /../pages/editItem.php');
    }







?>