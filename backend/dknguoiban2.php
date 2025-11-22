<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8" />
<title>Cài đặt vận chuyển - Đăng ký Người bán Shopee</title>
<style>
  /* Reset & layout cơ bản */
  body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: #f5f5f5;
    color: #333;
  }
  header {
    height: 50px;
    display: flex;
    align-items: center;
    padding: 0 24px;
    background: white;
    border-bottom: 1px solid #eee;
    font-size: 14px;
    color: #222;
    gap: 8px;
  }
  header .logo {
    font-weight: 600;
    color: #ee4d2d;
    display: flex;
    align-items: center;
  }
  header .logo svg {
    height: 22px;
    margin-right: 6px;
  }
  header .user {
    margin-left: auto;
    display: flex;
    align-items: center;
    gap: 8px;
    color: #777;
    font-size: 14px;
  }
  header .user svg {
    width: 18px;
    height: 18px;
  }
  
  /* Container chính */
  .container {
    max-width: 960px;
    margin: 24px auto;
    background: #fff;
    padding: 32px 48px 48px;
    border-radius: 6px;
    box-shadow: 0 2px 12px rgb(0 0 0 / 0.1);
  }

  /* Thanh tiến trình */
  .progress {
    display: flex;
    justify-content: space-between;
    margin-bottom: 36px;
    user-select: none;
  }
  .progress-step {
    flex: 1;
    position: relative;
    text-align: center;
    font-size: 13px;
    color: #bbb;
  }
  .progress-step.active,
  .progress-step.completed {
    color: #ee4d2d;
    font-weight: 600;
  }
  .progress-step::after {
    content: '';
    position: absolute;
    top: 9px;
    right: 0;
    height: 2px;
    width: 100%;
    background: #eee;
    z-index: -1;
  }
  .progress-step:last-child::after {
    display: none;
  }
  .progress-step.completed::after {
    background: #ee4d2d;
  }
  .progress-step .circle {
    width: 14px;
    height: 14px;
    border-radius: 50%;
    background: #eee;
    margin: 0 auto 8px;
  }
  .progress-step.active .circle,
  .progress-step.completed .circle {
    background: #ee4d2d;
  }
  .progress-step.completed {
    color: #ee4d2d;
  }

  /* Nhóm vận chuyển */
  .shipping-group {
    margin-bottom: 24px;
    border: 1px solid #eee;
    border-radius: 4px;
    background: #fafafa;
  }
  .shipping-group-header {
    display: flex;
    justify-content: space-between;
    padding: 12px 20px;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    user-select: none;
  }
  .shipping-group-header:hover {
    background: #f0f0f0;
  }
  .toggle-button {
    border: none;
    background: none;
    cursor: pointer;
    font-size: 14px;
    color: #555;
  }

  /* Danh sách phương thức */
  .shipping-list {
    border-top: 1px solid #eee;
    padding: 12px 20px 18px 20px;
  }
  .shipping-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: white;
    padding: 12px 16px;
    margin-bottom: 8px;
    border-radius: 4px;
    font-size: 14px;
    color: #333;
    border: 1px solid #ddd;
  }
  .shipping-item:last-child {
    margin-bottom: 0;
  }
  .shipping-item .label {
    display: flex;
    align-items: center;
    gap: 6px;
  }
  .shipping-item .label .note {
    color: #f44336;
    font-size: 13px;
  }
  .toggle-switch {
    position: relative;
    width: 38px;
    height: 20px;
    display: inline-block;
  }
  .toggle-switch input {
    opacity: 0;
    width: 0;
    height: 0;
  }
  .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    border-radius: 10px;
    transition: .3s;
  }
  .slider:before {
    position: absolute;
    content: "";
    height: 16px;
    width: 16px;
    left: 2px;
    bottom: 2px;
    background-color: white;
    border-radius: 50%;
    transition: .3s;
  }
  input:checked + .slider {
    background-color: #3cb371;
  }
  input:checked + .slider:before {
    transform: translateX(18px);
  }

  /* Ghi chú thêm đơn vị vận chuyển */
  .shipping-note {
    font-size: 12px;
    color: #999;
    margin-top: 0;
    margin-left: 4px;
  }

  /* Buttons dưới cùng */
  .bottom-buttons {
    display: flex;
    justify-content: space-between;
    margin-top: 36px;
  }
  .btn-back, .btn-next {
    font-size: 14px;
    padding: 10px 28px;
    border-radius: 4px;
    cursor: pointer;
    border: none;
    min-width: 120px;
  }
  .btn-back {
    background: white;
    border: 1px solid #ddd;
    color: #333;
  }
  .btn-back:hover {
    background: #f9f9f9;
  }
  .btn-next {
    background-color: #ee4d2d;
    color: white;
    font-weight: 600;
  }
  .btn-next:hover {
    background-color: #d44125;
  }
  /* 3 icon cột phải */
  aside.sidebar {
    position: fixed;
    right: 20px;
    top: 80px;
    width: 64px;
    display: flex;
    flex-direction: column;
    gap: 24px;
    align-items: center;
  }
  aside.sidebar button {
    background: none;
    border: none;
    cursor: pointer;
    padding: 0;
  }
  aside.sidebar svg {
    width: 24px;
    height: 24px;
    fill: #ee4d2d;
  }
  aside.sidebar button:hover svg {
    fill: #c43d1e;
  }
