<?php 
    require_once(__DIR__ . '/../templates/viewItem.php');
    require_once(__DIR__ . '/../templates/searchForm.php');
    require_once(__DIR__ . '/../templates/topo.php');
    require_once(__DIR__ . '/../database/connectdb.php');
    require_once(__DIR__ . '/../classes/item.class.php');
    require_once(__DIR__ . '/../classes/user.class.php');
    require_once(__DIR__ . '/../classes/session.class.php');

    $session = new Session();
    $db = getDatabaseConnection();
    $userID = $session->getID();
    $user = User::getUser($db, $userID);
    topo($user);
    displayViewItem();

    if (isset($_POST['itemID'])) {
        $itemID = $_POST['itemID'];
        try {
            $item = Item::getItem($db, $itemID);
            viewItemForm($item);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
       echo "Item ID not available.";
    }
?>