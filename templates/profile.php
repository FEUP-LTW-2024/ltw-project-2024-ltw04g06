<?php function profileEditDescript(User $user){?>
<head>
    <link rel="stylesheet" href="/../css/profile.css">
</head>
<main>
    <div class="info">
            <img src= <?= '/../' . $user->profilePicture?> alt="">
            <div class="text">
                <h2><?= $user->username?></h2>
                <h4><?= $user->name?></h4>
                <h4><?= $user->email?></h4>
                <h3>About me : </h3>
                <h4><?= $user->aboutMe?></h4>
            </div>
            <button ><a href="/pages/settings.php">Edit profile</a></button>
        </div>
<?php } ?>
<?php function myItemsAnalytics($db, $items, $isAdmin){
    ?>
    <div class="choice">
            <button><h3>My items</h3></button>
            <?php if ($isAdmin) { ?>
                <a href="/../pages/admin.php"><button><h3>Admin</h3></button></a>
            <?php } ?>
        </div>
        <div class="myItems">
            <div class="condition">
                <select id="condition" name="condition">
                    <option value="Sold">Sold</option>
                    <option value="Available" selected>Available</option>
                </select>
            </div>
            <div id = "prodShow" class="products">
                <a class="addProduct" href="/../pages/sellItem.php">
                    <div class="mais">+</div>
                </a>
                    <?php 
                        foreach($items as $item){ 
                            $status = Item::getItemStatus($db, $item->itemID);
                            if ($status != "Available") continue;
                            ?>
                            <div class="product" >
                            <?php
                                $imageUrls = explode(',', $item->images);
                                $imageSrc = $imageUrls[0];
                            ?>
                                  <img class="foto" src=<?='/../' . $imageSrc?> alt="">
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