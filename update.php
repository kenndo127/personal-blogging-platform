<?php
require_once("admin-verify.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){
  include("./includes/db_connect.php");
  include("./includes/functions.php");
  
  $post_id = $_POST['id'];
  $title = $_POST['title'];
  $slug = create_slug($title);
  $img_src = $_POST['img-src'];
  $content = $_POST['content'];

  $file_name = $_FILES['image']['name']; 
  $file_name = str_replace(" ", "_", $file_name);
  $file_tmp_name = $_FILES['image']['tmp_name'];
  $file_destination = 'uploads/' . $file_name; 

  if($_FILES['image']['error'] === UPLOAD_ERR_NO_FILE){
      $file_destination = $_POST['previous-image'];
  } else {
    //Ensuring user uploads only valid Image
    if($_FILES['image']['error'] === 0){
      $finfo = finfo_open(FILEINFO_MIME_TYPE);
      $mime_type = finfo_file($finfo, $file_tmp_name);
      
      $file_types = ["image/jpeg", "image/png", "image/gif", "image/webp"];

      if(in_array($mime_type, $file_types)){
        $image_info = getimagesize($file_tmp_name);

        if($image_info !== false){
          move_uploaded_file($file_tmp_name, $file_destination);
        } else{
          echo "There is a problem with the uploaded file.";
        }
      } else {
          echo "There is a problem with the uploaded file.";
      }
    } else {
        echo "There is a problem with the uploaded file.";
    }
  }

  $sql = "UPDATE posts SET title = ?, slug = ?, image = ?, image_source = ?, content = ? WHERE id = ?";
  $stmt = mysqli_prepare($connection, $sql);
  mysqli_stmt_bind_param($stmt, "sssssi", $title, $slug, $file_destination, $img_src, $content, $post_id);

  if(mysqli_stmt_execute($stmt)){
    session_start(); // used to create a success alert after updating
    $_SESSION['update-success'] = true;
    header("Location: all-posts.php");
    exit();
  }else {
    echo "Couldn't update blog";
  }
}
?>