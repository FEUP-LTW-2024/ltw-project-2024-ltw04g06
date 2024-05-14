<?php

declare(strict_types = 1);

class Size {
    public int $sizeID;
    public string $name;

    public function __construct(int $sizeID, string $name) {
        $this->sizeID = $sizeID;
        $this->name = $name;
    }

    static function getSize(PDO $db, int $sizeID): ?Size {
        $preparedStmt = $db->prepare('SELECT * FROM Size WHERE sizeID = ?');
        $preparedStmt->execute([$sizeID]);
        $sizeData = $preparedStmt->fetch();

        if (!$sizeData) {
            throw new Exception("Size not found with ID: $sizeID");
            return null;
        }

        return new Size(
            $sizeData['sizeID'],
            $sizeData['name']
        );
    }
    static function getSizeByName(PDO $db, string $newSize) {
        $preparedStmt = $db->prepare('SELECT * FROM Size WHERE name = ?');
        $preparedStmt->execute(array($newSize));
        $size = $preparedStmt->fetch();
    
        if (!$size) {
            throw new Exception("Size not found with name: $newSize");
            return null;
        }
    
        return self::getSize($db, $size['sizeID']);
      }

    static function getAllSizes(PDO $db) {
        $preparedStmt = $db->prepare('SELECT * FROM Size');
        $preparedStmt->execute();
        $sizes = [];
    
        while ($size = $preparedStmt->fetch()) {
            $sizes[] = self::getSize($db, $size['sizeID']);
        }
        return $sizes;
    }
    static function existingSize (PDO $db, string $newSize) : bool{
        $size = self::getSizeByName($db, $newSize);
        if(!$size) return false;
        else return true;
    }

    static function addSize(PDO $db, string $name) {
        if(!self::existingSize($db, $name)){
        $preparedStmt = $db->prepare("INSERT INTO Size ( name) VALUES( ?)");
        $preparedStmt->execute([ $name]);
        return true;
    }
    return false;
}
}

?>
