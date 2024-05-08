<?php function displayViewItem(){ ?>
    <head>
        <link rel="stylesheet" href="/../css/viewItem.css">
    </head>
    <main>
<?php } ?>

<?php function viewItemForm($item){ ?>
    <div class="form">
        <div class="left-column">
            <div class="title">
                <p> <?= $item->name ?> </p>
                <form action="/../actions/action_add_to_wishlist.php" method="post">
                    <input type="hidden" name="itemID" value="<?=$item->itemID?>">
                    <button type="submit" class="wishlist"><i class="fa-regular fa-heart"></i></button>
                </form>
            </div>
            <label for="foto" class="foto-label">
                <div class="quadrado">
                    <?php
                    $imageUrls = explode(',', $item->images);
                    $imageSrc = $imageUrls[0];
                    ?>
                    <img class="foto" src=<?='/../' . $imageSrc?> alt="">
                </div>
            </label>                
        </div>
        <div class="right-column">
            <div class="description">
                Description <?= $item->description ?>
            </div>
            <div class="brand">
                Brand <?= $item->brand ?>
            </div>
            <div class="model">
                Model <?= $item->model ?>
            </div>
            <div class="size">
                Size <?= $item->size ?>
            </div>
            <div class="condition">
                Condition <?= $item->condition ?>
            </div>
            <div class="category">
                Category <?= $item->category ?>
            </div>
            <div class="price">
                Price  <?= number_format($item->price, 2, ',', '.') ?>€
            </div>
        </div>
    </div>   
    <form action="/../actions/action_add_to_shopCart.php" method="post">
                    <input type="hidden" name="itemID" value="<?=$item->itemID?>">
                    <button type="submit" class="submitButton">Add to cart</button>
</main>
<?php } ?>
