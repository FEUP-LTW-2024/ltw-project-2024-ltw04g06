<?php

declare(strict_types = 1);

	class Message {
    private int $messageID;
    private int $senderID;
    private int $recipientID;
    private string $content;
    private string $time;

		
    public function __construct(int $messageID, int $senderID, int $recipientID, string $content, string $time) {
      $this->messageID = $messageID;
      $this->senderID = $senderID;
      $this->recipientID = $recipientID;
      $this->content = $content;
      $this->time = $time;
    }
  }

?>