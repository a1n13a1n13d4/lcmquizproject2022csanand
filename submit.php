<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "question";
$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['subjectcode']))
$subjectcode = $_POST['subjectcode'];
if(isset($_POST['subjectname']))
$subjectname = $_POST['subjectname'];
$subjectcode='';
$subjectname='';

$sql1 = "SELECT COUNT(*) FROM questions";
$result1 = $conn->query($sql1);

if ($result1->num_rows > 0) {
  $row1 = $result1->fetch_assoc();
  $question_count = $row1["COUNT(*)"];
} else {
  $question_count = 0;
}

for ($i = 1; $i <= 25; $i++) {
  $question = [
    "id" => $question_count + $i,
    "question" => $_POST["q{$i}"],
    "option1" => isset($_POST["q{$i}1"]),
    "option2" => isset($_POST["q{$i}2"]),
    "option3" => isset($_POST["q{$i}3"]),
    "option4" => isset($_POST["q{$i}4"]),
    "answer" => $_POST["a{$i}"],
    "picture" => isset($_FILES["image{$i}"]["name"])
  ];

  $target_dir = "uploads/";
  $target_file = $target_dir . basename(isset($_FILES["image{$i}"]["name"]));
  /*move_uploaded_file(isset($_FILES["image{$i}"]["tmp_name"], $target_file));*/

  $sql2 = "INSERT INTO questions (id, subjectcode, subjectname, question, option1, option2, option3, option4, answer, picture) VALUES ('{$question['id']}', '$subjectcode', '$subjectname', '{$question['question']}', '{$question['option1']}', '{$question['option2']}', '{$question['option3']}', '{$question['option4']}', '{$question['answer']}', '{$question['picture']}')";

  if (mysqli_query($conn, $sql2)) {
    echo "Question {$i} stored successfully<br>";
  } else {
    echo "Error: " . $sql2 . "<br>" . mysqli_error($conn);
  }
}

$conn->close();
?>
