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

/*
  $msgs = Message::getUserMessages($db,2,1);
  foreach($msgs as $msg) {
    echo " SenderID: ".$msg->senderID." RecipientID: ".$msg->recipientID." ->" . $msg ->content. "<br>";
  }*/

/*
  $contacts = Message::getUserMessageContacts($db,1);
  foreach($contacts as $contact) {
  echo "User ID: " . $contact->userID . "<br>";
  echo "Username: " . $contact->username . "<br>";
  }
  */



  /*
  $user1 = User::verifyUserPass($db,'john_doe', 'ola123');

 $existingUser = User::existingUser($db,'di' );
 if($existingUser){echo "user Exists <br>";}
 else {echo "user doesnt Exist <br>";}

 $addUser = User::addUser($db, 'di', 'di@example.com','ola123');
 if($addUser){echo "added user <br>";}
 else {echo"user not added <br>";}
 $existingUser = User::existingUser($db,'di' );
 if($existingUser){echo "user Exists <br>";}
 else {echo "user doesnt Exist <br>";}

 $user2 = User::verifyUserPass($db,'di', 'ola123');
 //$user2 = User::getUserByUsername($db,'ola');
 if( $user2  == false ){echo "FAILED VERIFY USER PASS";}
 else {echo "User2 ID: " . $user2->username . "<br>";}*/ 

 $existingUser = User::existingUser($db,'di' );
 if($existingUser){echo "user Exists <br>";}
 else {echo "user doesnt Exist <br>";}

 $addUserID = User::addUser($db, 'di', 'di@example.com','ola123');
 if($addUserID!= false){echo "added user <br>";
  $user2 = User::getUser($db, $addUserID);
  echo "User2 ID: " . $user2->userID . "<br>";
}
 else {echo"user not added <br>";}

 $existingUser = User::existingUser($db,'di' );
 if($existingUser){echo "user Exists <br>";}
 else {echo "user doesnt Exist <br>";}


/*
 $itemID = Item::addItem($db, "ola", 1, 2, 0, 3, "adidas", "ola", "ola", 12.00,"images/profilePictures/default");
 echo "ItemID" . $itemID . "<br>";
 $item = Item::getItem($db, $itemID);
 echo "StatusID: ". $item->statusID."<br>";*/

$editStatus = Item::editItemStatus($db, 1, "Available");
 $item = Item::getItem($db, 1);
 echo "StatusID: ". $item->statusID."<br>";
?>
