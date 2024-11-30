<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];

    // Kiểm tra xem có file ảnh nào được tải lên hay không
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        // Đường dẫn lưu ảnh
        $target_dir = 'images/';
        $target_file = $target_dir . basename($_FILES['image']['name']);

        // Kiểm tra loại file (chỉ cho phép các file ảnh)
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($imageFileType, $allowed_types)) {
            die("Chỉ được tải lên các file JPG, JPEG, PNG, hoặc GIF.");
        }

        // Kiểm tra xem file có vượt quá kích thước cho phép không (5MB)
        if ($_FILES['image']['size'] > 5 * 1024 * 1024) {
            die("File tải lên không được vượt quá 5MB.");
        }

        // Di chuyển file đã tải lên vào thư mục "images"
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            // Thêm dữ liệu vào bảng
            $sql = "INSERT INTO table_flower (name, description, image) VALUES ('$name', '$description', '$target_file')";
            if ($conn->query($sql) === TRUE) {
                header("Location: index.php");
                exit;
            } else {
                echo "Lỗi: " . $conn->error;
            }
        } else {
            die("Không thể tải file lên. Vui lòng thử lại.");
        }
    } else {
        die("Vui lòng chọn một file ảnh hợp lệ.");
    }
}
?>
