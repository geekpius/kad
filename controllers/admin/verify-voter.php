<?php
    session_start();
    require_once("Voter.php");
    require_once("../functions.php");

    $id=validate($_POST['id']);
    
    $voter = new Voter;
    echo $voter->verifyVoter($id);

       

?>