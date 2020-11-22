<?php
    session_start();
    require_once("Position.php");
    require_once("../functions.php");

    $criteria=validate($_POST['criteria']);
    $type=validate($_POST['type']);
    $position_name=validate($_POST['position_name']);
    $max_contestant=validate($_POST['max_contestant']);

    if(empty($criteria) ||empty($type) || empty($position_name) || empty($max_contestant)){
        echo 'All fields are required';
    }
    else
    {
        if($_SERVER['REQUEST_METHOD']=='POST'):
            if(empty($_POST['_token']) || $_POST['_token']!=$_SESSION['_token']):
                echo ('Invalid CSRF token');
            else:
                $position = new Position;
                echo $position->savePosition($position_name, $criteria, $type, $max_contestant);
            endif;
        endif;
    }

       

?>