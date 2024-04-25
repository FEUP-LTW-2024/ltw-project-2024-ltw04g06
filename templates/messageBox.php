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
                $additionalClass = ($messageUser->userID == $user1->userID) ? 'align-right' : ''; // Verifica se é user1 e adiciona as classes
                ?>
                    <div class="fr <?=$additionalClass?>">
                        <img src="<?= $messageUser->profilePicture ?>" alt="">
                        <span><?=$messageUser->username?></span>
                        <div class="time"><?=$m->time?></div>
                    </div>
                    
                    <div class="msg <?=$additionalClass?>">
                        <?=$m->content?>
                    </div>
                <?php } ?>
            </div>        
    </div>
    </main>
    <script src="../js/script.js"></script>
<?php } ?>