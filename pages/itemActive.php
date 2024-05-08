<?php 
    require_once(__DIR__ . '/../templates/itemActive.php');
    require_once(__DIR__ . '/../templates/searchForm.php');
    require_once(__DIR__ . '/../templates/topo.php');
    require_once(__DIR__ . '/../database/connectdb.php');
    require_once(__DIR__ . '/../classes/item.class.php');
    require_once(__DIR__ . '/../classes/session.class.php');

    $db = getDatabaseConnection();
    topo();

    $itemID = $_GET['itemID'];
    echo $itemID;
    if (isset($_GET['itemID'])) {
        $itemID = $_GET['itemID'];
        try {
            $item = Item::getItem($db, $itemID);
            ?>
            <div class="item">
                <h1><?= $item->name ?></h1>
                <p><strong>Preço:</strong> R$ <?= number_format($item->price, 2, ',', '.') ?></p>
                <p><strong>Marca:</strong> <?= $item->brand ?></p>
                <p><strong>Modelo:</strong> <?= $item->model ?></p>
                <p><strong>Descrição:</strong> <?= $item->description ?></p>
                <img src=<?='/../' . $item->images?> alt="<?= $item->name ?>">
            </div>
            <?php
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
       echo "Item ID not available.";
    }
  //  displayItemActive();
  //  itemActiveForm();
?>