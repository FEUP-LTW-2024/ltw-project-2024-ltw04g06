
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
        <form method="get" class="pessoas" id="contactForm">
        <?php
        if ($contacts == null){?>
            <h4>You have no messages</h4>
        <?php }?>
        <?php foreach ($contacts as $contact) { 
    ?>
    <input type="radio" id="<?=$contact->username ?>" name="userID" class="radio-btn" value="<?=$contact->userID?>">
    <label for="<?=$contact->username ?>" class="pessoa">
        <img src="<?=$contact->profilePicture?>" alt="">
        <p><?=$contact->username ?></p>
    </label> 
    <?php 
     }?>
     </form>
    </div> 
    <div class="mensagem hidden">

     </div>
<?php } ?>


<?php 
    require_once(__DIR__ . '/../database/connectdb.php');
    require_once(__DIR__ . '/../classes/message.class.php');
    require_once(__DIR__ . '/../classes/user.class.php');
    function  messageBox(int $userID2){ 
        $db = getDatabaseConnection();
        $user2 = User::getUser($db, $userID2);
        $userID1 = 1;
        $msgs = Message::getUserMessages($db, $userID1, $userID2);
    ?>
<head>
    <link rel="stylesheet" href="../css/msg.css">
</head>
            <div class="pessoa">
                <img src=" <?=$user2->profilePicture?> ">
                <span><?=$user2->username?></span>
                <button><i class="fa-regular fa-trash-can"></i></button>
            </div>
            <div class="caixa" id="caixaDeMensagens">
                <div class="conjunto">
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
           
                <form  id="messageForm" class="typing-area" method="post">
                    <input type="text" class="writerID" name="senderID" value="<?= $userID1 ?>" hidden>
                    <input type="text" class="receiverID" name="recipientID" value="<?= $userID2 ?>" hidden>
                    <textarea name="content"class="input-field" id="messageContent" placeholder="Message..." autocomplete="off"></textarea>
                    <button type="button" class="send_message"><i class="fab fa-telegram-plane"></i></button>
                </form>
            </div>        
    </main>
<?php } ?>