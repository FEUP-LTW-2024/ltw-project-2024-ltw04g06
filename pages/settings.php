<?php 
    require_once(__DIR__ . '/../templates/searchForm.php');
    require_once(__DIR__ . '/../templates/topo.php');
    require_once(__DIR__ . '/../templates/settings.php');
    require_once(__DIR__ . '/../database/connectdb.php');
    
    
    topo();
    displaySettings();

?>