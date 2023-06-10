<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "basic_information";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'];
$dob = $_POST['dob'];
$email = $_POST['email'];
$password = $_POST['password'];
$phone = mysqli_real_escape_string($conn, $_POST['phone']);
$address = $_POST['textarea'];
$register_number = $_POST['register_number'];
$department = $_POST['department'];
$year_of_joining = $_POST['year_of_joining'];

$sql = "INSERT INTO studentpage (name, dob, email, password, phone, address, register_number, department, year_of_joining)
VALUES ('$name', '$dob', '$email', '$password', '$phone', '$address', '$register_number', '$department', '$year_of_joining')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

