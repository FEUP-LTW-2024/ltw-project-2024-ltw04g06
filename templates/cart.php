<?php function createCart(){ ?>
    <head>
        <link rel="stylesheet" href="/../css/cart.css">
    </head>
    <main>
         <p class=title>Cart</p>
<?php } ?>

<?php function cartDisplay(){ ?>
    <ul class="items" id="items">
        <li>Item 1- 10,00€</li>
        <li>Item 2- 23,00€</li>
        <li>Item 3- 5,50€</li>
    </ul>
    <div class="total">
        <strong>Total:</strong> <span id="total">0,00€</span>
    </div>
    <button class="buy">Buy all</button>
</div>
</body>
<?php } ?>

<?php function emptyCart(){ ?>
    <body>
        <p class="empty">Your list is still empty :(</p>
        <a href="home.php" class="home">Add items to wishlist</a>
    </body>
</html>   
</main>  
<?php } ?>