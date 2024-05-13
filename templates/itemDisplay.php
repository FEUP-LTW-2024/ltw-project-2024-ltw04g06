<?php 
    require_once(__DIR__ . '/../classes/user.class.php');
    function itemDisplay(array $items, PDO $db, int $userID){ 
    ?>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/home.css">
</head>
<main>
    <div class="products">
    <?php foreach ($items as $item) {
        $user = Item::getItemSeller($db, $item->itemID);
        $status = Item::getItemStatus($db, $item->itemID);
        if ($status != "Available") continue;
        ?>
        <div class="product">
            <form id="profileForm<?= $user->userID ?>" action="/../pages/seeProfile.php" method="post" class="hidden">
                <input type="hidden" name="userId" value="<?= $user->userID ?>">
            </form>
            <header onclick="document.getElementById('profileForm<?= $user->userID ?>').submit();">
                <img src=<?= '/../' . $user->profilePicture?> alt="">
                <p><?=$user->username?></p>
            </header>
            <?php
                $imageUrls = explode(',', $item->images);
                $imageSrc = $imageUrls[0];
            ?>
            <form id="viewItem<?= $item->itemID ?>" action="/../pages/viewItem.php" method="post" class="hidden">
                <input type="hidden" name="itemID" value="<?=$item->itemID?>">
            </form>
            <img onclick="document.getElementById('viewItem<?= $item->itemID ?>').submit();" class="foto" src=<?='/../' . $imageSrc?> alt="">
            
            <form action="/../actions/action_add_to_wishlist.php" method="post">
            <input type="hidden" name="itemID" value="<?=$item->itemID?>">
            <p><?=$item->name?>
            <button type="submit" class="wishlist"><i class="fa-regular fa-heart <?php echo User::existItemUserWish($db, $userID, $item->itemID) ? 'red' : ''?>"></i></button></p>
            </form>
            
            <h4 class="price"><?=$item->price?><i class="fa-solid fa-euro-sign"></i></h4>
        </div>
        <?php } ?> 
    </div>
    </main>
    <?php } ?>