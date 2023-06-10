<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "basic_information"; 

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $register_number = $_POST["register_number"];
    $department = $_POST["department"];
    $year_of_joining = $_POST["year_of_joining"];
    $paper_title = $_POST["paper_title"];
    $paper_id = $_POST["paper_id"];

    $sql = "INSERT INTO exampage (name, register_number, department, year_of_joining, paper_title, paper_id) VALUES ('$name', '$register_number', '$department', '$year_of_joining', '$paper_title', '$paper_id')";

    if (mysqli_query($conn, $sql)) {
        echo "Record added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
