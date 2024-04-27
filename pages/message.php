
<?php 
    require_once(__DIR__ . '/../templates/searchForm.php');
    require_once(__DIR__ . '/../templates/topo.php');
    require_once(__DIR__ . '/../database/connectdb.php');
    require_once(__DIR__ . '/../templates/itemDisplay.php');
    require_once(__DIR__ . '/../classes/item.class.php');
    require_once(__DIR__ . '/../templates/message.php');
    require_once(__DIR__ . '/../classes/message.class.php');

    if (isset($_POST['writerID']) && isset($_POST['message']) && isset($_POST['receiverID'])) {
      $writerID = $_POST['writerID'];
      $message = $_POST['message'];
      $receiverID = $_POST['receiverID'];
      // Adicionar a mensagem à base de dados.
  }

  $db = getDatabaseConnection();
  topo();
  sideBar($db, 1);
  ?>