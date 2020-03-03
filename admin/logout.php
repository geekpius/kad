<?php
 session_start();
 if (isset($_SESSION['admin'])){

     unset($_SESSION['admin']);
     if (isset($_COOKIE[session_name()])){
    setcookie(session_name(), '', time()-42000, '/');
   }
   session_destroy();
 }


 header("Location: ./");

?>