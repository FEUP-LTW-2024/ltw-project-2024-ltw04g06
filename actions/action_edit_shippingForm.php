<?php
	require_once(__DIR__ . '/../classes/session.class.php');
	require_once(__DIR__ . '/../database/connectdb.php');
    require_once(__DIR__ . '/../classes/user.class.php');


	$db = getDatabaseConnection();
    $session = new Session();

	if (!$session->isLoggedIn()) {
        header('Location: /../pages/signIn.php');
        exit;
    }

    $sellerID = $session->getID();

    $address = $_POST['address'];
    $phoneNumber = $_POST['phoneNumber'];
    $description = $_POST['description'];

    $editAddress = User::editAddress($db, $sellerID, $address);
    $editPhoneNumber = User::editPhoneNumber($db, $sellerID, $phoneNumber);
    $editDescription = ShippingForm::editDescription($db, $sellerID, $description);

    if($editAddress || $editPhoneNumber || $editDescription){
        $session->addMessage('success', 'Edit shipping Form successful!');
        header('Location: /../pages/shippingForm.php');
        }
        else{
            $session->addMessage('error', 'Did not edit shipping Form settings!');
            header('Location: /../pages/shippingForm.php');
        }





?>