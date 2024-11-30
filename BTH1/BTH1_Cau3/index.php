<?php
$filename = "KTPM3.csv";

$sinhvien = [];

if (($handle = fopen($filename, "r")) !== FALSE) {
    $headers = fgetcsv($handle, 1000, ",");
    $headers = array_map('trim', $headers);

    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        if (count($headers) == count($data)) { 
            $sinhvien[] = array_combine($headers, $data);
        }
    }
    fclose($handle);
} else {
    die("Không thể đọc được tệp CSV hoặc tệp không tồn tại!");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sinh viên</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Danh sách sinh viên</h1>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Lastname</th>
                    <th>Firstname</th>
                    <th>City</th>
                    <th>Email</th>
                    <th>Course</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($sinhvien)): ?>
                    <?php foreach ($sinhvien as $sv): ?>
                        <tr>
                            <td><?= htmlspecialchars($sv['username'] ?? 'N/A') ?></td>
                            <td><?= htmlspecialchars($sv['password'] ?? 'N/A') ?></td>
                            <td><?= htmlspecialchars($sv['lastname'] ?? 'N/A') ?></td>
                            <td><?= htmlspecialchars($sv['firstname'] ?? 'N/A') ?></td>
                            <td><?= htmlspecialchars($sv['city'] ?? 'N/A') ?></td>
                            <td><?= htmlspecialchars($sv['email'] ?? 'N/A') ?></td>
                            <td><?= htmlspecialchars($sv['course1'] ?? 'N/A') ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">Không có dữ liệu để hiển thị.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>