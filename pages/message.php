
<?php 
    require_once(__DIR__ . '/../templates/searchForm.php');
    require_once(__DIR__ . '/../templates/topo.php');
    require_once(__DIR__ . '/../database/connectdb.php');
    require_once(__DIR__ . '/../templates/itemDisplay.php');
    require_once(__DIR__ . '/../classes/item.class.php');
    require_once(__DIR__ . '/../templates/message.php');
    require_once(__DIR__ . '/../classes/message.class.php');
    require_once(__DIR__ . '/../classes/session.class.php');

    $session = new Session();
    if (!$session->isLoggedIn()) {header('Location: /../pages/signIn.php');exit;}

    $db = getDatabaseConnection();
    $userID = $session->getID();
    $user = User::getUser($db, $userID);
    $receiverID = -1;

    if (isset($_SESSION['receiverID']) &&  $_SESSION['page'] == 'actionProfileToMessage'){
      $receiverID = $_SESSION['receiverID'];
      unset($_SESSION['page']);
    } 

    $userID = $session->getID();
    topo($db, $user);
    sideBar($db, $userID, $receiverID);
  
  ?>