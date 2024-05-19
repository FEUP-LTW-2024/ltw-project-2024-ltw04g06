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
    if (!$session->isLoggedIn()) {header('Location: /../pages/signIn.php');exit;}


    $userID = $session->getID();
    $user = User::getUser($db,$userID);
    $itemID = $_SESSION['itemID'];

    topo($db, $user);
    printShippingForm($db, $user, $itemID);

?>
