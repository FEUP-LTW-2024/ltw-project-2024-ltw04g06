<?php
    require_once(__DIR__ . '/../classes/item.class.php');
    require_once(__DIR__ . '/../database/connectdb.php');
    require_once(__DIR__ . '/../classes/session.class.php');
    require_once(__DIR__ . '/../classes/user.class.php');
    require_once(__DIR__ . '/../classes/shoppingCart.class.php'); // Change to shoppingCart.class.php

    $db = getDatabaseConnection();

    $session = new Session();
    if (!$session->isLoggedIn()) {
        header('Location: /../pages/signIn.php');
        exit;
    }

    $itemID = $_POST['itemIDDD'];
    $shoppingCartID = 1; // Change to appropriate shopping cart ID

    echo $_POST['itemIDDD'];
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(!ShoppingCart::existItemInCart($db, $shoppingCartID, $itemID)){
            echo "Item is not in the shopping cart.";
            $session->addMessage('error', 'Item is not in the shopping cart.');
            header('Location: /../pages/shoppingCart.php'); // Change to shopping cart page
        } 
        else {
            if (ShoppingCart::remItemFromCart($db, $shoppingCartID, $itemID)) {
                echo "Item removed from shopping cart.";
                $session->addMessage('success', 'Item removed from shopping cart successful!');
                header('Location: /../pages/shoppingCart.php'); // Change to shopping cart page
            } 
            else {
                echo "Failed to remove item from shopping cart.";
                $session->addMessage('error', 'Failed to remove item from shopping cart.');
                header('Location: /../pages/shoppingCart.php'); // Change to shopping cart page
            }
        }
    } 
    else {
        echo "Invalid request.";
        $session->addMessage('error', 'Invalid request.');
        header('Location: /../pages/shoppingCart.php'); // Change to shopping cart page
    }

?>
