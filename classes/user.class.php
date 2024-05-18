<?php

declare(strict_types = 1);
require_once(__DIR__ . '/wishlist.class.php');
require_once(__DIR__ . '/shoppingCart.class.php');
require_once(__DIR__ . '/image.class.php');

  class User {
    public int $userID;
    public string $username;
    public string $password;
    public string $name;
    public string $email;
    public string $role;
    public int $imageID;
    public string $aboutMe;
    public string $address;
    public int $phoneNumber;
    public int $wishlistID;
    public int $shoppingCartID;


    public function __construct(int $userID, string $username, string $password, string $name, string $email, string $role, int $imageID,  string $aboutMe,  string $address, int $phoneNumber, int $wishlistID, int $shoppingCartID) {
      $this->userID = $userID;
      $this->username = $username;
      $this->password = $password;
      $this->name = $name;
      $this->email = $email;
      $this->role = $role;
      $this->imageID = $imageID;
      $this->aboutMe = $aboutMe;
      $this->address = $address;
      $this->phoneNumber = $phoneNumber;
      $this->wishlistID = $wishlistID;
      $this->shoppingCartID = $shoppingCartID;

    }



    /*--Getters--*/

    static function getUser(PDO $db, int $userID) {
      $preparedStmt = $db->prepare( 'SELECT * FROM User WHERE userID = ?');
      $preparedStmt->execute(array($userID));
      $user = $preparedStmt->fetch();
      
      if (!$user) {
        throw new Exception("User not found with ID: $userID");
        return null;
    }
      return new User(
        $user['userID'],
        $user['username'],
        $user['password'],
        $user['name'],
        $user['email'],
        $user['role'],
        $user['imageID'],
        $user['aboutMe'],
        $user['address'],
        $user['phoneNumber'],
        $user['wishlistID'],
        $user['shoppingCartID'],
      );
    }

    static function getAllUsers(PDO $db) {
      $preparedStmt = $db->prepare( 'SELECT * FROM User');
      $preparedStmt->execute();
     $users = array();
      while($user = $preparedStmt->fetch()){
        $users[] = self::getUser($db, $user ['userID']);
      }
    return $users;
    }
    
    static function getTopSellers(PDO $db) {
      $preparedStmt = $db->prepare("SELECT sellerID FROM Item");
  
  $preparedStmt->execute();
  $sellerIDs = array();
  
  while ($row = $preparedStmt->fetch()) {
      $sellerIDs[] = $row['sellerID'];
  }
  $sellerIDCounts = array_count_values($sellerIDs);
  arsort($sellerIDCounts);
  $top3SellerIDs = array_slice(array_keys($sellerIDCounts), 0, 3);
  $users = array();
  foreach( $top3SellerIDs  as $sellerID) {
    $users[] = self::getUser($db, $sellerID);
  }
  return $users;
}
  



    static function getUserWishlist(PDO $db, int $userID) {
      $user = self::getUser($db, $userID);
      if($user!= null){
        $wishlist = Wishlist::getWishlistItems($db, $user->wishlistID);
        return $wishlist;
      }
      return null;
    }

    static function getUserPic(PDO $db, int $userID) {
      $user = User::getUser($db, $userID);
      if($user!= null){
        $image = Image::getImage($db, $user->imageID);
        return $image;
      }
      return null;
    }

    static function getUserShoppingCart(PDO $db, int $userID) {
      $user = self::getUser($db, $userID);
      if($user!= null){
        $shoppingCart = ShoppingCart::getShoppingCartItems($db, $user->shoppingCartID);
        return $shoppingCart;
      }
      return null;
    }




    /*--Verifications--*/

    static function existingUser (PDO $db, string $userField) : bool {                  //----------temos de filtrar as coisas que recebemos nesta string antes de chegar aqui. ver pp de segurança ex: slide28---------//
      if (strpos($userField, '@')) {                                                     //userField is email
        $preparedStmt = $db->prepare('SELECT * FROM User WHERE email = ?');
      } else {                                                                          //userField is username
        $preparedStmt = $db->prepare('SELECT * FROM User WHERE username = ?');
      }
        
      $preparedStmt->execute(array($userField));
      $existingUser = $preparedStmt->fetch();

      if(empty($existingUser)){
       return false;
      } else return true;
    }


    static function verifyUserPass (PDO $db, string $userField, string $password) {
      if (strpos($userField, '@')) {                                                     //userField is email
        $preparedStmt = $db->prepare('SELECT * FROM User WHERE email = ?');
      } else {                                                                          //userField is username
        $preparedStmt = $db->prepare('SELECT * FROM User WHERE username = ?');
      }

      $preparedStmt->execute(array($userField));
      $user = $preparedStmt->fetch();

      if($user !== false && password_verify($password, $user['password'])) {
        return User::getUser($db, $user['userID']);
      }
      else {
          return false;
      }
    }

    static function existItemUserWish (PDO $db, int $userID, int $itemID) {                  
      $user = self::getUser($db, $userID);
      $wishlistID = $user->wishlistID;
      $existItemInWishlist = Wishlist::existItemInWishlist($db, $wishlistID, $itemID);
      return $existItemInWishlist;
    }

    
    /*--Add--*/

    static function addItemUserWishlist(PDO $db, int $userID, int $itemID) {
      $user = self::getUser($db, $userID);
      $wishlistID = $user->wishlistID;
      return Wishlist::addItemToWishlist($db, $wishlistID, $itemID);
    }


    static function addItemUserShoppingCart(PDO $db, int $userID, int $itemID) {
      $user = self::getUser($db, $userID);
      $shoppingCartID = $user->shoppingCartID;
      return ShoppingCart::addItemToShoppingCart($db, $shoppingCartID, $itemID);
    }



    static function addUser (PDO $db, string $username, string $email, string $password)  {
      if(self::existingUser($db, $username) or self::existingUser($db, $email)) { return false; }

      $preparedStmt = $db->prepare("INSERT INTO Wishlist (wishlistID) VALUES (NULL)");
      $preparedStmt->execute();

      $wishlistID = $db->lastInsertId();

      $preparedStmt = $db->prepare("INSERT INTO ShoppingCart (shoppingCartID) VALUES (NULL)");
      $preparedStmt->execute();

      $shoppingCartID = $db->lastInsertId();
      
      $stmt = $db->prepare("INSERT INTO User (username, password, name, email, role, imageID, aboutMe, address, phoneNumber, wishlistID, shoppingCartID) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
      $stmt->execute([ $username,password_hash($password, PASSWORD_DEFAULT, ['cost' => 12]), '', $email, 'User',28,'','',0, $wishlistID, $shoppingCartID]);
      $userID = $db->lastInsertId();

      return $userID;
    }


    /*--Edit--*/

    static function editName(PDO $db, int $userID, string $newName) : bool {
      $user = self::getUser($db, $userID);
      if($user->name == $newName) return false;
      $preparedStmt = $db->prepare("UPDATE User SET name = :newName WHERE userID = :userID");
      $preparedStmt->bindParam(':newName', $newName, PDO::PARAM_STR);
      $preparedStmt->bindParam(':userID', $userID, PDO::PARAM_INT);
      $preparedStmt->execute();
      
      if ($preparedStmt->execute()) {
        return true;
      } else {
          return false;
      }
    }

    static function editImage(PDO $db, int $userID, int $imageID) : bool {
      $user = self::getUser($db, $userID);
      if($user->imageID == $imageID) return false;
      $preparedStmt = $db->prepare("UPDATE User SET imageID = :newImageID WHERE userID = :userID");
      $preparedStmt->bindParam(':newImageID', $imageID, PDO::PARAM_STR);
      $preparedStmt->bindParam(':userID', $userID, PDO::PARAM_INT);
      $preparedStmt->execute();
      
      if ($preparedStmt->execute()) {
        return true;
      } else {
          return false;
      }
    }


    static function editAboutMe(PDO $db, int $userID, string $newAboutMe) : bool {
      $user = self::getUser($db, $userID);
      if($user->aboutMe == $newAboutMe) return false;
      $preparedStmt = $db->prepare("UPDATE User SET aboutMe = :newAboutMe WHERE userID = :userID");
      $preparedStmt->bindParam(':newAboutMe', $newAboutMe, PDO::PARAM_STR);
      $preparedStmt->bindParam(':userID', $userID, PDO::PARAM_INT);
      $preparedStmt->execute();
  
      if ($preparedStmt->rowCount() > 0) {
        return true;
      } else {
        return false;
      }
    }

    static function editRole(PDO $db, int $userID, string $newRole) : bool {
      $user = self::getUser($db,$userID);
      if($user->role == $newRole) return false;
  
      $preparedStmt = $db->prepare("UPDATE User SET role = :newRole WHERE userID = :userID");
      $preparedStmt->bindParam(':newRole', $newRole, PDO::PARAM_STR);
      $preparedStmt->bindParam(':userID', $userID, PDO::PARAM_INT);
      $preparedStmt->execute();
      if ($preparedStmt->execute()) {
        return true;
      } else {
          return false;
        }
    }


    static function editUsername(PDO $db, int $userID, string $newUsername) : bool {
      if (self::existingUser($db, $newUsername)) {
          echo "Username already exists. Please choose a different one.";
          return false;
        }
  
      $preparedStmt = $db->prepare("UPDATE User SET username = :newUsername WHERE userID = :userID");
      $preparedStmt->bindParam(':newUsername', $newUsername, PDO::PARAM_STR);
      $preparedStmt->bindParam(':userID', $userID, PDO::PARAM_INT);
      $preparedStmt->execute();
      if ($preparedStmt->execute()) {
        return true;
      } else {
          return false;
        }
    }



    static function editEmail(PDO $db, int $userID, string $newEmail) : bool {
      if (self::existingUser($db, $newEmail)) {
          return false;
      }
  
      $preparedStmt = $db->prepare("UPDATE User SET email = :newEmail WHERE userID = :userID");
      $preparedStmt->bindParam(':newEmail', $newEmail, PDO::PARAM_STR);
      $preparedStmt->bindParam(':userID', $userID, PDO::PARAM_INT);
      $result = $preparedStmt->execute(); 
  
      if ($result) {
          return true;
      } else {
          return false;
      }
    }

    static function editPassword(PDO $db, int $userID,string $currentPass, string $newPass, string $confirmNewPass) : bool {
      $user = self::getUser($db,$userID);
      if(self::verifyUserPass($db,$user->username, $currentPass) == false){ echo "Wrong current pass";return false;}
      if($newPass != $confirmNewPass || $currentPass == $newPass ) return false;
      
      $hashedPassword = password_hash($newPass, PASSWORD_DEFAULT, ['cost' => 12]);

      $preparedStmt = $db->prepare("UPDATE User SET password = :newPassword WHERE userID = :userID");
      $preparedStmt->bindParam(':newPassword', $hashedPassword, PDO::PARAM_STR);
      $preparedStmt->bindParam(':userID', $userID, PDO::PARAM_INT);
      $result = $preparedStmt->execute();

      if ($result) {
          return true;
      } else {
          return false;
      }
    }


    static function editPhoneNumber(PDO $db, int $userID, string $newPhoneNumber) :bool {
      $user = self::getUser($db, $userID);
      if ($user->phoneNumber == $newPhoneNumber) {
          return false;
      }
      $preparedStmt = $db->prepare("UPDATE User SET phoneNumber = :newPhoneNumber WHERE userID = :userID");
      $preparedStmt->bindParam(':newPhoneNumber', $newPhoneNumber, PDO::PARAM_STR);
      $preparedStmt->bindParam(':userID', $userID, PDO::PARAM_INT);
      if ($preparedStmt->execute()) {
          return true;
      } else {
          return false;
      }
    }

    
    static function editAddress(PDO $db, int $userID, string $newAddress) :bool {
      $user = self::getUser($db, $userID);
      if ($user->address == $newAddress) {
          return false;
      }
      $preparedStmt = $db->prepare("UPDATE User SET address = :newAddress WHERE userID = :userID");
      $preparedStmt->bindParam(':newAddress', $newAddress, PDO::PARAM_STR);
      $preparedStmt->bindParam(':userID', $userID, PDO::PARAM_INT);
      if ($preparedStmt->execute()) {
          return true;
      } else {
          return false;
      }
    }
  
  

    /*--Remove--*/

    static function removeUser(PDO $db, int $userID) :bool {
      $items = Item::getUserItems($db, $userID);
      foreach($items as $item){
        $removeItem = Item::removeItem($db, $item->itemID);
        if(!$removeItem) return false;
      }
      $user = self::getUser($db,$userID);
      if (!self::existingUser($db, $user->username)) {
          return false;
      }
  
      $preparedStmt = $db->prepare("DELETE FROM User WHERE userID = ?");
      $preparedStmt->execute([$userID]);
  
      if ($preparedStmt->execute()) {
        return true;
      } else {
          return false;
      }
  }
  
    static function remItemUserWishlist(PDO $db, int $userID, int $itemID) {
      $user = self::getUser($db, $userID);
      $wishlistID = $user->wishlistID;
      return Wishlist::remItemFromWishlist($db, $wishlistID, $itemID);
    }


    static function remItemUserShoppingCart(PDO $db, int $userID, int $itemID) {
      $user = self::getUser($db, $userID);
      $shoppingCartID = $user->shoppingCartID;
      return ShoppingCart::remItemFromShoppingCart($db, $shoppingCartID, $itemID);
    }
  }
  



?>