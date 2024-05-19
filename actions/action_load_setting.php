<?php
require_once(__DIR__ . '/../templates/settings.php');
require_once(__DIR__ . '/../database/connectdb.php');
require_once(__DIR__ . '/../classes/session.class.php');
require_once(__DIR__ . '/../classes/user.class.php');

$db = getDatabaseConnection();
$session = new Session();
if (!$session->isLoggedIn()) {header('Location: /../pages/signIn.php');exit;}
if ($_SESSION['csrf'] !== $_POST['csrf']) { header('Location: /../pages/error.php'); exit; }


$userID = $session->getID();
$user = User::getUser($db,$userID);

$type = $_GET['type'];

switch ($type) {
    case 'ps':
        ProfileSettins($db, $user,$session);
        break;
    case 'as':
        AccountSettings($user,$session);
        break;
    case 'ss':
        SecuritySettings($user,$session);
        break;
        default:
}
?>
