<?php
    require_once(__DIR__ . '/../classes/item.class.php');
    require_once(__DIR__ . '/../database/connectdb.php');
    require_once(__DIR__ . '/../classes/session.class.php');
    require_once(__DIR__ . '/../classes/user.class.php');
    require_once(__DIR__ . '/../classes/shoppingCart.class.php');

    $db = getDatabaseConnection();
    $session = new Session();

    if (!$session->isLoggedIn()) {
        header('Location: /../pages/signIn.php');
        exit;
    }

    $userID = $session->getID();

    $itemID = $_POST['itemID'];

    $user = User::getUser($db, $userID);
    $shoppingCartID = $user -> shoppingCartID;



    if(ShoppingCart::existItemInShoppingCart($db, $shoppingCartID, $itemID)){
        $session->addMessage('error', 'Item is already in the Shopping Cart.');
        header('Location: /../pages/home.php');
     } 
     else {
        if (ShoppingCart::addItemToShoppingCart($db, $shoppingCartID, $itemID)) {
            $session->addMessage('success', 'Item added to shopping Cart successful!');
            header('Location: /../pages/cart.php');
        } 
        else {
            echo "Failed to add item to shopping Cart.";
        }
    }

    



?>