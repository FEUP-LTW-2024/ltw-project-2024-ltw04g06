<?php function createWishlist(){ ?>
    <head>
        <link rel="stylesheet" href="/../css/wishlist.css">
    </head>
    <main>
         <p class=title>Wishlist</p>
<?php } ?>

<?php function wishlistDisplay($wishlistItems) { ?>
    <body>
        <div class="all-images">
            <?php foreach ($wishlistItems as $itemm) { ?>
                <div class="image">
                    <img class=image src=<?='/../' . $itemm->images?> alt="">
                    <p class=item-name><?=$itemm->name?></p>
                    <form action="/../actions/action_rem_from_wishlist.php" method="post">
                        <input type="hidden" name="itemIDDD" value="<?php echo $itemm->itemID; ?>">
                        <button type="submit" class="remove">Remove</button>
                    </form>
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