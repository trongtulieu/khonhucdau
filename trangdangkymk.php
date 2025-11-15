  <?php
         session_start();
        include('ketnoi.php');
  ?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Đăng ký | Shopee Việt Nam</title>
  <style>
 * { margin: 0; padding: 0; box-sizing: border-box; font-family: Arial, sans-serif; }
    body { background-color: #f5f5f5}
    .header { background-color: #fff; padding: 10px 30px; display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid #ddd; }
    .header img { height: 60px; }
    .main { background-color: #d0011b; min-height: 450px; display: flex; justify-content: center; align-items: center; }
    /* Reset & cơ bản */
    * {
      box-sizing: border-box;
    }
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #fff;
      color: #333;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }
    a {
      color: #ee4d2d;
      text-decoration: none;
    }
    /* Container chính */
    main {
      flex-grow: 1;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 40px 15px;
    }
    /* Thanh tiến trình 3 bước */
    .progress-bar {
      display: flex;
      justify-content: center;
      gap: 40px;
      margin-bottom: 40px;
      font-size: 13px;
      user-select: none;
    }
    .progress-step {
      display: flex;
      align-items: center;
      gap: 8px;
      cursor: default;
      position: relative;
    }
    .progress-step .circle {
      width: 26px;
      height: 26px;
      border-radius: 50%;
      border: 2px solid #ccc;
      color: #ccc;
      font-weight: bold;
      text-align: center;
      line-height: 22px;
      background: #fff;
      transition: all 0.3s;
      flex-shrink: 0;
    }
    .progress-step.active .circle {
      border-color: #38b000;
      background-color: #38b000;
      color: #fff;
    }
    .progress-step.done .circle {
      border-color: #38b000;
      background-color: #38b000;
      color: #fff;
    }
    .progress-step.active .label,
    .progress-step.done .label {
      color: #38b000;
    }
    .progress-step .label {
      white-space: nowrap;
      color: #aaa;
    }
    /* Mũi tên giữa các bước */
    .progress-step:not(:last-child)::after {
      content: '';
      position: absolute;
      right: -28px;
      top: 50%;
      transform: translateY(-50%);
      width: 25px;
      height: 2px;
      background-color: #ccc;
      border-radius: 1px;
      z-index: 0;
    }
    .progress-step.done:not(:last-child)::after,
    .progress-step.active:not(:last-child)::after {
      background-color: #38b000;
    }
    /* Card đăng ký mật khẩu */
    .card {
      width: 380px;
      background: #fff;
      box-shadow: 0 4px 14px rgb(0 0 0 / 0.1);
      border-radius: 6px;
      padding: 25px 35px 35px;
      box-sizing: border-box;
    }
    .card h1 {
      font-weight: 600;
      font-size: 20px;
      margin-bottom: 6px;
      display: flex;
      align-items: center;
      gap: 8px;
      cursor: pointer;
      user-select: none;
    }
    .card h1 svg {
      width: 18px;
      height: 18px;
      fill: #ee4d2d;
      transition: transform 0.3s;
    }
    .card h1:hover svg {
      transform: translateX(-3px);
    }
    .card p.desc {
      margin-top: 0;
      color: #666;
      font-size: 13px;
      line-height: 1.4;
      margin-bottom: 20px;
      font-weight: 400;
    }
    /* Form input mật khẩu */
    .input-group {
      position: relative;
      margin-bottom: 24px;
    }
    .input-group input {
      width: 100%;
      padding: 10px 40px 10px 12px;
      font-size: 14px;
      border: 1.5px solid #ccc;
      border-radius: 4px;
      outline: none;
      transition: border-color 0.25s;
    }
    .input-group input:focus {
      border-color: #ee4d2d;
      box-shadow: 0 0 6px rgb(238 77 45 / 0.3);
    }
    /* Icon mắt hiện/ẩn */
    .input-group .toggle-password {
      position: absolute;
      right: 12px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
      user-select: none;
      width: 20px;
      height: 20px;
      fill: #999;
      transition: fill 0.2s;
    }
    .input-group .toggle-password:hover {
      fill: #ee4d2d;
    }
    /* Hướng dẫn yêu cầu mật khẩu */
    .password-rules {
      font-size: 12px;
      color: #999;
      line-height: 1.4;
      margin-top: -14px;
      margin-left: 6px;
      white-space: pre-line;
      user-select: none;
    }
    /* Nút Đăng ký */
    button.submit-btn {
      width: 100%;
      background-color: #ee4d2d;
      border: none;
      padding: 12px 0;
      font-size: 16px;
      font-weight: 600;
      color: white;
      border-radius: 4px;
      cursor: pointer;
      transition: background-color 0.25s;
    }
    button.submit-btn:hover:not(:disabled) {
      background-color: #d73211;
    }
    button.submit-btn:disabled {
      background-color: #f9a192;
      cursor: not-allowed;
    }
    /* Footer đơn giản */
    footer {
      margin-top: 40px;
      padding: 30px 15px;
      font-size: 11px;
      color: #666;
      text-align: center;
      border-top: 1px solid #eee;
    }
    /*màu của mk*/
  .rule {
      color: #999;
      font-size: 12px;
      margin: 3px 0;
      user-select: none;
      transition: color 0.3s;
}
.rule.valid {
  color: #38b000; /* màu xanh khi đúng */
}
.rule.invalid {
  color: #e03e2f; /* màu đỏ khi sai */
}
    /* Responsive */
    @media(max-width: 450px) {
      .card {
        width: 100%;
        padding: 20px;
      }
    }
  </style>
</head>
<body>
  <div class="header">
    <img width="60" src="https://img.icons8.com/color/70/shopee.png" alt="shopee"/> 
    <a href="#" style="color: #ee4d2d; text-decoration: none; position: fixed; left: 90px; "><h3> Shopee </h3> </a> 
    <a href="#" style="color: #040001ff; text-decoration: none; position: fixed; left: 170px;"><p> Đăng ký </p></a> 
    <a href="#" style="color: #d0011b; text-decoration: none;">Bạn cần giúp đỡ?</a> 
  </div>
<main>
  <!-- Thanh tiến trình -->
  <div class="progress-bar" aria-label="Progress bar đăng ký">
    <div class="progress-step done" aria-current="step">
      <div class="circle">1</div>
      <div class="label">Xác minh số điện thoại</div>
    </div>
    <div class="progress-step active">
      <div class="circle">2</div>
      <div class="label">Tạo mật khẩu</div>
    </div>
    <div class="progress-step">
      <div class="circle">3</div>
      <div class="label">Hoàn thành</div>
    </div>
  </div>
  
  <!-- Card đăng ký mật khẩu -->
  <div class="card" role="region" aria-labelledby="card-title" aria-describedby="card-desc">
    <h1 id="card-title" tabindex="0" aria-label="Quay lại">
      <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
        <path d="M15.41 16.59L10.83 12l4.58-4.59L14 6l-6 6 6 6z"/>
      </svg>
      Thiết Lập Mật Khẩu
    </h1>
    <p id="card-desc" class="desc">Bước cuối! Thiết lập mật khẩu để hoàn tất việc đăng ký.</p>

    <form id="passwordForm" novalidate>
      <div class="input-group">
        <input type="password" id="password" placeholder="Mật khẩu" aria-describedby="passwordHelp" aria-required="true" required />
        <svg class="toggle-password" id="togglePassword" viewBox="0 0 24 24" aria-label="Hiện mật khẩu" role="button" tabindex="0">
          <path d="M12 6a9 9 0 0 1 9 6 9 9 0 0 1-18 0 9 9 0 0 1 9-6m0-2A11 11 0 0 0 1 12a11 11 0 0 0 22 0 11 11 0 0 0-11-8zM12 9a3 3 0 1 1 0 6 3 3 0 0 1 0-6z" />
        </svg>
      </div>

      <div id="passwordHelp" class="password-rules">
  <div id="rule-lower" class="rule invalid">• Ít nhất một ký tự viết thường</div>
  <div id="rule-upper" class="rule invalid">• Ít nhất một ký tự viết hoa</div>
  <div id="rule-number" class="rule invalid">• Ít nhất một chữ số</div>
  <div id="rule-special" class="rule invalid">• Ít nhất một ký tự đặc biệt (!@#$%^&*)</div>
  <div id="rule-length" class="rule invalid">• Độ dài 8-16 ký tự</div>
  <div id="rule-charset" class="rule invalid">• Chỉ sử dụng chữ cái, số và ký tự phổ biến</div>
</div>

      <button type="submit" class="submit-btn" disabled>ĐĂNG KÝ</button>
    </form>
  </div>
</main>

<footer>
  <?php
include ('footer.php');
?>
  &copy; 2025 Shopee. Tất cả các quyền được bảo lưu.
</footer>

<script>
  (function() {
  const pwdInput = document.getElementById('password');
  const togglePwdBtn = document.getElementById('togglePassword');
  const submitBtn = document.querySelector('.submit-btn');
  const form = document.getElementById('passwordForm');

  // Các phần tử hiển thị trạng thái từng rule
  const rules = {
    lower: document.getElementById('rule-lower'),
    upper: document.getElementById('rule-upper'),
    number: document.getElementById('rule-number'),
    special: document.getElementById('rule-special'),
    length: document.getElementById('rule-length'),
    charset: document.getElementById('rule-charset'),
  };

  // Toggle hiện/ẩn mật khẩu
  togglePwdBtn.addEventListener('click', () => {
    if(pwdInput.type === 'password') {
      pwdInput.type = 'text';
      togglePwdBtn.setAttribute('aria-label', 'Ẩn mật khẩu');
    } else {
      pwdInput.type = 'password';
      togglePwdBtn.setAttribute('aria-label', 'Hiện mật khẩu');
    }
  });
  togglePwdBtn.addEventListener('keydown', e => {
    if(e.key === 'Enter' || e.key === ' ') {
      e.preventDefault();
      togglePwdBtn.click();
    }
  });

  // Hàm kiểm tra password và cập nhật trạng thái cho từng rule
  function validatePassword(value) {
    const checks = {
      lower: /[a-z]/.test(value),
      upper: /[A-Z]/.test(value),
      number: /[0-9]/.test(value),
      special: /[!@#$%^&*]/.test(value),
      length: value.length >=8 && value.length <=16,
      charset: /^[A-Za-z0-9!@#$%^&*]*$/.test(value)
    };

    // Cập nhật trạng thái hiển thị từng rule
    for (const key in checks) {
      if (checks[key]) {
        rules[key].classList.add('valid');
        rules[key].classList.remove('invalid');
      } else {
        rules[key].classList.add('invalid');
        rules[key].classList.remove('valid');
      }
    }

    return Object.values(checks).every(Boolean);
  }

  // Sự kiện nhập input
  pwdInput.addEventListener('input', () => {
    const valid = validatePassword(pwdInput.value);
    submitBtn.disabled = !valid;
  });

  // Xử lý submit form
  form.addEventListener('submit', e => {
    e.preventDefault();
    if(validatePassword(pwdInput.value)) {
      alert('Đăng ký mật khẩu thành công! 🎉');
      // Xử lý tiếp như gửi dữ liệu,...
    } else {
      alert('Mật khẩu chưa đáp ứng đủ yêu cầu.');
    }
  });
})();

</script>
</body>
</html>
