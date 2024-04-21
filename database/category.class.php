<?php

  declare(strict_types = 1);

	class Category {
    private int $categoryID;
    private string $name;

    public function __construct(int $categoryID, string $name) {
      $this->categoryID = $categoryID;
      $this->name = $name;
    }
	}

?>