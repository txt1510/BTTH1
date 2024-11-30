<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$files = glob("*.csv");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['csv_file'])) {
    $fileName = $_POST['csv_file'];

    if (file_exists($fileName)) {
        if (($handle = fopen($fileName, "r")) !== FALSE) {
            $headers = fgetcsv($handle, 1000, ","); 

            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if (count($headers) == count($data)) {
                    $username = $data[0];
                    $password = $data[1];
                    $lastname = $data[2];
                    $firstname = $data[3];
                    $city = $data[4];
                    $email = $data[5];
                    $course = $data[6];

                    $sql = "INSERT INTO students (username, password, lastname, firstname, city, email, course)
                            VALUES ('$username', '$password', '$lastname', '$firstname', '$city', '$email', '$course')";

                    if (!$conn->query($sql)) {
                        echo "Lỗi: " . $sql . "<br>" . $conn->error;
                    }
                }
            }
            fclose($handle);
            echo "<div class='alert alert-success'>Dữ liệu từ file <strong>$fileName</strong> đã được lưu vào CSDL thành công!</div>";
        } else {
            echo "<div class='alert alert-danger'>Không thể đọc file CSV!</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>File không tồn tại!</div>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chọn File CSV Từ Server</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Chọn File CSV Từ Server</h1>
        <form action="" method="post" class="border p-4 shadow-sm">
            <div class="mb-3">
                <label for="csv_file" class="form-label">Chọn file CSV từ thư mục gốc:</label>
                <select name="csv_file" id="csv_file" class="form-select" required>
                    <option value="">-- Chọn file --</option>
                    <?php foreach ($files as $file): ?>
                        <option value="<?= htmlspecialchars($file) ?>"><?= htmlspecialchars($file) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Xử lý file</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
