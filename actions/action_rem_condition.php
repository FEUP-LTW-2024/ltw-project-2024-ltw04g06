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

    $conditionName = $_POST['conditionName'];
    $condition = Condition::getConditionByName($db, $conditionName);

    if(!Condition::existingCondition($db, $conditionName)){
        $session->addMessage('error', 'Condition doesnt exist.');
            header('Location: /../pages/home.php'); 
    }
    else{
        $items = Item::getFilteredItems($db, NULL, $condition, NULL, NULL, NULL);
        if(empty($items)){
            Condition::remCondition($db, $conditionName);
            $session->addMessage('success', 'Condition removed!');
                header('Location: /../pages/home.php'); 
        }
        else{
            $session->addMessage('error', 'There are items in this condition. Cant remove it!');
                header('Location: /../pages/home.php'); 
        }

    }