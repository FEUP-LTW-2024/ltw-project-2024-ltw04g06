<?php function showUsers($db, $userID, $users){ ?>
<head>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<div class="admin-options">
        <h1>Admin Options</h1>
    </div>

<main class="admin"> 
    <?php foreach($users as $user){   
        if ($user->role == 'Admin') continue;
    ?>
        <div class="user">
<h2 class="username"><?= $user->username ?></h2>
            <form id="profileForm<?= $user->userID ?>" action="/../pages/seeProfile.php" method="post">
                <input type="hidden" name="userId" value="<?php echo htmlspecialchars($user->userID); ?>">
            </form>
            <img onclick="document.getElementById('profileForm<?= $user->userID ?>').submit();" src="<?=  User::getUserPic($db, $user->userID) ?>" alt="">
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
<div class="change-type"><h1>Delete</h1></div>

<div class="change">
            <div class="category">
                <h3>Category</h3>
                <form action="/../actions/action_rem_category.php" method="post">
                <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
                    <?php
                        $db = getDatabaseConnection();
                        $categories = Category::getAllCategories($db);
                        echo ' <select name="categoryName">';
                        echo '<option value="NULL" selected>Not selected</option>';
                        foreach ($categories as $category) {
                            echo '<option value= "' . htmlspecialchars($category->name) . '">' . htmlspecialchars($category->name) . '</option>';
                        }
                        echo '</select>';
                    ?>
                    <button type="submit">DELETE</button>
                </form>
            </div>
                
                <div class="condition">
                    <h3>Condition</h3>
                    <form action="/../actions/action_rem_condition.php" method="post">
                    <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">

                    <?php
                        $db = getDatabaseConnection();
                        $conditions = Condition::getAllConditions($db);
                        echo ' <select name="conditionName">';
                        echo '<option value="NULL" selected>No filter</option>';
                        foreach ($conditions as $condition) {
                            echo '<option value= "' .htmlspecialchars($condition->usage) . '">' . htmlspecialchars($condition->usage) . '</option>';
                        }
                        echo '</select>';
                    ?>
                     <button type="submit">DELETE</button>
                    </form>
                </div>  

 
        <div class="size">
                <h3>Size</h3>
                <form action="/../actions/action_rem_size.php" method="post">
                <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
                    <?php
                        $db = getDatabaseConnection();
                        $sizes = Size::getAllSizes($db);
                        echo '<select name="sizeName">';
                        echo '<option value="NULL" selected>No filter</option>';
                        foreach ($sizes as $size) {
                            echo '<option value= "' . htmlspecialchars($size->name) . '">' . htmlspecialchars($size->name) . '</option>';
                        }
                        echo '</select>';
                    ?>
                    <button type="submit">DELETE</button>
                </form>
            </div> 
    </div>

    <div class="change-type"><h1>Add</h1></div>

    <div class="addition">
        <div class="category">
            <h3>Category</h3>
            <form action="/../actions/action_add_category.php" method="post">
                <input type="text" name="newCategory" id="newCategory">
                <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">

                <button type="submit">ADD</button>
            </form>
            </div>
            <div class="condition">
                <h3>Condition</h3>
                <form action="/../actions/action_add_condition.php" method="post">
                <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
                    <input type="text" name="newCondition" id="newCondition">
                    <button type="submit">ADD</button>
            </form>
                </div>
                <div class="size">
                <h3>Size</h3>
                <form action="/../actions/action_add_size.php" method="post">
                <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
                <input type="text" name="newSize" id="newSize">
                <button type="submit">ADD</button>
            </form>
            </div>   
                
    </div>
    
<?php } ?>