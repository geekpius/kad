<?php
    session_start();
    require_once("Setting.php");
    require_once("../functions.php");

    $name=validate($_POST['name']);
    $end_date=validate($_POST['end_date']);
    $end_time=validate($_POST['end_time']);

    if(empty($name) ||empty($end_date) || empty($end_time)){
        echo 'All fields are required';
    }
    else
    {
        if($_SERVER['REQUEST_METHOD']=='POST'):
            if(empty($_POST['_token']) || $_POST['_token']!=$_SESSION['_token']):
                echo ('Invalid CSRF token');
            else:
                $setting = new Setting;
                echo $setting->setTime($name, $end_date, $end_time);
            endif;
        endif;
    }

       

?>