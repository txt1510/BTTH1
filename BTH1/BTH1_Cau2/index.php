<?php
include 'db.php';

$sql = "SELECT * FROM questions ORDER BY question_order"; 
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Bài thi trắc nghiệm</title>
</head>
<body>
  <h1>Bài thi trắc nghiệm Android</h1>
  <form method="POST" action="submit.php">
    <?php
    if ($result->num_rows > 0) {
        $i = 1;
        while($row = $result->fetch_assoc()) {
            echo "<div>
                    <h3>Câu $i: " . $row['question'] . "</h3>
                    <input type='radio' name='question_" . $row['id'] . "[]' value='A'> " . $row['option_a'] . "<br>
                    <input type='radio' name='question_" . $row['id'] . "[]' value='B'> " . $row['option_b'] . "<br>
                    <input type='radio' name='question_" . $row['id'] . "[]' value='C'> " . $row['option_c'] . "<br>
                    <input type='radio' name='question_" . $row['id'] . "[]' value='D'> " . $row['option_d'] . "<br>
                  </div><br>";
            $i++;
        }
    } else {
        echo "Không có câu hỏi nào trong cơ sở dữ liệu.";
    }
    ?>
    <button type="submit">Nộp bài</button>
  </form>
</body>
</html>

<?php
$conn->close();
?>
