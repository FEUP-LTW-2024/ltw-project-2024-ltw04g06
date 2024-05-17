<?php

declare(strict_types = 1);

	class ShoppingCart {
		public int $shoppingCartID;

		public function __construct(int $shoppingCartID, int $itemID) {
			$this->shoppingCartID = $shoppingCartID;
		}

		static function getShoppingCartItems(PDO $db, int $shoppingCartID) {
			$preparedStmt = $db->prepare('SELECT itemID FROM ShoppingCartItem WHERE shoppingCartID = ?');
			$preparedStmt->execute(array($shoppingCartID));
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
		

		static function existItemInShoppingCart (PDO $db, int $shoppingCartID, int $itemID) : bool{
			$items = self::getShoppingCartItems($db, $shoppingCartID);
			foreach($items as $item) {
				if($item->itemID == $itemID) return true;
			}
			return false;
		}
	

		static function addItemToShoppingCart(PDO $db, int $shoppingCartID, int $itemID){
			$itemAlreadyInCart = (self::existItemInShoppingCart($db, $shoppingCartID, $itemID));

			if($itemAlreadyInCart) { return false; }

			$preparedStmt = $db->prepare("INSERT INTO ShoppingCartItem (shoppingCartID, itemID) VALUES (?, ?)");
      		$preparedStmt->execute([$shoppingCartID, $itemID]);

			return $itemID;
		}
		
		static function remItemFromShoppingCart(PDO $db, int $shoppingCartID, int $itemID){
			$itemAlreadyInCart = (self::existItemInShoppingCart($db, $shoppingCartID, $itemID));

			if($itemAlreadyInCart == false) { return false; }

			$preparedStmt = $db->prepare("DELETE FROM ShoppingCartItem WHERE shoppingCartID = ? AND itemID = ?");
			$preparedStmt->execute([$shoppingCartID, $itemID]);
		
			return true; 
		}
		


	}

?>
