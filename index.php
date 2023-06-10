<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "quiz_db";
$tbname="questions_insert";

$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

if ($_FILES['image']['error'] == UPLOAD_ERR_OK) {
  $imageData = file_get_contents($_FILES['image']['tmp_name']);
  $sql = "INSERT INTO $tbname (image) VALUES (?)";
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, 'b', $imageData);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>