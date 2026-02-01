<?php

  if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(!filter_var($_POST['newsletter-email'], FILTER_VALIDATE_EMAIL)){
      session_start();
      $_SESSION['invalid-email'] = true;
      header("Location: newsletter.php");
      exit();
    }

    $subscriber_email = filter_var($_POST['newsletter-email'], FILTER_VALIDATE_EMAIL);

    include_once("./includes/db_connect.php");
    $sql = "INSERT INTO subscribers (subscriber_email) VALUES (?)";
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, "s", $subscriber_email);

    try{
      if(mysqli_stmt_execute($stmt)){
        session_start();
        $_SESSION['subscribed'] = true;
        header("Location: newsletter.php");
        exit();
      }
    } catch(mysqli_sql_exception){
        session_start();
        $_SESSION['duplicate'] = true;
        header("Location: newsletter.php");
        exit();
    }

  }

?>