<?php

	declare(strict_types = 1);

	class Status {
    private int $id;
    private string $date;
    private string $name;

    public function __construct(int $id, string $date, string $name) {
      $this->id = $id;
      $this->date = $date;
      $this->name = $name;
    }
	}

?>