</style>
</head>
<body>

<header>
  <div class="logo">
    <svg viewBox="0 0 24 24" fill="#ee4d2d" xmlns="http://www.w3.org/2000/svg"><path d="M20.12 1H3.88A2.88 2.88 0 0 0 1 3.88v16.24A2.88 2.88 0 0 0 3.88 23h16.24A2.88 2.88 0 0 0 23 20.12V3.88A2.88 2.88 0 0 0 20.12 1Zm-6.72 7.781 3.097 2.69-3.097 2.69V16a.754.754 0 0 1-1.056.7l-5.985-2.653c-.337-.149-.337-.602 0-.751l5.985-2.653a.754.754 0 0 1 1.056.7Zm6.16 6.662a.75.75 0 1 1 1.5 0 .75.75 0 0 1-1.5 0Z"/></svg>
    Shopee Đăng ký trở thành Người bán Shopee
  </div>
  <div class="user">
    <svg xmlns="http://www.w3.org/2000/svg" fill="#777" viewBox="0 0 24 24"><path d="M12 12a5 5 0 1 0-5-5 5 5 0 0 0 5 5zm0 2c-3.33 0-10 1.67-10 5v3h20v-3c0-3.33-6.67-5-10-5z"/></svg>
    <span>1bw3d7e77v ▼</span>
  </div>
</header>

<div class="container" role="main">
  <!-- Thanh tiến trình -->
  <nav aria-label="Tiến trình đăng ký">
    <div class="progress" aria-current="step">
      <div class="progress-step completed">
        <div class="circle" aria-hidden="true"></div>
        Thông tin Shop
      </div>
      <div class="progress-step active">
        <div class="circle" aria-hidden="true"></div>
        Cài đặt vận chuyển
      </div>
      <div class="progress-step">
        <div class="circle" aria-hidden="true"></div>
        Hoàn tất
      </div>
    </div>
  </nav>

  <!-- Các nhóm vận chuyển -->
  <section aria-label="Các phương thức vận chuyển">
    
    <div class="shipping-group" data-group="hoa-toc">
      <div class="shipping-group-header" tabindex="0" role="button" aria-expanded="true" aria-controls="list-hoa-toc">
        Hỏa Tốc
        <button class="toggle-button" aria-label="Thu gọn Hỏa Tốc">Thu gọn ∧</button>
      </div>
      <div class="shipping-list" id="list-hoa-toc">
        <div class="shipping-item">
          <div class="label">Hỏa Tốc - Trong Ngày</div>
          <label class="toggle-switch" aria-label="Bật tắt Hỏa Tốc - Trong Ngày">
            <input type="checkbox" />
            <span class="slider"></span>
          </label>
        </div>
        <div class="shipping-item">
          <div class="label">Hỏa Tốc - 4 Giờ <span class="note">[COD đã được kích hoạt]</span></div>
          <label class="toggle-switch" aria-label="Bật tắt Hỏa Tốc - 4 Giờ">
            <input type="checkbox" checked />
            <span class="slider"></span>
          </label>
        </div>
      </div>
    </div>

    <div class="shipping-group" data-group="nhanh">
      <div class="shipping-group-header" tabindex="0" role="button" aria-expanded="true" aria-controls="list-nhanh">
        Nhanh
        <button class="toggle-button" aria-label="Thu gọn Nhanh">Thu gọn ∧</button>
      </div>
      <div class="shipping-list" id="list-nhanh">
        <div class="shipping-item">
          <div class="label">Nhanh <span class="note">[COD đã được kích hoạt]</span></div>
          <label class="toggle-switch" aria-label="Bật tắt Nhanh">
            <input type="checkbox" checked />
            <span class="slider"></span>
          </label>
        </div>
      </div>
    </div>

    <div class="shipping-group" data-group="tu-nhan-hang">
      <div class="shipping-group-header" tabindex="0" role="button" aria-expanded="true" aria-controls="list-tu-nhan-hang">
        Tủ Nhận Hàng
        <button class="toggle-button" aria-label="Thu gọn Tủ Nhận Hàng">Thu gọn ∧</button>
      </div>
      <div class="shipping-list" id="list-tu-nhan-hang">
        <div class="shipping-item">
          <div class="label">Tủ Nhận Hàng</div>
          <label class="toggle-switch" aria-label="Bật tắt Tủ Nhận Hàng">
            <input type="checkbox" checked />
            <span class="slider"></span>
          </label>
        </div>
      </div>
    </div>

    <div class="shipping-group" data-group="hang-cong-kenh">
      <div class="shipping-group-header" tabindex="0" role="button" aria-expanded="true" aria-controls="list-hang-cong-kenh">
        Hàng Công Kênh
        <button class="toggle-button" aria-label="Thu gọn Hàng Công Kênh">Thu gọn ∧</button>
      </div>
      <div class="shipping-list" id="list-hang-cong-kenh">
        <div class="shipping-item">
          <div class="label">Hàng Công Kênh <span class="note">[COD đã được kích hoạt]</span></div>
          <label class="toggle-switch" aria-label="Bật tắt Hàng Công Kênh">
            <input type="checkbox" checked />
            <span class="slider"></span>
          </label>
        </div>
      </div>
    </div>

    <p class="shipping-note" style="margin-top:12px;">
      Thêm đơn vị vận chuyển <br>
      <small>Lưu ý: Shopee không hỗ trợ theo dõi quá trình cho các phương thức vận chuyển không có tích hợp và cũng sẽ không chịu trách nhiệm về bất kỳ sản phẩm nào bị thiếu hoặc hư hỏng.</small>
    </p>

  </section>

  <!-- Buttons -->
  <div class="bottom-buttons">
    <button type="button" class="btn-back" onclick="history.back();">Quay lại</button>
    <button type="button" class="btn-next" onclick="alert('Chuyển bước tiếp theo (demo)')">Tiếp theo</button>
  </div>
