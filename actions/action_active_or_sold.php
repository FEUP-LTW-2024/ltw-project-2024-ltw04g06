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

if(isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], "pages/profile.php") !== false && $selectedCondition == 'Available'){
    echo '<a class="addProduct" href="/../pages/sellItem.php">';
    echo '<div class="mais">+</div>';
    echo '</a>';
}


foreach ($Items as $item) {
    $status = Item::getItemStatus($db, $item->itemID);
    if ($status !=  $selectedCondition) continue;
    $isItemActive = $status == 'Active';
    $filePath = $isItemActive ? '/../pages/itemActive.php' : '/../pages/itemSold.php';
    echo '<div class="product">';
    echo '<form id="itemActive' . $item->itemID . '" action="'.$filePath.'" method="post" class="hidden">';
    echo '    <input type="hidden" name="itemID" value="' . $item->itemID . '">';
    echo '</form>';
    echo '<img onclick="document.getElementById(\'itemActive' . $item->itemID . '\').submit();" class="foto" src="' . Item::getImagePic($db, $item->imageID) . '" alt="">';
    echo '<p>' . $selectedCondition . '</p>';
    echo '<h4 class="price">' . $item->price . '<i class="fa-solid fa-euro-sign"></i> ' . $item->sizeID . '</h4>';
    echo '</div>';
}
?>
