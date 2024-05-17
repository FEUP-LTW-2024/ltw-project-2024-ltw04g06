
<?php
    require_once(__DIR__ . '/../classes/category.class.php');
    require_once(__DIR__ . '/../classes/condition.class.php');
    require_once(__DIR__ . '/../classes/size.class.php');
    require_once(__DIR__ . '/../database/connectdb.php');
    $db = getDatabaseConnection();
 function displayEditItem($item){ ?>
    <head>
        <link rel="stylesheet" href="/../css/sellItem.css">
        <script src="/../js/sellItem.js"></script>
    </head>
    <main>
         <p>Edit your item</p>
         <p class="edit"><i class="fas fa-pencil-alt"></i> Write only on the parameters you want to change.</p>
<?php } ?>

<?php function editItemForm($item){ ?>
    <form action="/../actions/action_edit_item.php" method="post"  enctype="multipart/form-data">

 <input type="hidden" name="itemID" value="<?php echo htmlspecialchars($item->itemID); ?>">
    <div class="form">
        <div class="left-column">
            <div class="title">
                <label for="title">New title</label>
                <textarea placeholder="<?= $item->name?>" class="title-input" type="text" rows="1" cols="24" id="title" name="newName"></textarea>
            </div>
            <label for="foto" class="foto-label">
                <div id="quadrado" class="quadrado">
                    <div class="load-photo">
                        Load new photo
                    </div>
                </div>
                <input type="file" id="foto" accept="image/*" class="foto-input" name="foto" onchange="showImage(this)" multiple>
                <img id="imagemExibida" src="#" alt="Minha Imagem" style="display: none;">
            </label> 
            <div id="imagensExibidas"></div>       
        </div>
        <div class="right-column">
            <div class="description">
                <label for="description">New description</label>
                <textarea placeholder="<?= $item->description?>" class="description-input" name="newDescription" rows="10" cols="58"></textarea>
            </div>
            <div class="brand">
                <label for="brand">New brand</label>
                <input placeholder="<?= $item->brand?>" class="brand-input" type="text" name="newBrand">
        
                <label class="model-label" for="model">New model</label>
                <textarea placeholder="<?= $item->model?>" class="model-input" type="text" rows="1" cols="20" name="newModel"></textarea>
            </div>
            <div class="size">
                <label class="condition-label" for="condition">New condition</label>
                <select class="condition" name="newConditionName">
                <?php
                        $db = getDatabaseConnection();
                        $conditionItem = Condition::getCondition($db, $item->conditionID);
                        $conditions = Condition::getAllConditions($db);
                        echo '<option value="NULL" selected>' . htmlspecialchars($conditionItem->usage) . '</option>';
                        foreach ($conditions as $condition) {
                            echo '<option value= "' .  htmlspecialchars($condition->usage) . '">' .  htmlspecialchars($condition->usage) . '</option>';
                        }
                    ?>
                </select>
                <label class="size-label" for="size">New size</label>
                <div class="size2">
                <?php
                    $db = getDatabaseConnection();
                    $sizes = Size::getAllSizes($db);
                    foreach ($sizes as $size) {
                        echo '<label for='.htmlspecialchars($size->name) . '>';
                        echo '<input type="radio" id="' . htmlspecialchars($size->name) . '" name="newSizeName" value="' . htmlspecialchars($size->name) . '">' . htmlspecialchars($size->name);
                        echo '</label> ';
                    }
                    echo '</select>';
                ?>

 
                </div>
            </div>
            <div class="category">
                <label for="category">New category</label>
                <select name="newCategoryName">
                <?php
                        $db = getDatabaseConnection();
                        $categoryItem = Category::getCategory($db, $item->categoryID);
                        $categories = Category::getAllCategories($db);
                        echo '<option value="NULL" selected>' . htmlspecialchars($categoryItem->name) . '</option>';
                        foreach ($categories as $category) {
                            echo '<option value= "' . htmlspecialchars($category->name) . '">' .htmlspecialchars($category->name) . '</option>';
                        }
                    ?>

                </select>
            
                <label class="price-label" for="price">New price</label>
                <textarea placeholder="<?= $item->price?>€" class="price-input" type="text" rows="1" cols="20" name="newPrice"></textarea>
            </div>
        </div>
    </div>        
    <input type="submit" class="submitButton" value="Continue">
    </form>
</main>
<?php } ?>
