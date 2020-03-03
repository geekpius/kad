<?php

    session_start();
    if(!isset($_SESSION['admin']))
    {
        header("Location: ./");
    }
    else
    {
        $user= $_SESSION['admin'];
    }


    $_SESSION['_token']=bin2hex(openssl_random_pseudo_bytes(16));

?>