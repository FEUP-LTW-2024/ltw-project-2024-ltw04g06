<?php 
    require_once(__DIR__ . '/../classes/user.class.php');
    function itemDisplay(array $items, PDO $db){ 
    ?>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/home.css">
</head>
<main>
    <div class="products">
    <?php foreach ($items as $item) {
        $user = Item::getItemSeller($db, $item->itemID);
        ?>
        <div class="product">
            <header>
                <img src=<?= '/../' . $user->profilePicture?> alt="">
                <p><?=$user->username?></p>
            </header>
            <img class="foto" src=<?='/../' . $item->images?> alt="">
            
            <form action="/../actions/action_add_to_wishlist.php" method="post">
            <input type="hidden" name="itemIDD" value="<?=$item->itemID?>">
            <p><?=$item->name?>
            <button type="submit" class="wishlist"><i class="fa-regular fa-heart"></i></button></p>
            </form>
            
            <h4 class="price"><?=$item->price?><i class="fa-solid fa-euro-sign"></i></h4>
        </div>
        <?php } ?> 
    </div>
    </main>
    <?php } ?>