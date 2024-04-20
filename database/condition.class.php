<?php

declare(strict_types = 1);

class Condition {
	private int $id;
	private string $usage;


	public function __construct(int $id, string $usage) {
		$this->id = $id;
		$this->usage = $usage;
	}
}

?>