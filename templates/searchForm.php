<?php
    require_once(__DIR__ . '/../classes/category.class.php');
    require_once(__DIR__ . '/../classes/condition.class.php');
    require_once(__DIR__ . '/../classes/size.class.php');
    require_once(__DIR__ . '/../database/connectdb.php');
    $db = getDatabaseConnection();
?>

<?php function searchForm(){ ?>
<head>
    <link rel="stylesheet" href="../css/sF.css">
</head>
<div id="overlayForm">
    <header>
        <h3>Filter by:</h3>
    </header>
    <form action="/../pages/home.php" method="post">
        <div  class = "row">
        <div class="category">
            <h3>Category</h3>
                <?php
                    $db = getDatabaseConnection();
                    $categories = Category::getAllCategories($db);
                    echo ' <select name="category">';
                    echo '<option value="NULL" selected>No filter</option>';
                    foreach ($categories as $category) {
                        echo '<option value= "' . $category->name . '">' . $category->name . '</option>';
                    }
                    echo '</select>';
                ?>

            </div>

            <div class="condition">
                <h3>Condition</h3>
                <?php
                    $db = getDatabaseConnection();
                    $conditions = Condition::getAllConditions($db);
                    echo ' <select name="condition">';
                    echo '<option value="NULL" selected>No filter</option>';
                    foreach ($conditions as $condition) {
                        echo '<option value= "' . $condition->usage . '">' . $condition->usage . '</option>';
                    }
                    echo '</select>';
                ?>
            </div>
            <div class="size">
                <h3>Size</h3>
                <select name="size">
                    <option value="NULL" selected>No filter</option>
                    <option value="not used">Not used</option>
                    <option value="barely used">Barely used</option>
                    <option value='Used'>Used</option>
                    <option value="very used">Very used</option>
                </select>
            </div>
        </div> 
        
        <div class="price">
            <h3>Price</h3>
            <label>Min: <input type="number" name="min"></label>
            <br>
            <label>Max: <input type="number" name="max"></label>
            <br>
            <button type="submit">Search</button>
        </div>
    </form>

</div>
<?php } ?>