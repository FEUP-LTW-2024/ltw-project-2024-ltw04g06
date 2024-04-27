
<?php function displayNameLogo(){ ?>
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="/../css/style.css">
    </head>
    <main>
        <h1>Random name/logo</h1>
<?php } ?>

<?php function signInBox(){ ?>
    <div class="box">
            <header>
                Log in
            </header>
            <form action="/../actions/action_signIn.php" method = "post">
                <label for=""><i class="fa-regular fa-user"></i></label>
                <input type="text" name = "userField" placeholder="Email or username"><br>
                <label for=""><i class="fa-solid fa-lock"></i></label>
                <input type="password" name = "password" placeholder="Password"><br>
                <input type="submit" class="submitButton" value="Continue">
            </form>
        </div>
        <h5><a href="/../pages/signUp.php">New to website?</a></h5>
        <div class="box">
            <a href="">Log in</a>
        </div>
    </main>  
<?php } ?>

<?php function signUpBox(){ ?>
    <div class="box">
            <header>
                Sign up
            </header>
            <form action="/../actions/action_signUp.php" method = "post">
                <label for=""><i class="fa-regular fa-user"></i></label>
                <input type="text" name = "username" placeholder="Username"><br>
                <label for=""><i class="fa-regular fa-envelope"></i></label>
                <input type="email" name = "email" placeholder="Email"><br>
                <label for=""><i class="fa-solid fa-lock"></i></label>
                <input type="password" name = "password" placeholder="Password"><br>
                <input type="submit" class="submitButton" value="Continue">
            </form>
        </div>
        <h5><a href="/../pages/signIn.php">Already have a account?</a></h5>
        <div class="box">
            <a href="">Create your account</a>
        </div>
    </main>    
<?php } ?>

