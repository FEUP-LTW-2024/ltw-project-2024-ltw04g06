<?php function displayItemSold(){ ?>
    <head>
        <link rel="stylesheet" href="/../css/itemSold.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    </head>
    <main>
<?php } ?>

<?php function itemSoldForm(Item $item, PDO $db, int $userID){ ?>
    <div class="form">
        <div class="left-column">
           <div class="products">
            <?php $user = Item::getItemSeller($db, $item->itemID);?>
                <div class="product">  
                <button class="submitButton">Sold</button>
              
            
                    <p class="item-name"><?= $item->name ?></p>
                    <form action="/../actions/action_add_to_wishlist.php" method="post">
                        <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
                        <input type="hidden" name="itemID" value="<?php echo htmlspecialchars($item->itemID); ?>">
                        <button type="submit" class="wishlist"><i class="fa-regular fa-heart <?php echo User::existItemUserWish($db, $userID, $item->itemID) ? 'red' : ''?>"></i></button></p>
                    </form>
          
                <label for="foto" class="foto-label">
                <div class="image">
                    <form id="itemActive<?= $item->itemID ?>" action="" method="post" class="hidden">
                    <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">

                        <input type="hidden" name="itemID" value="<?php echo htmlspecialchars($item->itemID); ?>">
                    </form>
                    <img onclick="document.getElementById('itemActive<?= $item->itemID ?>').submit();" class="foto" src=<?=Item::getImagePic($db, $item)?> alt="">
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
                <p class="seller">Seller</p>
                <form id="profileForm<?= $item->sellerID ?>" action="/../actions/action_toSeeProfile.php" method="post" class="hidden">
                    <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
                    <input type="hidden" name="userId" value="<?php echo htmlspecialchars($item->sellerID); ?>">
                </form>
                <header onclick="document.getElementById('profileForm<?= $item->sellerID ?>').submit();">
                    <?php $userSeller= User::getUser($db, $item->sellerID);?>
                    <img src=<?= User::getUserPic($db, $userSeller->userID)?> alt="">
                    <p><?=$userSeller->username?></p>
                </header>

                <p class="buyer">Buyer</p>
                <?php $shipForm = ShippingForm::getShippingFormByItemID($db, $item->itemID);
                $buyerID = $shipForm->buyerID;
                $buyer = User::getUser($db, $buyerID);?>
                <form id="profileForm<?= $buyerID ?>" action="/../pages/seeProfile.php" method="post" class="hidden">
                    <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
                    <input type="hidden" name="userId" value="<?php echo htmlspecialchars($buyerID); ?>">
                </form>
                <header onclick="document.getElementById('profileForm<?= $buyerID ?>').submit();">
                    <img src=<?= User::getUserPic($db, $buyerID)?> alt="">
                    <p><?=$buyer->username?></p>
                </header>

        </div>
    </div>
    <?php 
        if ($item->sellerID == $userID){?>
            <form action="/../pages/printShipping.php" method="post">
            <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
                <input type="hidden" name="itemID" value="<?php echo htmlspecialchars($item->itemID); ?>">
                <button type="submit" class="print">Print Ship Form</button>
            </form>
        <?php }?>
</main>
<?php } ?>