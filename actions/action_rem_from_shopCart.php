<?php
    require_once(__DIR__ . '/../classes/item.class.php');
    require_once(__DIR__ . '/../database/connectdb.php');
    require_once(__DIR__ . '/../classes/session.class.php');
    require_once(__DIR__ . '/../classes/user.class.php');
    require_once(__DIR__ . '/../classes/shoppingCart.class.php'); 

    $db = getDatabaseConnection();

    $session = new Session();
    if (!$session->isLoggedIn()) {header('Location: /../pages/signIn.php');exit;}
    if ($_SESSION['csrf'] !== $_POST['csrf']) { header('Location: /../pages/error.php'); exit; }

    $userID = $session->getID();
    $user = User::getUser($db, $userID);

    $itemID = $_POST['itemID'];
    $_SESSION['itemID'] = $_POST['itemID'];
    $shoppingCartID = $user->shoppingCartID; 


    if(!ShoppingCart::existItemInShoppingCart($db, $shoppingCartID, $itemID)){
        $session->addMessage('error', 'Item is not in the shopping cart.');
        header('Location: /../pages/cart.php'); 
    } 
    else {
        if (ShoppingCart::remItemFromShoppingCart($db, $shoppingCartID, $itemID)) {
            $session->addMessage('success', 'Item removed from shopping cart.');
            header('Location: /../pages/cart.php'); 
        } 
        else {
            $session->addMessage('error', 'Failed to remove item from shopping cart.');
            header('Location: /../pages/cart.php'); 
        }
    }


?>
