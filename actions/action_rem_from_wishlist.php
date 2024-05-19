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
    $user = User::getUser($db, $userID);
    
    $itemID=$_POST['itemID'];
    $wishlistID = $user->wishlistID;

    if($wishlistID!==null){
    echo $_POST['itemID'];}
    echo $wishlistID;
   
        if(!Wishlist::existItemInWishlist($db, $wishlistID, $itemID)){
            $session->addMessage('error', 'Item is not in the wishlist.');
            header('Location: /../pages/wishlist.php');
            echo "item not in wishlist";
        } 
        else {
            if (Wishlist::remItemFromWishlist($db, $wishlistID, $itemID)) {
                $session->addMessage('success', 'Item removed from wishlist successful!');
                header('Location: /../pages/wishlist.php');
                echo "item in wishlist removed";
            } 
            else {
                $session->addMessage('error', 'Failed to remove item from wishlist.');
                header('Location: /../pages/wishlist.php');
                echo "item in wishlist but not removed";
            }
        }
    
?>