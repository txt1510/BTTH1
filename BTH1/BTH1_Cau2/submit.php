<?php
include 'db.php';
$score = 0;
$total = 0;
$sql = "SELECT * FROM questions";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $question_id = $row['id'];
    $correct_answer = explode(",", $row['answer']);  
    $user_answer = isset($_POST['question_' . $question_id]) ? $_POST['question_' . $question_id] : [];  
    if (is_array($user_answer) && !array_diff($user_answer, $correct_answer) && !array_diff($correct_answer, $user_answer)) {
        $score++;
    }
    $total++;
}

echo "Bạn đã trả lời đúng $score / $total câu hỏi!";
echo "<br> <a href='index.php'><button>Làm lại</button></a>";
$conn->close();
?>
