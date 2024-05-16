<?php
    require_once(__DIR__ . '/../classes/item.class.php');
    require_once(__DIR__ . '/../database/connectdb.php');
    require_once(__DIR__ . '/../classes/session.class.php');
    require_once(__DIR__ . '/../classes/size.class.php'); 

    $db = getDatabaseConnection();
    $session = new Session();
    
    if (!$session->isLoggedIn()) {
        header('Location: /../pages/signIn.php');
        exit;
    }

    if ($_SESSION['csrf'] !== $_POST['csrf']) { header('Location: /../pages/error.php'); }


    $sizeName = $_POST['sizeName'];
    $size = Size::getSizeByName($db, $sizeName);

    if(!Size::existingSize($db, $sizeName)){
        $session->addMessage('error', 'Size doesnt exist.');
            header('Location: /../pages/admin.php'); 
    }
    else{
        $items = Item::getFilteredItems($db, NULL, NULL, NULL, $size->sizeID, NULL);
        if(empty($items)){
            Size::remSize($db, $sizeName);
            $session->addMessage('success', 'Size removed!');
                header('Location: /../pages/admin.php'); 
        }
        else{
            $session->addMessage('error', 'There are items in this size. Cant remove it!');
                header('Location: /../pages/admin.php'); 
        }

    }