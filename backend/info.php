<?php
// info.php - Xử lý dữ liệu form Thông tin Người bán

// Bật chế độ hiển thị lỗi (phát triển)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Lấy dữ liệu POST
$shopName = trim($_POST['shopName'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');

// Kiểm tra các trường bắt buộc: bạn có thể mở rộng kiểm tra khác
if ($shopName === '' || $email === '') {
    // Nếu thiếu dữ liệu, quay lại trang form kèm thông báo lỗi
    // Bạn có thể dùng session hoặc GET để truyền thông báo lỗi
    // Ở ví dụ đơn giản sau đây dùng alert và quay lại
    echo "<script>
        alert('Vui lòng nhập đầy đủ thông tin, đặc biệt là tên Shop và email.');
        window.history.back();
    </script>";
    exit;
}

// Ở đây bạn có thể lưu dữ liệu vào database hoặc xử lý khác
// Ví dụ bên dưới chỉ demo lưu vào session (nếu cần)

session_start();
$_SESSION['shopName'] = $shopName;
$_SESSION['email'] = $email;
$_SESSION['phone'] = $phone;

// Chuyển hướng sang trang tiếp theo (Cài đặt vận chuyển)
header('Location: dknguoiban2.php');
exit;
?>
