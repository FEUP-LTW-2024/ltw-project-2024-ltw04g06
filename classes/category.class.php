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

    static function getCategoryByName(PDO $db, string $newCategory) {
      $preparedStmt = $db->prepare('SELECT * FROM Category WHERE name = ?');
      $preparedStmt->execute(array($newCategory));
      $category = $preparedStmt->fetch();
  
      if (!$category) {
        return null;
      }
  
      return self::getCategory($db, $category['categoryID']);
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

    static function existingCategory (PDO $db, string $newCategory) : bool{
			$category = self::getCategoryByName($db, $newCategory);
			if(!$category) return false;
      else return true;
		}


    static function addCategory(PDO $db, string $name){
      if(!self::existingCategory($db, $name)){
      $preparedStmt = $db->prepare("INSERT INTO Category (name) VALUES( ?)");
      $preparedStmt -> execute([$name]);
      return true;
    }
    return false;
	}


  static function remCategory(PDO $db, string $categoryName){
    $existingCat = (self::existingCategory($db, $categoryName));

    if($existingCat == false) { return false; }

    $preparedStmt = $db->prepare("DELETE FROM Category WHERE name = ? ");
    $preparedStmt->execute([$categoryName]);
  
    return true; 
  }
}

?>