<?php

declare(strict_types = 1);

  class User {
    public int $id;
    public string $username;
    public string $hashedPassword;
    public string $name;
    public string $email;
    public string $role;
    public string $profilePicture;
    public int $wishlistId;


    public function __construct(int $id, string $username, string $hashedPassword, string $name, string $email, string $role, string $profilePicture, int $wishlistId) {
      $this->id = $id;
      $this->username = $username;
      $this->hashedPassword = $hashedPassword;
      $this->name = $name;
      $this->email = $email;
      $this->role = $role;
      $this->profilePicture = $profilePicture;
      $this->wishlistId = $wishlistId;
    }
  }

?>