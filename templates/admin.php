<?php function showUsers($db, $userID, $users){ ?>
<head>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<main class="admin"> 
    <?php foreach($users as $user){   
        if ($user->role == 'Admin') continue;
    ?>
        <div class="user">
            <h2><?= $user->name ?></h2>
            <h4><?= $user->phoneNumber ?></h4>
            <form id="profileForm<?= $user->userID ?>" action="/../pages/seeProfile.php" method="post">
                <input type="hidden" name="userId" value="<?php echo htmlspecialchars($user->userID); ?>">
            </form>
            <img onclick="document.getElementById('profileForm<?= $user->userID ?>').submit();" src="<?=  User::getUserPic($db, $user->userID) ?>" alt="">
            <h2><?= $user->role ?></h2>
            <form id="adminForm<?= $user->userID ?>" action="/../actions/action_add_admin.php" method="post">
                <input type="hidden" name="userId" value="<?php echo htmlspecialchars($user->userID); ?>">
            </form>
            <button onclick="document.getElementById('adminForm<?= $user->userID ?>').submit();">Convert to admin</button>
            <form id="DeleteForm<?= $user->userID ?>" action="/../actions/action_delete_account.php" method="post">
                <input type="hidden" name="userId" value="<?php echo htmlspecialchars($user->userID); ?>">
            </form>
            <button onclick="document.getElementById('DeleteForm<?= $user->userID ?>').submit();">Delete account</button>
        </div>
        

    <?php } ?>
            
</main>
<div class="change">
            <div class="category">
                <h3>Category</h3>
                <form action="">
                    <?php
                        $db = getDatabaseConnection();
                        $categories = Category::getAllCategories($db);
                        echo ' <select name="category">';
                        echo '<option value="NULL" selected>No filter</option>';
                        foreach ($categories as $category) {
                            echo '<option value= "' . $category->name . '">' . $category->name . '</option>';
                        }
                        echo '</select>';
                    ?>
                    <button type="submit">Delete</button>
                </form>
                </div>
                
                <div class="condition">
                    <h3>Condition</h3>
                    <form action="">
                    <?php
                        $db = getDatabaseConnection();
                        $conditions = Condition::getAllConditions($db);
                        echo ' <select name="condition">';
                        echo '<option value="NULL" selected>No filter</option>';
                        foreach ($conditions as $condition) {
                            echo '<option value= "' . $condition->usage . '">' . $condition->usage . '</option>';
                        }
                        echo '</select>';
                    ?>
                     <button type="submit">Delete</button>
                    </form>
                </div>  

 
        <div class="size">
                <h3>Size</h3>
                <form action="">
                <?php
                    $db = getDatabaseConnection();
                    $sizes = Size::getAllSizes($db);
                    echo '<select name="size">';
                    echo '<option value="NULL" selected>No filter</option>';
                    foreach ($sizes as $size) {
                        echo '<option value= "' . $size->name . '">' . $size->name . '</option>';
                    }
                    echo '</select>';
                ?>
                <button type="submit">Delete</button>
                    </form>
            </div> 
    </form>
            <form action="">
                    <select name="type" id="">
                        <option value="category">Category</option>
                        <option value="condition">Condition</option>
                        <option value="size">Size</option>
                    </select>
                    <input type="text" name="texto" id="">
                    <button type="submit">ADD</button>
            </form>
            </div>
<?php } ?>