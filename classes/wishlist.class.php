<?php

declare(strict_types = 1);

	class Wishlist {
		public int $wishlistID;

		public function __construct(int $wishlistID, int $itemID) {
			$this->wishlistID = $wishlistID;
		}

		static function getWishlistItems(PDO $db, int $wishlistID) {
			$preparedStmt = $db->prepare('SELECT itemID FROM WishlistItem WHERE wishlistID = ?');
			$preparedStmt->execute(array($wishlistID));
			$items = array();

			while ($itemID = $preparedStmt->fetch(PDO::FETCH_ASSOC)) {
				$ID = $itemID['itemID'];
				$item = Item::getItem($db, $ID);
				$items[] = $item;
			}
		
			if (empty($items)) {
				return null;
			}
			return $items;
		}
		

		static function existItemInWishlist (PDO $db, int $wishlistID, int $itemID) : bool {
			$items = self::getWishlistItems($db, $wishlistID);
			foreach($items as $item) {
				if($item->itemID == $itemID) return true;
			}
			return false;
		}
	

		static function addItemToWishlist(PDO $db, int $wishlistID, int $itemID){
			$itemAlreadyInWish = (self::existItemInWishlist($db, $wishlistID, $itemID));

			if($itemAlreadyInWish) { return false; }

			$preparedStmt = $db->prepare("INSERT INTO WishlistItem (wishlistID, itemID) VALUES (?, ?)");
      		$preparedStmt->execute([$wishlistID, $itemID]);

			return $itemID;
		}
		
		static function remItemFromWishlist(PDO $db, int $wishlistID, int $itemID){
			$itemAlreadyInWish = (self::existItemInWishlist($db, $wishlistID, $itemID));

			if($itemAlreadyInWish == false) { return false; }

			$preparedStmt = $db->prepare("DELETE FROM WishlistItem WHERE wishlistID = ? AND itemID = ?");
			$preparedStmt->execute([$wishlistID, $itemID]);
		
			return true; 
		}
		


	}

?>
