<?php

declare(strict_types = 1);

  class User {
    public int $userID;
    public string $username;
    public string $password;
    public string $name;
    public string $email;
    public string $role;
    public string $profilePicture;
    public int $wishlistID;


    public function __construct(int $userID, string $username, string $password, string $name, string $email, string $role, string $profilePicture, int $wishlistID) {
      $this->userID = $userID;
      $this->username = $username;
      $this->password = $password;
      $this->name = $name;
      $this->email = $email;
      $this->role = $role;
      $this->profilePicture = $profilePicture;
      $this->wishlistID = $wishlistID;
    }

    static function getUser(PDO $db, int $userID) {
      $preparedStmt = $db->prepare( 'SELECT * FROM User WHERE userID = ?');
      $preparedStmt->execute(array($userID));
      $user = $preparedStmt->fetch();
      
      if (!$user) {
        throw new Exception("User not found with ID: $userID");
    }
      return new User(
        $user['userID'],
        $user['username'],
        $user['password'],
        $user['name'],
        $user['email'],
        $user['role'],
        $user['profilePicture'],
        $user['wishlistID'],
      );
    }

    static function validUsername(PDO $db, string $username) {                  //----------temos de filtrar as coisas que recebemos nesta string antes de chegar aqui. ver pp de segurança ex: slide28---------//
      $preparedStmt = $db->prepare('SELECT * FROM User WHERE username = ?');
        
      $preparedStmt->execute(array($username));
      $existingUser = $preparedStmt->fetch();

      if(empty($existingUser)){
       return true;
      } else return false;
    }

    static function verifyUserPass(PDO $db, string $userField, string $password) {
      if (strpos($userField, '@')) {                                                     //userField is email
        $preparedStmt = $db->prepare('SELECT * FROM User WHERE email = ?');
      } else {                                                                           //userField is username
        $preparedStmt = $db->prepare('SELECT * FROM User WHERE username = ?');
      }

      $preparedStmt->execute(array($userField));
      $user = $preparedStmt->fetch();

      if($user !== false && password_verify($password, $user['password'])) {
        return $user;
      }
      else {
          return false;
      }
    }



  }

?>