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

    $userID = $session->getID();

    $itemID=$_POST['itemID'];
    $wishlistID = 1;

    echo $_POST['itemID'];
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(!Wishlist::existItemInWishlist($db, $wishlistID, $itemID)){
            echo "Item is not in the wishlist.";
            $session->addMessage('error', 'Item is not in the wishlist.');
            header('Location: /../pages/wishlist.php');
        } 
        else {
            if (Wishlist::remItemFromWishlist($db, $wishlistID, $itemID)) {
                echo "Item removed from wishlist.";
                $session->addMessage('success', 'Item removed from wishlist successful!');
                header('Location: /../pages/wishlist.php');
            } 
            else {
                echo "Failed to remove item from wishlist.";
                $session->addMessage('error', 'Failed to remove item from wishlist.');
                header('Location: /../pages/wishlist.php');
            }
        }
    } 
    else {
        echo "Invalid request.";
        $session->addMessage('error', 'Invalid request.');
        header('Location: /../pages/wishlist.php');
    }

?>