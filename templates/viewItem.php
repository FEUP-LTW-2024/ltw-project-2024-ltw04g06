<?php function displayViewItem(){ ?>
    <head>
        <link rel="stylesheet" href="/../css/viewItem.css">
    </head>
    <main>
<?php } ?>

<?php function viewItemForm($item, $db){ ?>
    <div class="form">
        <div class="left-column">
           <div class="products">
            <?php $user = Item::getItemSeller($db, $item->itemID);?>
                <div class="product">
                <form id="profileForm<?= $user->userID ?>" action="/../pages/seeProfile.php" method="post" class="hidden">
                    <input type="hidden" name="userId" value="<?= $user->userID ?>">
                </form>
                <header onclick="document.getElementById('profileForm<?= $user->userID ?>').submit();">
                    <img src=<?= '/../' . $user->profilePicture?> alt="">
                    <p><?=$user->username?></p>
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
                    $imageSrc1 = $imageUrls[1];
                    $imageSrc2 = $imageUrls[2];
                    $imageSrc3 = $imageUrls[3];
                    ?>
                    <form id="viewItem<?= $item->itemID ?>" action="" method="post" class="hidden">
                        <input type="hidden" name="itemID" value="<?=$item->itemID?>">
                    </form>
                    <img onclick="document.getElementById('viewItem<?= $item->itemID ?>').submit();" class="foto" src=<?='/../' . $imageSrc?> alt="">
                    <div class="mini-images">
                       <img onclick="document.getElementById('viewItem<?= $item->itemID ?>').submit();" class="foto" src=<?='/../' . $imageSrc1?> alt="">
                       <img onclick="document.getElementById('viewItem<?= $item->itemID ?>').submit();" class="foto" src=<?='/../' . $imageSrc2?> alt="">
                       <img onclick="document.getElementById('viewItem<?= $item->itemID ?>').submit();" class="foto" src=<?='/../' . $imageSrc3?> alt="">
                    </div>
                    </div>   
            </label> 
               </div>
           </div>               
        </div>
        <div class="right-column">
            <form action="/../pages/message.php" method="post">
                <button type="submit" class="message">Message seller</button>
            </form>
            <div class="description">
                <p><label class="description"><strong>Description: </strong> <?= $item->description ?></p></label>
            </div>
           
                <div class="brand-model">
                    <p><label class="brand"><strong>Brand: </strong><?= $item->brand ?></label>

                    <label class="model"><strong>Model:</strong> <?= $item->model ?></label></p>
                </div>
                <div class="condition-size">
                    <p><label class="condition"><strong>Condition: </strong><?= $item->conditionID ?></label>

                    <label class="size"><strong>Size:</strong> <?= $item->sizeID ?></label></p>
                </div>
                <div class="category-price">
                    <p><label class="category"><strong>Category:</strong> <?= $item->categoryID ?></label>

                    <label class="price"><strong>Price:</strong> <?= number_format($item->price, 2, ',', '.') ?>€</label></p>
                </div>
        </div>
    </div>   
    <form action="/../actions/action_add_to_shopCart.php" method="post">
                    <input type="hidden" name="itemID" value="<?=$item->itemID?>">
                    <button type="submit" class="submitButton">Buy</button>
    </form>
</main>
<?php } ?>
