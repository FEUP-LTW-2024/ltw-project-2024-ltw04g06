<?php
require_once(__DIR__ . '/../database/validate_input.php');

class Session {
    private array $msgs;
    private string $csrf;

    static function generate_random_token() {
      return bin2hex(openssl_random_pseudo_bytes(32));
    }

    public function __construct() {
      session_set_cookie_params(60*60*12, '/');
      //session_set_cookie_params(10, '/');

        session_start();

        if (!isset($_SESSION['csrf'])) {
          $_SESSION['csrf'] = self::generate_random_token();
        }

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

      public function findMsgWithType($type) {
        if ($this->getMessages()) {
          foreach ($this->getMessages() as $msg) {
            if($msg['type'] == $type) return $msg;
          }
        }
        return null;
      }
}
?>