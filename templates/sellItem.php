
<?php
    require_once(__DIR__ . '/../classes/category.class.php');
    require_once(__DIR__ . '/../classes/condition.class.php');
    require_once(__DIR__ . '/../classes/size.class.php');
    require_once(__DIR__ . '/../database/connectdb.php');
    $db = getDatabaseConnection();
 function displaySellItem(){ ?>
    <head>
        <link rel="stylesheet" href="/../css/sellItem.css">
        <script src="/../js/sellItem.js"></script>
    </head>
    <main>
         <p>Sell an item</p>
<?php } ?>

<?php function sellItemForm($session){ ?>
 <form action="/../actions/action_add_item.php" method="post"  enctype="multipart/form-data" onsubmit="encodeAndSendMessage(event, 'sellItemForm', '/../actions/action_add_item.php')">
    <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
    <div class="form">
        <div class="left-column">
            <div class="title">
                <label for="title">Title</label>
                <textarea placeholder="You must fill this." class="title-input" type="text" rows="1" cols="24" id="title" name="title" maxlength="21"></textarea>
            </div>
            <label for="foto" class="foto-label">
                <div id="quadrado" class="quadrado">
                    <div class="load-photo">
                       Load photo
                    </div>
                </div>
                <input type="file" id="foto" accept="image/*" class="foto-input" name="foto" onchange="showImage(this)">
                <img id="imagemExibida" src="#" alt="Minha Imagem" style="display: none;">
            </label> 
            <div id="imagensExibidas"></div>       
        </div>
        <div class="right-column">
            <div class="description">
                <label for="description">Description</label>
                <textarea placeholder="You must fill this." class="description-input" name="description" rows="10" cols="58" maxlength="300"></textarea>
            </div>
            <div class="brand">
                <label for="brand">Brand</label>
                <textarea class="brand-input" type="text" rows="1" cols="19" name="brand" maxlength="35"></textarea>
        
                <label class="model-label" for="model">Model</label>
                <textarea class="model-input" type="text" rows="1" cols="20" name="model" maxlength="35"></textarea>
            </div>
            <div class="size">
                <label class="condition-label" for="condition">Condition</label>
                <select class="condition" name="condition">
                <?php
                        $db = getDatabaseConnection();
                        $conditions = Condition::getAllConditions($db);
                        echo '<option value="NULL" selected>Not selected</option>';
                        foreach ($conditions as $condition) {
                            echo '<option value= "' .  htmlspecialchars($condition->usage) . '">' .  htmlspecialchars($condition->usage) . '</option>';
                        }
                    ?>
                </select>
                <label class="size-label" for="size">Size</label>
                <div class="size2">
                <?php
                    $db = getDatabaseConnection();
                    $sizes = Size::getAllSizes($db);
                    foreach ($sizes as $size) {
                        $name = htmlspecialchars($size->name);
                        echo '<input type="radio" id="' . $name . '" name="sizes" value="' . $name . '" class="radio-input">';
                        echo '<label for="' . $name . '" class="radio-label">' . $name . '</label>';
                    }
                ?>

 
                </div>
            </div>
            <div class="category">
                <label for="category">Category</label>
                <select name="category">
                <?php
                        $db = getDatabaseConnection();
                        $categories = Category::getAllCategories($db);
                        echo '<option value="NULL" selected>Not selected</option>';
                        foreach ($categories as $category) {
                            echo '<option value= "' . htmlspecialchars($category->name) . '">' .htmlspecialchars($category->name) . '</option>';
                        }
                    ?>

                </select>
            
                <label class="price-label" for="price">Price</label>
                <textarea placeholder="You must fill this." class="price-input" rows="1" cols="20" maxlength="35"></textarea>
            </div>
        </div>
    </div>
    <?php 
        $session->displayMessages();
    ?>        
    <input type="submit" class="submitButton" value="Continue">
    </form>
</main>
<?php } ?>
