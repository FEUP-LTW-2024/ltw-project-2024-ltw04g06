<?php function createWishlist(){ ?>
    <head>
        <link rel="stylesheet" href="/../css/wishlist.css">
    </head>
    <main>
         <p class=title>Wishlist</p>
<?php } ?>

<?php function wishlistDisplay($wishlistItems, $db) { ?>
    <body>
        <div class="products">
            <?php foreach ($wishlistItems as $item) { 
                $user = Item::getItemSeller($db, $item->itemID);?>
                <div class="product">
                <form id="profileForm<?= $user->userID ?>" action="/../actions/action_toSeeProfile.php" method="post" class="hidden">
                    <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
                    <input type="hidden" name="userId" value="<?php echo htmlspecialchars($user->userID); ?>">
                </form>
                <header onclick="document.getElementById('profileForm<?= $user->userID ?>').submit();">
                    <img src=<?= User::getUserPic($db, $user->userID)?> alt="">
                    <p><?=$user->username?></p>
                </header>
                <div class="image">
                    <form id="viewItem<?= $item->itemID ?>" action="/../actions/action_toViewItem.php" method="post" class="hidden">
                        <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
                        <input type="hidden" name="itemID" value="<?php echo htmlspecialchars($item->itemID); ?>">
                    </form>
                    <img onclick="document.getElementById('viewItem<?= $item->itemID ?>').submit();" class="foto" src=<?=Item::getImagePic($db, $item)?> alt="">
                   
                    <p class=item-name><?=$item->name?></p>
                    <form action="/../actions/action_rem_from_wishlist.php" method="post">
                        <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
                        <input type="hidden" name="itemID" value="<?php echo htmlspecialchars($item->itemID); ?>">
                        <button type="submit" class="remove">Remove</button>
                    </form>
                </div>
                </div>
            <?php } ?>
        </div>
    </body>
</html>   
</main>
<?php } ?>

<?php function emptyWishlist(){ ?>
    <body>
        <p class="empty">Your list is still empty :(</p>
        <a href="home.php" class="home">Add items to wishlist</a>
    </body>
</html>   
</main>  
<?php } ?>