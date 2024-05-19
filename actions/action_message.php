<?php
require_once(__DIR__ . '/../classes/session.class.php');
require_once(__DIR__ . '/../database/connectdb.php');
require_once(__DIR__ . '/../classes/message.class.php');
require_once(__DIR__ . '/../classes/user.class.php');

$db = getDatabaseConnection();
$session = new Session();

if (!$session->isLoggedIn()) {header('Location: /../pages/signIn.php');exit;}
if ($_SESSION['csrf'] !== $_POST['csrf']) { header('Location: /../pages/error.php'); exit; }



$content = $_POST['content'];
$recipientID = $_POST['recipientID'];
$senderID = $_POST['senderID'];
$sender = User::getUser($db, $senderID);

$messageID = Message::addMessage($db, $senderID, $recipientID, $content);
$message = Message::getMessage($db, $messageID);

if ($messageID !== false) {
    echo '<div class="fr">
            <img class="imgs" src=' . User::getUserPic($db, $sender->userID) . '>
            <span>' . htmlspecialchars($sender->username) . '</span>
            <div class="time"> ' . htmlspecialchars($message->time) . ' </div>
          </div>
          <div class="msg">' . htmlspecialchars($content) . '</div>';
    exit;
} else {
    die(header('Location: /../pages/error.php'));
}
