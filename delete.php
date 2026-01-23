<?php
require_once("admin-verify.php");

  include("db_connect.php");
  if($_SERVER["REQUEST_METHOD"] === "POST"){
    $post_id = $_POST['post_id'];
    $image = $_POST['image'];

    $sql = "DELETE FROM posts WHERE id = ?";
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, "i", $post_id);
    $status = mysqli_stmt_execute($stmt);

    if($status){
      unlink($image); //deleting image from directory
      header("Location: all-posts.php");
      exit();
    } else {
      echo "Couldn't delete Image";
    }

  }

?>