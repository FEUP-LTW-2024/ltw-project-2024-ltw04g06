<?php
	require_once(__DIR__ . '/../classes/session.class.php');

	$session = new Session();
    $session->logout();

    header('Location: /../pages/signIn.php');

?>