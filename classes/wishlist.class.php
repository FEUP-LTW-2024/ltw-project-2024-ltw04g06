<?php

declare(strict_types = 1);

	class Wishlist {
		private int $wishlistID;
		private int $itemID;


		public function __construct(int $wishlistID, int $itemID) {
			$this->wishlistID = $wishlistID;
			$this->itemID = $itemID;
		}
	}

?>
