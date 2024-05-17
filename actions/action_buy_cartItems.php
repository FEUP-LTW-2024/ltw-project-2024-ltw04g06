<?php
    require_once(__DIR__ . '/../classes/item.class.php');
    require_once(__DIR__ . '/../database/connectdb.php');
    require_once(__DIR__ . '/../classes/session.class.php');
    require_once(__DIR__ . '/../classes/user.class.php');
    require_once(__DIR__ . '/../classes/shoppingCart.class.php');

    $db = getDatabaseConnection();
    $session = new Session();

	if (!$session->isLoggedIn()) {
        header('Location: /../pages/signIn.php');
        exit;
    }

    //if ($_SESSION['csrf'] !== $_POST['csrf']) { header('Location: /../pages/error.php'); }

    $userID = $session->getID();
    $user = User::getUser($db, $userID);
    $shoppingCartID = $user -> shoppingCartID;

    $items = ShoppingCart::getShoppingCartItems($db, $shoppingCartID);
    
    if($items!=NULL) {
        foreach($items as $item){
            Item::editItemStatus($db, $item->itemID, $userID, "Sold");
        }
        header('Location: /../pages/home.php');
    }
    else{
        die(header('Location: /../pages/error.php'));
    }

?>