<?php
// Trang thông tin người bán
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8" />
<title>Thông tin Người bán Shopee</title>
<style>
  body {
    font-family: Arial, sans-serif;
    background-color: #f5f5f5;
    margin: 0; padding: 0;
  }
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

  .container {
    max-width: 960px;
    margin: 24px auto;
    background: white;
    padding: 40px 56px 56px 56px;
    border-radius: 6px;
    box-shadow: 0 2px 12px rgb(0 0 0 / 0.1);
  }

  /* Progress bar phần đầu */
  .progress {
    display: flex;
    justify-content: space-between;
    max-width: 700px;
    margin-bottom: 32px;
  }
  .step {
    flex: 1;
    text-align: center;
    font-size: 14px;
    color: #bbb;
    position: relative;
  }
  .step.active {
    color: #ee4d2d;
    font-weight: 600;
  }
  .step.active::before {
    content: '';
    position: absolute;
    top: 12px;
    left: 50%;
    height: 3px;
    width: 100%;
    background: #ee4d2d;
    transform: translateX(-50%);
    z-index: -1;
  }
  .step:last-child::before {
    display: none;
  }

  .step-dot {
    display: inline-block;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: #ee4d2d;
    margin-bottom: 8px;
  }

  /* Form */
  form label {
    display: block;
    margin-top: 24px;
    font-size: 14px;
    font-weight: 500;
    color: #333;
  }
  form label.required::before {
    content: "*";
    color: #ee4d2d;
    margin-right: 4px;
  }
  input[type="text"],
  input[type="email"] {
    width: 300px;
    height: 34px;
    padding: 6px 8px;
    margin-top: 8px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 14px;
  }
  input[readonly] {
    background: #f2f2f2;
  }
  button.add-address {
    margin-left: 8px;
    padding: 5px 12px;
    font-size: 14px;
    border: 1px solid #ddd;
    border-radius: 4px;
    background: white;
    cursor: pointer;
  }
  button.add-address:hover {
    background: #f9f9f9;
  }

  hr {
    border: none;
    border-top: 1px solid #eee;
    margin: 32px 0 24px;
  }
  /*modal*/
  /* Modal nền tối và căn giữa */
.modal {
  display: none; /* Ẩn mặc định */
  position: fixed;
  z-index: 9999;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow-y: auto;
  background-color: rgb(0 0 0 / 0.3);
  backdrop-filter: blur(2px);
  -webkit-backdrop-filter: blur(2px);
  padding: 40px 0;
  box-sizing: border-box;
}

/* Nội dung modal */
.modal-content {
  background-color: #fff;
  margin: 0 auto;
  padding: 24px 32px;
  border-radius: 4px;
  max-width: 480px;
  position: relative;
}

/* Header modal */
.modal-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-size: 18px;
  font-weight: 600;
  color: #333;
  margin-bottom: 24px;
}

/* nút đóng */
.close-btn {
  background: none;
  border: none;
  font-size: 26px;
  cursor: pointer;
  line-height: 1;
  color: #999;
  transition: color 0.2s;
}
.close-btn:hover {
  color: #ee4d2d;
}

/* Form trong modal */
.modal-content label {
  display: block;
  margin-top: 12px;
  font-size: 14px;
  font-weight: 500;
  color: #333;
}
.modal-content input[type="text"],
.modal-content select,
.modal-content textarea {
  width: 100%;
  padding: 8px 10px;
  margin-top: 6px;
  border: 1px solid #ddd;
  border-radius: 4px;
  font-size: 14px;
  box-sizing: border-box;
}
.modal-content textarea {
  resize: vertical;
}

/* phần định vị nhỏ */
.location-info {
  margin-top: 12px;
  font-size: 12px;
  color: #666;
  display: flex;
  align-items: center;
  gap: 6px;
}

/* Footer nút */
.modal-footer {
  margin-top: 24px;
  display: flex;
  justify-content: flex-end;
  gap: 12px;
}

.btn-cancel {
  background: white;
  border: 1px solid #ddd;
  border-radius: 4px;
  color: #333;
  padding: 8px 20px;
  font-size: 14px;
  cursor: pointer;
}
.btn-cancel:hover {
  background: #f9f9f9;
}

