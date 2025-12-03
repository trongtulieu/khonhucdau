<?php
session_start();
// Lấy số điện thoại đã đăng ký từ session
$phone_number = isset($_SESSION['phone_number']) ? $_SESSION['phone_number'] : '';

// Nếu không có số điện thoại trong session -> chuyển về trang chủ hoặc trang đăng ký
if (empty($phone_number)) {
    header("Location: trangchu.php");
    exit();
}

// Sau khi lấy xong có thể xóa session phone_number nếu bạn muốn tránh dùng lại
// unset($_SESSION['phone_number']);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <title>Đăng ký Shopee</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Arial&display=swap');

        /* Reset cơ bản */
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #fff;
            margin: 0; 
            padding: 0;
            color: #0c0c0c;
        }

        a {
            text-decoration: none;
            font-weight: 400;
            font-size: 13px;
            color: #ff5722;
        }
        a:hover {
            text-decoration: underline;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 56px;
            padding: 0 40px;
            border-bottom: 1px solid #f2f2f2;
            background: #fff;
            font-weight: 400;
            font-size: 14px;
            color: #0c0c0c;
        }

        header .logo {
            display: flex;
            align-items: center;
        }

        header .logo img {
            width: 24px;
            height: 24px;
            object-fit: contain;
            margin-right: 8px;
        }

        /* Steps */
        .step-container {
            margin: 40px auto 60px auto;
            max-width: 600px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 60px;
        }

        .step {
            text-align: center;
            font-weight: 600;
            font-size: 13px;
            color: #81c341;
            position: relative;
            width: 130px;
        }

        .step .circle {
            margin: 0 auto 8px auto;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background-color: #81c341;
            color: white;
            line-height: 28px;
            font-weight: 700;
            font-size: 14px;
        }

        .step.done .circle.checkmark {
            font-size: 16px;
            line-height: 28px;
        }

        /* Mũi tên */
        .step:not(:last-child)::after {
            content: "";
            position: absolute;
            top: 13px;
            right: -50px;
            width: 40px;
            height: 14px;
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="40" height="14" viewBox="0 0 40 14"><path d="M0 7h35M30 2l7 5-7 5" stroke="%2381c341" stroke-width="2" fill="none"/></svg>');
            background-repeat: no-repeat;
            background-position: center;
            background-size: contain;
        }

        /* Nội dung chính */
        .content-box {
            max-width: 335px;
            margin: 0 auto 60px auto;
            padding: 40px 30px;
            background: #fff;
            box-shadow: 0 4px 12px rgb(0 0 0 / 7%);
            border-radius: 4px;
            text-align: center;
        }

        .content-box h2 {
            font-weight: 600;
            font-size: 18px;
            margin-bottom: 24px;
            color: #0c0c0c;
        }

        .check-icon {
            width: 48px;
            height: 48px;
            border: 2px solid #81c341;
            border-radius: 50%;
            color: #81c341;
            font-size: 24px;
            line-height: 46px;
            margin: 0 auto 24px auto;
        }

        .content-box p {
            font-weight: 400;
            font-size: 14px;
            color: #0c0c0c;
            margin: 6px 0;
            line-height: 20px;
        }

        .content-box p.phone-number {
            color: #ff5722;
            font-weight: 600;
            font-size: 14px;
            margin: 6px 0 18px 0;
            white-space: nowrap;
        }

        button {
            background-color: #ff5722;
            color: white;
            border: none;
            border-radius: 2px;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            padding: 12px 0;
            width: 100%;
            margin-top: 12px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #e64a19;
        }

        footer {
            display: flex;
            justify-content: center;
            border-top: 1px solid #eee;
            background: #fafafa;
            padding: 18px 0;
            font-size: 11px;
            font-weight: 600;
            gap: 60px;
            color: #0c0c0c;
        }

        footer > div {
            cursor: default;
            user-select: none;
        }

        @media (max-width: 600px) {
            .step-container {
                gap: 30px;
                max-width: 90%;
            }

            footer {
                flex-wrap: wrap;
                gap: 30px 10px;
                font-size: 10px;
            }

            .content-box {
                max-width: 90%;
                padding: 30px 20px;
            }

            header {
                padding: 0 20px;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <img src="https://upload.wikimedia.org/wikipedia/commons/2/29/Shopee_logo.svg" alt="Shopee Logo" />
            Đăng ký
        </div>
        <a href="#">Bạn cần giúp đỡ?</a>
    </header>

    <div class="step-container">
        <div class="step done">
            <div class="circle">1</div>
            Xác minh số điện thoại
        </div>
        <div class="step done">
            <div class="circle">2</div>
            Tạo mật khẩu
        </div>
        <div class="step done">
            <div class="circle checkmark">&#10003;</div>
            Hoàn thành
        </div>
    </div>

    <div class="content-box">
        <h2>Đăng ký thành công!</h2>
        <div class="check-icon">&#10003;</div>
        <p>Bạn đã tạo thành công tài khoản Shopee với số</p>
        <p class="phone-number"><?= htmlspecialchars($phone_number) ?></p>
        <p>Bạn sẽ được chuyển hướng đến Shopee trong 3 giây</p>
        <button onclick="window.location.href='trangchu.php'">Quay lại Shopee</button>
    </div>

    <footer>
        <div>DỊCH VỤ KHÁCH HÀNG</div>
        <div>SHOPEE VIỆT NAM</div>
        <div>THANH TOÁN</div>
        <div>THEO DÕI SHOPEE</div>
        <div>TẢI ỨNG DỤNG SHOPEE</div>
    </footer>

    <script>
        setTimeout(function() {
            window.location.href = "trangchu.php";
        }, 3000);
    </script>
</body>
</html>