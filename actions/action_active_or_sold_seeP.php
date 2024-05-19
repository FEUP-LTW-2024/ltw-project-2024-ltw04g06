<?php

require_once(__DIR__ . '/../templates/settings.php');
require_once(__DIR__ . '/../database/connectdb.php');
require_once(__DIR__ . '/../classes/session.class.php');
require_once(__DIR__ . '/../classes/user.class.php');
require_once(__DIR__ . '/../classes/item.class.php');

$selectedCondition = $_GET['condition'];
$userID = $_GET['userID'];
$db = getDatabaseConnection();
$user = User::getUser($db,$userID);
$Items = Item::getUserItems($db, $userID);


foreach ($Items as $item) {
    $status = Item::getItemStatus($db, $item->itemID);
    if ($status !=  $selectedCondition) continue;
    $filePath = $status == 'Available' ? '/../actions/action_toViewItem.php' : '/../actions/action_toItemSold.php';
    echo '<div class="product">';
    echo '<form id="itemActive' . $item->itemID . '" action="'.$filePath.'" method="post" class="hidden">';
    echo '    <input type="hidden" name="itemID" value="' . $item->itemID . '">';
    echo '</form>';
    echo '<img onclick="document.getElementById(\'itemActive' . $item->itemID . '\').submit();" class="foto" src="' . Item::getImagePic($db, $item) . '" alt="">';
    echo '<p>' .  $item->name . '</p>';
    echo '<h4 class="price">' . $item->price . '<i class="fa-solid fa-euro-sign"></i></h4>';
    echo '</div>';
}
?>
