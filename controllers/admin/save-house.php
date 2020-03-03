<?php
    session_start();
    require_once("House.php");
    require_once("../functions.php");

    $house_name=validate($_POST['house_name']);
    $house_alias=validate($_POST['house_alias']);

    if(empty($house_name) || empty($house_alias)){
        echo 'All fields are required';
    }
    else
    {
        if($_SERVER['REQUEST_METHOD']=='POST'):
            if(empty($_POST['_token']) || $_POST['_token']!=$_SESSION['_token']):
                echo ('Invalid CSRF token');
            else:
                $house = new House;
                echo $house->saveHouse($house_name, $house_alias);
            endif;
        endif;
    }

       

?>