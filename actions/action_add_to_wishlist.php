<?php
    require_once(__DIR__ . '/../classes/item.class.php');
    require_once(__DIR__ . '/../database/connectdb.php');
    require_once(__DIR__ . '/../classes/session.class.php');
    require_once(__DIR__ . '/../classes/user.class.php');
    require_once(__DIR__ . '/../classes/wishlist.class.php');

    $db = getDatabaseConnection();
    $session = new Session();
    if (!$session->isLoggedIn()) {header('Location: /../pages/signIn.php');exit;}
    if ($_SESSION['csrf'] !== $_POST['csrf']) { header('Location: /../pages/error.php'); exit; }

    $userID = $session->getID();

    $itemID = $_POST['itemID'];
    $user = User::getUser($db, $userID);
    $wishlistID = $user->wishlistID;

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(Wishlist::existItemInWishlist($db, $wishlistID, $itemID)){
           Wishlist::remItemFromWishlist($db, $wishlistID, $itemID);
           header('Location: /../pages/home.php');
        } 
        else {
            if (Wishlist::addItemToWishlist($db, $wishlistID, $itemID)) {
               echo "Item added to wishlist.";
               $session->addMessage('success', 'Item added to wishlist successful!');
               header('Location: /../pages/home.php');
            } 
            else {
                echo "Failed to add item to wishlist.";
            }
        }
    } 
    else {
        echo "Invalid request.";
    }
?>