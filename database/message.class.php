<?php

declare(strict_types = 1);

	class Message {
    private int $id;
    private int $senderId;
    private int $recipientId;
    private string $content;
    private string $time;

		
    public function __construct(int $id, int $senderId, int $recipientId, string $content, string $time) {
      $this->id = $id;
      $this->senderId = $senderId;
      $this->recipientId = $recipientId;
      $this->content = $content;
      $this->time = $time;
    }
  }

?>