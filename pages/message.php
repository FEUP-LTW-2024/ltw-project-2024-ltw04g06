
<?php 
    require_once(__DIR__ . '/../templates/searchForm.php');
    require_once(__DIR__ . '/../templates/topo.php');
    require_once(__DIR__ . '/../database/connectdb.php');
    require_once(__DIR__ . '/../templates/itemDisplay.php');
    require_once(__DIR__ . '/../classes/item.class.php');
    require_once(__DIR__ . '/../templates/message.php');
    require_once(__DIR__ . '/../classes/message.class.php');
    require_once(__DIR__ . '/../classes/session.class.php');

  $db = getDatabaseConnection();
  $session = new Session();

  $userID = $session->getID();
  topo();
  sideBar($db, $userID);
  ?>