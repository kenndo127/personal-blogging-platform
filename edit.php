<?php
require_once("admin-verify.php");

if (!(isset($_GET['id'])) || !(is_numeric($_GET['id']))) {
  header("Location: all-posts.php");
  exit();
}
include("./db_connect.php");
$post_id = (int) $_GET['id'];

$sql = "SELECT * FROM posts WHERE id = ?";
$stmt = mysqli_prepare($connection, $sql);
mysqli_stmt_bind_param($stmt, "i", $post_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$row = mysqli_fetch_assoc($result);
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
  <nav style="display: none;"></nav>

  <!-- Main section -->
  <main style="margin: 0;">
    <div class="main-nav">
      <h2>Edit your post here!</h2>
    </div>

    <!-- title, date, image, image-source, news -->

    <div class="new-post">
      <div class="container">

        <form id="postForm" action="posts.php" method="post" enctype="multipart/form-data">

          <div class="mb-4">
            <label for="Blog Title" class="form-label">Edit Title</label>
            <input type="text" class="form-control" id="blog-title" name="title" placeholder="This is the title of the blog ... " value="<?php echo $row['title'] ?>">
          </div>

          <div class="row">
            <div class="col-lg-6 col-sm-6">
              <div class="mb-4">
                <label for="formFile" class="form-label">Edit your blog Image</label>
                <input class="form-control" name="image" type="file" id="formFile" value="<?php echo $row['image'] ?>">
              </div>
            </div>

            <div class="col-lg-6 col-sm-6">
              <div class="mb-4">
                <label for="Image Source" class="form-label">Edit Image Source</label>
                <input type="text" class="form-control" id="image-source" name="img-src" value=<?php echo $row['image_source'] ?>>
              </div>
            </div>
          </div>

          <!-- Quill editor -->
          <div id="editor">
            <?php echo $row['content'] ?>
          </div>

          <!-- Hidden input that will be sent to backend -->
          <input type="hidden" name="content" id="content">

          <button type="submit" name="publish">Update</button>

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