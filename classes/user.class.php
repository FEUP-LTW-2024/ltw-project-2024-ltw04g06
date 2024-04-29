<?php

declare(strict_types = 1);
require_once(__DIR__ . '/wishlist.class.php');

  class User {
    public int $userID;
    public string $username;
    public string $password;
    public string $name;
    public string $email;
    public string $role;
    public string $profilePicture;
    public string $aboutMe;
    public string $address;
    public int $phoneNumber;
    public int $wishlistID;


    public function __construct(int $userID, string $username, string $password, string $name, string $email, string $role, string $profilePicture,  string $aboutMe,  string $address, int $phoneNumber, int $wishlistID) {
      $this->userID = $userID;
      $this->username = $username;
      $this->password = $password;
      $this->name = $name;
      $this->email = $email;
      $this->role = $role;
      $this->profilePicture = $profilePicture;
      $this->aboutMe = $aboutMe;
      $this->address = $address;
      $this->phoneNumber = $phoneNumber;
      $this->wishlistID = $wishlistID;
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
        $user['profilePicture'],
        $user['aboutMe'],
        $user['address'],
        $user['phoneNumber'],
        $user['wishlistID'],
      );
    }

    
    static function getUserByUsername(PDO $db, string $username) {
      $preparedStmt = $db->prepare( 'SELECT * FROM User WHERE username = ?');
      $preparedStmt->execute(array($username));
      $user = $preparedStmt->fetch();
      
      if (!$user) {
        throw new Exception("User not found with username: $username");
        return false;
    }
      return new User(
        $user['userID'],
        $user['username'],
        $user['password'],
        $user['name'],
        $user['email'],
        $user['role'],
        $user['profilePicture'],
        $user['aboutMe'],
        $user['address'],
        $user['phoneNumber'],
        $user['wishlistID'],
      );
    }

    static function getUserWishlist(PDO $db, int $userID) {
      $user = self::getUser($db, $userID);
      if($user!= null){
        $wishlist = Wishlist::getWishlistItems($db, $user->wishlistID);
        return $wishlist;
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

    
    /*--Add--*/

    static function addItemUserWishlist(PDO $db, int $userID, int $itemID) {
      $user = self::getUser($db, $userID);
      $wishlistID = $user->wishlistID;
      return Wishlist::addItemToWishlist($db, $wishlistID, $itemID);
    }


    static function addUser (PDO $db, string $username, string $email, string $password)  {
      if(self::existingUser($db, $username) or self::existingUser($db, $email)) { return false; }

      $preparedStmt = $db->prepare("INSERT INTO Wishlist (wishlistID) VALUES (NULL)");
      $preparedStmt->execute();

      $wishlistID = $db->lastInsertId();
      
      $stmt = $db->prepare("INSERT INTO User (username, password, name, email, role, profilePicture, aboutMe, address, phoneNumber, wishlistID) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
      $stmt->execute([ $username,password_hash($password, PASSWORD_DEFAULT, ['cost' => 10]), '', $email, 'User', 'images/profilePictures/default','','',0, $wishlistID]);
      $userID = $db->lastInsertId();

  
      echo "User added successfully with userID: $userID";
      return $userID;
    }


    /*--Edit--*/

    static function editName(PDO $db, int $userID, string $newName) {
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

    static function editAboutMe(PDO $db, int $userID, string $newAboutMe) {
      $user = self::getUser($db, $userID);
      if($user->aboutMe == $newAboutMe) return false;
      $preparedStmt = $db->prepare("UPDATE User SET aboutMe = :newAboutMe WHERE userID = :userID");
      $preparedStmt->bindParam(':newAboutMe', $newAboutMe, PDO::PARAM_STR);
      $preparedStmt->bindParam(':userID', $userID, PDO::PARAM_INT);
      $preparedStmt->execute();
  
      if ($preparedStmt->rowCount() > 0) {
          return array("success" => true, "message" => "About Me updated successfully for userID: $userID");
      } else {
          return array("success" => false, "message" => "Failed to update About Me for userID: $userID");
      }
  }


    static function editUsername(PDO $db, int $userID, string $newUsername) {
      if (self::existingUser($db, $newUsername)) {
          echo "Username already exists. Please choose a different one.";
          return false;
          //return array("success" => false, "message" => "Username already exists. Please choose a different one.");      
        }
  
      $preparedStmt = $db->prepare("UPDATE User SET username = :newUsername WHERE userID = :userID");
      $preparedStmt->bindParam(':newUsername', $newUsername, PDO::PARAM_STR);
      $preparedStmt->bindParam(':userID', $userID, PDO::PARAM_INT);
      $preparedStmt->execute();
      if ($preparedStmt->execute()) {
        return true;
        //return array("success" => true, "message" => "Username changed successfully for userID: $userID");
      } else {
          return false;
          //return array("success" => false, "message" => "Failed to change username for userID: $userID");
      }
    }



    static function editEmail(PDO $db, int $userID, string $newEmail) {
      if (self::existingUser($db, $newEmail)) {
          return false;
          //return array("success" => false, "message" => "Email already exists. Please choose a different one.");
      }
  
      $preparedStmt = $db->prepare("UPDATE User SET email = :newEmail WHERE userID = :userID");
      $preparedStmt->bindParam(':newEmail', $newEmail, PDO::PARAM_STR);
      $preparedStmt->bindParam(':userID', $userID, PDO::PARAM_INT);
      $result = $preparedStmt->execute(); // Executing the prepared statement
  
      if ($result) {
          return true;
          //return array("success" => true, "message" => "Email changed successfully for userID: $userID");
      } else {
          return false;
          //return array("success" => false, "message" => "Failed to change email for userID: $userID");
      }
  }
  


  



    /*--Remove--*/

    static function remItemUserWishlist(PDO $db, int $userID, int $itemID) {
      $user = self::getUser($db, $userID);
      $wishlistID = $user->wishlistID;
      return Wishlist::remItemFromWishlist($db, $wishlistID, $itemID);
    }
  }
  

?>