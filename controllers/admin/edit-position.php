<?php
    session_start();
    require_once("Position.php");
    require_once("../functions.php");

    $pos_id=validate($_POST['pos_id']);
    $position_name=validate($_POST['position_name']);
    $max_contestant=validate($_POST['max_contestant']);

    if(empty($position_name) || empty($max_contestant)){
        echo 'All fields are required';
    }
    else
    {
        if($_SERVER['REQUEST_METHOD']=='POST'):
            if(empty($_POST['_token']) || $_POST['_token']!=$_SESSION['_token']):
                echo ('Invalid CSRF token');
            else:
                $position = new Position;
                echo $position->updatePosition($position_name, $max_contestant, $pos_id);
            endif;
        endif;
    }

       

?>