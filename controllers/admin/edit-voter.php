<?php
    session_start();
    require_once("Voter.php");
    require_once("../functions.php");

    $voter_id=validate($_POST['voter_id']);
    $fullname=validate($_POST['fullname']);
    $gender=validate($_POST['gender']);
    $form=validate($_POST['form']);
    $house=validate($_POST['house']);

    if(empty($voter_id) || empty($gender) || empty($fullname) || empty($form) || empty($house)){
        echo 'All fields are required';
    }
    else
    {
        if($_SERVER['REQUEST_METHOD']=='POST'):
            if(empty($_POST['_token']) || $_POST['_token']!=$_SESSION['_token']):
                echo ('Invalid CSRF token');
            else:
                $voter = new Voter;
                echo $voter->updateVoter($voter_id, $fullname, $gender, $form, $house);
            endif;
        endif;
    }

       

?>