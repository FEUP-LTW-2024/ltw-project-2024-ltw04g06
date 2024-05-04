<?php 
    require_once(__DIR__ . '/../templates/wishlist.php');
    require_once(__DIR__ . '/../templates/searchForm.php');
    require_once(__DIR__ . '/../templates/topo.php');

    topo();
    createWishlist();
    wishlistDisplay();
?>