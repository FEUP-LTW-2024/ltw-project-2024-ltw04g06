<?php
    require_once(__DIR__ . '/../classes/item.class.php');
    require_once(__DIR__ . '/../database/connectdb.php');
    require_once(__DIR__ . '/../classes/session.class.php');
    require_once(__DIR__ . '/../classes/user.class.php');
    require_once(__DIR__ . '/../classes/wishlist.class.php');

    $db = getDatabaseConnection();

    $session = new Session();
    if (!$session->isLoggedIn()) {
        header('Location: /../pages/signIn.php');
        exit;
    }

    $itemID=$_POST['itemIDDD'];
    $wishlistID=1;

    echo $_POST['itemIDDD'];
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(!Wishlist::existItemInWishlist($db, $wishlistID, $itemID)){
            echo "Item is not in the wishlist.";
        } 
        else {
            if (Wishlist::remItemFromWishlist($db, $wishlistID, $itemID)) {
                echo "Item removed from wishlist.";
            } 
            else {
                echo "Failed to remove item from wishlist.";
            }
        }
    } 
    else {
        echo "Invalid request.";
    }

?>