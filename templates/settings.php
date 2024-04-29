<?php function displaySettings($user){?>
    <head>
        <link rel="stylesheet" href="/../css/settings.css">
    </head>
    <main class="settings-box">
        <aside class="selectSetting">
            <h1>Settings</h1>
            <a id="ps"><h2>Profile_settings</h2></a>
            <a id="as"><h2>Account_settings</h2></a>
            <a id="ss"><h2>Security_settings</h2></a>
            <a id="l"><h2>Language</h2></a>
        </aside>
        <div class="container">
            <?php  ProfileSettins($user)?>
        </div>

    <?php } ?>
<?php function ProfileSettins($user){?>
    <div class="profile-setting">
        <form action="/../actions/action_edit_profile.php" method="post">
            <div class="img">
                <img src="/../images/profilePictures/pp1.jpg" alt="">
                <button><i class="fa-solid fa-pen-to-square"></i> Change Photo</button>
            </div>
            <label for="Name">Name</label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($user->name); ?>"><br><br>
            <label for="AboutMe">About me</label>
            <input type="text" name="aboutMe"  value="<?php echo htmlspecialchars($user->aboutMe); ?>"><br><br>
            <button type="submit">Apply Changes</button>
        </form>
    </div>

            </main>
<?php } ?>

<?php function AccountSettings($user){?>
    <div class="account-setting">
    <form action="/../actions/action_edit_account.php" method="post">
            <label for="Username">Username</label>
            <input type="text" name="username" value="OlderValue"><br><br>
            <label for="Email">Email</label>
            <input name="email" ><br><br>
            <button type="submit">Apply Changes</button>
        </form>
    </div>
    <div class="account-setting">
        <h2>Account desactivation</h2>
        <p>Your account will be deleted and can <span>NOT</span> be recovered</p>
        <button>Delete account</button>
    </div>
    

    </main>
<?php } ?>
<?php function SecuritySettings($user){?>
    <div class="security-setting">
    <form action="/../actions/action_edit_security.php" method="post">
            <label for="CurrentPassword">Current Password</label>
            <input type="password" name="currentPassword" ><br><br>
            <label for="NewPassword">New Password</label>
            <input type="password" name="newPassword"><br><br>
            <label for="ConfirmPassword">Confirm Password</label>
            <input type="password" name="confirmNewPassword"><br><br>
            <button type="submit">Apply Changes</button>
        </form>
    </div>

</main>
<?php } ?>
<?php function Languages(){?>
    
<?php } ?>