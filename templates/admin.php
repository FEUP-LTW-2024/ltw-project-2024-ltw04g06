<?php function showUsers($users){ ?>
<head>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<main class="admin"> 
    <?php foreach($users as $user){   
        //if ($user->role == 'Admin') continue;
    ?>
        <div class="user">
            <h2><?= $user->name ?></h2>
            <h4><?= $user->phoneNumber ?></h4>
            <form id="profileForm<?= $user->userID ?>" action="/../pages/seeProfile.php" method="post">
                <input type="hidden" name="userId" value="<?= $user->userID ?>">
            </form>
            <img onclick="document.getElementById('profileForm<?= $user->userID ?>').submit();" src="<?= $user->profilePicture ?>" alt="">
            <h2><?= $user->role ?></h2>
            <form id="adminForm<?= $user->userID ?>" action="/../actions/action_add_admin.php" method="post">
                <input type="hidden" name="userId" value="<?= $user->userID ?>">
            </form>
            <button onclick="document.getElementById('adminForm<?= $user->userID ?>').submit();">Convert to admin</button>
            <form id="DeleteForm<?= $user->userID ?>" action="/../actions/action_delete_account.php" method="post">
                <input type="hidden" name="userId" value="<?= $user->userID ?>">
            </form>
            <button onclick="document.getElementById('DeleteForm<?= $user->userID ?>').submit();">Delete account</button>
        </div>

    <?php } ?>

</main>
<?php } ?>