<?php
function displayItemActive()
{ 
?>
    <head>
        <link rel="stylesheet" href="/../css/itemActive.css">
    </head>
    <main>
<?php 
} 

function itemActiveForm($item, $db)
{ 
?>
    <div class="form">
        <div class="left-column">
            <div class="products">
                <div class="product">
                    <header>
                        <button class="submitButton">Active</button>
                    </header>
                    <p class="item-name"><?= htmlspecialchars($item->name) ?></p>
                    <form action="/../actions/action_add_to_wishlist.php" method="post">
                        <input type="hidden" name="csrf" value="<?= htmlspecialchars($_SESSION['csrf']) ?>">
                        <input type="hidden" name="itemID" value="<?= htmlspecialchars($item->itemID) ?>">
                    </form>
                    <label for="foto" class="foto-label">
                        <div class="image">
                            <form id="itemActive<?= htmlspecialchars($item->itemID) ?>" action="" method="post" class="hidden">
                                <input type="hidden" name="csrf" value="<?= htmlspecialchars($_SESSION['csrf']) ?>">
                                <input type="hidden" name="itemID" value="<?= htmlspecialchars($item->itemID) ?>">
                            </form>
                            <img onclick="document.getElementById('itemActive<?= htmlspecialchars($item->itemID) ?>').submit();" class="foto" src="<?= htmlspecialchars(Item::getImagePic($db, $item)) ?>" alt="">
                        </div>
                    </label>
                </div>
            </div>
        </div>
        <div class="right-column">
            <form action="/../actions/action_itemToEdit.php" method="post" >
            <input type="hidden" name="itemID" value="<?php echo htmlspecialchars($item->itemID); ?>">
            <input type="hidden" name="csrf" value="<?= htmlspecialchars($_SESSION['csrf']) ?>">
            <button type="submit" class="edit"><i class="fas fa-pencil-alt"></i>Edit item</button>            
            </form>
            <div class="description">
                <p><label class="description"><strong>Description: </strong> <?= htmlspecialchars($item->description) ?></p></label>
            </div>
            <div class="brand-model">
                <p><label class="brand"><strong>Brand: </strong><?= htmlspecialchars($item->brand) ?></label>
                <label class="model"><strong>Model:</strong> <?= htmlspecialchars($item->model) ?></label></p>
            </div>
            <div class="condition-size">
                <p>
                    <?php
                    $condition = Condition::getCondition($db, $item->conditionID);
                    $size = Size::getSize($db, $item->sizeID);
                    ?>
                    <label class="condition"><strong>Condition: </strong><?= htmlspecialchars($condition->usage) ?></label>
                    <label class="size"><strong>Size:</strong> <?= htmlspecialchars($size->name) ?></label>
                </p>
            </div>
            <div class="category-price">
                <p>
                    <?php
                    $category = Category::getCategory($db, $item->categoryID);
                    ?>
                    <label class="category"><strong>Category:</strong> <?= htmlspecialchars($category->name) ?></label>
                    <label class="price"><strong>Price:</strong> <?= number_format($item->price, 2, ',', '.') ?>€</label>
                </p>
            </div>
        </div>
    </div>
</main>
<?php 
} 
?>
