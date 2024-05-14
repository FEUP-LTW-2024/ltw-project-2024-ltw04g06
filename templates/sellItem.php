<?php function displaySellItem(){ ?>
    <head>
        <link rel="stylesheet" href="/../css/sellItem.css">
        <script src="/../js/sellItem.js"></script>
    </head>
    <main>
         <p>Sell an item</p>
<?php } ?>

<?php function sellItemForm(){ ?>
 <form action="/../actions/action_add_item.php" method="post">
    <div class="form">
        <div class="left-column">
            <div class="title">
                <label for="title">Title</label>
                <input class="title-input" type="text" id="title" name="title">
            </div>
            <label for="foto" class="foto-label">
                <div id="quadrado" class="quadrado">
                    Load photo
                </div>
                <input type="file" id="foto" accept="image/*" class="foto-input" name="foto" onchange="showImage(this)" multiple>
                <img id="imagemExibida" src="#" alt="Minha Imagem" style="display: none;">
            </label> 
            <div id="imagensExibidas"></div>       
        </div>
        <div class="right-column">
            <div class="description">
                <label for="description">Description</label>
                <input class="description-input" type="text" name="description">
            </div>
            <div class="brand">
                <label for="brand">Brand</label>
                <input class="brand-input" type="text" name="brand">
        
                <label class="model-label" for="model">Model</label>
                <input class="model-input" type="text" name="model">
            </div>
            <div class="size">
                <label class="condition-label" for="condition">Condition</label>
                <select class="condition" name="condition">
                    <option value="Not used">Not used</option>
                    <option value="Barely used" selected>Barely used</option>
                    <option value="Used">Used</option>
                    <option value="Very used">Very used</option>
                </select>
                <label class="size-label" for="size">Size</label>
                <div class="size2">
                <label for="xs">
                    <input type="radio" id="xs" name="sizes" value="XS"> XS 
                </label> 
                <label for="s">
                    <input type="radio" id="s" name="sizes" value="S"> S 
                </label> 
                <label for="m">
                    <input type="radio" id="m" name="sizes" value="M"> M 
                </label>
                <label for="l">
                    <input type="radio" id="l" name="sizes" value="L"> L 
                </label>
                <label for="xl">
                    <input type="radio" id="xl" name="sizes" value="XL"> XL 
                </label>
                <label for="xxl">
                    <input type="radio" id="xxl" name="sizes" value="XXL"> XXL 
                </label>
                </div>
            </div>
            <div class="category">
                <label for="category">Category</label>
                <select name="category">
                    <option value="Clothing">Clothing</option>
                    <option value="Accessories">Acessories</option>
                    <option value="Electronics">Electronics</option>
                    <option value="Furniture">Furniture</option>
                    <option value="toys">Toys</option>
                </select>
            
                <label class="price-label" for="price">Price</label>
                <input class="price-input" type="text" name="price">
            </div>
        </div>
    </div>        
    <input type="submit" class="submitButton" value="Continue">
    </form>
</main>
<?php } ?>
