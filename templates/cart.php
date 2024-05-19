<?php 
function createCart(){ 
?>
    <head>
        <link rel="stylesheet" href="/../css/cart.css">
    </head>
    <main>
         <p class="title">Cart</p>
<?php 
} 

function cartDisplay(PDO $db,$session, $cartItems){ 
?>
    <body>

        <div class="products">
            <?php $totalPrice = 0;
            foreach ($cartItems as $item) { 
                $totalPrice += $item->price;
                $user = Item::getItemSeller($db, $item->itemID);?>
                <div class="product">
                <form id="profileForm<?= $user->userID ?>" action="/../actions/action_toSeeProfile.php" method="post" class="hidden">
                    <input type="hidden" name="userId" value="<?php echo htmlspecialchars($user->userID); ?>">
                </form>
                <header onclick="document.getElementById('profileForm<?= $user->userID ?>').submit();">
                    <img src=<?= User::getUserPic($db, $user->userID)?> alt="">
                    <p><?=$user->username?></p>
                </header>
                <div class="image">
                    <form id="viewItem<?= $item->itemID ?>" action="/../actions/action_toItemSold.php" method="post" class="hidden">
                        <input type="hidden" name="itemID" value="<?php echo htmlspecialchars($item->itemID); ?>">
                    </form>
                    <img onclick="document.getElementById('viewItem<?= $item->itemID ?>').submit();" class="foto" src=<?=Item::getImagePic($db, $item)?> alt="">
                   
                    <p class="item-name"><?= htmlspecialchars($item->name) ?></p>
                    <p class="item-price"><?= number_format($item->price, 2, ',', '.') ?>€</p>
                    <form action="/../actions/action_rem_from_shopCart.php" method="post">
                        <input type="hidden" name="csrf" value="<?= htmlspecialchars($_SESSION['csrf']) ?>">
                        <input type="hidden" name="itemID" value="<?= htmlspecialchars($item->itemID) ?>">
                        <button type="submit" class="remove">Remove</button>
                    </form>
                </div>
            </div>
            <?php } ?>
        </div>
        <p class="total">Total: <?= number_format($totalPrice, 2, ',', '.') ?>€</p>
        <?php 
            $session->displayMessages();
            ?>
        <?php if ($cartItems != null){?>
            <form action="/../pages/editShipping.php" method="post">
                <button class="buy" type="submit">Buy all</button>
            </form>
        <?php }?>
    </body>
</html>   
</main>
<?php 
} 

function emptyCart(){ 
?>
    <body>
        <p class="empty">Your list is still empty :(</p>
        <a href="home.php" class="home">Add items to cart</a>
    </body>
</html>   
</main>  
<?php 
} 
?>
