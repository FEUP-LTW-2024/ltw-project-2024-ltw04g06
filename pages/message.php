
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
    $db = getDatabaseConnection();
    $userID = $session->getID();
    $user = User::getUser($db, $userID);
    $receiverID = -1;

   if ($_SERVER["REQUEST_METHOD"] == "POST"){
     $receiverID = $_POST['receiverID'];
   }

  $userID = $session->getID();
  topo($db, $user);
  sideBar($db, $userID, $receiverID);
  ?>