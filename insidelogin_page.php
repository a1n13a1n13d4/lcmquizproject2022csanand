<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "quiz_db";

$conn = mysqli_connect($host, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$name = $_POST['name'];
$date_of_birth = $_POST['dob'];
$email = $_POST['email'];
$password = $_POST['password'];
$gender = $_POST['gender'];
$phone_number = mysqli_real_escape_string($conn, $_POST['phone']);
$district = $_POST['district'];
$studying_degree = $_POST['degree'];

$sql = "INSERT INTO loginpage_save (name, dob, email, password, gender, phone, district, degree) 
        VALUES ('$name', '$date_of_birth', '$email', '$password', '$gender', '$phone_number', '$district', '$studying_degree')";

if (mysqli_query($conn, $sql)) {
    session_start();
    $_SESSION['name'] = $name;
    header("Location: DEPARTMENT PAGE.html");
    exit;
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
