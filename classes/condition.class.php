<?php

declare(strict_types = 1);

class Condition {
    public int $conditionID;
    public string $usage;

    public function __construct(int $conditionID, string $usage) {
        $this->conditionID = $conditionID;
        $this->usage = $usage;
    }

    static function getCondition(PDO $db, int $conditionID): ?Condition {
        $preparedStmt = $db->prepare('SELECT * FROM Condition WHERE conditionID = ?');
        $preparedStmt->execute([$conditionID]);
        $conditionData = $preparedStmt->fetch();

        if (!$conditionData) {
            throw new Exception("Condition not found with ID: $conditionID");
            return null;
        }

        return new Condition(
            $conditionData['conditionID'],
            $conditionData['usage']
        );
    }

    static function getConditionByName(PDO $db, string $newCondition) {
        $preparedStmt = $db->prepare('SELECT * FROM Condition WHERE usage = ?');
        $preparedStmt->execute(array($newCondition));
        $condition = $preparedStmt->fetch();
    
        if (!$condition) {
            return null;
        }
    
        return self::getCondition($db, $condition['conditionID']);
      }


    static function getAllConditions(PDO $db) {
        $preparedStmt = $db->prepare('SELECT * FROM Condition');
        $preparedStmt->execute();
        $conditions = [];
    
        while ($condition = $preparedStmt->fetch()) {
            $conditions[] = self::getCondition($db, $condition['conditionID']);
        }
        return $conditions;
      }

    static function existingCondition (PDO $db, string $newCondition) : bool{
        $condition = self::getConditionByName($db, $newCondition);
        if(!$condition) return false;
        else return true;
    }

    static function addCondition(PDO $db, string $usage) {
        if(!self::existingCondition($db,$usage)){
        $preparedStmt = $db->prepare("INSERT INTO Condition (usage) VALUES(?)");
        $preparedStmt->execute([$usage]);
        return true;
        }
        return false;
    }

    static function remCondition(PDO $db, string $conditionName){
        $existingCond = (self::existingCondition($db, $conditionName));
    
        if($existingCond == false) { return false; }
    
        $preparedStmt = $db->prepare("DELETE FROM Condition WHERE usage = ? ");
        $preparedStmt->execute([$conditionName]);
      
        return true; 
      }
}

?>
