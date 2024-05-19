<?php
    require_once(__DIR__ . '/../classes/item.class.php');
    require_once(__DIR__ . '/../database/connectdb.php');
    require_once(__DIR__ . '/../classes/session.class.php');
    require_once(__DIR__ . '/../classes/user.class.php');
    require_once(__DIR__ . '/../classes/condition.class.php');
    require_once(__DIR__ . '/../classes/size.class.php');
    require_once(__DIR__ . '/../classes/category.class.php');
    require_once(__DIR__ . '/../classes/image.class.php');

    $db = getDatabaseConnection();

    $session = new Session();
    if (!$session->isLoggedIn()) {header('Location: /../pages/signIn.php');exit;}
    if ($_SESSION['csrf'] !== $_POST['csrf']) { header('Location: /../pages/error.php'); exit; }


    $name = $_POST['title'];
    $sellerID = $session->getID();
    $categoryName = $_POST['category'];
    $sizeName = $_POST['sizes'];
    $conditionName = $_POST['condition'];
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    unlink(__DIR__ . "/../images/items/$itemID.jpg");
    Image::addImage($db, "/../images/items/$itemID.jpg");

    $imageID = $db->lastInsertId();
    $originalFileName =  __DIR__ . "/../images/items/$itemID.jpg";
            
    move_uploaded_file($_FILES['foto']['tmp_name'], $originalFileName);

    if (!empty($name) && !empty($categoryName) && !empty($conditionName)
    && !empty($description) && !empty($price) && !empty($imageID)) {
        if (validTitle($name) && $sellerID !== false && $categoryName !== false && $sizeName !== false &&
            $conditionName !== false && $brand !== false && $model !== false &&
            $description !== false && validPrice($price) && $images !== false) {
                $category = Category::getCategoryByName($db, $categoryName);
                $condition = Condition::getConditionByName($db, $conditionName);
                if($sizeName!= NULL){ 
                    $size = Size::getSizeByName($db, $sizeName);
                    $s = $size->sizeID;
                 }
                 else{$s = 0;}
                Item::addItem($db, $name, $sellerID, $category->categoryID, $s, $condition->conditionID, $brand, $model, $description, $price, $imageID);
                $session->addMessage('success', 'item successfully added!');
                header('Location: /../pages/profile.php');
                exit;
        } else {
            $session->addMessage('error', 'Title can only contain letters, digits and . - _ with a max of 35 chars.');
            header('Location: /../pages/sellItem.php');
        }
    }
    else{
        $session->addMessage('error', 'Please complete the required fields: title, photo, description, category, condition, and price.');
        header('Location: /../pages/sellItem.php');
    }

    ?>