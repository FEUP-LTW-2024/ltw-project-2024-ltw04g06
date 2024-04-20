<?php

declare(strict_types = 1);

class Size {
	private int $id;
	private string $name;


	public function __construct(int $id, string $name) {
		$this->id = $id;
		$this->name = $name;
	}
}

?>