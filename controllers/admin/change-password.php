<?php
    session_start();
    require_once("Admin.php");
    require_once("../functions.php");

    $user = $_SESSION['admin'];
    $current_password=validate($_POST['current_password']);
    $password=validate($_POST['password']);
    $password_confirmation=validate($_POST['password_confirmation']);

    if(empty($current_password) || empty($password) || empty($password_confirmation)){
        echo 'All fields are required';
    }
    elseif($password!=$password_confirmation){
        echo 'Password confirmation does not match';
    }
    else
    {
        if($_SERVER['REQUEST_METHOD']=='POST'):
            if(empty($_POST['_token']) || $_POST['_token']!=$_SESSION['_token']):
                echo ('Invalid CSRF token');
            else:
                $admin = new Admin;
                echo $admin->changePassword($user['id'], $current_password, $password);
            endif;
        endif;
    }

       

?>