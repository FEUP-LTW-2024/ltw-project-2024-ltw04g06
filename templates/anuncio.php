<?php
require_once(__DIR__ . '/../classes/user.class.php');
 function anuncio(PDO $db){ ?>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/home.css">
</head>
<main>
<h3 class="biggest-sellers">Our Biggest Sellers</h3>
<div class="anuncios">
<?php
$users = User::getTopSellers($db);
 foreach ($users as $user) {
        ?>
    <form id="profileForm<?= $user->userID ?>" action="/../pages/seeProfile.php" method="post" class="hidden">
        <input type="hidden" name="userId" value="<?php echo htmlspecialchars($user->userID); ?>">
    </form>
    <header onclick="document.getElementById('profileForm<?= $user->userID ?>').submit();">
        <img src=<?=  User::getUserPic($db, $user->userID)?> alt="">
        <p class="username"><?= $user->username ?></p>    </header>
        <div class="user-info hidden"><?= $user->email ?></div>
        
    <?php } ?> 
</div>
</main>
<script>
    function showUserInfo(email) {
        const userInfo = document.querySelector('.user-info');
        userInfo.textContent = email;
        userInfo.classList.remove('hidden');
    }

    function hideUserInfo() {
        const userInfo = document.querySelector('.user-info');
        userInfo.classList.add('hidden');
    }
</script>
<?php } ?>