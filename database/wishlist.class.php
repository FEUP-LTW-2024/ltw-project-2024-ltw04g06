<?php

declare(strict_types = 1);

	class Wishlist {
		private int $id;
		private int $itemId;


		public function __construct(int $id, int $itemId) {
			$this->id = $id;
			$this->itemId = $itemId;
		}
	}

?>
