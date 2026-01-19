<?php
  //making admin is logged in before accessing the dashboards
session_start();

if(!(isset($_SESSION['logged-in'])) || $_SESSION['logged-in'] !== true){
  header("Location: ./login.php");
  exit();
}

?>