<?php
   session_start();
   
   if(session_destroy()) {
   		unset($_SESSION['name']);
      	header("Location: index.php");
         exit();
   }
?>