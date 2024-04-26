<?php

require_once(__DIR__ . '/../database/connectdb.php');
require_once(__DIR__ . '/user.class.php');
require_once(__DIR__ . '/item.class.php');
require_once(__DIR__ . '/message.class.php');
  $db = getDatabaseConnection();
/*
  $user = User::getUser($db, 1);

  echo "User ID: " . $user->userID . "<br>";
  echo "Username: " . $user->username . "<br>";
  echo "Name: " . $user->name . "<br>";
  echo "Email: " . $user->email . "<br>";
  echo "Role: " . $user->role . "<br>";
  echo "Profile Picture: " . $user->profilePicture . "<br>";
  echo "Wishlist ID: " . $user->wishlistID . "<br>";
  echo "<br>";

  $item = Item::getItem($db, 1);

  echo "Item ID: " . $item->itemID . "<br>";
  echo "Images" . $item ->images . "<br>";
  echo "Description: " . $item->description . "<br>";
  echo "<br>";

  $items = Item::getFilteredItems($db);
  foreach($items as $item) {
    echo "Item ID: " . $item->itemID . "<br>";
  }

  $user = Item::getItemSeller($db,3);
  echo "User ID: " . $user->userID . "<br>";
  echo "Username: " . $user->username . "<br>";
  echo "Name: " . $user->name . "<br>";
  echo "Email: " . $user->email . "<br>";
  echo "Role: " . $user->role . "<br>";
  echo "Profile Picture: " . $user->profilePicture . "<br>";
  echo "Wishlist ID: " . $user->wishlistID . "<br>";
  echo "<br>";*/


  $msgs = Message::getUserMessages($db,2,1);
  foreach($msgs as $msg) {
    echo " SenderID: ".$msg->senderID." RecipientID: ".$msg->recipientID." ->" . $msg ->content. "<br>";
  }

/*
  $contacts = Message::getUserMessageContacts($db,1);
  foreach($contacts as $contact) {
  echo "User ID: " . $contact->userID . "<br>";
  echo "Username: " . $contact->username . "<br>";
  }
  */


 $user = User::verifyUserPass($db,'john@example.com','ola123');
 echo "User ID: " . $user->userID . "<br>";

 $existingUser = User::existingUser($db,'ola' );
 if($existingUser){echo "user Exists <br>";}
 else {echo "user doesnt Exist <br>";}

 $addUser = User::addUser($db, 'ola', 'ola@example.com','$2y$10$S/rltAJpIzCkpGvpHEqMYuOAVJJg5HOvs4xha5tT8O78er8X2jt4q');
 if($addUser){echo "added user <br>";}
 else {echo"user not added <br>";}
 $existingUser = User::existingUser($db,'ola' );
 if($existingUser){echo "user Exists <br>";}
 else {echo "user doesnt Exist <br>";}
?>
