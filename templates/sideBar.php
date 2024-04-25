<?php 
    function sideBar(PDO $db, int $userID){ 
    $contacts = Message::getUserMessageContacts($db, $userID);
    ?>
<head>
    <link rel="stylesheet" href="../css/msg.css">
</head>
<main>
    <div class="sideBar">
        <h2>Messages</h2>
        <div class="pessoas">
        <?php foreach ($contacts as $contact) { ?>
            <button class="pessoa">
                <img src="<?=$contact->profilePicture?>" alt="">
                <p><?=$contact->username ?></p>
            </button>
            <?php } ?>
        </div>
    </div>
<?php } ?>