<?php function displayItemActive(){ ?>
    <head>
        <link rel="stylesheet" href="/../css/itemActive.css">
    </head>
    <main>
      <script src="itemActive.js"></script>
        <button class="submitButton">Sold</button>
        <button class="submitButton" onclick="window.location.href = '/../pages/sellItem.php'">Edit item</button>
<?php } ?>

<?php function itemActiveForm(){ ?>
    <div class="form">
        <div class="left-column">
            <div class="title">
                Title <?php echo htmlspecialchars($_POST['title']); ?>
            </div>
            <label for="foto" class="foto-label">
                <div class="quadrado">
                <?php
                $imageUrls = explode(',', $item->images);
                $imageSrc = $imageUrls[0];
            ?>
                    <img src=<?='/../' . $imageSrc?> alt="<?= $item->name ?>">
                </div>
            </label>                
        </div>
        <div class="right-column">
            <div class="description">
                Description <?php echo htmlspecialchars($_POST['description']); ?>
            </div>
            <div class="brand">
                Brand <?php echo htmlspecialchars($_POST['brand']); ?>
            </div>
            <div class="model">
                Model <?php echo htmlspecialchars($_POST['model']); ?>
            </div>
            <div class="size">
                Size <?php echo htmlspecialchars($_POST['sizes']); ?>
            </div>
            <div class="condition">
                Condition <?php echo htmlspecialchars($_POST['condition']); ?>
            </div>
            <div class="category">
                Category <?php echo htmlspecialchars($_POST['category']); ?>
            </div>
            <div class="price">
                Price <?php echo htmlspecialchars($_POST['price']); ?>
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
</main>
<?php } ?>