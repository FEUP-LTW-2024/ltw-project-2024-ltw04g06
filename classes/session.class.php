<?php

class Session {
    private array $msgs;

    public function __construct() {
        session_start();
  
        $this->msgs = isset($_SESSION['msgs']) ? $_SESSION['msgs'] : array();
        unset($_SESSION['msgs']);
      }

      public function getName() {
        return isset($_SESSION['name']) ? $_SESSION['name'] : null;
      }

      public function setName(string $name) {
        $_SESSION['name'] = $name;
      }

      public function getID() {
        return isset($_SESSION['ID']) ? $_SESSION['ID'] : null;    
      }

      public function setId(int $id) {
        $_SESSION['ID'] = $id;
      }

      public function logout() {
        session_destroy();
      }

      public function isLoggedIn() {
        return isset($_SESSION['ID']);    
      }


      public function addMessage(string $type, string $message) {
        $_SESSION['msgs'][] = array('type' => $type, 'text' => $message);
      }
  
      public function getMessages() {
        return $this->msgs;
      }
}
?>