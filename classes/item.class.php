<?php

declare(strict_types = 1);

require_once(__DIR__ . '/status.class.php');
require_once(__DIR__ . '/shippingForm.class.php');
require_once(__DIR__ . '/image.class.php');


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
    public int $imageID;

    public function __construct(int $itemID,string $name, int $sellerID, int $categoryID, int $sizeID, int $conditionID, int $statusID, float $price, string $brand, string $model, string $description, int $imageID) {
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
      $this->imageID = $imageID;
    }

    /*--Getters--*/

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
        $item['imageID'],
      );
    }
    static function getItemsByName(PDO $db, string $searchString) {
      $preparedStmt = $db->prepare("SELECT * FROM Item WHERE name LIKE ?");
      $preparedStmt->execute(["$searchString%"]);
      $items = [];
  
      while ($item = $preparedStmt->fetch()) {
          $items[] = self::getItem($db, $item['itemID']);
      }
  
      return $items;
  }
  static function getImagePic(PDO $db, Item $item) {
    if($item!= null){
      $image = Image::getImage($db, $item->imageID);
      return $image;
    }
    return null;
  }
  

    static function getUserItems(PDO $db, int $sellerID) {
      $preparedStmt = $db->prepare( 'SELECT itemID FROM Item WHERE sellerID = ?');
      $preparedStmt->execute(array($sellerID));
      $items = array();

      while ($itemID = $preparedStmt->fetch()) {
				$ID = $itemID['itemID'];
				$item = self::getItem($db, $ID);
				$items[] = $item;
			}
      if (empty($items)) {
				return null;
			}
			return $items;
    }

    static function getPurchasedItems(PDO $db, int $userID) {
      $preparedStmt = $db->prepare('SELECT itemID FROM ShippingForm WHERE buyerID = ?');
      $preparedStmt->execute(array($userID));
      $items = array();

      while ($row = $preparedStmt->fetch()) {
          $itemID = $row['itemID'];
          $item = self::getItem($db, $itemID);
          $items[] = $item;
      }
      if (empty($items)) {
				return null;
			}

      return $items;
  }

    static function getNumAvailableItems(PDO $db, int $sellerID) {
      $items = self::getUserItems($db, $sellerID);
      if ($items === null) {
          return 0;
      }
      $availableCount = 0;
      foreach ($items as $item) {
          $status = self::getItemStatus($db, $item->itemID);
          if ($status === "Available") {
              $availableCount++;
          }
      }
      return $availableCount;
    }
    static function getNumSoldItems(PDO $db, int $sellerID) {
      $items = self::getUserItems($db, $sellerID);
      if ($items === null) {
          return 0;
      }
      $soldCount = 0;
      foreach ($items as $item) {
          $status = self::getItemStatus($db, $item->itemID);
          if ($status === "Sold") {
              $soldCount++;
          }
      }
      return $soldCount;
    }
    

    static function getFilteredItems(PDO $db, $category, $condition, $minPrice, $size, $maxPrice) {
      $query = 'SELECT * FROM Item join Category on Item.categoryID = Category.categoryID
      join Condition on Item.conditionID = Condition.conditionID
      join Size on Item.sizeID = Size.sizeID
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

      if ($size != NULL && $size != "NULL") {
        $query .= ' AND Size.name = ?';
        $params[] = $size;
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
          $items[] = self::getItem($db, $item['itemID']);
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

    /*--Add--*/

    static function addItem (PDO $db, string $name, int $sellerID, int $categoryID, int $sizeID, int $conditionID, string $brand, string $model, string $description, float $price, string $imageID)  {
      $statusID = Status::addStatus($db,"Available");
      $preparedStmt = $db->prepare("INSERT INTO Item (name, sellerID, categoryID, sizeID, conditionID, statusID, brand, model, description, price, imageID ) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
      if ($preparedStmt->execute([ $name, $sellerID, $categoryID, $sizeID, $conditionID, $statusID, $brand, $model, $description, $price, $imageID])) {
        return true;
      } else {
          return false;
      }
    }    

    /*--Edit--*/
        
    static function editItemStatus(PDO $db, int $itemID, int $buyerID, string $name) {
      $item = self::getItem($db, $itemID);
      $itemStatus = Status::getStatus($db, $item->statusID);
  
      if ($itemStatus->name == $name) {
          return false;
      }
  
      $statusID = Status::addStatus($db, $name);
      $preparedStmt = $db->prepare("UPDATE Item SET statusID = :statusID WHERE itemID = :itemID");
      $preparedStmt->bindParam(':statusID', $statusID, PDO::PARAM_INT);
      $preparedStmt->bindParam(':itemID', $itemID, PDO::PARAM_INT);
      $preparedStmt->execute();
  
      if ($name == "Sold") {
        $currentTime = date('Y-m-d H:i:s');
        ShippingForm::addShippingForm($db, $itemID, $item->sellerID, $buyerID, $currentTime);
      } else {
        return false;
      }
    }
    
    static function editName(PDO $db, Item $item, string $newName) : bool {
      $itemID = $item->itemID;
      if($item->name == $newName) return false;
      $preparedStmt = $db->prepare("UPDATE Item SET name = :newName WHERE itemID = :itemID");
      $preparedStmt->bindParam(':newName', $newName, PDO::PARAM_STR);
      $preparedStmt->bindParam(':itemID', $itemID, PDO::PARAM_INT);
      $preparedStmt->execute();
      
      if ($preparedStmt->execute()) {
        return true;
      } else {
          return false;
      }
    }

    static function editImage(PDO $db, Item $item, int $newImageID) : bool {
      $itemID = $item->itemID;
      if($item->imageID == $newImageID) return false;
      $preparedStmt = $db->prepare("UPDATE Item SET imageID = :newImageID WHERE itemID = :itemID");
      $preparedStmt->bindParam(':newImageID', $newImageID, PDO::PARAM_STR);
      $preparedStmt->bindParam(':itemID', $itemID, PDO::PARAM_INT);
      $preparedStmt->execute();
      
      if ($preparedStmt->execute()) {
        return true;
      } else {
          return false;
      }
    }

    static function editCategory(PDO $db, Item $item, int $newCategoryID) : bool {
      $itemID = $item->itemID;
      if($item->categoryID == $newCategoryID) return false;
      $preparedStmt = $db->prepare("UPDATE Item SET categoryID = :newCategoryID WHERE itemID = :itemID");
      $preparedStmt->bindParam(':newCategoryID', $newCategoryID, PDO::PARAM_STR);
      $preparedStmt->bindParam(':itemID', $itemID, PDO::PARAM_INT);
      $preparedStmt->execute();
      
      if ($preparedStmt->execute()) {
        return true;
      } else {
          return false;
      }
    }

    static function editCondition(PDO $db, Item $item, int $newConditionID) : bool {
      $itemID = $item->itemID;
      if($item->conditionID == $newConditionID) return false;
      $preparedStmt = $db->prepare("UPDATE Item SET conditionID = :newConditionID WHERE itemID = :itemID");
      $preparedStmt->bindParam(':newConditionID', $newConditionID, PDO::PARAM_STR);
      $preparedStmt->bindParam(':itemID', $itemID, PDO::PARAM_INT);
      $preparedStmt->execute();
      
      if ($preparedStmt->execute()) {
        return true;
      } else {
          return false;
      }
    }

    static function editSize(PDO $db, Item $item, int $newSizeID) : bool {
      $itemID = $item->itemID;
      if($item->sizeID == $newSizeID) return false;
      $preparedStmt = $db->prepare("UPDATE Item SET sizeID = :newSizeID WHERE itemID = :itemID");
      $preparedStmt->bindParam(':newSizeID', $newSizeID, PDO::PARAM_STR);
      $preparedStmt->bindParam(':itemID', $itemID, PDO::PARAM_INT);
      $preparedStmt->execute();
      
      if ($preparedStmt->execute()) {
        return true;
      } else {
          return false;
      }
    }

    static function editPrice(PDO $db, Item $item, float $newPrice) : bool {
      $itemID = $item->itemID;
      if($item->price == $newPrice) return false;
      $preparedStmt = $db->prepare("UPDATE Item SET price = :newPrice WHERE itemID = :itemID");
      $preparedStmt->bindParam(':newPrice', $newPrice, PDO::PARAM_STR);
      $preparedStmt->bindParam(':itemID', $itemID, PDO::PARAM_INT);
      $preparedStmt->execute();
      
      if ($preparedStmt->execute()) {
        return true;
      } else {
          return false;
      }
    }

    static function editBrand(PDO $db, Item $item, string $newBrand) : bool {
      $itemID = $item->itemID;
      if($item->brand == $brand) return false;
      $preparedStmt = $db->prepare("UPDATE Item SET brand = :newBrand WHERE itemID = :itemID");
      $preparedStmt->bindParam(':newBrand', $newBrand, PDO::PARAM_STR);
      $preparedStmt->bindParam(':itemID', $itemID, PDO::PARAM_INT);
      $preparedStmt->execute();
      
      if ($preparedStmt->execute()) {
        return true;
      } else {
          return false;
      }
    }

    static function editModel(PDO $db, Item $item, string $newModel) : bool {
      $itemID = $item->itemID;
      if($item->model == $newModel) return false;
      $preparedStmt = $db->prepare("UPDATE Item SET model = :newModel WHERE itemID = :itemID");
      $preparedStmt->bindParam(':newModel', $newModel, PDO::PARAM_STR);
      $preparedStmt->bindParam(':itemID', $itemID, PDO::PARAM_INT);
      $preparedStmt->execute();
      
      if ($preparedStmt->execute()) {
        return true;
      } else {
          return false;
      }
    }

    static function editDescription(PDO $db, Item $item, string $newDescription) : bool {
      $itemID = $item->itemID;
      if($item->description == $description) return false;
      $preparedStmt = $db->prepare("UPDATE Item SET description = :newDescription WHERE itemID = :itemID");
      $preparedStmt->bindParam(':newDescription', $newDescription, PDO::PARAM_STR);
      $preparedStmt->bindParam(':itemID', $itemID, PDO::PARAM_INT);
      $preparedStmt->execute();
      
      if ($preparedStmt->execute()) {
        return true;
      } else {
          return false;
      }
    }


    /*--Remove--*/
    
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