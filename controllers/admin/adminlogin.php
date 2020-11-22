<?php
    session_start();
    require_once("Admin.php");
    require_once("../functions.php");

    $username=validate($_POST['username']);
    $password=validate($_POST['password']);

    if(empty($username) || empty($password)){
            echo 'All fields are required';
    }else
    {
        if($_SERVER['REQUEST_METHOD']=='POST'):
            if(empty($_POST['_token']) || $_POST['_token']!=$_SESSION['_token']):
                echo ('Invalid CSRF token');
            else:
                $admin = new Admin;
                $admin->adminLogin($username, $password);
            endif;
        endif;
    }

       

?>