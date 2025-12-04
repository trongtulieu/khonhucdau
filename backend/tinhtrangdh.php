<?php
include('../frontend/ketnoi.php');

$thongke = [
    "cho_xu_li" => 0,
    "da_hoan_thanh" => 0,
    "da_huy" => 0
];

$sqlTK = "SELECT trang_thai, COUNT(*) AS so_luong FROM donhang GROUP BY trang_thai";
$kqTK = mysqli_query($connect, $sqlTK);

while ($row = mysqli_fetch_assoc($kqTK)) {
    $thongke[$row['trang_thai']] = $row['so_luong'];
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Biểu đồ đơn hàng</title>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
/* NỀN STYLE SHOPEE */
body {
    margin: 0;
    background: #fef6f5;
    font-family: "Helvetica", Arial, sans-serif;
}

/* HEADER CAM SHOPEE */
.header {
    width: 100%;
    background: #fe6433;
    padding: 18px 0;
    color: white;
    text-align: center;
    font-size: 22px;
    font-weight: bold;
    box-shadow: 0 3px 8px rgba(0,0,0,.15);
    letter-spacing: 0.5px;
}

/* --- 3 BOX THỐNG KÊ KIỂU SHOPEE --- */
.stats-container {
    width: 90%;
    margin: 25px auto 10px;
    display: flex;
    justify-content: space-between;
    gap: 20px;
}

.stat-box {
    flex: 1;
    background: white;
    padding: 18px 20px;
    border-radius: 12px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    display: flex;
    align-items: center;
    border: 1px solid #f2f2f2;
    transition: 0.25s;
}

.stat-box:hover {
    transform: translateY(-4px);
    box-shadow: 0 6px 15px rgba(0,0,0,0.15);
}

.stat-icon {
    width: 55px;
    height: 55px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 26px;
    color: white;
    margin-right: 18px;
}

/* MÀU ICON THEO LOẠI ĐƠN */
.icon-pending { background: #ff9800; }  /* Chờ xử lý */
.icon-success { background: #4caf50; }  /* Hoàn thành */
.icon-cancel { background: #f44336; }   /* Hủy */


/* BOX TRẮNG KIỂU SHOPEE */
.chart-box {
    width: 600px;
    margin: 40px auto;
    background: #ffffff;
    padding: 25px;
    border-radius: 14px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.12);
    border: 1px solid #f2f2f2;
    transition: 0.25s;
}

.chart-box:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 16px rgba(0,0,0,.18);
}

/* TIÊU ĐỀ */
.chart-title {
    text-align: center;
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 18px;
    color: #333;
}
</style>

</head>
<body>

<!-- HEADER -->
<div class="header">
    Bảng Thống Kê Đơn Hàng
</div>

<!-- 3 BOX THỐNG KÊ -->
<div class="stats-container">

    <div class="stat-box">
        <div class="stat-icon icon-pending">⏳</div>
        <div>
            <div style="font-size:15px; color:#555;">Đơn Chờ Xử Lý</div>
            <div style="font-size:22px; font-weight:bold; color:#fe6433;">
                <?= $thongke['cho_xu_li'] ?>
            </div>
        </div>
    </div>

    <div class="stat-box">
        <div class="stat-icon icon-success">✔</div>
        <div>
            <div style="font-size:15px; color:#555;">Đơn Đã Hoàn Thành</div>
            <div style="font-size:22px; font-weight:bold; color:#4caf50;">
                <?= $thongke['da_hoan_thanh'] ?>
            </div>
        </div>
    </div>

    <div class="stat-box">
        <div class="stat-icon icon-cancel">✖</div>
        <div>
            <div style="font-size:15px; color:#555;">Đơn Đã Hủy</div>
            <div style="font-size:22px; font-weight:bold; color:#f44336;">
                <?= $thongke['da_huy'] ?>
            </div>
        </div>
    </div>

</div>

<!-- BIỂU ĐỒ -->
<div class="chart-box">
    <div class="chart-title">
        Tình trạng đơn hàng
    </div>

    <canvas id="orderChart"></canvas>
</div>

<script>
const ctx = document.getElementById('orderChart');

new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ['Chờ xử lý', 'Đã hoàn thành', 'Đã hủy'],
        datasets: [{
            data: [
                <?= $thongke['cho_xu_li'] ?>,
                <?= $thongke['da_hoan_thanh'] ?>,
                <?= $thongke['da_huy'] ?>
            ],
            backgroundColor: [
                '#ffcc80', // vàng nhạt Shopee
                '#4caf50', // xanh thành công
                '#f44336'  // đỏ hủy
            ],
            borderWidth: 2,
            borderColor: "#fff"
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    padding: 18,
                    font: { size: 14 }
                }
            }
        }
    }
});
</script>

</body>
</html>
