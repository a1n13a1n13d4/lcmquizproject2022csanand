<?php
session_start();
$host = "localhost";
$username = "root";
$password = "";
$dbname = "quiz_db";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $register_number = mysqli_real_escape_string($conn, $_POST["register_number"]);
    $department = mysqli_real_escape_string($conn, $_POST["department"]);
    $college = mysqli_real_escape_string($conn, $_POST["college"]);
    $year_of_joining = mysqli_real_escape_string($conn, $_POST["year_of_joining"]);

    $sql = "SELECT * FROM loginpage_analyse WHERE LOWER(name)=LOWER('$name') AND LOWER(register_number)=LOWER('$register_number') AND LOWER(department)=LOWER('$department') AND LOWER(college)=LOWER('$college') AND LOWER(year_of_joining)=LOWER('$year_of_joining')";

    $result = $conn->query($sql);

    if ($result === false) {
        echo "Error: " . $conn->error;
    } else {
        if ($result->num_rows > 0) {
            $_SESSION['name'] = $name; 
            header("Location: DEPARTMENT PAGE.html");
            exit();
        } else {
            echo "Did you come from another college use another login page it is for only LOYOLA COLLEGE,METTALA students.";
        }
    }
}
if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $register_number = $_POST['register_number'];
    $department = $_POST['department'];
    $college = $_POST['college'];
    $year_of_joining = $_POST['year_of_joining'];
    $redirect = $_POST['redirect'];
    
    header("Location: $redirect");
    exit();
}
$conn->close();
?>
