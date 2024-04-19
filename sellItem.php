<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="sellItem.css">
    </head>
    <body>
    <header><?php include('topo.php')?></header>
        <main>
        <p>Sell an item</p>
        <div class="form">
            <div class="left-column">
                <div class="title">
                    <label for="title">Title</label>
                    <input type="text" name="title">
                </div>
                <label for="foto" class="foto-label">
                    <div class="quadrado">
                        Load photo
                    </div>
                    <input type="file" id="foto" accept="image/*" class="foto-input">
                </label>                
            </div>
            <div class="right-column">
                <div class="description">
                    <label for="description">Description</label>
                    <input type="text" name="description">
                </div>
                <div class="brand">
                    <label for="brand">Brand</label>
                    <input type="text" name="brand">
                </div>
                <div class="model">
                    <label for="model">Model</label>
                    <input type="text" name="model">
                </div>
                <div class="size">
                    <label for="size">Size</label>
                    <div class="size2">
                    <label for="xs">
                        <input type="radio" id="xs" name="sizes" value="xs"> XS 
                    </label> 
                    <label for="s">
                        <input type="radio" id="s" name="sizes" value="s"> S 
                    </label> 
                    <label for="m">
                        <input type="radio" id="m" name="sizes" value="m"> M 
                    </label>
                    <label for="l">
                        <input type="radio" id="l" name="sizes" value="l"> L 
                    </label>
                    <label for="xl">
                        <input type="radio" id="xl" name="sizes" value="xl"> XL 
                    </label>
                    <label for="xxl">
                        <input type="radio" id="xxl" name="sizes" value="xxl"> XXL 
                    </label>
                    </div>
                </div>
                <div class="condition">
                    <label for="condition">Condition</label>
                    <select name="condition">
                        <option value="not used">Not used</option>
                        <option value="barely used" selected>Barely used</option>
                        <option value="used">Used</option>
                        <option value="very used">Very used</option>
                    </select>
                </div>
                <div class="category">
                    <label for="category">Category</label>
                    <select name="category">
                        <option value="clothes">Clothes</option>
                        <option value="acessories">Acessories</option>
                        <option value="electronics">Electronics</option>
                        <option value="furniture">Furniture</option>
                        <option value="toys">Toys</option>
                    </select>
                </div>
                <div class="price">
                    <label for="price">Price</label>
                    <input type="text" name="price">
                </div>
            </div>
        </div>        
        <input type="submit" class="submitButton" value="Continue">
    </main>
    </body>
</html>