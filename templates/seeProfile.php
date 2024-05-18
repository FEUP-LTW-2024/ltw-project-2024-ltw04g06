<?php function SeeProfile(PDO $db, User $user){?>
<head>
    <link rel="stylesheet" href="/../css/profile.css">
</head>
<main>
    <div class="info">
            <img src= <?= User::getUserPic($db, $user->userID)?> alt="">
            <div class="hidden" id="userID"><?= $user->userID?></div>
            <div class="text">
                <h2><?= $user->username?></h2>
                <h4><?= $user->name?></h4>
                <h4><?= $user->email?></h4>
                <h3>About me : </h3>
                <h4><?= $user->aboutMe?></h4>
                <form id="OpenMessage" action="/../actions/action_profileToMessage.php" method="post">
                    <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
                    <input type="hidden" name="receiverID" value="<?php echo htmlspecialchars($user->userID); ?>">
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
                <select id="conditionSeeP" name="condition">
                    <option value="Sold">Sold</option>
                    <option value="Available" selected>Available</option>
                </select>
            </div>
            <div id = "prodShowSeeP" class="products">
                    <?php 
                        foreach($items as $item){ 
                            $status = Item::getItemStatus($db, $item->itemID);
                            if ($status != "Available") continue;
                            ?>
                            <div class="product" >
                                    <form id="viewItem<?= $item->itemID ?>" action="/../actions/action_toViewItem.php" method="post" class="hidden">
                                        <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
                                        <input type="hidden" name="itemID" value="<?php echo htmlspecialchars($item->itemID); ?>">
                                     </form>
                                  <img onclick="document.getElementById('viewItem<?= $item->itemID ?>').submit();" class="foto" src=<?=Item::getImagePic($db, $item)?> alt="">
                                <p><?=$item->name?></i></p>
                                <h4 class="price"><?=$item->price?><i class="fa-solid fa-euro-sign"></i></h4>
                            </div>
                        <?php
                        }
                    ?>
            </div>
        </div>
    </main>
<?php } ?>