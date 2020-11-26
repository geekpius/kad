<?php
    session_start();
    require_once("Setting.php");
    require_once("../functions.php");

    $name=validate($_POST['name']);
    $position=validate($_POST['position']);
    $contestant=validate($_POST['contestant']);

    if(empty($name) ||empty($position) || empty($contestant)){
        echo 'All fields are required';
    }
    else
    {
        if($_SERVER['REQUEST_METHOD']=='POST'):
            if(empty($_POST['_token']) || $_POST['_token']!=$_SESSION['_token']):
                echo ('Invalid CSRF token');
            else:
                $setting = new Setting;
                echo $setting->config($name, $position, $contestant);
            endif;
        endif;
    }
       

?>