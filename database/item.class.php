<?php

declare(strict_types = 1);

  class Item {
    public int $itemID;
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

    public function __construct(int $itemID, int $sellerID, int $categoryID, int $sizeID, int $conditionID, int $statusID, float $price, string $brand, string $description, string $images) {
      $this->itemID = $itemID;
      $this->sellerID = $sellerID;
      $this->categoryID = $categoryID;
      $this->sizeID = $sizeID;
      $this->conditionID = $conditionID;
      $this->statusID = $statusID;
      $this->price = $price;
      $this->brand = $brand;
      $this->description = $description;
      $this->images = $images;
    }

    static function getItem(PDO $db, int $itemID) {
      $preparedStmt = $db->prepare( 'SELECT * FROM Item WHERE itemID = ?');
      $preparedStmt->execute(array($itemID));
      $item = $preparedStmt->fetch();
      
      if (!$item) {
        throw new Exception("User not found with ID: $itemID");
    }
      return new Item(
        $item['itemID'],
        $item['sellerID'],
        $item['categoryID'],
        $item['sizeID'],
        $item['conditionID'],
        $item['statusID'],
        $item['price'],
        $item['brand'],
        $item['description'],
        $item['images'],
      );
    }



  }

?>