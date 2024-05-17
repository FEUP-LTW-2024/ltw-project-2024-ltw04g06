<?php

require_once(__DIR__ . '/../database/connectdb.php');
require_once(__DIR__ . '/user.class.php');
require_once(__DIR__ . '/item.class.php');
require_once(__DIR__ . '/message.class.php');
require_once(__DIR__ . '/wishlist.class.php');
require_once(__DIR__ . '/status.class.php');
require_once(__DIR__ . '/shippingForm.class.php');
require_once(__DIR__ . '/condition.class.php');
require_once(__DIR__ . '/category.class.php');


  $db = getDatabaseConnection();


  echo "-----------Teste-----------<br>";
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

 /*
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
*/

/*
 $itemID = Item::addItem($db, "ola", 1, 2, 0, 3, "adidas", "ola", "ola", 12.00,"images/profilePictures/default");
 echo "ItemID" . $itemID . "<br>";
 $item = Item::getItem($db, $itemID);
 echo "StatusID: ". $item->statusID."<br>";*/
/*
$editStatus = Item::editItemStatus($db, 1, "Available");
 $item = Item::getItem($db, 1);
 echo "StatusID: ". $item->statusID."<br>";
*/

/*
$items = User::getUserWishlist($db, 1);
 foreach($items as $item) {
  echo "Item ID: " . $item->name . "<br>";
}

$itemID = User::addItemUserWishlist($db,1,3);
if($itemID!= false){echo "ADD SUCCESSFUL <br>";}

$items = User::getUserWishlist($db, 1);
 foreach($items as $item) {
  echo "Item ID: " . $item->itemID . "<br>";
}


$items = User::remItemUserWishlist($db, 1, 3);
if($itemID){echo "REMOVE SUCCESSFUL <br>";}

$items = User::getUserWishlist($db, 1);
 foreach($items as $item) {
  echo "Item ID: " . $item->itemID . "<br>";
}*/

/*
$msgs = Message::getUserMessages($db,2,1);
  foreach($msgs as $msg) {
    echo " SenderID: ".$msg->senderID." RecipientID: ".$msg->recipientID." ->" . $msg ->content. "<br>";
  }

$messageID = Message::addMessage($db,1,2, "Teste0");

if($messageID!= false){"ADDED MESSAGE <br>";}
$msgs = Message::getUserMessages($db,2,1);
  foreach($msgs as $msg) {
    echo " SenderID: ".$msg->senderID." RecipientID: ".$msg->recipientID." ->" . $msg ->content. "<br>";
  }*/

/*
  $items = Item::getUserItems($db, 2);
  foreach($items as $item) {
    $statusID = $item->statusID;
    $status = Status::getStatus($db, $statusID);
    echo "Item Status: " . $status->name . "<br>";
  }

  $edited = User::editName($db, 1, "Joaquim_doe");
  if($edited){
    $user = User::getUser($db, 1);
    echo "Edited Name! ". $user->name . "<br>";
  }
  else echo "DIDNT edit name. <br>";

  $edited = User::editAboutMe($db, 1, "Afinal sou o joao_doe!");
  if($edited){
    $user = User::getUser($db, 1);
    echo "Edited AboutMe! ". $user->aboutMe . "<br>";
  }
  else echo "DIDNT edit aboutMe. <br>";

  $edited = User::editUsername($db, 1, "john_doe");
  if($edited){
    $user = User::getUser($db, 1);
    echo "Edited Username! ". $user->username . "<br>";
  }
    else echo "DIDNT edit Username. <br>";


  $edited = User::editEmail($db, 1, "john_doe@gmail.com");
  if($edited){
    $user = User::getUser($db, 1);
    echo "Edited email! ". $user->email . "<br>";
  }
    else echo "DIDNT edit email. <br>";

  $edited = User::editPassword($db, 1, "adeus123","adeus123", "adeus123");
  if($edited){
    $user = User::getUser($db, 1);
    echo "Edited password! ". $user->password . "<br>";
  }
    else echo "DIDNT edit password. <br>";

$removeItem = Item::removeItem($db, 1);
if($removeItem) echo "Item Removed <br>";
else echo "Item wasnt removed";


$removeUser = User::removeUser($db,2);
if($removeUser) echo "Removed <br>";
else echo "Not Removed";*/



/*
$items = User::getUserShoppingCart($db, 1);
foreach($items as $item) {
  echo "Item ID: " . $item->name . "<br>";
}

$itemID = User::addItemUserShoppingCart($db,1,3);
if($itemID!= false){echo "ADD SUCCESSFUL <br>";}

$items = User::getUserShoppingCart($db, 1);
foreach($items as $item) {
  echo "Item ID: " . $item->itemID . "<br>";
}


$items = User::remItemUserShoppingCart($db, 1, 3);
if($items){echo "REMOVE SUCCESSFUL <br>";}

$items = User::getUserShoppingCart($db, 1);
foreach($items as $item) {
  echo "Item ID: " . $item->itemID . "<br>";
}




$status = Item::getItemStatus($db, 3);
echo "STATUS: ". $status. "<br>";

$items = Item::getFilteredItems($db, 1, 3, 0, 99999999.99);
foreach($items as $item) {
  echo "Item ID: " . $item->itemID . "<br>";
}

$items = Item::getItemsByName($db, 'used');
foreach($items as $item) {
  echo "Item ID: " . $item->itemID . "<br>";
}

$shippingForm = ShippingForm::getShippingFormByItemID($db, 2);
  echo "ShippForm: ". $shippingForm->description . "<br>";

$shippingForm = ShippingForm::editDescription($db, 2, "new description");

$shippingForm = ShippingForm::getShippingFormByItemID($db, 2);
  echo "ShippForm: ". $shippingForm->description . "<br>";

  
  $user = User::getUser($db, 2);
  echo "user pn:" . $user -> address. "<br>";
  $user = User::editAddress($db, 2, "rua da tua mae 666");
  $user = User::getUser($db, 2);
  echo "user pn:" . $user -> address. "<br>";
*/

/*
$user  = User::getUser($db, 1);
echo $user ->role ."<br>";  
$editRole = User::editRole($db,1, "User");   

$user  = User::getUser($db, 1);
echo $user ->role ."<br>";    

$conditions = Condition::getAllConditions($db);
                foreach ($conditions as $condition) {
                    echo 'condition' .$condition->name . '<br>';
                }

                $categories = Category::getAllCategories($db);
foreach ($categories as $category) {
    echo 'category ' . $category->name . '<br>';
}

$users = User::getTopSellers($db);
foreach ($users as $user) {
  echo 'user ' . $user->name . '<br>';
}

$category = Category::getCategoryByName($db, "Clothing");
echo $category->categoryID;

$addedUserID = User::addUser($db, "ola", "ola@gmail.com", "ola_tudobem1");
echo "userID" . $addedUserID."<br>";


*/
$items = Item::getPurchasedItems($db,1);
foreach($items as $item) {
  echo "item". $item->itemID . "<br>";
}



?>



