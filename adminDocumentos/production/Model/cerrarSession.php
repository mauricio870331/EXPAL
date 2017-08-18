<?php 
  session_start(); 
  unset($_SESSION['descripcion']);
  unset($_SESSION['id_utemp']);     
  unset($_SESSION['pass']); 
  unset($_SESSION['tiempo']); 
  session_destroy();
  header('Location: ../index.php');
    exit;
?>