<?php
  session_start();
  $_SESSION = array(); // reset array to remove previously saved values
  session_destroy(); // terminate the session
  header("Location: ./login.php"); // route back to login
  exit();
?>