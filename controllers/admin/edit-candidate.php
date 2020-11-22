<?php
    session_start();
    require_once("Candidate.php");
    require_once("../functions.php");

    $can_id=validate($_POST['can_id']);
    $fullname=validate($_POST['fullname']);
    $position=validate($_POST['position']);
    $gender=validate($_POST['gender']);

    if(empty($fullname) || empty($position) || empty($gender)){
        echo 'All fields are required';
    }
    else
    {
        if($_SERVER['REQUEST_METHOD']=='POST'):
            if(empty($_POST['_token']) || $_POST['_token']!=$_SESSION['_token']):
                echo ('Invalid CSRF token');
            else:
                $cand = new Candidate;
                echo $cand->updateCandidate($fullname, $position, $gender, $can_id);
            endif;
        endif;
    }

       

?>