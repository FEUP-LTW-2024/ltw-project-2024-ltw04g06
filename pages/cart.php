<?php 
    require_once(__DIR__ . '/../templates/cart.php');
    require_once(__DIR__ . '/../templates/searchForm.php');
    require_once(__DIR__ . '/../templates/topo.php');

    topo();
    displaySellItem();
    sellItemForm();
?>