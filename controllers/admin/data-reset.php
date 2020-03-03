<?php
    session_start();
    require_once("Setting.php");
    require_once("../functions.php");

    $type=validate($_POST['type']);

    if($_SERVER['REQUEST_METHOD']=='POST'):
        if(empty($_POST['_token']) || $_POST['_token']!=$_SESSION['_token']):
            echo ('Invalid CSRF token');
        else:
            $setting = new Setting;
            if($type=='test'){
                echo $setting->testReset();
            }else{
                echo $setting->factoryReset();
            }
        endif;
    endif;

       

?>