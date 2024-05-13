<?php

  declare(strict_types = 1);

	class Category {
    public int $categoryID;
    public string $name;

    public function __construct(int $categoryID, string $name) {
      $this->categoryID = $categoryID;
      $this->name = $name;
    }

    static function getCategory(PDO $db, int $categoryID) {
      $preparedStmt = $db->prepare('SELECT * FROM Category WHERE categoryID = ?');
      $preparedStmt->execute(array($categoryID));
      $category = $preparedStmt->fetch();
  
      if (!$category) {
          throw new Exception("Category not found with ID: $categoryID");
          return null;
      }
  
      return new Category(
          $category['categoryID'],
          $category['name']
      );
    }

    static function getAllCategories(PDO $db) {
      $preparedStmt = $db->prepare('SELECT * FROM Category');
      $preparedStmt->execute();
      $categories = [];
  
      while ($category = $preparedStmt->fetch()) {
          $categories[] = self::getCategory($db, $category['categoryID']);
      }
      return $categories;
    }


    static function addCategory(PDO $db, int $categoryID, string $name){
      $preparedStmt = $db->prepare("INSERT INTO Category (categoryID, name) VALUES(?, ?)");
      $preparedStmt -> execute([$categoryID, $name]);
    }


	}

?>