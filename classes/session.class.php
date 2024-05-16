<?php
require_once(__DIR__ . '/../database/validate_input.php');

class Session {
    private array $msgs;
    private string $csrf;

    static function generate_random_token() {
      return bin2hex(openssl_random_pseudo_bytes(32));
    }

    public function __construct() {
      session_set_cookie_params(43200, '/'); 
      session_start();
  
      if (!isset($_SESSION['csrf'])) {
          $_SESSION['csrf'] = self::generate_random_token();
      }
  
      $this->msgs = isset($_SESSION['msgs']) ? $_SESSION['msgs'] : array();
      unset($_SESSION['msgs']);
  
      if (isset($_SESSION['last_activity'])) {
          $this->checkActivity();
      } else {
          $_SESSION['last_activity'] = time();
      }
  }
  
  private function checkActivity() {
      $currentTime = time();
  
      $lastActivityTime = $_SESSION['last_activity'];
      $timeDifference = $currentTime - $lastActivityTime;
  
      if ($timeDifference > 3600) {// will log off after 1 hour
          header('Location: /../pages/signIn.php');
          $this->logout();
      } else {
          $_SESSION['last_activity'] = $currentTime;
      }
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

      public function setID(int $id) {
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

      public function addSpecificMessage(string $type,string $specificType, string $message) {
        $_SESSION['msgs'][] = array('type' => $type,'specificType'=> $specificType, 'text' => $message);
      }
  
      public function getMessages() {
        return $this->msgs;
      }

      public function displayMessages() {
        if ($this->getMessages()) {
          foreach ($this->getMessages() as $msg) {
            echo '<div class="message ' . $msg['type'] . '">' . $msg['text'] . '</div>';
          }
        }
      }
      public function displayMessage( $msg) {
            echo '<div class="message ' . $msg['type'] . '">' . $msg['text'] . '</div>';
      }

      public function findMsgWithType($type) {
        if ($this->getMessages()) {
          foreach ($this->getMessages() as $msg) {
            if($msg['type'] == $type) return $msg;
          }
        }
        return null;
      }
      public function findMsgWithSpecificType($specificType) {
        if ($this->getMessages()) {
          foreach ($this->getMessages() as $msg) {
            if($msg['specificType'] == $specificType) return $msg;
          }
        }
        return null;
      }
}
?>