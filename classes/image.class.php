<?php

declare(strict_types = 1);

require_once(__DIR__ . '/status.class.php');


  class Image {
    public int $imageID;
    public string $link;

    public function __construct(int $imageID, string $link) {
      $this->imageID = $imageID;
      $this->link = $link;
    }
    static function addImage(PDO $db, string $link) :bool {
      $preparedStmt = $db->prepare("INSERT INTO Image VALUES(NULL, ?)");
      $success = $preparedStmt->execute([$link]);
        
      if ($success) {
          return true;
      } else {
          return false;
      }
    }
    static function getImage(PDO $db, int $imageID) {
			$preparedStmt = $db->prepare('SELECT link FROM Image WHERE Image.imageID = ?');
			$preparedStmt->execute([$imageID]);
      $result = $preparedStmt->fetch();
      return $result['link'];
		}
  }
?>