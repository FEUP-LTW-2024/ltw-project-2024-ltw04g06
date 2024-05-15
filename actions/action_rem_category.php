<?php
    require_once(__DIR__ . '/../classes/item.class.php');
    require_once(__DIR__ . '/../database/connectdb.php');
    require_once(__DIR__ . '/../classes/session.class.php');
    require_once(__DIR__ . '/../classes/category.class.php'); 

    $db = getDatabaseConnection();

    $session = new Session();
    if (!$session->isLoggedIn()) {
        header('Location: /../pages/signIn.php');
        exit;
    }
    if ($_SESSION['csrf'] !== $_POST['csrf']) {
        header('Location: /../pages/signIn.php');// MANDAR PARA PAGINA 404
      }

    $categoryName = $_POST['categoryName'];
    $category = Category::getCategoryByName($db, $categoryName);

    if(!Category::existingCategory($db, $categoryName)){
        $session->addMessage('error', 'Category doesnt exist.');
            header('Location: /../pages/admin.php'); 
    }
    else{
        $items = Item::getFilteredItems($db, $category->name, NULL, NULL, NULL, NULL);
        if(empty($items)){
            Category::remCategory($db, $categoryName);
            $session->addMessage('success', 'Category removed!');
                header('Location: /../pages/admin.php'); 
        }
        else{
            $session->addMessage('error', 'There are items in this category. Cant remove it!');
                header('Location: /../pages/admin.php'); 
        }

    }