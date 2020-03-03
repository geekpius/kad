<?php
    session_start();
    require_once("Admin.php");
    require_once("../functions.php");

    $id=validate($_POST['id']);
    
    $admin = new Admin;
    echo $admin->deleteUser($id);

       

?>