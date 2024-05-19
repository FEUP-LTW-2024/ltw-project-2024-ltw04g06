<?php
    require_once(__DIR__ . '/../classes/image.class.php');

function displayNameLogo($db)
{ 
?>
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="/../css/style.css">
        <link rel="icon" href="/../images/logo.jpg" type="image/x-icon">
        <script src="../js/togglePass.js" defer></script>


    </head>
    <main>
    <img class="logoLogs" src="<?= htmlspecialchars(Image::getImage($db, 0)) ?>">
<?php 
} 
function signInBox($session)
{ 
?>
    <div class="box">
        <header>
            Log in
        </header>
        
        <form id = "sign-in-form" action="/../actions/action_signIn.php" method="post" onsubmit="encodeAndSendMessage(event, 'sign-in-form', '/../actions/action_signIn.php')">
            <input type="hidden" name="csrf" value="<?= htmlspecialchars($_SESSION['csrf']) ?>">
            <label for="userField"><i class="fa-regular fa-user"></i></label>
            <input type="text"id = "userField" name="userField" placeholder="Email or username"><br>
            <label for="userField"><i class="fa-solid fa-lock"></i></label>
            <input type="password" name="password" id="password" placeholder="Password">
            <i class="fa-solid fa-eye" id="togglePassword"></i><br>

            <?php 
            $session->displayMessages();
            ?>
            <input type="submit" class="submitButton" value="Continue">
        </form>
    </div>
    <h5>New to website?</h5>
    <div class="box">
        <a href="/../pages/signUp.php">Create your account</a>
    </div>
</main>  
<?php 
} 

function signUpBox($session)
{ 
    $usernameError = $session->findMsgWithType('usernameError');
    $emailError = $session->findMsgWithType('emailError');
    $passwordError = $session->findMsgWithType('passwordError');
    $existAccError = $session->findMsgWithType('error');
?>
    <div class="box">
        <header>
            Sign up
        </header>
        <?php
        if ($existAccError) {
            echo '<div class="message existAccError">' . htmlspecialchars($existAccError['text']) . '</div>';
        }
        ?>
        <form id = 'sign-up-form' action="/../actions/action_signUp.php" method="post" onsubmit="encodeAndSendMessage(event, 'sign-up-form', '/../actions/action_signUp.php')">
            <input type="hidden" name="csrf" value="<?= htmlspecialchars($_SESSION['csrf']) ?>">
            <label for="username"><i class="fa-regular fa-user"></i></label>
            <input type="text" name="username" placeholder="Username"><br>
            <?php if ($usernameError) {
                echo '<div class="message usernameError">' . htmlspecialchars($usernameError['text']) . '</div>';
            }
            ?>
            <label for="email"><i class="fa-regular fa-envelope"></i></label>
            <input type="email" name="email" placeholder="Email"><br>
            <?php if ($emailError) {
                echo '<div class="message emailError">' . htmlspecialchars($emailError['text']) . '</div>';
            }
            ?>
            <label for="password"><i class="fa-solid fa-lock"></i></label>
            <input type="password" name="password" id="password" placeholder="Password">
            <i class="fa-solid fa-eye" id="togglePassword"></i><br>

            <?php if ($passwordError) {
                echo '<div class="message passwordError">' . htmlspecialchars($passwordError['text']) . '</div>';
            }
            ?>
            <input type="submit" class="submitButton" value="Continue">
        </form>
    </div>
    <h5>Already have an account?</h5>
    <div class="box">
        <a href="/../pages/signIn.php">Log in</a>
    </div>
</main>    
<?php 
} 
?>
