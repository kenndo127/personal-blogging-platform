<?php
require_once("admin-verify.php");

include("./includes/db_connect.php");
include("./includes/functions.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){

  //Get input from user
  $title = $_POST['title'];
  $slug = create_slug($title);
  $img_src = $_POST['img-src'];
  $content = $_POST['content'];

  //Dealing with the images
  $file_name = $_FILES['image']['name']; 
  $file_name = str_replace(" ", "_", $file_name);
  $file_tmp_name = $_FILES['image']['tmp_name'];
  $file_destination = 'uploads/' . $file_name; 

  //Ensuring user uploads only valid Image
  if($_FILES['image']['error'] === 0){
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime_type = finfo_file($finfo, $file_tmp_name);
    
    $file_types = ["image/jpeg", "image/png", "image/gif", "image/webp"];

    if(in_array($mime_type, $file_types)){
      $image_info = getimagesize($file_tmp_name);

      if($image_info !== false){
        move_uploaded_file($file_tmp_name, $file_destination);

        //Send details to database
        $sql = "INSERT INTO posts (title, slug, image, image_source, content) VALUES (?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($connection, $sql);
        mysqli_stmt_bind_param(
          $stmt,
          "sssss",
          $title,
          $slug,
          $file_destination,
          $img_src,
          $content
        );

        $query = mysqli_stmt_execute($stmt);

        if($query){
          $success = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
              You have successfully uploaded your post.
            <div type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></div>
          </div>";
        } else {
          $unsuccessful = "<div class='alert alert-error alert-dismissible fade show' role='alert'>
              Could not upload post!
            <div type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></div>
          </div>";
        }
      } else{
        $image_error = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            Only Images are allowed!
          <div type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></div>
        </div>";
      }
    } else {
        $image_error = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            Only Images are allowed!
          <div type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></div>
        </div>";      
    }
  } else {
        $image_error = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            Only Images are allowed!
          <div type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></div>
        </div>";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Posts</title>
  <link rel="icon" type="image/x-icon" href="./assets/logo.png">
</head>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

<!-- Quill Editor -->
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet">

<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Anta&family=Bai+Jamjuree:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600;1,700&family=Caveat:wght@400..700&family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&family=Micro+5&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

<!-- CSS -->
<link rel="stylesheet" href="./styles/dashboard.css">

<body>

  <!-- Side Nav -->
  <nav>
    <ul>
      <a href="dashboard-menu.php">
        <li><img src="./assets/home-icon.svg" alt="home-icon"> Dashboard</li>
      </a>

      <a href="posts.php">
        <li><img src="./assets/add-post-icon.svg" alt="add-post-icon"> Add Posts</li>
      </a>

      <a href="all-posts.php">
        <li><img src="./assets/edit-icon.svg" alt="edit-icon"> Edit</li>
      </a>

      <a href="settings.php">
        <li><img src="./assets/settings-icon.svg" alt="settings-icon"> Settings</li>
      </a>
    </ul>
  </nav>

  <!-- Main section -->
  <main>
    <div class="main-nav">
      <h2>Post a Blog Today !</h2>
      <a href="./logout.php">Logout <img src="./assets/logout-icon.svg" alt="Log out Icon"></a>
    </div>

    <!-- title, date, image, image-source, news -->

    <div class="new-post">
      <div class="container">

      <?php if(isset($image_error)) echo $image_error; ?>
      <?php if(isset($success)) echo $success; ?>
      <?php if(isset($unsuccessful)) echo $unsuccessful; ?>

        <form id="postForm" action="posts.php" method="post" enctype="multipart/form-data">

          <div class="mb-4">
            <label for="Blog Title" class="form-label">Title</label>
            <input type="text" class="form-control" id="blog-title" name="title" placeholder="This is the title of the blog ... ">
          </div>

          <div class="row">
            <div class="col-lg-6 col-sm-6">
              <div class="mb-4">
                <label for="formFile" class="form-label">Upload your blog Image</label>
                <input class="form-control" name="image" type="file" id="formFile">
              </div>
            </div>

            <div class="col-lg-6 col-sm-6">
              <div class="mb-4">
                <label for="Image Source" class="form-label">Image Source</label>
                <input type="text" class="form-control" id="image-source" name="img-src" placeholder="Enter your image source">
              </div>
            </div>
          </div>

          <!-- Quill editor -->
          <div id="editor"> </div>

          <!-- Hidden input that will be sent to backend -->
          <input type="hidden" name="content" id="content">

          <button type="submit" name="publish">Publish</button>

        </form>
      </div>
    </div>

  </main>



  <!-- bootstrap js -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

  <!-- Quill js -->
  <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>

  <script src="quillSetup.js"></script>

</body>

</html>