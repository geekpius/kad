<?php

    session_start();
    if(!isset($_SESSION['voter']))
    {
        header("Location: ../");
    }
    else
    {
        $user= $_SESSION['voter'];
    }


    $_SESSION['_token']=bin2hex(openssl_random_pseudo_bytes(16));

?>