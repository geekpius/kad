<?php
session_start();
require_once("Voter.php");

$file=$_FILES['file']['tmp_name'];

if(!empty($file)){
    $voter  = new Voter;
    echo $voter->importVoters($file);
}else{
    echo 'No file selected';
} 

?>