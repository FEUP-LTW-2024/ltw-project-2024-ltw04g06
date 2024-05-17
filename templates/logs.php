<?php
function displayNameLogo()
{ 
?>
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="/../css/style.css">
    </head>
    <main>
        <h1>Random name/logo</h1>
<?php 
} 

function signInBox($session)
{ 
?>
    <div class="box">
        <header>
            Log in
        </header>
        
        <form action="/../actions/action_signIn.php" method="post">
            <input type="hidden" name="csrf" value="<?= htmlspecialchars($_SESSION['csrf']) ?>">
            <label for=""><i class="fa-regular fa-user"></i></label>
            <input type="text" name="userField" placeholder="Email or username"><br>
            <label for=""><i class="fa-solid fa-lock"></i></label>
            <input type="password" name="password" placeholder="Password"><br>
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
        <form action="/../actions/action_signUp.php" method="post">
            <input type="hidden" name="csrf" value="<?= htmlspecialchars($_SESSION['csrf']) ?>">
            <label for=""><i class="fa-regular fa-user"></i></label>
            <input type="text" name="username" placeholder="Username"><br>
            <?php if ($usernameError) {
                echo '<div class="message usernameError">' . htmlspecialchars($usernameError['text']) . '</div>';
            }
            ?>
            <label for=""><i class="fa-regular fa-envelope"></i></label>
            <input type="email" name="email" placeholder="Email"><br>
            <?php if ($emailError) {
                echo '<div class="message emailError">' . htmlspecialchars($emailError['text']) . '</div>';
            }
            ?>
            <label for=""><i class="fa-solid fa-lock"></i></label>
            <input type="password" name="password" placeholder="Password"><br>
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
