
<?php function searchForm(){ ?>
<head>
    <link rel="stylesheet" href="../css/sF.css">
</head>
<div id="overlayForm">
    <header>
        <h3>Filter by:</h3>
    </header>
    <form action="">
        <div class="category">
            <h3>Category</h3>
                <input type="radio" id="clothing" name="category" value="Clothing">
                <label for="clothing">Clothing</label>
                
                <input type="radio" id="accessories" name="category" value="Accessories">
                <label for="accessories">Accessories</label>
                
                <input type="radio" id="electronics" name="category" value="Electronics">
                <label for="electronics">Electronics</label>
                
                <input type="radio" id="furniture" name="category" value="Furniture">
                <label for="furniture">Furniture</label>
                
                <input type="radio" id="toys" name="category" value="Toys">
                <label for="toys">Toys</label>
        </div>
        <div class="condicion">
            <h3>Condition</h3>
            <select name="condition">
                <option value="not used">Not used</option>
                <option value="barely used" selected>Barely used</option>
                <option value="used">Used</option>
                <option value="very used">Very used</option>
            </select>
        </div>
        <div class="price">
            <h3>Price</h3>
            <label>Min: <input type="number" name="min"></label>
            <br>
            <label>Max: <input type="number" name="max"></label>
            
        </div>
    </form>
</div>
<?php } ?>