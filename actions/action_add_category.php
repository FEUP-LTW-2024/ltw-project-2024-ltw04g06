<?php
    require_once(__DIR__ . '/../database/connectdb.php');
    require_once(__DIR__ . '/../classes/session.class.php');
    require_once(__DIR__ . '/../classes/category.class.php');

    $db = getDatabaseConnection();
    $session = new Session();

    if (!$session->isLoggedIn()) {
        header('Location: /../pages/signIn.php');
        exit;
    }

    $newCategory = $_POST['newCategory'];

    if(Category::existingCategory($db, $newCategory)){
        $session->addMessage('error', 'Category already exists!');
        header('Location: /../pages/home.php');
    }
    else{
    $category = Category::addCategory($db, $newCategory);
    $session->addMessage('success', 'Category added!');
            header('Location: /../pages/home.php');
        }

?>