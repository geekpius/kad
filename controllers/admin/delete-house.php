<?php
    session_start();
    require_once("House.php");
    require_once("../functions.php");

    $id=validate($_POST['id']);
    
    $house = new House;
    echo $house->deleteHouse($id);

       

?>