</div>
<!-- Sidebar icon phải -->
<aside class="sidebar" aria-label="Sidebar chức năng">
  <button title="Thông báo" aria-label="Thông báo">
    <svg viewBox="0 0 24 24"><path d="M12 24a2.99 2.99 0 0 0 2.83-2H9.17a3 3 0 0 0 2.83 2zm6.36-6v-5a6.36 6.36 0 0 0-5-6V6a1.36 1.36 0 0 0-2.72 0v1a6.36 6.36 0 0 0-5 6v5l-1.64 2h16.92z"/></svg>
  </button>
  <button title="Trợ giúp" aria-label="Trợ giúp">
    <svg viewBox="0 0 24 24"><path d="M12 1a11 11 0 1 0 11 11A11 11 0 0 0 12 1zm4 14h-2v-2a2 2 0 0 0-4 0v2H8v-4a4 4 0 0 1 8 0z"/></svg>
  </button>
  <button title="Chat" aria-label="Chat">
    <svg viewBox="0 0 24 24"><path d="M21 6h-18c-1.1 0-2 .9-2 2v10a2 2 0 0 0 2 2h4l4 4 4-4h4a2 2 0 0 0 2-2v-10c0-1.1-.9-2-2-2z"/></svg>
  </button>
</aside>

<script>
  // Xử lý Thu gọn / Mở rộng
  document.querySelectorAll('.shipping-group').forEach(group => {
    const header = group.querySelector('.shipping-group-header');
    const toggleBtn = header.querySelector('.toggle-button');
    const list = group.querySelector('.shipping-list');

    function toggleCollapse() {
      const isExpanded = header.getAttribute('aria-expanded') === 'true';

      if (isExpanded) {
        // Thu gọn
        list.style.display = 'none';
        header.setAttribute('aria-expanded', 'false');
        toggleBtn.textContent = 'Mở rộng ∨';
        toggleBtn.setAttribute('aria-label', `Mở rộng ${header.textContent.trim()}`);
      } else {
        // Mở rộng
        list.style.display = 'block';
        header.setAttribute('aria-expanded', 'true');
        toggleBtn.textContent = 'Thu gọn ∧';
        toggleBtn.setAttribute('aria-label', `Thu gọn ${header.textContent.trim()}`);
      }
    }

    // Click toggle nút thu gọn
    toggleBtn.addEventListener('click', e => {
      e.stopPropagation();
      toggleCollapse();
    });

    // Click vào header cũng toggle
    header.addEventListener('click', e => {
      if (e.target !== toggleBtn) {
        toggleCollapse();
      }
    });

    // Có thể cho keyboard toggle bằng Enter/Space
    header.addEventListener('keydown', e => {
      if (e.key === 'Enter' || e.key === ' '){
        e.preventDefault();
        toggleCollapse();
      }
    });
  });
</script>

</body>
</html>
