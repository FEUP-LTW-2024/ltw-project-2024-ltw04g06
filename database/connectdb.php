<?php

function getDatabaseConnection() : PDO {
    $db = new PDO('sqlite:' . __DIR__ . '/../database/create.db');
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (!isDatabasePopulated($db)) { // it will only populate de the db on its access
        $populate_sql = file_get_contents(__DIR__ . '/../database/populate.sql');
        $db->exec($populate_sql);
        setDatabasePopulatedFlag($db);
    }

    return $db;
}

function isDatabasePopulated(PDO $db) : bool {
    $stmt = $db->query("SELECT ConditionID FROM Condition WHERE conditionID = 1");
    $result = $stmt->fetch();
    return ($result !== false);
}

function setDatabasePopulatedFlag(PDO $db) {
    $db->exec("CREATE TABLE IF NOT EXISTS database_flags (populated INTEGER)");
    $db->exec("INSERT INTO database_flags (populated) VALUES (1)");
}

?>
