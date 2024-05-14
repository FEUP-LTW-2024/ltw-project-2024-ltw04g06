<?php function displayItemActive(){ ?>
    <head>
        <link rel="stylesheet" href="/../css/itemActive.css">
    </head>
    <main>
<?php } ?>

<?php function itemActiveForm($item, $db){ ?>
    <div class="form">
        <div class="left-column">
           <div class="products">
            <?php $user = Item::getItemSeller($db, $item->itemID);?>
                <div class="product">
                <header>
                    <button onclick="window.location.href='/../pages/itemSold.php?itemID=<?=$item->itemID?>'" class="submitButton">Active</button>
                </header>
            
                    <p class="item-name"><?= $item->name ?></p>
                    <form action="/../actions/action_add_to_wishlist.php" method="post">
                        <input type="hidden" name="itemID" value="<?php echo htmlspecialchars($item->itemID); ?>">
                        <button type="submit" class="wishlist"><i class="fa-regular fa-heart"></i></button>
                    </form>
          
                <label for="foto" class="foto-label">
                <div class="image">
                    <form id="itemActive<?= $item->itemID ?>" action="" method="post" class="hidden">
                        <input type="hidden" name="itemID" value="<?php echo htmlspecialchars($item->itemID); ?>">
                    </form>
                    <img onclick="document.getElementById('itemActive<?= $item->itemID ?>').submit();" class="foto" src=<?=Item::getImagePic($db, $item->imageID)?> alt="">
                    </div>   
            </label> 
               </div>
           </div>               
        </div>
        <div class="right-column">
            <form action="" method="post">
                <button type="submit" class="edit"><i class="fas fa-pencil-alt"></i>Edit item</button>
            </form>
            <div class="description">
                <p><label class="description"><strong>Description: </strong> <?= $item->description ?></p></label>
            </div>
           
                <div class="brand-model">
                    <p><label class="brand"><strong>Brand: </strong><?= $item->brand ?></label>

                    <label class="model"><strong>Model:</strong> <?= $item->model ?></label></p>
                </div>
                <div class="condition-size">
                    <p><?php
                        require_once(__DIR__ . '/../classes/condition.class.php');
                        require_once(__DIR__ . '/../classes/size.class.php');
                        require_once(__DIR__ . '/../database/connectdb.php');
                        $db = getDatabaseConnection();
                        $condition = Condition::getCondition($db, $item->conditionID);
                        $size = Size::getSize($db, $item->sizeID);
                    ?>
                    <label class="condition"><strong>Condition: </strong><?= $condition->usage ?></label>

                    <label class="size"><strong>Size:</strong> <?= $size->name ?></label></p>
                </div>
                <div class="category-price">
                    <p><?php
                        require_once(__DIR__ . '/../classes/category.class.php');
                        require_once(__DIR__ . '/../database/connectdb.php');
                        $db = getDatabaseConnection();
                        $category = Category::getCategory($db, $item->categoryID);
                    ?>
                    <label class="category"><strong>Category:</strong> <?= $category->name ?></label>

                    <label class="price"><strong>Price:</strong> <?= number_format($item->price, 2, ',', '.') ?>€</label></p>
                </div>
        </div>
    </div>   
</main>
<?php } ?>