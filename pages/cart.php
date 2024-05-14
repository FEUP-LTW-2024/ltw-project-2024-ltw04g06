<?php 
    require_once(__DIR__ . '/../templates/cart.php');
    require_once(__DIR__ . '/../templates/searchForm.php');
    require_once(__DIR__ . '/../templates/topo.php');
    require_once(__DIR__ . '/../database/connectdb.php');
    require_once(__DIR__ . '/../classes/item.class.php');
    require_once(__DIR__ . '/../classes/session.class.php');
    require_once(__DIR__ . '/../classes/shoppingCart.class.php');
    require_once(__DIR__ . '/../classes/user.class.php');

    $session = new Session();
    $db = getDatabaseConnection();
    $userID = $session->getID();
    $user = User::getUser($db, $userID);
    if (!$session->isLoggedIn()) {
        header('Location: /../pages/signIn.php');
        exit;
    }

    topo($db, $user);
    createCart();
    $itemID=$_POST['itemID'];
    $user = User::getUser($db, $userID);
    $shoppingCartID = $user -> shoppingCartID;
    $cartItems=ShoppingCart::getShoppingCartItems($db, $shoppingCartID);
    if(empty($cartItems)){
        emptyCart();
    }
    cartDisplay($db, $cartItems);
?>