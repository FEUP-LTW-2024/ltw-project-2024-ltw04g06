<?php function createCart(){ ?>
    <head>
        <link rel="stylesheet" href="/../css/cart.css">
    </head>
    <main>
         <p class=title>Cart</p>
<?php } ?>

<?php function cartDisplay($cartItems, $db){ ?>
    <body>
        <div class="products">
            <?php $totalPrice = 0;
            foreach ($cartItems as $item) { 
                $totalPrice += $item->price;
                $user = Item::getItemSeller($db, $item->itemID);?>
                <div class="product">
                <form id="profileForm<?= $user->userID ?>" action="/../pages/seeProfile.php" method="post" class="hidden">
                    <input type="hidden" name="userId" value="<?= $user->userID ?>">
                </form>
                <header onclick="document.getElementById('profileForm<?= $user->userID ?>').submit();">
                    <img src=<?= '/../' . $user->profilePicture?> alt="">
                    <p><?=$user->username?></p>
                </header>

                <div class="image">
                    <?php
                    $imageUrls = explode(',', $item->images);
                    $imageSrc = $imageUrls[0];
                    ?>
                    <form id="viewItem<?= $item->itemID ?>" action="/../pages/viewItem.php" method="post" class="hidden">
                        <input type="hidden" name="itemID" value="<?=$item->itemID?>">
                    </form>
                    <img onclick="document.getElementById('viewItem<?= $item->itemID ?>').submit();" class="foto" src=<?='/../' . $imageSrc?> alt="">
                   
                    <p class=item-name><?=$item->name?></p>
                    <p class="item-price"><?= number_format($item->price, 2, ',', '.') ?>€</p>
                    <form action="/../actions/action_rem_from_shopCart.php" method="post">
                        <input type="hidden" name="itemID" value="<?=$item->itemID?>">
                        <button type="submit" class="remove">Remove</button>
                    </form>
                    
                </div>
                <p class="total">Total: <?= number_format($totalPrice, 2, ',', '.') ?>€</p>
                <button class="buy">Buy all</button>
            <?php } ?>
        </div>
    </body>
</html>   
</main>
<?php } ?>

<?php function emptyCart(){ ?>
    <body>
        <p class="empty">Your list is still empty :(</p>
        <a href="home.php" class="home">Add items to cart</a>
    </body>
</html>   
</main>  
<?php } ?>