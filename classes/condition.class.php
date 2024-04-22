<?php

declare(strict_types = 1);

class Condition {
	private int $conditionID;
	private string $usage;


	public function __construct(int $conditionID, string $usage) {
		$this->conditionID = $conditionID;
		$this->usage = $usage;
	}
}

?>