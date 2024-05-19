<?php
function profileEdit(PDO $db, User $user)
{
?>
    <head>
        <link rel="stylesheet" href="/../css/profile.css">
    </head>
    <main>
        <div class="info">
            <img src="<?= htmlspecialchars(User::getUserPic($db, $user->userID)) ?>" alt="">
            <div class="hidden" id="userID"><?= htmlspecialchars($user->userID) ?></div>
            <div class="text">
                <h2><?= htmlspecialchars($user->username) ?></h2>
                <h4><?= htmlspecialchars($user->name) ?></h4>
                <h4><?= htmlspecialchars($user->email) ?></h4>
                <h3>About me : </h3>
                <h4><?= htmlspecialchars($user->aboutMe) ?></h4>
            </div>
            <button><a href="/pages/settings.php">Edit profile</a></button>
        </div>
<?php
}

function profileOptions($db, $items, $isAdmin)
{
?>
        <div class="choice">
            <button><h3>My items</h3></button>
            <?php if ($isAdmin) { ?>
                <a href="/../pages/admin.php"><button><h3>Admin</h3></button></a>
            <?php } ?>
        </div>
        <div class="myItems">
            <div class="condition">
                <select id="condition" name="condition" onchange="document.getElementById('condition-form').submit();">
                    <option value="Sold"> Sold</option>
                    <option value="Available" selected> Available</option>
                    <option value="Purchased"> Purchased</option>
                </select>
            </div>
            <div id="prodShow" class="products">
                <a class="addProduct" href="/../pages/sellItem.php">
                    <div class="mais">+</div>
                </a>
                <?php
                foreach ($items as $item) {
                    $status = Item::getItemStatus($db, $item->itemID);
                    if ($status != "Available") continue;
                ?>
                    <div onclick="document.getElementById('itemActive<?= htmlspecialchars($item->itemID) ?>').submit();" class="product">
                        <form action="/../actions/action_toItemActive.php" method="post" class="hidden" id="itemActive<?= htmlspecialchars($item->itemID) ?>">
                            <input type="hidden" name="csrf" value="<?= htmlspecialchars($_SESSION['csrf']) ?>">
                            <input type="hidden" name="itemID" value="<?= htmlspecialchars($item->itemID) ?>">
                        </form>
                        <img class="foto" src="<?= htmlspecialchars(Item::getImagePic($db, $item)) ?>" alt="">
                        <p><?= htmlspecialchars($item->name) ?></i></p>
                        <h4 class="price"><?= htmlspecialchars($item->price) ?><i class="fa-solid fa-euro-sign"></i></h4>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </main>
<?php
}
?>
