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

    static function addSize(PDO $db, int $sizeID, string $name) {
        $preparedStmt = $db->prepare("INSERT INTO Size (sizeID, name) VALUES(?, ?)");
        $preparedStmt->execute([$sizeID, $name]);
    }
}

?>
