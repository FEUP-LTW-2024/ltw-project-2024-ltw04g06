<?php

	declare(strict_types = 1);

	class Status {
    public int $statusID;
    public string $date;
    public string $name;

    public function __construct(int $statusID, string $date, string $name) {
      $this->statusID = $statusID;
      $this->date = $date;
      $this->name = $name;
    }

    static function getStatus(PDO $db, int $statusID) {
      $preparedStmt = $db->prepare( 'SELECT * FROM Status WHERE statusID = ?');
      $preparedStmt->execute(array($statusID));
      $status = $preparedStmt->fetch();

      if(!$status){
        throw new Exception("Status not found with ID: $statusID");
        return null;
    }
    return new Status(
      $status['statusID'],
      $status['date'],
      $status['name']
    );
    }

    static function getStatusByName(PDO $db, int $name) {
      $preparedStmt = $db->prepare( 'SELECT * FROM Status WHERE name = ?');
      $preparedStmt->execute(array($name));
      $status = $preparedStmt->fetch();

      if(!$status){
        throw new Exception("Status not found with name: $name");
        return null;
    }
    return new Status(
      $status['statusID'],
      $status['date'],
      $status['name']
    );
    }


    static function addStatus(PDO $db, string $name) {
      $date = date('Y-m-d');
      echo "CURRENT DATE". $date . "<br>";
      $preparedStmt = $db->prepare("INSERT INTO Status (date, name) VALUES ( ?, ?)");
      $preparedStmt->execute([$date, $name]);
      $statusID = $db->lastInsertId();
  
      echo "Status added successfully with statusID: $statusID";
      return $statusID;
    }



	}

?>