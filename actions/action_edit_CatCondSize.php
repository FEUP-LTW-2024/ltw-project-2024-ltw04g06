<?php
    require_once(__DIR__ . '/../database/connectdb.php');
    require_once(__DIR__ . '/../classes/session.class.php');
    require_once(__DIR__ . '/../classes/category.class.php');
    require_once(__DIR__ . '/../classes/condition.class.php');
    require_once(__DIR__ . '/../classes/size.class.php');
    require_once(__DIR__ . '/../classes/item.class.php');

    $db = getDatabaseConnection();
    $session = new Session();
    if (!$session->isLoggedIn()) {header('Location: /../pages/signIn.php');exit;}
    if ($_SESSION['csrf'] !== $_POST['csrf']) { header('Location: /../pages/error.php'); exit; }


    $categoryName = $_POST['categoryName'];
    $conditionName = $_POST['conditionName'];
    $sizeName = $_POST['sizeName'];

    $newCategory = $_POST['newCategory'];
    $newCondition = $_POST['newCondition'];
    $newSize = $_POST['newSize'];

    if($categoryName!= NULL){
        $category = Category::getCategoryByName($db, $categoryName);

        if(Category::existingCategory($db, $categoryName)){
            $items = Item::getFilteredItems($db, $category->name, NULL, NULL, NULL, NULL);
            if(empty($items)){
                Category::remCategory($db, $categoryName);
                $session->addSpecificMessage('success','categoryRem', 'Category removed!');
            }
            else{
                $session->addSpecificMessage('error','categoryRem', 'Cant remove, items present in this category!');
            }
        }
    }


    if($conditionName!= NULL){
        $condition = Condition::getConditionByName($db, $conditionName);

        if(Condition::existingCondition($db, $conditionName)){
            $items = Item::getFilteredItems($db, NULL, $condition->usage, NULL, NULL, NULL);
            if(empty($items)){
                Condition::remCondition($db, $conditionName);
                $session->addSpecificMessage('success','conditionRem', 'Condition removed!');
            }
            else{
                $session->addSpecificMessage('error','conditionRem', 'Cant remove, items present in this condition!');
            }
        }
    }

    if($sizeName!= NULL){
        $size = Size::getSizeByName($db, $sizeName);
        
        if(Size::existingSize($db, $sizeName)){
            $items = Item::getFilteredItems($db, NULL, NULL, NULL, $size->name, NULL);
            if(empty($items)){
                Size::remSize($db, $sizeName);
                $session->addSpecificMessage('success','sizeRem', 'Size removed!');
            }
            else{
                $session->addSpecificMessage('error','sizeRem', 'Cant remove, items present in this size!');
            }
        }
    }



    if($newCategory!= NULL){
        if(Category::existingCategory($db, $newCategory)){
            $session->addSpecificMessage('error','categoryAdd', 'Category already exists!');
        }
        else{
            if(validCatConSize($newCategory)){
        $category = Category::addCategory($db, $newCategory);
            $session->addSpecificMessage('success', 'categoryAdd', 'Category created successfully!');
            } else {
            $session->addSpecificMessage('error','categoryAdd', 'Category not added! Maximum of 30 chars.');
            }
        }
    }

    
    if($newCondition!= NULL){
        if(Condition::existingCondition($db, $newCondition)){
            $session->addSpecificMessage('error','conditionAdd', 'Condition already exists!');
        }
        else{
            if(validCatConSize($newCondition)){
                $condition = Condition::addCondition($db, $newCondition);
        $session->addSpecificMessage('success','conditionAdd', 'Condition created successfully!');
            } else {
                $session->addSpecificMessage('error','conditionAdd', 'Condition not added! Maximum of 30 chars.');
            }
        }
    }

    if($newSize != NULL){
        if(Size::existingSize($db, $newSize)){
            $session->addSpecificMessage('error','sizeAdd', 'Size already exists!');
        }
        else{
            if(validCatConSize($newSize)){
                $size = Size::addSize($db, $newSize);
                $session->addSpecificMessage('success','sizeAdd', 'Size created successfully!');
            } else {
                $session->addSpecificMessage('error','sizeAdd', 'Size not added! Maximum of 30 chars.');
            }
        }
    }

    header('Location: /../pages/admin.php');

?>
