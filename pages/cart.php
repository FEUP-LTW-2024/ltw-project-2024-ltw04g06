<?php 
    require_once(__DIR__ . '/../templates/cart.php');
    require_once(__DIR__ . '/../templates/searchForm.php');
    require_once(__DIR__ . '/../templates/topo.php');
    require_once(__DIR__ . '/../database/connectdb.php');
    require_once(__DIR__ . '/../classes/item.class.php');
    require_once(__DIR__ . '/../classes/session.class.php');
    require_once(__DIR__ . '/../classes/shoppingCart.class.php');
    require_once(__DIR__ . '/../classes/user.class.php');

    $db = getDatabaseConnection();
    $session = new Session();
    if (!$session->isLoggedIn()) {header('Location: /../pages/signIn.php');exit;}


    $userID = $session->getID();
    $user = User::getUser($db, $userID);
    topo($db, $user);
    createCart();

    $cartID = $user->shoppingCartID;
    $cartItems=ShoppingCart::getShoppingCartItems($db, $cartID);
    if(empty($cartItems)){
        emptyCart();
    }
    cartDisplay($db,$session, $cartItems);
?>