<?php
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

    $newSize = $_POST['newSize'];

    if(Size::existingSize($db, $newSize)){
        $session->addMessage('error', 'Size already exists!');
        header('Location: /../pages/admin.php');
    }
    else{
        if(validCatConSize($newSize)){
            $size = Size::addSize($db, $newSize);
            $session->addMessage('success', 'Size added!');
            header('Location: /../pages/admin.php');
        } else {
            $session->addMessage('error', 'Size not added! Maximum of 30 chars.');
        header('Location: /../pages/admin.php');
        }
    }

?>
