<?php function displayItemActive(){ ?>
    <head>
        <link rel="stylesheet" href="/../css/itemActive.css">
    </head>
    <main>
<?php } ?>

<?php function itemActiveForm($item){ ?>
    <div class="form">
        <div class="left-column">
            <div class="title">
                <p> <?= $item->name ?> </p>
                <form action="/../actions/action_add_to_wishlist.php" method="post">
                    <input type="hidden" name="itemIDD" value="<?=$item->itemID?>">
                    <button type="submit" class="wishlist"><i class="fa-regular fa-heart"></i></button>
                </form>
            </div>
            <label for="foto" class="foto-label">
                <div class="quadrado">
                    <img src=<?='/../' . $item->images?> alt="<?= $item->name ?>">
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
        </div>
    </div>   
    <button class="submitButton" onclick="window.location.href = '/../actions/action_add_to_shopCart.php'">Buy</button>     
</main>
<?php } ?>

<?php function ola($item) { ?>
    <div class="item">
        <h1><?= $item->name ?></h1>
        <p><strong>Preço:</strong> R$ <?= number_format($item->price, 2, ',', '.') ?></p>
        <p><strong>Marca:</strong> <?= $item->brand ?></p>
            <p><strong>Modelo:</strong> <?= $item->model ?></p>
            <p><strong>Descrição:</strong> <?= $item->description ?></p>
            <img src=<?='/../' . $item->images?> alt="<?= $item->name ?>">
    </div>
<?php } ?>