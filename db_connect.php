<?php
//Initializing connection variables
$db_server = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "blogdb";
$connection = "";

//Proper error handling
try {
  $connection = mysqli_connect($db_server, $db_user, $db_password, $db_name);
} catch (mysqli_sql_exception) {
  echo "Could not connect to " . $db_name;
}

//global function
function create_slug($string) {
    // 1. Lowercase the string
    $slug = strtolower($string);
    // 2. Replace any non-alphanumeric characters with a hyphen
    $slug = preg_replace('/[^a-z0-9-]+/', '-', $slug);
    // 3. Remove multiple hyphens in a row and trim from ends
    $slug = preg_replace('/-+/', '-', $slug);
    return trim($slug, '-');
}