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

    static function addCondition(PDO $db, int $conditionID, string $usage) {
        $preparedStmt = $db->prepare("INSERT INTO Condition (conditionID, usage) VALUES(?, ?)");
        $preparedStmt->execute([$conditionID, $usage]);
    }
}

?>
