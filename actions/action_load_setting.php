<?php
require_once(__DIR__ . '/../templates/settings.php');
require_once(__DIR__ . '/../database/connectdb.php');
require_once(__DIR__ . '/../classes/session.class.php');
require_once(__DIR__ . '/../classes/user.class.php');

$db = getDatabaseConnection();
$session = new Session();

$userID = $session->getID();
$user = User::getUser($db,$userID);

$type = $_GET['type'];

switch ($type) {
    case 'ps':
        ProfileSettins($user);
        break;
    case 'as':
        AccountSettings($user);
        break;
    case 'ss':
        SecuritySettings($user);
        break;
    case 'l':
        Languages();
        break;
    default:
        echo "Tipo de configuração inválido.";
}
?>