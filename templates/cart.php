<?php function createCart(){ ?>
    <head>
        <link rel="stylesheet" href="/../css/cart.css">
    </head>
    <main>
         <p class=title>Cart</p>
<?php } ?>

<?php function cartDisplay($cartItems){ ?>
    <body>
        <div class="all-images">
            <?php foreach ($cartItems as $item) { ?>
                <div class="image">
                    <?php
                    $imageUrls = explode(',', $item->images);
                    $imageSrc = $imageUrls[0];
                    ?>
                    <img class="foto" src=<?='/../' . $imageSrc?> alt="">
                   
                    <p class=item-name><?=$item->name?></p>
                    <form action="/../actions/action_rem_from_shopCart.php" method="post">
                        <input type="hidden" name="itemID" value="<?=$item->itemID?>">
                        <button type="submit" class="remove">Remove</button>
                    </form>
                </div>
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