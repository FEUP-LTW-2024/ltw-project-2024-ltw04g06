<?php
    require_once(__DIR__ . '/../classes/item.class.php');
    require_once(__DIR__ . '/../database/connectdb.php');
    require_once(__DIR__ . '/../classes/session.class.php');
    require_once(__DIR__ . '/../classes/user.class.php');
    require_once(__DIR__ . '/../classes/wishlist.class.php');

    $db = getDatabaseConnection();
    $session = new Session();

    if (!$session->isLoggedIn()) {header('Location: /../pages/signIn.php');exit;}

    $userID = $session->getID();
    $user = User::getUser($db, $userID);
    $itemID = $_GET['itemID'];
    $wishlistID = $user->wishlistID;

    if($_SERVER['REQUEST_METHOD'] === 'GET') {
        if(Wishlist::existItemInWishlist($db, $wishlistID, $itemID)){
           Wishlist::remItemFromWishlist($db, $wishlistID, $itemID);
        } 
        else {
            if (Wishlist::addItemToWishlist($db, $wishlistID, $itemID)) {
               echo "Item added to wishlist.";
               $session->addMessage('success', 'Item added to wishlist successful!');
            } else {
                echo "Failed to add item to wishlist.";
            }
        }
    } 
    else {
        echo "Invalid request.";
    }
?>