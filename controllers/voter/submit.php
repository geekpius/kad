<?php
    session_start();
    require_once("Vote.php");
    require_once("../functions.php");

    $userId=validate($_POST['voter_id']);
    $createdAt=gmdate('Y-m-d H:i');

    if($_SERVER['REQUEST_METHOD']=='POST'):
        if(empty($_POST['_token']) || $_POST['_token']!=$_SESSION['_token']):
            echo ('Invalid CSRF token');
        else:
            $votes = new Vote;
            $votes->submitVotes($userId, $_POST['votes'], $createdAt);
        endif;
    endif;
       

?>