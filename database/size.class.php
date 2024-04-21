<?php

declare(strict_types = 1);

class Size {
	private int $sizeID;
	private string $name;


	public function __construct(int $sizeID, string $name) {
		$this->id = $sizeID;
		$this->name = $name;
	}
}

?>