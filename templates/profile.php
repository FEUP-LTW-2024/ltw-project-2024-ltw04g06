<?php function profileEditDescript(){?>
<head>
    <link rel="stylesheet" href="/../css/profile.css">
</head>
<main>
    <div class="info">
            <img src="/../images/leetcode.png" alt="">
            <div class="text">
                <h2>PixelPrincess</h2>
                <h4>Ana Martins</h4>
                <h4>pixelprincess.martins@example.com</h4>
            </div>
            <button>Edit profile</button>
        </div>
<?php } ?>
<?php function myItemsAnalytics(){?>
    <div class="choice">
            <button><h3>My items</h3></button>
            <button><h3>Analytics</h3></button>
        </div>
        <div class="myItems">
            <div class="condition">
                <select name="condition">
                    <option value="Sold" selected>Sold</option>
                    <option value="Active">Active</option>
                </select>
            </div>
            <div class="products">
                <a class="addProduct" href="/../pages/sellItem.php">
                    <div class="mais">+</div>
                </a>
                    <?php 
                        //
                    ?>
                <div class="product" >
                    <img class="foto" src='/../images/leetcode.png'alt="">
                    <p>Used unicorn shirt</i></p>
                    <h4 class="price">20.00<i class="fa-solid fa-euro-sign"></i> XXL</h4>
                </div>
                <div class="product">
                    <img class="foto" src='/../images/leetcode.png'alt="">
                    <p>Used unicorn shirt</i></p>
                    <h4 class="price">20.00<i class="fa-solid fa-euro-sign"></i> XXL</h4>
                </div>
            </div>
        </div>
    </main>
<?php } ?>