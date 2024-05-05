<?php function createWishlist(){ ?>
    <head>
        <link rel="stylesheet" href="/../css/wishlist.css">
    </head>
    <main>
         <p>Wishlist</p>
<?php } ?>

<?php function wishlistDisplay($wishlistItems) { ?>
    <body>
        <div class="all-images">
            <?php foreach ($wishlistItems as $itemm) { ?>
                <div class="image">
                    <img src="<?php echo $itemm->images; ?>" alt="<?php echo $itemm->name; ?>">
                    <form action="/../actions/action_remove_from_wishlist.php" method="post">
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