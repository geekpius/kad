<?php
    session_start();
    require_once("Position.php");
    require_once("../functions.php");

    $id=validate($_POST['id']);
    
    $position = new Position;
    echo $position->deletePosition($id);

       

?>