.btn-save {
  background-color: #ee4d2d;
  border: none;
  border-radius: 4px;
  color: white;
  padding: 8px 24px;
  font-weight: 600;
  cursor: pointer;
}
.btn-save:hover {
  background-color: #d44125;
}
/*dongmodal*/

  /* Nút dưới cùng */
  .buttons {
    display: flex;
    justify-content: flex-end;
    gap: 12px;
    margin-top: 32px;
  }
  .btn-save {
    background: white;
    border: 1px solid #ddd;
    border-radius: 4px;
    color: #333;
    padding: 8px 20px;
    font-size: 14px;
    cursor: pointer;
  }
  .btn-save:hover {
    background: #f9f9f9;
  }
  .btn-next {
    background-color: #ee4d2d;
    border: none;
    border-radius: 4px;
    color: white;
    padding: 8px 24px;
    font-weight: 600;
    cursor: pointer;
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
    <img src="https://upload.wikimedia.org/wikipedia/commons/2/29/Shopee_logo.svg" alt="Shopee logo" />
    Đăng ký trở thành Người bán Shopee
  </div>
  <div class="user">
    <div class="avatar">👤</div>
    <span>1bw3d7e77v ▼</span>
  </div>
</header>

<div class="container">
  <!-- Thanh tiến trình -->
  <div class="progress">
    <div class="step active">
      <span class="step-dot"></span>
      Thông tin Shop
    </div>
    <div class="step">
      <span class="step-dot" style="background:#eee;"></span>
      Cài đặt vận chuyển
    </div>
    <div class="step">
      <span class="step-dot" style="background:#eee;"></span>
      Hoàn tất
    </div>
  </div>

  <hr />

  <!-- Form nhập thông tin -->
  <form action="info.php" method="post">
    <label class="required" for="shopName">Tên Shop</label>
    <input type="text" id="shopName" name="shopName" placeholder="Nhập vào" maxlength="30" required />
    <small style="font-size: 12px; color:#999;">10/30</small>

    <label class="required" for="address">Địa chỉ lấy hàng</label>
    <button type="button" class="add-address">+ Thêm</button>

    <label class="required" for="email" style="margin-top: 24px;">Email</label>
    <input type="email" id="email" name="email" placeholder="Nhập vào" required />

    <label class="required" for="phone" style="margin-top: 24px;">Số điện thoại</label>
    <input type="text" id="phone" name="phone" placeholder="Nhập vào" required />

    <hr />

    <div class="buttons">
     <a href="dknguoiban.php" class="btn-save" style="text-decoration:none; display:inline-block; padding:8px 20px; border:1px solid #ddd; border-radius:4px; color:#333;">Quay lại</a>
      </a>
      <button type="submit" class="btn-next"> Tiếp theo </button>
    </div>
  </form>
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
<!-- Modal Thêm Địa Chỉ Mới -->
<div id="modalAddAddress" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <span class="modal-title">Thêm Địa Chỉ Mới</span>
      <button class="close-btn" aria-label="Đóng">&times;</button>
    </div>
    <form id="formAddAddress">
      <label for="fullName">Họ & Tên</label>
      <input type="text" id="fullName" name="fullName" placeholder="Nhập vào" required />

      <label for="phoneNumber">Số điện thoại</label>
      <input type="text" id="phoneNumber" name="phoneNumber" placeholder="Nhập vào" required />

      <label>Địa chỉ</label>
      
      <label for="province">Tỉnh/Thành phố/Quận/Huyện/Phường/Xã</label>
      <select id="province" name="province" required>
        <option value="" disabled selected>Chọn</option>
        <!-- Có thể thêm option động hoặc tĩnh tại đây -->
        <option value="Hanoi">Hà Nội</option>
        <option value="HCM">TP Hồ Chí Minh</option>
        <!-- ... -->
      </select>

      <label for="detailedAddress">Địa chỉ chi tiết</label>
      <textarea id="detailedAddress" name="detailedAddress" rows="3" placeholder="Số nhà, tên đường.v.v.." required></textarea>

      <div class="location-info">
        <span>📍 Định vị</span>
        <small>Giúp đơn hàng được giao nhanh nhất</small>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn-cancel"> Hủy </button>
        <button type="submit" class="btn-save"> Lưu </button>
      </div>
    </form>
  </div>
</div>
<script>
  // Lấy các phần tử
  const addAddressBtn = document.querySelector('button.add-address');
  const modal = document.getElementById('modalAddAddress');
  const closeBtn = modal.querySelector('.close-btn');
  const cancelBtn = modal.querySelector('.btn-cancel');
  const formAddAddress = document.getElementById('formAddAddress');

  // Hàm mở modal
  function openModal() {
    modal.style.display = 'block';
  }

  // Hàm đóng modal
  function closeModal() {
    modal.style.display = 'none';
    formAddAddress.reset(); // Xóa form sau khi đóng
  }

  // Mở modal khi bấm nút thêm địa chỉ
  addAddressBtn.addEventListener('click', openModal);

  // Đóng modal khi bấm nút X hoặc Hủy
  closeBtn.addEventListener('click', closeModal);
  cancelBtn.addEventListener('click', closeModal);

  // Đóng modal khi click ra ngoài vùng modal-content
  window.addEventListener('click', function(event) {
    if (event.target === modal) {
      closeModal();
    }
  });

  // Xử lý submit form (tạm xử lý demo, có thể sửa tùy nhu cầu)
  formAddAddress.addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Lấy dữ liệu ví dụ
    const fullName = formAddAddress.fullName.value.trim();
    const phone = formAddAddress.phoneNumber.value.trim();
    const province = formAddAddress.province.value;
    const detailedAddress = formAddAddress.detailedAddress.value.trim();

    // Kiểm tra dữ liệu đã nhập (ở đây chỉ đơn giản)
    if (!fullName || !phone || !province || !detailedAddress) {
      alert('Vui lòng nhập đầy đủ thông tin');
      return;
    }

    // Ở đây bạn có thể dùng AJAX gửi dữ liệu lên server hoặc thêm vào list địa chỉ trên trang

    alert('Địa chỉ mới đã được lưu (demo)');

    // Đóng modal sau khi lưu
    closeModal();
  });
 
  const mainForm = document.querySelector('form[action="info.php"]');

  mainForm.addEventListener('submit', function(e) {
    if (!mainForm.checkValidity()) {
      return; // trình duyệt hiển thị lỗi HTML5
    }
    e.preventDefault();
    window.location.href = 'dknguoiban2.php';
  });
</script>
</body>
</html>