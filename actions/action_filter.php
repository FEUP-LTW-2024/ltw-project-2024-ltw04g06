<?php
require_once(__DIR__ . '/../templates/settings.php');
require_once(__DIR__ . '/../database/connectdb.php');
require_once(__DIR__ . '/../classes/session.class.php');
require_once(__DIR__ . '/../classes/user.class.php');
require_once(__DIR__ . '/../classes/item.class.php');


$db = getDatabaseConnection();
$session = new Session();

$category = $_POST['category']; 
$condition = $_POST['condition']; 
$minPrice = $_POST['min'];  
$maxPrice = $_POST['max']; 

$items = Item::getFilteredItems($db, $category, $condition, $minPrice, $maxPrice);






?>