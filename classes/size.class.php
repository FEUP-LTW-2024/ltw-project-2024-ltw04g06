<?php

declare(strict_types = 1);

class Size {
	public int $sizeID;
	public string $name;


	public function __construct(int $sizeID, string $name) {
		$this->id = $sizeID;
		$this->name = $name;
	}



}

?>