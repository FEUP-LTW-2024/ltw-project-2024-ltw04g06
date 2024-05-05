<?php function createWishlist(){ ?>
    <head>
        <link rel="stylesheet" href="/../css/wishlist.css">
    </head>
    <main>
         <p>Wishlist</p>
<?php } ?>

<?php function wishlistDisplay(){ ?>
    <body>
        <div class="all-images">
            <?php for ($i = 1; $i <= 9; $i++) { ?>
                <div class="image">
                    <img src="/../images/plushies_<?php echo $i % 3; ?>.png" alt="Imagem <?php echo $i; ?>">
                    <form action="/../actions/action_remove_wishlist.php" method="post">
                        <input type="hidden" name="itemIDDD" value="<?php echo $i; ?>"> 
                        <button type="submit" class="remove-btn">Remove</button>
                    </form>
                </div>
            <?php } ?>
        </div>
    </body>
</html>   
</main>
<?php } ?>