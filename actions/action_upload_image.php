<?php
    require_once(__DIR__ . '/../classes/item.class.php');
    require_once(__DIR__ . '/../classes/image.class.php');
    require_once(__DIR__ . '/../database/connectdb.php');
    require_once(__DIR__ . '/../classes/session.class.php');
    require_once(__DIR__ . '/../classes/user.class.php');
    require_once(__DIR__ . '/../classes/wishlist.class.php');

    $db = getDatabaseConnection();
    $session = new Session();
    $userID = $session->getID();
    $itemID=$_POST['itemID'];
    
    $tempFileName = $_FILES['image']['tmp_name'];

    $id = $dbh->lastInsertId();
    $originalFileName = "images/originals/$id.jpg";

    $width = imagesx($original);    
    $height = imagesy($original);   
    $square = min($width, $height);  
  
    imagejpeg($original, $originalFileName);
?>