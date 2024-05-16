<?php
    require_once(__DIR__ . '/../database/connectdb.php');
    require_once(__DIR__ . '/../classes/session.class.php');
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


    $newCategory = $_POST['newCategory'];
    $newCondition = $_POST['newCondition'];
    $newSize = $_POST['newSize'];


    if($newCategory!= NULL){
        if(Category::existingCategory($db, $newCategory)){
            $session->addSpecificMessage('error','categoryMsg', 'Category already exists!');
        }
        else{
            if(validCatConSize($newCategory)){
        $category = Category::addCategory($db, $newCategory);
            $session->addSpecificMessage('success', 'categoryMsg', 'Category created successfully!');
            } else {
            $session->addSpecificMessage('error','categoryMsg', 'Category not added! Maximum of 30 chars.');
            }
        }
    }

    
    if($newCondition!= NULL){
        if(Condition::existingCondition($db, $newCondition)){
            $session->addSpecificMessage('error','conditionMsg', 'Condition already exists!');
        }
        else{
            if(validCatConSize($newCondition)){
                $condition = Condition::addCondition($db, $newCondition);
        $session->addSpecificMessage('success','conditionMsg', 'Condition created successfully!');
            } else {
                $session->addSpecificMessage('error','conditionMsg', 'Condition not added! Maximum of 30 chars.');
            }
        }
    }

    if($newSize != NULL){
        if(Size::existingSize($db, $newSize)){
            $session->addSpecificMessage('error','sizeMsg', 'Size already exists!');
        }
        else{
            if(validCatConSize($newSize)){
                $size = Size::addSize($db, $newSize);
                $session->addSpecificMessage('success','sizeMsg', 'Size created successfully!');
            } else {
                $session->addSpecificMessage('error','sizeMsg', 'Size not added! Maximum of 30 chars.');
            }
        }
    }

    header('Location: /../pages/admin.php');

?>
