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

function cartDisplay(PDO $db, $cartItems){ 
?>
    <body>
        <div class="all-images">
            <?php 
            $totalPrice = 0;
            foreach ($cartItems as $item) { 
                $totalPrice += $item->price;
            ?>
                <div class="image">
                    <img class="foto" src="<?= htmlspecialchars(Item::getImagePic($db, $item)) ?>" alt="">
                   
                    <p class="item-name"><?= htmlspecialchars($item->name) ?></p>
                    <p class="item-price"><?= number_format($item->price, 2, ',', '.') ?>€</p>
                    <form action="/../actions/action_rem_from_shopCart.php" method="post">
                        <input type="hidden" name="csrf" value="<?= htmlspecialchars($_SESSION['csrf']) ?>">
                        <input type="hidden" name="itemID" value="<?= htmlspecialchars($item->itemID) ?>">
                        <button type="submit" class="remove">Remove</button>
                    </form>
                </div>
            <?php 
            } 
            ?>
        </div>
        <p class="total">Total: <?= number_format($totalPrice, 2, ',', '.') ?>€</p>
        <button class="buy">Buy all</button>
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
