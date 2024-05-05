<?php 
    require_once(__DIR__ . '/../templates/wishlist.php');
    require_once(__DIR__ . '/../templates/searchForm.php');
    require_once(__DIR__ . '/../templates/topo.php');
    require_once(__DIR__ . '/../database/connectdb.php');
    require_once(__DIR__ . '/../classes/item.class.php');
    require_once(__DIR__ . '/../classes/session.class.php');
    require_once(__DIR__ . '/../classes/wishlist.class.php');

    $db = getDatabaseConnection();
    topo();
    createWishlist();
    $wishlistID=1;
    $wishlistItems=Wishlist::getWishlistItems($db, $wishlistID);
    wishlistDisplay($wishlistItems);
?>