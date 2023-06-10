<?php
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "basic_information";

$conn = mysqli_connect($hostname, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$paper_id =  mysqli_real_escape_string($conn,$_POST['paper_id']);
$register_number =  mysqli_real_escape_string($conn, $_POST['register_number']);
$department =  mysqli_real_escape_string($conn,$_POST['department']);
$year_of_joining =  mysqli_real_escape_string($conn, $_POST['year_of_joining']);

$sql = "INSERT INTO paperallotment (paper_id, register_number, department, year_of_joining) 
        VALUES ('$paper_id', '$register_number', '$department', '$year_of_joining')";

$conn->close();
?>
