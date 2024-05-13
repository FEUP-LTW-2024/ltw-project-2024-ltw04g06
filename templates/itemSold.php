<?php function displayItemSold(){ ?>
    <head>
        <link rel="stylesheet" href="/../css/itemSold.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    </head>
    <main>
<?php } ?>

<?php function itemSoldForm($item, $db){ ?>
    <div class="form">
        <div class="left-column">
           <div class="products">
            <?php $user = Item::getItemSeller($db, $item->itemID);?>
                <div class="product">
                <header>
                    <form action="/../pages/itemActive.php" method="post">
                        <input type="hidden" name="itemID" value="<?=$item->itemID?>">
                        <button type="submit" class="submitButton">Active</button>
                    </form>
                </header>
            
                    <p class="item-name"><?= $item->name ?></p>
                    <form action="/../actions/action_add_to_wishlist.php" method="post">
                        <input type="hidden" name="itemID" value="<?= $item->itemID ?>">
                        <button type="submit" class="wishlist"><i class="fa-regular fa-heart"></i></button>
                    </form>
          
                <label for="foto" class="foto-label">
                <div class="image">
                    <?php
                    $imageUrls = explode(',', $item->images);
                    $imageSrc = $imageUrls[0];
                    ?>
                    <form id="itemActive<?= $item->itemID ?>" action="" method="post" class="hidden">
                        <input type="hidden" name="itemID" value="<?=$item->itemID?>">
                    </form>
                    <img onclick="document.getElementById('itemActive<?= $item->itemID ?>').submit();" class="foto" src=<?='/../' . $imageSrc?> alt="">
                    </div>   
            </label> 
               </div>
           </div>               
        </div>
        <div class="right-column">
            <form action="" method="post">
                <button type="submit" class="edit"> <i class="fas fa-pencil-alt"></i>Edit item</button>
            </form>
            <div class="description">
                <p><label class="description"><strong>Description: </strong> <?= $item->description ?></p></label>
            </div>
           
                <div class="brand-model">
                    <p><label class="brand"><strong>Brand: </strong><?= $item->brand ?></label>

                    <label class="model"><strong>Model:</strong> <?= $item->model ?></label></p>
                </div>
                <div class="condition-size">
                    <p><label class="condition"><strong>Condition: </strong><?= $item->condition ?></label>

                    <label class="size"><strong>Size:</strong> <?= $item->size ?></label></p>
                </div>
                <div class="category-price">
                    <p><label class="category"><strong>Category:</strong> <?= $item->category ?></label>

                    <label class="price"><strong>Price:</strong> <?= number_format($item->price, 2, ',', '.') ?>€</label></p>
                </div>
        </div>
    </div>   
    <form action="/../actions/action_edit_shippingForm.php" method="post">
        <input type="hidden" name="itemID" value="<?=$item->itemID?>">
        <button type="submit" class="print">Print Ship Form</button>
    </form>
</main>
<?php } ?>