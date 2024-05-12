<?php function topo(User $user){ ?>
<head>
    <link rel="stylesheet" href="../css/topo.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="../js/script.js" defer></script>
</head>
<body>
    <div class="topo">
        <div class="firstRow">
            <h2>LOGO</h2>
            <div class="barra">
                <button class="all" id="showFormButton">All<i class="fa-solid fa-caret-down"></i>
                </button>
                <div id="elementToToggle" class="hidden">
                    <?php searchForm() ?>
                </div>
                <form action="/../pages/home.php" method="post">
                    <input name="word" type="text">
                    <button type="submit" class="pesquisa"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>
            <h3><i class="fa-regular fa-bell"></i></h3> 
            <h3><a href="/../pages/message.php"><i class="fa-regular fa-envelope"></i></a></h3> 
            <h3><a href="/../pages/wishlist.php"><i class="fa-regular fa-heart"></i></h3>
            <button class="carrinho"><a href="/../pages/cart.php"><i class="fa-solid fa-cart-shopping"></i></button>
            <h3><a href="/../pages/sellItem.php">Sell an item</a></h3>
            <div class="avatar">
                <div id="menu">
                    <input type="checkbox" id="hamburger"> 
                    <label class="hamburger" for="hamburger"></label>
                    <ul>
                        <li><a href="/../pages/profile.php">Profile</a></li>
                        <li><a href="/../pages/settings.php">Settings</a></li>
                        <li><a href="/../actions/action_logout.php">Log out</a></li>
                    </ul>
                </div>
                <img src="<?=$user->profilePicture?>">
            </div>
        </div>
        <div class="types">
            <ul>
                <li><a href="/../pages/home.php?category=Clothing">Clothing</a></li>
                <li><a href="/../pages/home.php?category=Accessories">Accessories</a></li>
                <li><a href="/../pages/home.php?category=Eletronics">Eletronics</a></li>
                <li><a href="/../pages/home.php?category=Furniture">Furniture</a></li>
                <li><a href="/../pages/home.php?category=Toys">Toys</a></li>
            </ul>
        </div>
    </div>
    
</body>
<?php } ?>