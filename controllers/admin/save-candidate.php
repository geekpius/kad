<?php
    session_start();
    require_once("Candidate.php");
    require_once("../functions.php");

    $fullname=validate($_POST['fullname']);
    $position=validate($_POST['position']);
    $gender=validate($_POST['gender']);
    $house=validate($_POST['house']);
    $image = $_SESSION['image'];

    if(empty($fullname) || empty($position) || empty($gender) || empty($image)){
        echo 'All fields are required';
    }
    else
    {
        if($_SERVER['REQUEST_METHOD']=='POST'):
            if(empty($_POST['_token']) || $_POST['_token']!=$_SESSION['_token']):
                echo ('Invalid CSRF token');
            else:
                $cand = new Candidate;
                echo $cand->saveCandidate($fullname, $position, $gender, $house, $image);
                unset($_SESSION['image']);
            endif;
        endif;
    }

       

?>