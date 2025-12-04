<?php
session_start();
include('../frontend/ketnoi.php');


// Lấy mã người dùng đang đăng nhập
$ma_nd = $_SESSION['MA_ND']; 

$connect = mysqli_connect("127.0.0.1", "root", "", "tmdt");
if (!$connect) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

// Hàm đếm số đơn theo trạng thái của USER
function getCount($connect, $status, $ma_nd) {
    $sql = "SELECT COUNT(*) AS total FROM donhang WHERE MA_TT = $status AND MA_ND = $ma_nd";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row["total"];
}

// Lấy số lượng từng trạng thái
$cho_xac_nhan = getCount($connect, 1, $ma_nd);
$cho_lay_hang = getCount($connect, 2, $ma_nd);
$cho_giao_hang = getCount($connect, 3, $ma_nd);
$danh_gia      = getCount($connect, 4, $ma_nd);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Đơn mua</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background: #f5f5f5;
        margin: 0;
        padding: 0;
    }

    .container {
        background: white;
        padding: 20px;
    }

    .title {
        font-size: 22px;
        font-weight: bold;
        margin-bottom: 15px;
    }

    .order-menu {
        display: flex;
        justify-content: space-around;
        text-align: center;
        padding: 15px 0;
    }

    .order-box {
        cursor: pointer;
        width: 25%;
    }

    .order-box img {
        width: 40px;
        opacity: 0.8;
    }

    .order-box p {
        margin-top: 8px;
        font-size: 15px;
    }

    /* Hover giống app */
    .order-box:hover img {
        opacity: 1;
    }
</style>
</head>
<body>

<div class="order-menu">
    <div class="order-box">
        <img src="https://cdn-icons-png.flaticon.com/512/1040/1040253.png">
        <p>Chờ xác nhận <span class="badge"><?= $cho_xac_nhan ?></span></p>
    </div>

    <div class="order-box">
        <img src="https://cdn-icons-png.flaticon.com/512/679/679720.png">
        <p>Chờ lấy hàng <span class="badge"><?= $cho_lay_hang ?></span></p>
    </div>

    <div class="order-box">
        <img src="https://cdn-icons-png.flaticon.com/512/859/859270.png">
        <p>Chờ giao hàng <span class="badge"><?= $cho_giao_hang ?></span></p>
    </div>

    <div class="order-box">
        <img src="https://cdn-icons-png.flaticon.com/512/1828/1828884.png">
        <p>Đánh giá <span class="badge"><?= $danh_gia ?></span></p>
    </div>
</div>
</body>
<script>
function refreshOrderCount() {
    fetch('ajax_order_count.php')
        .then(res => res.json())
        .then(data => {
            document.querySelector('.order-box:nth-child(1) .badge').innerText = data.cho_xac_nhan;
            document.querySelector('.order-box:nth-child(2) .badge').innerText = data.cho_lay_hang;
            document.querySelector('.order-box:nth-child(3) .badge').innerText = data.cho_giao_hang;
            document.querySelector('.order-box:nth-child(4) .badge').innerText = data.danh_gia;
        });
}

// Nếu muốn tự động refresh sau 5s:
setInterval(refreshOrderCount, 5000);
</script>
</html>