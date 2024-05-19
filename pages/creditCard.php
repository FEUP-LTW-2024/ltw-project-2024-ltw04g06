<?php
	require_once(__DIR__ . '/../classes/session.class.php');
	require_once(__DIR__ . '/../database/connectdb.php');
    require_once(__DIR__ . '/../classes/user.class.php');
    require_once(__DIR__ . '/../templates/creditCard.php');
    require_once(__DIR__ . '/../templates/topo.php');
    require_once(__DIR__ . '/../templates/searchForm.php');

	$db = getDatabaseConnection();
    $session = new Session();
    if (!$session->isLoggedIn()) {header('Location: /../pages/signIn.php');exit;}


    $buyerID = $session->getID();


    topo($db, User::getUser($db, $buyerID));
    creditCard($session);

?>
