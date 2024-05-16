<?php
    require_once(__DIR__ . '/../classes/item.class.php');
    require_once(__DIR__ . '/../database/connectdb.php');
    require_once(__DIR__ . '/../classes/session.class.php');
    require_once(__DIR__ . '/../classes/condition.class.php'); 

    $db = getDatabaseConnection();
    $session = new Session();
    
    if (!$session->isLoggedIn()) {
        header('Location: /../pages/signIn.php');
        exit;
    }

    if ($_SESSION['csrf'] !== $_POST['csrf']) { header('Location: /../pages/error.php'); }



    $conditionName = $_POST['conditionName'];
    $condition = Condition::getConditionByName($db, $conditionName);

    if(!Condition::existingCondition($db, $conditionName)){
        $session->addMessage('error', 'Condition doesnt exist.');
            header('Location: /../pages/admin.php'); 
    }
    else{
        $items = Item::getFilteredItems($db, NULL, $condition->usage, NULL, NULL, NULL);
        if(empty($items)){
            Condition::remCondition($db, $conditionName);
            $session->addMessage('success', 'Condition removed!');
                header('Location: /../pages/admin.php'); 
        }
        else{
            $session->addMessage('error', 'There are items in this condition. Cant remove it!');
                header('Location: /../pages/admin.php'); 
        }

    }