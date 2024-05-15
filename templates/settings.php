<?php function displaySettings(PDO $bd, $user,$session){?>
    <head>
        <link rel="stylesheet" href="/../css/settings.css">
    </head>
    <main class="settings-box">
        <aside class="selectSetting">
            <h1>Settings</h1>
            <a id="ps"><h2>Profile_settings</h2></a>
            <a id="as"><h2>Account_settings</h2></a>
            <a id="ss"><h2>Security_settings</h2></a>
        </aside>
        <div class="container">
            <?php  ProfileSettins($bd, $user,$session)?>
        </div>

    <?php } ?>
<?php function ProfileSettins(PDO $db, $user,$session){?>
    <div class="profile-setting">
        <form action="/../actions/action_edit_profile.php" method="post" enctype="multipart/form-data">
            <div class="img">
                <input type="file" id="foto" accept="image/*" class="foto-input" name="foto" onchange="showImage(this)" multiple>
                <img id="imagemExibida" src="<?=User::getUserPic($db, $user->userID)?>" alt="Minha Imagem" style="display: none;">
                <button><i class="fa-solid fa-pen-to-square"></i> Change Photo</button><br>
            </div>
            <label for="Name">Name</label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($user->name); ?>"><br><br>
            <label for="AboutMe">About me</label>
            <input type="text" name="aboutMe"  value="<?php echo htmlspecialchars($user->aboutMe); ?>">
            <?php 
                    $session->displayMessages();
                ?>
            <button type="submit">Apply Changes</button>
        </form>
    </div>

            </main>
<?php } ?>

<?php function AccountSettings($user,$session){?>
    <div class="account-setting">
    <form action="/../actions/action_edit_account.php" method="post">
            <label for="Username">Username</label>
            <input type="text" name="username" value="<?php echo htmlspecialchars($user->username); ?>"><br><br>
            <label for="Email">Email</label>
            <input type="text" name="email" value="<?php echo htmlspecialchars($user->email); ?>"><br><br>
            <button type="submit">Apply Changes</button>
        </form>
    </div>
    <div class="account-setting">
    <form action="/../actions/action_rem_account.php" method="post">
        <h2>Account desactivation</h2>
        <p>Your account will be deleted and can <span>NOT</span> be recovered</p>
        <button>Delete account</button>
    </div>
    

    </main>
<?php } ?>
<?php function SecuritySettings($user,$session){?>
    <div class="security-setting">
    <form action="/../actions/action_edit_security.php" method="post">
            <label for="CurrentPassword">Current Password</label>
            <input type="password" name="currentPassword" ><br><br>
            <label for="NewPassword">New Password</label>
            <input type="password" name="newPassword"><br><br>
            <label for="ConfirmPassword">Confirm Password</label>
            <input type="password" name="confirmNewPassword">
            <?php 
                    $session->displayMessages();
                ?>
            <button type="submit">Apply Changes</button>
        </form>
    </div>

</main>
<?php } ?>
