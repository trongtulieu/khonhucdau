<?php
// Xử lý chuyển trang theo biến step
$step = isset($_GET['step']) ? $_GET['step'] : 'start';
?>

<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8" />
<title>Đăng ký người bán Shopee</title>
<style>
  /* Reset và cơ bản */
  * {
    box-sizing: border-box;
  }
  body {
    font-family: Arial, sans-serif;
    background-color: #f5f5f5;
    margin: 0;
    padding: 0;
  }
  /* Header */
  header {
    height: 56px;
    background: #fff;
    border-bottom: 1px solid #eee;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 24px;
    font-size: 16px;
    color: #333;
  }
  .logo {
    display: flex;
    align-items: center;
    font-weight: 600;
  }
  .logo img {
    height: 28px;
    margin-right: 8px;
  }
  .user {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    color: #777;
  }
  .avatar {
    width: 28px;
    height: 28px;
    background: #ddd;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 16px;
  }

  /* Layout chính gồm content và cột phải */
  .layout {
    display: flex;
    max-width: 1200px;
    margin: 24px auto;
    gap: 24px;
    padding: 0 24px;
  }

  /* Content chính */
  main {
    flex: 1;
    background: #fff;
    border-radius: 6px;
    padding: 48px 64px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.1);
    text-align: center;
  }

  h3 {
    margin-bottom: 16px;
    font-weight: 600;
  }
  p {
    margin-bottom: 32px;
    color: #555;
    line-height: 1.5;
    font-size: 16px;
  }

  button {
    cursor: pointer;
    background-color: #ee4d2d;
    border: none;
    border-radius: 4px;
    padding: 12px 36px;
    color: #fff;
    font-weight: 700;
    font-size: 16px;
    transition: background-color 0.3s ease;
  }
  button:hover {
    background-color: #d44125;
  }

  img.intro-icon {
    width: 160px;
    margin-bottom: 32px;
  }

  /* Cột bên phải */
  aside.sidebar {
    width: 64px;
    display: flex;
    flex-direction: column;
    gap: 24px;
    justify-content: flex-start;
    align-items: center;
    position: fixed;
    right: 20px;
    top: 80px;
  }

  /* Icon nút */
  .sidebar button {
    background: none;
    border: none;
    cursor: pointer;
    padding: 0;
    font-size: 0;
    position: relative;
  }
  .sidebar button svg {
    width: 24px;
    height: 24px;
    fill: #ee4d2d;
  }
  /* Nút hover */
  .sidebar button:hover svg {
    fill: #c43d1e;
  }
</style>
</head>
<body>
    <?php include 'header.php'; ?>


<div class="layout">
  <main>
    <?php if ($step === 'start'): ?>
      <img
        class="intro-icon"
        src="imgdkuser.png"
        alt="Chào mừng"
      />
      <h3>Chào mừng đến với Shopee!</h3>
      <p>Vui lòng cung cấp thông tin để thành lập tài khoản người bán trên Shopee</p>
      <form method="get" action="">
        <input type="hidden" name="step" value="info" />
      </form>
    <a href="dknguoiban1.php"><button type="submit"> Bắt đầu đăng ký </button></a>
</div>
        <?php endif; ?>
    </main>
  
 
</div>

</body>
</html>