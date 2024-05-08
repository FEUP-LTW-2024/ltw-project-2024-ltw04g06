<?php

require_once(__DIR__ . '/../templates/settings.php');
require_once(__DIR__ . '/../database/connectdb.php');
require_once(__DIR__ . '/../classes/session.class.php');
require_once(__DIR__ . '/../classes/user.class.php');
require_once(__DIR__ . '/../classes/item.class.php');

$selectedCondition = $_GET['condition'];
$userID = 1; // Alterar aqui
$db = getDatabaseConnection();
$user = User::getUser($db,$userID);
$Items = Item::getUserItems($db, $userID);

// Se o userID for igual ao da sessão
echo '<a class="addProduct" href="/../pages/sellItem.php">';
echo '<div class="mais">+</div>';
echo '</a>';

foreach ($Items as $item) {
    $status = Item::getItemStatus($db, $item->itemID);
    if ($status !=  $selectedCondition) continue;
    echo '<div class="product">';
    echo '<img class="foto" src="/../' . $item->images . '" alt="">';
    echo '<p>' . $selectedCondition . '</p>';
    echo '<h4 class="price">' . $item->price . '<i class="fa-solid fa-euro-sign"></i> ' . $item->sizeID . '</h4>';
    echo '</div>';
}
?>
