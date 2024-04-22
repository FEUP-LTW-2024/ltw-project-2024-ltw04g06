<?php function itemDisplay(array $items){ ?>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/home.css">
</head>
<main>
    <div class="products">
    <?php foreach ($items as $item) {
        ?>
        <div class="product">
            <header>
                <img src=<?=$item->images?> alt="">
                <h3><?=$item->sellerID?></h3>
            </header>
            <img class="foto" src=<?=$item->images?> alt="">
            <h3><?=$item->description?> <i class="fa-regular fa-heart"></i></h3>
            <h4><?=$item->price?><i class="fa-solid fa-euro-sign"></i></h4>
        </div>
        <?php } ?>
    </div>
    </main>
    <?php } ?>