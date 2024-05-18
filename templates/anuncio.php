<?php
require_once(__DIR__ . '/../classes/user.class.php');

function anuncio(PDO $db){ 
?>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/home.css">
</head>
<main>
    <h3 class="biggest-sellers">Our Biggest Sellers</h3>
    <div class="anuncios">
    <?php
    $users = User::getTopSellers($db);
    $firstUser = true;
    foreach ($users as $user) {
    ?>
        <form id="profileForm<?= htmlspecialchars($user->userID) ?>" action="/../actions/action_toSeeProfile.php" method="post" class="hidden">
            <input type="hidden" name="userId" value="<?= htmlspecialchars($user->userID); ?>">
            <input type="hidden" name="csrf" value="<?= htmlspecialchars($_SESSION['csrf']); ?>">
        </form>
        <header onclick="document.getElementById('profileForm<?= htmlspecialchars($user->userID) ?>').submit();">

        <img src="<?= htmlspecialchars(User::getUserPic($db, $user->userID)); ?>" alt="" onmouseover="showUserInfo(this)" onmouseout="hideUserInfo(this)">
            <div class="user-details">
            <div class="crown">
            <?php if ($firstUser): ?>
                <i class="fas fa-crown"></i>
            <?php  $firstUser = false;endif; ?>
            </div>
                <p class="username"><?= htmlspecialchars($user->username); ?></p>
                <div class="user-info">
                <p>Available items: <?= htmlspecialchars(Item::getNumAvailableItems($db, $user->userID)); ?></p>
                <p>Sold Items: <?= htmlspecialchars(Item::getNumSoldItems($db, $user->userID)); ?></p>
            </div>
        </header>
        
    <?php 
    } 
    ?> 
    </div>
</main>
<script src="../js/showInfo.js"></script>
<?php 
} 
?>
