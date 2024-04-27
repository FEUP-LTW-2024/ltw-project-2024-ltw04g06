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
    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Adicionar Produto</h2>
        </div>
    </div>
    <div class="choice">
            <button><h3>My items</h3></button>
            <button><h3>Analytics</h3></button>
        </div>
        <div class="myItems">
            <div class="condicion">
                <select name="condition">
                    <option value="Active">Active</option>
                    <option value="Sold" selected>Sold</option>
                </select>
            </div>
            <div class="products">
                <div class="addProduct">
                    <div class="mais">+</div>
                </div>
                    <?php 
                        //
                    ?>
                <div class="product" onclick="openModal();">
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