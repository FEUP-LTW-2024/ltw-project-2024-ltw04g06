<?php
	require_once(__DIR__ . '/../classes/session.class.php');

	$session = new Session();
    if (!$session->isLoggedIn()) {header('Location: /../pages/signIn.php');exit;}

    $session->logout();

    header('Location: /../pages/signIn.php');

?>