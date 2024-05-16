<?php 
    require_once(__DIR__ . '/../templates/searchForm.php');
    require_once(__DIR__ . '/../templates/topo.php');
    require_once(__DIR__ . '/../database/connectdb.php');
    require_once(__DIR__ . '/../templates/anuncio.php');
    require_once(__DIR__ . '/../templates/itemDisplay.php');
    require_once(__DIR__ . '/../templates/printShippingForm.php');
    require_once(__DIR__ . '/../classes/item.class.php');
    require_once(__DIR__ . '/../classes/shippingForm.class.php');
    require_once(__DIR__ . '/../classes/session.class.php');
    
    $db = getDatabaseConnection();
    $session = new Session();

    $userID = $session->getID();
    $user = User::getUser($db,$userID);
    $itemID = $_POST['itemID'];

    topo($db, $user);
    printShippingForm($db, $user, $itemID);

?>
