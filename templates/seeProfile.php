<?php function SeeProfile(User $user){?>
<head>
    <link rel="stylesheet" href="/../css/profile.css">
</head>
<main>
    <div class="info">
            <img src= <?= '/../' . $user->profilePicture?> alt="">
            <div class="hidden" id="userID"><?= $user->userID?></div>
            <div class="text">
                <h2><?= $user->username?></h2>
                <h4><?= $user->name?></h4>
                <h4><?= $user->email?></h4>
                <h3>About me : </h3>
                <h4><?= $user->aboutMe?></h4>
                <form id="OpenMessage" action="/../pages/message.php" method="post">
                    <input type="hidden" name="receiverID" value="<?= $user->userID ?>">
                </form>
                <h3 class = "msgbutton" onclick="document.getElementById('OpenMessage').submit();" >Message me <i class="fa-regular fa-envelope"></i></h3>

            </div>
        </div>
<?php } ?>
<?php function myItemsAnalytics($db, $items){
    ?>
    <div class="choice">
            <button><h3>Items</h3></button>
        </div>
        <div class="myItems">
            <div class="condition">
                <select id="condition" name="condition">
                    <option value="Sold">Sold</option>
                    <option value="Available" selected>Available</option>
                </select>
            </div>
            <div id = "prodShow" class="products">
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