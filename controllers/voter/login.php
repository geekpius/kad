<?php
    session_start();
    require_once("Vote.php");
    require_once("../functions.php");

    $access_number=validate($_POST['access_number']);

    if(empty($access_number)){
            echo 'All fields are required';
    }else
    {
        if($_SERVER['REQUEST_METHOD']=='POST'):
            if(empty($_POST['_token']) || $_POST['_token']!=$_SESSION['_token']):
                echo ('Invalid CSRF token');
            else:
                $vote = new Vote;
                echo $vote->login($access_number);
            endif;
        endif;
    }

       

?>