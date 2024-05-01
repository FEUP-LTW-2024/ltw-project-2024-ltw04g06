<?php function topo(){ ?>
<head>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="../js/script.js" defer></script>
</head>
<body>
    <div class="topo">
        <div class="firstRow">
            <div class="barra">
                <button class="all" id="showFormButton">All<i class="fa-solid fa-caret-down"></i>
                </button>
                <div id="elementToToggle" class="hidden">
                    <?php searchForm() ?>
                </div>
                <input type="text">
                <button class="pesquisa"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
            <h3><i class="fa-regular fa-bell"></i></h3> 
            <h3><a href="/../pages/message.php"><i class="fa-regular fa-envelope"></i></a></h3> 
            <h3><a href="/../pages/wishlist.php"><i class="fa-regular fa-heart"></i></h3>
            <button class="carrinho"><i class="fa-solid fa-cart-shopping"></i></button>
            <h3><a href="">Sell an item</a></h3>
            <div class="avatar">
                <div id="menu">
                    <input type="checkbox" id="hamburger"> 
                    <label class="hamburger" for="hamburger"></label>
                    <ul>
                        <li><a href="/../pages/profile.php">Profile</a></li>
                        <li><a href="/../pages/settings.php">Settings</a></li>
                        <li><a href="">Log out</a></li>
                    </ul>
                </div>
                <img src="">
            </div>
        </div>
        <div class="types">
            <ul>
                <li><a href="">Clothing</a></li>
                <li><a href="">Acessories</a></li>
                <li><a href="">Eletronics</a></li>
                <li><a href="">Furniture</a></li>
                <li><a href="">Toys</a></li>
            </ul>
        </div>
    </div>
    
</body>
<?php } ?>