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

    $itemID=$_POST['itemIDD'];
    $wishlistID=1;

    echo $_POST['itemIDD'];
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(Wishlist::existItemInWishlist($db, $wishlistID, $itemID)){
            echo "Item is already in the wishlist.";
        } 
        else {
            if (Wishlist::addItemToWishlist($db, $wishlistID, $itemID)) {
                echo "Item added to wishlist.";
            } 
            else {
                echo "Failed to add item to wishlist.";
            }
        }
    } 
    else {
        echo "Invalid request.";
    }
