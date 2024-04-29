<?php
require_once(__DIR__ . '/../templates/settings.php');

$type = $_GET['type'];

switch ($type) {
    case 'ps':
        ProfileSettins();
        break;
    case 'as':
        AccountSettings();
        break;
    case 'ss':
        SecuritySettings();
        break;
    case 'l':
        Languages();
        break;
    default:
        echo "Tipo de configuração inválido.";
}
?>
