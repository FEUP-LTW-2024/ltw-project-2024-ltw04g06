<?php

declare(strict_types = 1);

require_once(__DIR__ . '/status.class.php');


  class Item {
    public int $itemID;
    public string $name;
    public int $sellerID;
    public int $categoryID;
    public int $sizeID;
    public int $conditionID;
    public int $statusID;
    public float $price;
    public string $brand;
    public string $model;
    public string $description;
    public string $images;

    public function __construct(int $itemID,string $name, int $sellerID, int $categoryID, int $sizeID, int $conditionID, int $statusID, float $price, string $brand, string $model, string $description, string $images) {
      $this->itemID = $itemID;
      $this->name = $name;
      $this->sellerID = $sellerID;
      $this->categoryID = $categoryID;
      $this->sizeID = $sizeID;
      $this->conditionID = $conditionID;
      $this->statusID = $statusID;
      $this->price = $price;
      $this->brand = $brand;
      $this->model = $model;
      $this->description = $description;
      $this->images = $images;
    }

    static function getItem(PDO $db, int $itemID) {
      $preparedStmt = $db->prepare( 'SELECT * FROM Item WHERE itemID = ?');
      $preparedStmt->execute(array($itemID));
      $item = $preparedStmt->fetch();
      
      if (!$item) {
        throw new Exception("Item not found with ID: $itemID");
        return null;
    }
      return new Item(
        $item['itemID'],
        $item['name'],
        $item['sellerID'],
        $item['categoryID'],
        $item['sizeID'],
        $item['conditionID'],
        $item['statusID'],
        $item['price'],
        $item['brand'],
        $item['model'],
        $item['description'],
        $item['images'],
      );
    }

    static function getUserItems(PDO $db, int $sellerID) {
      $preparedStmt = $db->prepare( 'SELECT itemID FROM Item WHERE sellerID = ?');
      $preparedStmt->execute(array($sellerID));
      $items = array();

      while ($itemID = $preparedStmt->fetch(PDO::FETCH_ASSOC)) {
				$ID = $itemID['itemID'];
				$item = Item::getItem($db, $ID);
				$items[] = $item;
			}
      if (empty($items)) {
				//throw new Exception("Wishlist not found with ID: $wishlistID");
				return null;
			}
			return $items;
    }

    static function getFilteredItems(PDO $db, $category, $condition, $minPrice, $maxPrice) {
      $query = 'SELECT * FROM Item join Category on Item.categoryID = Category.categoryID
      join Condition on Item.conditionID = Condition.conditionID
       WHERE 1 = 1';
      $params = [];

  
      if ($category != NULL && $category != "NULL") {
          $query .= ' AND Category.name = ?';
          $params[] = $category;
      }
  
      if ($condition != NULL && $condition != "NULL") {
          $query .= ' AND Condition.usage = ?';
          $params[] = $condition;
      }
  
      if ($minPrice != NULL) {
          $query .= ' AND price > ?';
          $params[] = $minPrice;
      }
      
      if ($maxPrice != NULL) {
          $query .= ' AND price < ?';
          $params[] = $maxPrice;
      }
  
      $preparedStmt = $db->prepare($query);
      $preparedStmt->execute($params);
      $items = array();
      while ($item = $preparedStmt->fetch()) {
          $items[] = new Item(
              $item['itemID'],
              $item['name'],
              $item['sellerID'],
              $item['categoryID'],
              $item['sizeID'],
              $item['conditionID'],
              $item['statusID'],
              $item['price'],
              $item['brand'],
              $item['model'],
              $item['description'],
              $item['images']
          );
      }
      return $items;
  }


    static function getItemSeller(PDO $db, int $itemID) {
      $preparedStmt = $db->prepare('SELECT User.* FROM Item JOIN User ON Item.sellerID = User.userID
                                  WHERE Item.itemID = ?;');
                                  
      $preparedStmt->execute([$itemID]);
      $user = $preparedStmt->fetch();

      if (!$user) {
        throw new Exception("Seller not found for itemID: $itemID");
        return false;
      }
      return  User::getUser($db, $user['userID']);
    }

    static function getItemStatus(PDO $db, int $itemID){
      $item = Item::getItem($db, $itemID);
      $status = Status::getStatus($db, $item->statusID);
      if(!$status) {
        throw new Exception("Status not found for itemID: $itemID");
        return false;
      }
      return $status->name;
    }

        
    static function editItemStatus (PDO $db, int $itemID, string $name) : bool {
      $item = self::getItem($db, $itemID);
      $itemStatus = Status::getStatus($db, $item->statusID);

      if($itemStatus->name == $name){
        return false;}
      $statusID = Status::addStatus($db, $name);
      $preparedStmt = $db->prepare("UPDATE Item SET statusID = :statusID WHERE itemID = :itemID");
      $preparedStmt->bindParam(':statusID', $statusID, PDO::PARAM_INT);
      $preparedStmt->bindParam(':itemID', $itemID, PDO::PARAM_INT);
      if ($preparedStmt->execute()) {
        return true;
      } else {
          return false;
      }
    }


    static function addItem (PDO $db, string $name, int $sellerID, int $categoryID, int $sizeID, int $conditionID, string $brand, string $model, string $description, float $price, string $images)  {
      $statusID = Status::addStatus($db,"Available");

      $preparedStmt = $db->prepare("INSERT INTO Item (name, sellerID, categoryID, sizeID, conditionID, statusID, brand, model, description, price, images ) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
      $preparedStmt->execute([ $name, $sellerID, $categoryID, $sizeID, $conditionID, $statusID, $brand, $model, $description, $price, $images]);
      $itemID = $db->lastInsertId();
  
      return $itemID;
    }

    static function removeItem(PDO $db, int $itemID) {
      $item = self::getItem($db, $itemID);
      if($item == false) return false;
      $preparedStmt = $db->prepare("DELETE FROM Item WHERE itemID = ?");
      $preparedStmt->execute([$itemID]);
  
      if ($preparedStmt->execute()) {
        return true;
      } else {
          return false;
      }
    }

  }



  

?>