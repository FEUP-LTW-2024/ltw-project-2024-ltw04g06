<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="itemActive.css">
    </head>
    <body>
    <header><?php include('topo.php')?></header>
    <main>
      <script src="itemActive.js"></script>
        <button class="submitButton">Sold</button>
        <button class="submitButton" onclick="soldButton()">Edit item</button>
        <div class="form">
            <div class="left-column">
                <div class="title">
                    Title <?php echo htmlspecialchars($_POST['title']); ?>
                </div>
                <label for="foto" class="foto-label">
                    <div class="quadrado">
                        Photo <?php echo htmlspecialchars($_POST['foto']); ?>
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
                    Size 
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
    </main>
    </body>
</html>