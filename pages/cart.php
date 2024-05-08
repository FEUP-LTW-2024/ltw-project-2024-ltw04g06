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
    if (!$session->isLoggedIn()) {
        header('Location: /../pages/signIn.php');
        exit;
    }

    $userID = $session->getID();
    topo();
    createCart();
    $itemID=$_POST['itemID'];
    $user = User::getUser($db, $userID);
    $shoppingCartID = $user -> shoppingCartID;
    $cartItems=Wishlist::getWishlistItems($db, $shoppingCartID);
    if(empty($cartItems)){
        emptyCart();
    }
    cartDisplay($cartItems);
?>