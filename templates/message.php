<?php 
function sideBar(PDO $db, int $userID, int $receiverID){ 
    $contacts = Message::getUserMessageContacts($db, $userID);
?>
<head>
    <link rel="stylesheet" href="../css/msg.css">
    <script src="/../js/encode.js"></script>
</head>
<main>
    <div class="sideBar">
        <h2>Messages</h2>
        <form method="get" class="pessoas" id="contactForm">
            <input type="hidden" name="csrf" value="<?= htmlspecialchars($_SESSION['csrf']) ?>">
            <?php
            if ($contacts == null && $receiverID == -1){
                echo '<h4>You have no messages</h4>';
            }
            if ($receiverID != -1){
                $contact = User::getUser($db, $receiverID);
            ?>
            <input checked type="radio" id="<?= htmlspecialchars($contact->username) ?>" name="userID" class="radio-btn" value="<?= htmlspecialchars($contact->userID) ?>">
            <label for="<?= htmlspecialchars($contact->username) ?>" class="pessoa">
                <img class="imgs" src="<?= htmlspecialchars(User::getUserPic($db, $contact->userID)) ?>" alt="">
                <p><?= htmlspecialchars($contact->username) ?></p>
            </label> 
            <?php } ?>
            <?php foreach ($contacts as $contact) { 
                if ($contact->userID == $receiverID) continue;
            ?>
            <input type="radio" id="<?= htmlspecialchars($contact->username) ?>" name="userID" class="radio-btn" value="<?= htmlspecialchars($contact->userID) ?>">
            <label for="<?= htmlspecialchars($contact->username) ?>" class="pessoa">
                <img class="imgs" src="<?= htmlspecialchars(User::getUserPic($db, $contact->userID)) ?>" alt="">
                <p><?= htmlspecialchars($contact->username) ?></p>
            </label> 
            <?php } ?>
        </form>
    </div> 
    <?php
    if ($receiverID != -1){
    ?>
    <div class="mensagem">
        <?php messageBox($db, $userID, $receiverID); ?>
    </div>
    <?php } else { ?>
    <div class="mensagem hidden">
    </div>
    <?php } ?>
</main>
<?php } ?>

<?php 
require_once(__DIR__ . '/../database/connectdb.php');
require_once(__DIR__ . '/../classes/message.class.php');
require_once(__DIR__ . '/../classes/user.class.php');

function messageBox(PDO $db, int $userID1, int $userID2){ 
    $user2 = User::getUser($db, $userID2);
    $msgs = Message::getUserMessages($db, $userID1, $userID2);
?>
<head>
    <link rel="stylesheet" href="../css/msg.css">
</head>
            <div class="pessoa">
                <img class="imgs" src=" <?=User::getUserPic($db, $user2->userID)?> ">
                <span><?=$user2->username?></span>
                <button><i class="fa-regular fa-trash-can"></i></button>
            </div>
            <div class="caixa" id="caixaDeMensagens">
                <div class="conjunto">
                <?php foreach ($msgs as $m) { 
                $messageUser = User::getUser($db, $m->senderID);
                ?>
                    <div class="fr">
                        <img class="imgs" src="<?= User::getUserPic($db, $messageUser->userID) ?>" alt="">
                        <span><?=$messageUser->username?></span>
                        <div class="time"><?=$m->time?></div>
                    </div>
                    
                    <div class="msg">
                        <?=$m->content?>
                    </div>
                <?php } ?>
                </div>
           
                <form id="messageForm" class="typing-area" method="post" onsubmit="encodeAndSendMessage(event, 'messageForm', '/../actions/action_message.php')">
                <input type="hidden" name="csrf" value="<?= htmlspecialchars($_SESSION['csrf']) ?>">
                <input type="text" class="writerID" name="senderID" value="<?php echo htmlspecialchars($userID1); ?>" hidden>
                <input type="text" class="receiverID" name="recipientID" value="<?php echo htmlspecialchars($userID2); ?>" hidden>
                <textarea name="content" class="input-field" id="messageContent" placeholder="Message..." autocomplete="off"></textarea>
                <button type="submit" class="send_message"><i class="fab fa-telegram-plane"></i></button>
            </form>
            <p id="encodedMessage" style="display:none;"></p>
            </div>        
    </main>
<?php } ?>
