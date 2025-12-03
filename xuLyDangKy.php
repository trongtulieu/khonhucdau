<?php
// Bắt đầu session
session_start();
// Kết nối database
include('ketnoi.php');

// Thiết lập charset utf8 cho hiển thị tiếng Việt
header('Content-Type: text/html; charset=UTF-8');

// Kiểm tra số điện thoại có trong session không (đã xác minh ở bước trước)
if (!isset($_SESSION['dienthoai']) || empty(trim($_SESSION['dienthoai']))) {
    echo "Lỗi: Không tìm thấy số điện thoại trong session. <a href='trangchu.php'>Quay lại trang chủ</a>";
    exit;
}
$dienthoai = trim($_SESSION['dienthoai']);

// Lấy mật khẩu từ form POST, kiểm tra hợp lệ
if (!isset($_POST['matkhau']) || empty(trim($_POST['matkhau']))) {
    echo "Vui lòng nhập mật khẩu. <a href='javascript: history.go(-1)'>Trở lại</a>";
    exit;
}
$matkhau = trim($_POST['matkhau']);

// Kiểm tra nếu số điện thoại đã tồn tại trong bảng users
$stmt = mysqli_prepare($connect, "SELECT dienthoai FROM users WHERE dienthoai = ?");
mysqli_stmt_bind_param($stmt, "s", $dienthoai);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);

if (mysqli_stmt_num_rows($stmt) > 0) {
    echo "Số điện thoại này đã tồn tại. Vui lòng kiểm tra lại. <a href='javascript: history.go(-1)'>Trở lại</a>";
    mysqli_stmt_close($stmt);
    exit;
}
mysqli_stmt_close($stmt);

// Mã hóa mật khẩu
$hashed_matkhau = password_hash($matkhau, PASSWORD_DEFAULT);

// Thêm người dùng mới vào database
$stmt2 = mysqli_prepare($connect, "INSERT INTO users (dienthoai, matkhau) VALUES (?, ?)");
mysqli_stmt_bind_param($stmt2, "ss", $dienthoai, $hashed_matkhau);
$ketqua_2 = mysqli_stmt_execute($stmt2);

if ($ketqua_2) {
    // Lưu số điện thoại vào session để hiển thị trang đăng ký thành công
    $_SESSION['phone_number'] = $dienthoai; 

    // Xóa khỏi session biến dienthoai (đã dùng)
    unset($_SESSION['dienthoai']); 

    // Đóng kết nối và chuyển hướng sang trang đăng ký thành công
    mysqli_stmt_close($stmt2);
    mysqli_close($connect);

    header("Location: trangdangkyht.php");
    exit();

} else {
    // Lỗi khi insert
    echo "<script>alert('Đăng ký thất bại: " . mysqli_error($connect) . "'); window.history.back();</script>";
    mysqli_stmt_close($stmt2);
    mysqli_close($connect);
    exit();
}
?>