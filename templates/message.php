
<?php 
    function sideBar(PDO $db, int $userID, int $receiverID){ 
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
        if ($contacts == null && $receiverID == -1){?>
            <h4>You have no messages</h4>
        <?php }
        if ($receiverID != -1){
            $contact = User::getUser($db, $receiverID);
            ?>
            <input checked type="radio" id="<?=$contact->username ?>" name="userID" class="radio-btn" value="<?php echo htmlspecialchars($contact->userID); ?>">
            <label for="<?=$contact->username ?>" class="pessoa">
            <img src="<?=User::getUserPic($db, $contact->userID)?>" alt="">
            <p><?=$contact->username ?></p>
            </label> 
        <?php }?>
        <?php foreach ($contacts as $contact) { 
            if ($contact->userID == $receiverID) continue;
    ?>
    <input type="radio" id="<?=$contact->username ?>" name="userID" class="radio-btn" value="<?php echo htmlspecialchars($contact->userID); ?>">
    <label for="<?=$contact->username ?>" class="pessoa">
        <img src="<?=User::getUserPic($db, $contact->userID)?>" alt="">
        <p><?=$contact->username ?></p>
    </label> 
    <?php 
     }?>
     </form>
    </div> 
    <?php
        if ($receiverID != -1){?>
            <div class="mensagem">
                <?php messageBox($db, $userID, $receiverID);?>
            </div>
         <?php }else{?>
            <div class="mensagem hidden">
        
            </div>
    <?php }}?>


<?php 
    require_once(__DIR__ . '/../database/connectdb.php');
    require_once(__DIR__ . '/../classes/message.class.php');
    require_once(__DIR__ . '/../classes/user.class.php');
    function  messageBox(PDO $bd, int $userID1, int $userID2){ 
        $db = getDatabaseConnection();
        $user2 = User::getUser($db, $userID2);
        $msgs = Message::getUserMessages($db, $userID1, $userID2);
    ?>
<head>
    <link rel="stylesheet" href="../css/msg.css">
</head>
            <div class="pessoa">
                <img src=" <?=User::getUserPic($db, $user2->userID)?> ">
                <span><?=$user2->username?></span>
                <button><i class="fa-regular fa-trash-can"></i></button>
            </div>
            <div class="caixa" id="caixaDeMensagens">
                <div class="conjunto">
                <?php foreach ($msgs as $m) { 
                $messageUser = User::getUser($db, $m->senderID);
                ?>
                    <div class="fr">
                        <img src="<?= User::getUserPic($db, $messageUser->userID) ?>" alt="">
                        <span><?=$messageUser->username?></span>
                        <div class="time"><?=$m->time?></div>
                    </div>
                    
                    <div class="msg">
                        <?=$m->content?>
                    </div>
                <?php } ?>
                </div>
           
                <form id="messageForm" class="typing-area" method="post" onsubmit="encodeAndSendMessage(event, 'messageForm', 'path/to/action_message.php')">
                <input type="text" class="writerID" name="senderID" value="<?php echo htmlspecialchars($userID1); ?>" hidden>
                <input type="text" class="receiverID" name="recipientID" value="<?php echo htmlspecialchars($userID2); ?>" hidden>
                <textarea name="content" class="input-field" id="messageContent" placeholder="Message..." autocomplete="off"></textarea>
                <button type="submit" class="send_message"><i class="fab fa-telegram-plane"></i></button>
            </form>
            <p id="encodedMessage" style="display:none;"></p>
            </div>        
    </main>
<?php } ?>