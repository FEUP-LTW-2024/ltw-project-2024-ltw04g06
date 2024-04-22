<?php

	declare(strict_types = 1);

	class Status {
    private int $statusID;
    private string $date;
    private string $name;

    public function __construct(int $statusID, string $date, string $name) {
      $this->statusID = $statusID;
      $this->date = $date;
      $this->name = $name;
    }
	}

?>