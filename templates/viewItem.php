<?php function displayViewItem(){ ?>
    <head>
        <link rel="stylesheet" href="/../css/viewItem.css">
    </head>
    <main>
<?php } ?>

<?php function viewItemForm($item, $db, $userID){ ?>
    <div class="form">
        <div class="left-column">
           <div class="products">
            <?php $user = Item::getItemSeller($db, $item->itemID);?>
                <div class="product">
                <form id="profileForm<?= $user->userID ?>" action="/../actions/action_toSeeProfile.php" method="post" class="hidden">
                    <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
                    <input type="hidden" name="userId" value="<?php echo htmlspecialchars($user->userID); ?>">
                </form>
                <header onclick="document.getElementById('profileForm<?= $user->userID ?>').submit();">
                    <img src=<?= User::getUserPic($db, $user->userID)?> alt="">
                    <p><?=$user->username?></p>
                </header>
            
                    <p class="item-name"><?= $item->name ?></p>
                    <form id = "wishlist-form" method="get">
                        <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
                        <input type="hidden" name="itemID" value="<?php echo htmlspecialchars($item->itemID); ?>">
                        <button type="submit" id = "heart" class="wishlist <?php echo User::existItemUserWish($db, $userID, $item->itemID) ? 'red' : ''?>"><i class="fa-regular fa-heart"></i></button>
                    </form>
          
                <label for="foto" class="foto-label">
                <div class="image">
                    <form id="viewItem<?= $item->itemID ?>" action="" method="post" class="hidden">
                        <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
                        <input type="hidden" name="itemID" value="<?php echo htmlspecialchars($item->itemID); ?>">
                    </form>
                    <img onclick="document.getElementById('viewItem<?= $item->itemID ?>').submit();" class="foto" src=<?=Item::getImagePic($db, $item)?> alt="">
                    </div>   
            </label> 
               </div>
           </div>               
        </div>
        <div class="right-column">
            <form action="" method="post" >
                <input type="hidden" name="itemID" value="">
                <input type="hidden" name="csrf" value="">
                <p type="submit" class="edit"> </p>            
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
                    <label class="condition"><strong>Condition: </strong><?=  $condition->usage ?></label>

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
    <form action="/../actions/action_add_to_shopCart.php" method="post">
        <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
        <input type="hidden" name="itemID" value="<?php echo htmlspecialchars($item->itemID); ?>">
        <button type="submit" class="submitButton">Buy</button>
    </form>
</main>
<?php } ?>
