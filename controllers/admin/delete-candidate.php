<?php
    session_start();
    require_once("Candidate.php");
    require_once("../functions.php");

    $id=validate($_POST['id']);

    $cand = new Candidate;
    echo $cand->deleteCandidate($id);
       

?>