<?php
 session_start();
// session_destroy();
 unset($_SESSION['valid-user']);

 header("location:../index.php");
 
?>
