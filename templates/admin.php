<?php
function showOptions($db, $session, $userID, $users) {
?>
<head>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<div class="admin-options">
    <h1>Admin Options</h1>
</div>

<main class="admin">
    <?php foreach($users as $user) {   
        if ($user->role == 'Admin') continue;
    ?>
    <div class="user">
        <h2 class="username"><?= htmlspecialchars($user->username) ?></h2>
        <form id="profileForm<?= $user->userID ?>" action="/../actions/action_adminToProfile.php" method="post">
            <input type="hidden" name="csrf" value="<?= htmlspecialchars($_SESSION['csrf']) ?>">
            <input type="hidden" name="userId" value="<?= htmlspecialchars($user->userID) ?>">
        </form>
        <img onclick="document.getElementById('profileForm<?= $user->userID ?>').submit();" src="<?= htmlspecialchars(User::getUserPic($db, $user->userID)) ?>" alt="">
        <form id="adminForm<?= $user->userID ?>" action="/../actions/action_add_admin.php" method="post">
            <input type="hidden" name="csrf" value="<?= htmlspecialchars($_SESSION['csrf']) ?>">
            <input type="hidden" name="userId" value="<?= htmlspecialchars($user->userID) ?>">
        </form>
        <button onclick="document.getElementById('adminForm<?= $user->userID ?>').submit();">Convert to admin</button>
        <form id="DeleteForm<?= $user->userID ?>" action="/../actions/action_delete_account.php" method="post">
            <input type="hidden" name="csrf" value="<?= htmlspecialchars($_SESSION['csrf']) ?>">
            <input type="hidden" name="userId" value="<?= htmlspecialchars($user->userID) ?>">
        </form>
        <button onclick="document.getElementById('DeleteForm<?= $user->userID ?>').submit();">Delete account</button>
    </div>
    <?php } ?>
</main>

<div class="change-type"><h1>Delete</h1></div>
<?php 
    $categoryMsg = $session->findMsgWithSpecificType('categoryRem');
    $conditionMsg = $session->findMsgWithSpecificType('conditionRem');
    $sizeMsg = $session->findMsgWithSpecificType('sizeRem');
?>   
<div class="change">
    <div class="category">
        <?php if ($categoryMsg) {
            $session->displayMessage($categoryMsg);
        }
        ?>
        <h3>Category</h3>
        <form action = '/../actions/action_edit_CatCondSize.php' id ="edit-catCondSize-form"  method="post" onsubmit="encodeAndSendMessage(event, 'edit-catCondSize-form', '/../actions/action_edit_CatCondSize.php')">
            <input type="hidden" name="csrf" value="<?= htmlspecialchars($_SESSION['csrf']) ?>">
            <?php
            $categories = Category::getAllCategories($db);
            echo '<select name="categoryName">';
            echo '<option value="NULL" selected>Not selected</option>';
            foreach ($categories as $category) {
                echo '<option value="' . htmlspecialchars($category->name) . '">' . htmlspecialchars($category->name) . '</option>';
            }
            echo '</select>';
            ?>
    </div>
    <div class="condition">
        <?php if ($conditionMsg) {
            $session->displayMessage($conditionMsg);
        }
        ?>
        <h3>Condition</h3>
        <input type="hidden" name="csrf" value="<?= htmlspecialchars($_SESSION['csrf']) ?>">
        <?php
        $conditions = Condition::getAllConditions($db);
        echo '<select name="conditionName">';
        echo '<option value="NULL" selected>Not selected</option>';
        foreach ($conditions as $condition) {
            echo '<option value="' . htmlspecialchars($condition->usage) . '">' . htmlspecialchars($condition->usage) . '</option>';
        }
        echo '</select>';
        ?>
    </div>  
    <div class="size">
        <?php if ($sizeMsg) {
            $session->displayMessage($sizeMsg);
        }
        ?>
        <h3>Size</h3>
        <input type="hidden" name="csrf" value="<?= htmlspecialchars($_SESSION['csrf']) ?>">
        <?php
        $sizes = Size::getAllSizes($db);
        echo '<select name="sizeName">';
        echo '<option value="NULL" selected>Not selected</option>';
        foreach ($sizes as $size) {
            if ($size->sizeID == 0) { continue; }
            echo '<option value="' . htmlspecialchars($size->name) . '">' . htmlspecialchars($size->name) . '</option>';
        }
        echo '</select>';
        ?>
    </div> 
</div>

<div class="change-type"><h1>Add</h1></div>
<?php 
    $categoryMsg = $session->findMsgWithSpecificType('categoryAdd');
    $conditionMsg = $session->findMsgWithSpecificType('conditionAdd');
    $sizeMsg = $session->findMsgWithSpecificType('sizeAdd');
?>   
<div class="addition">
    <div class="category">
        <?php if ($categoryMsg) {
            $session->displayMessage($categoryMsg);
        }
        ?>
        <h3>Category</h3>
        <input type="text" name="newCategory" id="newCategory">
        <input type="hidden" name="csrf" value="<?= htmlspecialchars($_SESSION['csrf']) ?>">
    </div>
    <div class="condition">
        <?php if ($conditionMsg) {
            $session->displayMessage($conditionMsg);
        }
        ?>
        <h3>Condition</h3>
        <input type="text" name="newCondition" id="newCondition">
        <input type="hidden" name="csrf" value="<?= htmlspecialchars($_SESSION['csrf']) ?>">
    </div>
    <div class="size">
        <?php if ($sizeMsg) {
            $session->displayMessage($sizeMsg);
        }
        ?>
        <h3>Size</h3>
        <input type="text" name="newSize" id="newSize">
        <input type="hidden" name="csrf" value="<?= htmlspecialchars($_SESSION['csrf']) ?>">
        </div> 
        <button type="submit">SUBMIT CHANGES</button>
    </form>  
</div>
<?php } ?>
