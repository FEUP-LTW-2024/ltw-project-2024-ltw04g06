<?php 
    require_once(__DIR__ . '/../templates/wishlist.php');
    require_once(__DIR__ . '/../templates/searchForm.php');
    require_once(__DIR__ . '/../templates/topo.php');
    require_once(__DIR__ . '/../database/connectdb.php');
    require_once(__DIR__ . '/../classes/item.class.php');
    require_once(__DIR__ . '/../classes/session.class.php');
    require_once(__DIR__ . '/../classes/wishlist.class.php');
    require_once(__DIR__ . '/../classes/user.class.php');

    $db = getDatabaseConnection();
    $session = new Session();
    if (!$session->isLoggedIn()) {
        header('Location: /../pages/signIn.php');
        exit;
    }

    $userID = $session->getID();
    topo();
    createWishlist();
    $itemID=$_POST['itemID'];
    $user = User::getUser($db, $userID);
    $wishlistID = $user->wishlistID;
    $wishlistItems=Wishlist::getWishlistItems($db, $wishlistID);
    if(empty($wishlistItems)){
        emptyWishlist();
    }
    wishlistDisplay($wishlistItems);
?>