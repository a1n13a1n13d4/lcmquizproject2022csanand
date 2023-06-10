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

$sql = "SELECT * FROM questions ORDER BY RAND() LIMIT 15";
$condition = $conn->query($sql);

if ($condition->num_rows > 0) {
  $questions = array();
  while($row = $condition->fetch_assoc()) {
    $questions[] = $row;
  }
} else {
  echo "conditions failed!!!";
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Quiz</title>
    <div class="ab">
	<img src="IMG_20230214_083052.png" width=85 alt="Logo"  style="float: left;">
	<img src="logo_of_college2-removebg-preview (1).png" width=85 alt="logo" style="float:right;">
<a href="loyola video.mp4"><h1>LOYOLA COLLEGE,METTALA</h1></a><br>
<b><h2>CENTRAL LIBRARY</h2></b>
<hr>
    </div>
  <style>
.ab{
    background:lightyellow;
    color:black;
}   
h1{
	width: 90%;
	margin: 0 10px 0 10px;
	text-align: center;        
	word-spacing: 0.5em;
  color:black;		                
}
h2{
    width: 90%;   	
    margin: 0 10px 0 10px;    	
    text-align: center;    	
    word-spacing: 0.5em;     	
    font-family: TimesNewRoman;		
}
body {
  font-family: Arial, sans-serif;
  background-color: white;
  margin: 0;
  padding: 0;
  background-image: url('lcm logo.png');
}
#all{
  max-width: 700px;
  margin: 20px auto;
  padding: 20px;
  background-color: #fff;
  border-radius: 5px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);	
}
#timer {
  font-size: 18px;
  font-weight: bold;
  color: red;
  text-align: center;
  margin-top: 20px;
}

#Timewords {
  font-size: 18px;
  font-weight: bold;
  color: white;
  text-align: center;
  margin-top: 20px;
}
#Timing{
	background-color:black;
}
form {
  margin-top: 20px;
}

button {
  padding: 10px;
  margin-top: 10px;
  background-color: #4CAF50;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

button:hover {
  background-color: #3e8e41;
}

label {
  margin-left: 5px;
}

input[type="radio"] {
  margin-right: 5px;
}
  </style>
</head>
<body>
  <div id="all">
  <div id="Timing">
  <div id="Timewords">
  <label>Time Remaining:</label></div><div id="timer">30</div></div>
  <div id="question-container"></div></div>
  <script>
    const questions = <?php echo json_encode($questions); ?>;
    let currentQuestionIndex = 0;
    let score = 0;
    let timerId = null;
    
    function startTimer() {
      let seconds = 30;
      document.getElementById("timer").textContent = seconds;
      timerId = setInterval(() => {
        seconds--;
        document.getElementById("timer").textContent = seconds;
        if (seconds <= 0) {
          clearInterval(timerId);
          showNextQuestion();
        }
      }, 1000);
    }
    
    function showNextQuestion() {
      clearInterval(timerId);
      const questionContainer = document.getElementById("question-container");
      const currentQuestion = questions[currentQuestionIndex];
      if (!currentQuestion) {
        questionContainer.innerHTML = `<p>Your score is ${score}/15</p>`;
        return;
      }
      const options = [
        currentQuestion.option1,
        currentQuestion.option2,
        currentQuestion.option3,
        currentQuestion.option4,
      ];
      const optionHtml = options.map(option => `
        <input type="radio" name="answer" value="${option}">
        <label>${option}</label><br>
      `).join("");
      questionContainer.innerHTML = `
        <p>Question ${currentQuestionIndex + 1}: ${currentQuestion.question}</p>
        <form onsubmit="return submitAnswer(event)">
          ${optionHtml}
          <button type="submit">Submit</button>
        </form>
      `;
      currentQuestionIndex++;
      startTimer();
    }
    
    function submitAnswer(event) {
      event.preventDefault();
      const selectedOption = document.querySelector("input[name=answer]:checked");
      if (!selectedOption) {
        return alert("Please select an option.");
      }
      const answer = selectedOption.value;
      const currentQuestion = questions[currentQuestionIndex - 1];
      if (answer === currentQuestion.answer) {
        score++;
      }
      showNextQuestion();
    }
    
    showNextQuestion();
  </script>
</body>
</html>

<?php
$conn->close();
?>