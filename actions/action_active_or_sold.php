<?php

require_once(__DIR__ . '/../templates/settings.php');
require_once(__DIR__ . '/../database/connectdb.php');
require_once(__DIR__ . '/../classes/session.class.php');
require_once(__DIR__ . '/../classes/user.class.php');
require_once(__DIR__ . '/../classes/item.class.php');

$selectedCondition = $_GET['condition'];
$userID = $_GET['userID'];
$db = getDatabaseConnection();
$user = User::getUser($db, $userID);
$Items = $selectedCondition == 'Purchased' ? Item::getPurchasedItems($db, $userID) : Item::getUserItems($db, $userID);

if ($selectedCondition == 'Available') {
    echo '<a class="addProduct" href="/../pages/sellItem.php">';
    echo '<div class="mais">+</div>';
    echo '</a>';
}

foreach ($Items as $item) {
    $status = Item::getItemStatus($db, $item->itemID);
    if ($status != $selectedCondition && $selectedCondition != 'Purchased') continue;
    $filePath = $status == 'Available' ? '/../actions/action_toItemActive.php' : ($status == 'Sold' ? '/../actions/action_toItemSold.php' : '');
    echo '<div class="product">';
    echo '<form id="itemActive' . htmlspecialchars($item->itemID) . '" action="' . htmlspecialchars($filePath) . '" method="post" class="hidden">';
    echo '    <input type="hidden" name="itemID" value="' . htmlspecialchars($item->itemID) . '">';
    echo '</form>';
    echo '<img onclick="document.getElementById(\'itemActive' . htmlspecialchars($item->itemID) . '\').submit();" class="foto" src="' . htmlspecialchars(Item::getImagePic($db, $item)) . '" alt="">';
    echo '<p>' . htmlspecialchars($item->name) . '</p>';
    echo '<h4 class="price">' . htmlspecialchars($item->price) . '<i class="fa-solid fa-euro-sign"></i></h4>';
    echo '</div>';
}
?>
