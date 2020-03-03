<?php
session_start();

$uploaddir = '../../assets/images/candidates/';
$file = $uploaddir ."cand_".basename($_FILES['photo']['name']);
$file_name= 'cand_'.$_FILES['photo']['name'];

    if (move_uploaded_file($_FILES['photo']['tmp_name'], $file)) {
        $_SESSION['image']=$file_name;
        echo $file_name;
    } else {
	    echo "error";
    }

?>