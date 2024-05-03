<?php function profileEditDescript(User $user){?>
<head>
    <link rel="stylesheet" href="/../css/profile.css">
</head>
<main>
    <div class="info">
            <img src="/../images/leetcode.png" alt="">
            <div class="text">
                <h2><?= $user->username?></h2>
                <h4><?= $user->name?></h4>
                <h4><?= $user->email?></h4>
                <h3>About me : </h3>
                <h4><?= $user->aboutMe?></h4>
            </div>
            <button>Edit profile</button>
        </div>
<?php } ?>
<?php function myItemsAnalytics($items){
    ?>
    <div class="choice">
            <button><h3>My items</h3></button>
            <button><h3>Analytics</h3></button>
        </div>
        <div class="myItems">
            <div class="condition">
                <select id="condition" name="condition">
                    <option value="Sold">Sold</option>
                    <option value="Active" selected>Active</option>
                </select>
            </div>
            <div id = "prodShow" class="products">
                <a class="addProduct" href="/../pages/sellItem.php">
                    <div class="mais">+</div>
                </a>
                    <?php 
                        foreach($items as $item){ 
                            //Php condition for active
                            ?>
                            <div class="product" >
                                <img class="foto" src=<?=$item->images?>alt="">
                                <p><?=$item->name?></i></p>
                                <h4 class="price"><?=$item->price?><i class="fa-solid fa-euro-sign"></i> <?=$item->sizeID?></h4>
                            </div>
                        <?php
                        }
                    ?>
            </div>
        </div>
    </main>
<?php } ?>