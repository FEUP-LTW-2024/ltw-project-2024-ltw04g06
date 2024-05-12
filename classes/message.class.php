<?php

declare(strict_types = 1);

	class Message {
    public int $messageID;
    public int $senderID;
    public int $recipientID;
    public string $content;
    public string $time;

		
    public function __construct(int $messageID, int $senderID, int $recipientID, string $content, string $time) {
      $this->messageID = $messageID;
      $this->senderID = $senderID;
      $this->recipientID = $recipientID;
      $this->content = $content;
      $this->time = $time;
    }

    static function getMessage(PDO $db, int $messageID) {
      $preparedStmt = $db->prepare( 'SELECT * FROM Message WHERE messageID = ?');
      $preparedStmt->execute(array($messageID));
      $message = $preparedStmt->fetch();

      if (!$message) {
        throw new Exception("Message not found with ID: $messageID");
        return null;
    }
      return new Message(
        $message['messageID'],
        $message['senderID'],
        $message['recipientID'],
        $message['content'],
        $message['time'],
      );

    }


    /*Gives array of users that a certain user has messages with*/ 
    static function getUserMessageContacts(PDO $db, int $userID) { 
      $preparedStmt = $db->prepare('SELECT DISTINCT senderID AS contactID FROM Message WHERE recipientID = ? 
                                    UNION
                                    SELECT DISTINCT recipientID AS contactID FROM Message WHERE senderID = ?');
      $preparedStmt->execute([$userID, $userID]);
      $contacts = [];
      while ($contact = $preparedStmt->fetch()) {
        $contacts[] = User::getUser($db, $contact['contactID']);
      }
      return $contacts;
  }


    /*Gives array of messages between 2 users*/
    static function getUserMessages(PDO $db, int $userID1, int $userID2) {
      $preparedStmt = $db->prepare('SELECT  DISTINCT m.*
                                      FROM Message m
                                      JOIN MessageUser mu ON m.messageID = mu.messageID
                                      WHERE (m.senderID = ? AND m.recipientID = ?) OR
                                            (m.senderID = ? AND m.recipientID = ?)');
      $preparedStmt->execute([$userID1, $userID2, $userID2, $userID1]);
      $msgs = [];
      while ($msg = $preparedStmt->fetch()) {
          $msgs[] = new Message (
              $msg['messageID'],
              $msg['senderID'],
              $msg['recipientID'],
              $msg['content'],
              $msg['time']
          );
      }
        return $msgs;
    }

    static function addToMessage(PDO $db, int $senderID, int $recipientID, string $content){ 
      $timeZone = new DateTimeZone('Europe/Lisbon');
      $dateTime = new DateTime('now', $timeZone);
      $time = $dateTime->format('Y-m-d H:i:s');
      
      $preparedStmt = $db->prepare("INSERT INTO Message( senderID, recipientID, content, time ) VALUES ( ?, ?, ?, ?)");
      if(!$preparedStmt->execute([$senderID, $recipientID, $content, $time])) {
        return false;
      }
      $messageID = $db->lastInsertId();

      return $messageID;
    }


    static function addMessage(PDO $db, int $senderID, int $recipientID, string $content){ // VERIFICAR O QUE PASSA AQUI NO CONTENT
      $messageID = self::addToMessage($db, $senderID, $recipientID, $content);

      $preparedStmt = $db->prepare("INSERT INTO MessageUser(messageID, userID) VALUES (?, ?)");
      if (!$preparedStmt->execute([$messageID, $senderID])) {
          return false;
      }
      
      $preparedStmt = $db->prepare("INSERT INTO MessageUser(messageID, userID) VALUES (?, ?)");
      if (!$preparedStmt->execute([$messageID, $recipientID])) {
          return false;
      }

      return $messageID;
    }






}


?>