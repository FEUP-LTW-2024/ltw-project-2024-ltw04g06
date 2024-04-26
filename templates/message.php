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
        <?php
        foreach ($contacts as $contact) { 
    ?>
    <input type="radio" id="<?=$contact->username ?>" name="contact" class="radio-btn" value="<?=$contact->userID?>">
    <label for="<?=$contact->username ?>" class="pessoa">
        <img src="<?=$contact->profilePicture?>" alt="">
        <p><?=$contact->username ?></p>
    </label> 
    <?php 
     }?> 
</div>
    </div>
<?php
if (isset($_POST['contact'])) {
    $userID = $_POST['contact'];
    return  $userID;
} 
} ?>

<?php 
    function  messageBox(PDO $db, int $userID1, int $userID2){ 
        $msgs = Message::getUserMessages($db, $userID1, $userID2);
        $user1 = User::getUser($db, $userID1);
        $user2 = User::getUser($db, $userID2);
    ?>
<head>
    <link rel="stylesheet" href="../css/msg.css">
</head>
<div class="mensagem">
            <div class="pessoa">
                <img src=" <?=$user2->profilePicture?> ">
                <span><?=$user2->username?></span>
                <button><i class="fa-regular fa-trash-can"></i></button>
            </div>
            <div class="caixa" id="caixaDeMensagens">
            <?php foreach ($msgs as $m) { 
                $messageUser = User::getUser($db, $m->senderID);
                ?>
                    <div class="fr">
                        <img src="<?= $messageUser->profilePicture ?>" alt="">
                        <span><?=$messageUser->username?></span>
                        <div class="time"><?=$m->time?></div>
                    </div>
                    
                    <div class="msg">
                        <?=$m->content?>
                    </div>
                <?php } ?>
            </div>        
    </div>
    </main>
<?php } ?>