<?php
    session_start();
    require_once("Vote.php");
    require_once("../functions.php");
    require_once("../../models/DBLayer.php"); $positions = Model::all('positions');
    $userId = validate($_POST['voter_id']);
    $createdAt = gmdate('Y-m-d H:i');
    foreach($positions as $pos){
        $pos_name=(strpos($pos['name'],' ')!==false)? str_replace(' ','_',$pos['name']):$pos['name'];
        if(isset($_POST[$pos_name])){
            $candidate = $_POST[$pos_name];
            $vote = new Vote;
            $vote->saveVoterCart($userId, $candidate, $pos['name'],$createdAt);
        }
    }
 
    header("Location: ../../vote/preview.php");
       

?>