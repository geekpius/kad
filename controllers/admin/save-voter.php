<?php
    session_start();
    require_once("Voter.php");
    require_once("../functions.php");

    $access_number=validate($_POST['access_number']);
    $fullname=validate($_POST['fullname']);
    $gender=validate($_POST['gender']);
    $form=validate($_POST['form']);
    $house=validate($_POST['house']);

    if(empty($access_number) || empty($gender) || empty($fullname) || empty($form) || empty($house)){
        echo 'All fields are required';
    }
    else
    {
        if($_SERVER['REQUEST_METHOD']=='POST'):
            if(empty($_POST['_token']) || $_POST['_token']!=$_SESSION['_token']):
                echo ('Invalid CSRF token');
            else:
                $voter = new Voter;
                echo $voter->saveVoter($access_number, $fullname, $gender, $form, $house);
            endif;
        endif;
    }

       

?>