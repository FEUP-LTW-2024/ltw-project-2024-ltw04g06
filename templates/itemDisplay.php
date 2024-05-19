<?php 
    require_once(__DIR__ . '/../classes/user.class.php');
    function itemDisplay(array $items, PDO $db, int $userID){ 
    ?>
<head>
    <link rel="stylesheet" href="../css/home.css">
</head>
<main>
    <div class="products">  
    <?php if(empty($items)){ ?>
        <p class="empty">No items that match this filter.</p>
        <a href="sellItem.php" class="sell">Try selling an Item!</a>
        <?php } ?>
        <?php foreach ($items as $item) {
        $user = Item::getItemSeller($db, $item->itemID);
        $status = Item::getItemStatus($db, $item->itemID);
        if ($status != "Available") continue;
        ?>
        <div class="product"onclick="document.getElementById('viewItem<?= $item->itemID ?>').submit();">
            <form id="profileForm<?= $user->userID ?>" action="/../actions/action_toSeeProfile.php" method="post" class="hidden">
            <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
                <input type="hidden" name="userId" value="<?php echo htmlspecialchars($user->userID); ?>">
            </form>
            <header onclick="event.stopPropagation(); document.getElementById('profileForm<?= $user->userID ?>').submit();">                <img src=<?= User::getUserPic($db, $item->sellerID)?> alt="">
                <p><?=$user->username?></p>
            </header>
            <?php $page = $item->sellerID == $userID ? '/../actions/action_toItemActive.php' : '/../actions/action_toViewItem.php'?>
            <form id="viewItem<?= $item->itemID ?>" action="<?= $page?>" method="post" class="hidden">
            <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
                <input type="hidden" name="itemID" value="<?php echo htmlspecialchars($item->itemID); ?>">
            </form>
            <img onclick="document.getElementById('viewItem<?= $item->itemID ?>').submit();" class="foto" src=<?=Item::getImagePic($db, $item)?> alt="">
            <form id = "wishlist-form <?=$item->itemID?>" method="get">
                <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
                <input type="hidden" name="itemID" value="<?php echo htmlspecialchars($item->itemID); ?>">
                <p class="item-name"><?=$item->name?>
                <button id ="heart" class="wishlist <?php echo User::existItemUserWish($db, $userID, $item->itemID) ? 'red' : ''?>"><i class="fa-regular fa-heart"></i></button></p>
             </form>
            <h4 class="price"><?=$item->price?><i class="fa-solid fa-euro-sign"></i></h4>
        </div>
        <?php } ?> 
    </div>
    </main>
    <?php } ?>