
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

<?php function editItemForm($item, $session){ ?>
    <form action="/../actions/action_edit_item.php" method="post"  enctype="multipart/form-data" onsubmit="encodeAndSendMessage(event, 'edit-item-form', '/../actions/action_edit_item.php')">

 <input type="hidden" name="itemID" value="<?php echo htmlspecialchars($item->itemID); ?>">
 <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
    <div class="form">
        <div class="left-column">
            <div class="title">
                <label for="title">New title</label>
                <textarea  class="title-input" type="text" rows="1" cols="24" id="title" name="newName"><?= $item->name?></textarea>
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
                <textarea  class="description-input" name="newDescription" rows="10" cols="58"><?= $item->description?></textarea>
            </div>
            <div class="brand">
                <label for="brand">New brand</label>
                <input value="<?= $item->brand?>" class="brand-input" type="text" name="newBrand">
        
                <label class="model-label" for="model">New model</label>
                <textarea class="model-input" type="text" rows="1" cols="20" name="newModel"><?= $item->model?></textarea>
            </div>
            <div class="size">
                <label class="condition-label" for="condition">New condition</label>
                <select class="condition" name="newConditionName">
                <?php
                        $db = getDatabaseConnection();
                        $conditionItem = Condition::getCondition($db, $item->conditionID);
                        $conditions = Condition::getAllConditions($db);
                        echo '<option value="NULL">' . htmlspecialchars($conditionItem->usage) . '</option>';
                        foreach ($conditions as $condition) {
                            if ($item->conditionID == $condition->conditionID){
                                echo '<option selected value= "' .  htmlspecialchars($condition->usage) . '">' .  htmlspecialchars($condition->usage) . '</option>';
                            }else{
                                echo '<option value= "' .  htmlspecialchars($condition->usage) . '">' .  htmlspecialchars($condition->usage) . '</option>';
                            }
                        }
                    ?>
                </select>
                <label class="size-label" for="size">New size</label>
                <div class="size2">
                    <?php
                    $db = getDatabaseConnection();
                    $sizes = Size::getAllSizes($db);
                    foreach ($sizes as $size) {
                        $name = htmlspecialchars($size->name);
                        if ($item->sizeID == $size->sizeID){
                            echo '<input type="radio" checked id="' . $name . '" name="newSizeName" value="' . $name . '" class="radio-input">';
                        }else{
                            echo '<input type="radio" id="' . $name . '" name="newSizeName" value="' . $name . '" class="radio-input">';
                        }
                        echo '<label for="' . $name . '" class="radio-label">' . $name . '</label>';
                    }
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
                            if ($item->categoryID == $category->categoryID){
                                echo '<option selected value= "' . htmlspecialchars($category->name) . '">' .htmlspecialchars($category->name) . '</option>';
                            }else{
                                echo '<option value= "' . htmlspecialchars($category->name) . '">' .htmlspecialchars($category->name) . '</option>';
                            }
                        }
                    ?>

                </select>
            
                <label class="price-label" for="price">New price</label>
                <textarea class="price-input" type="text" rows="1" cols="20" name="newPrice"><?= $item->price?></textarea>
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