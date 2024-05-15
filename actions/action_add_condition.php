<?php
    require_once(__DIR__ . '/../database/connectdb.php');
    require_once(__DIR__ . '/../classes/session.class.php');
    require_once(__DIR__ . '/../classes/condition.class.php');

    $db = getDatabaseConnection();
    $session = new Session();

    if (!$session->isLoggedIn()) {
        header('Location: /../pages/signIn.php');
        exit;
    }

    $newCondition = $_POST['newCondition'];

    if(Condition::existingCondition($db, $newCondition)){
        $session->addMessage('error', 'Condition already exists!');
        header('Location: /../pages/admin.php');
    }
    else{
    $condition = Condition::addCondition($db, $newCondition);
    $session->addMessage('success', 'Condition added!');
            header('Location: /../pages/admin.php');
        }

?>
