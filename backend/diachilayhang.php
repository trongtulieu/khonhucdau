<?php
include '../frontend/ketnoi.php';

// Lấy dữ liệu POST và trim
$hoten = trim($_POST['fullName'] ?? '');
$sodienthoai = trim($_POST['phoneNumber'] ?? '');
$diachichitiet = trim($_POST['detailedAddress'] ?? '');

// Validate cơ bản
if (!$hoten || !$sodienthoai || !$diachichitiet) {
    echo json_encode(['status'=>'error','message'=>'Vui lòng điền đầy đủ thông tin']); exit;
}

// Validate số điện thoại Việt Nam (bắt đầu 0, 10-11 số)
if(!preg_match('/^0\d{9,10}$/', $sodienthoai)){
    echo json_encode(['status'=>'error','message'=>'Số điện thoại không hợp lệ']); exit;
}

// Prepare statement
$stmt = $connect->prepare("INSERT INTO diachilayhang (hoten,sodienthoai,diachichitiet) VALUES (?,?,?)");

if (!$stmt) {
    echo json_encode(['status'=>'error','message'=>'Prepare thất bại: '.$connect->error]); exit;
}

$stmt->bind_param("sss", $hoten, $sodienthoai, $diachichitiet);

// Execute
if ($stmt->execute()) {
    echo json_encode(['status'=>'success','message'=>'Địa chỉ đã được lưu']);
} else {
    echo json_encode(['status'=>'error','message'=>'Lưu thất bại: '.$stmt->error]);
}
?>
