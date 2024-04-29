<?php function displaySettings(){?>
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
            <?php  ProfileSettins()?>
        </div>

    <?php } ?>
<?php function ProfileSettins(){?>
    <div class="profile-setting">
        <form action="" method="post">
            <div class="img">
                <img src="/../images/profilePictures/pp1.jpg" alt="">
                <button><i class="fa-solid fa-pen-to-square"></i> Change Photo</button>
            </div>
            <label for="Name">Name</label>
            <input type="text" name="Name" value="OlderValue"><br><br>
            <label for="AboutMe">About me</label>
            <input name="aboutMe" ><br><br>
            <button type="submit">Apply Changes</button>
        </form>
    </div>

            </main>
<?php } ?>

<?php function AccountSettings(){?>
    <div class="account-setting">
    <form action="" method="post">
            <label for="Username">Username</label>
            <input type="text" name="Username" value="OlderValue"><br><br>
            <label for="Email">Email</label>
            <input name="Email" ><br><br>
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
<?php function SecuritySettings(){?>
    <div class="security-setting">
    <form action="" method="post">
            <label for="CurrentPassword">Current Password</label>
            <input type="password" name="CurrentPassword" ><br><br>
            <label for="NewPassword">New Password</label>
            <input type="password" name="NewPassword"><br><br>
            <label for="ConfirmPassword">Confirm Password</label>
            <input type="password" name="ConfirmPassword"><br><br>
            <button type="submit">Apply Changes</button>
        </form>
    </div>

</main>
<?php } ?>
<?php function Languages(){?>
    
<?php } ?>