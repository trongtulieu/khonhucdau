<?php
// info.php - Trang thông tin người bán
include '../frontend/ketnoi.php'; // kết nối DB

// Xử lý form chính nếu cần POST (ở đây chỉ chuyển tiếp)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Location: dknguoiban2.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8" />  
<title>Thông tin Người bán Shopee</title>
<style>
  body { font-family: Arial, sans-serif; background-color: #f5f5f5; margin:0; padding:0; }
  .container { max-width:960px; margin:24px auto; background:white; padding:40px 56px 56px 56px; border-radius:6px; box-shadow:0 2px 12px rgb(0 0 0 / 0.1); }
  .progress {
  display: flex;
  justify-content: space-between;
  max-width: 700px;
  margin: 0 auto 32px;
  position: relative;
}

.step {
  flex: 1;
  text-align: center;
  font-size: 14px;
  color: #bbb;
  position: relative;
}

/* line nối giữa các bước */
.step::after {
  content: "";
  position: absolute;
  top: 10px;      
  right: -50%;
  width: 100%;
  height: 2px;
  background: #e0e0e0;
  z-index: 1;
}

/* bước cuối thì không có line */
.step:last-child::after {
  display: none;
}

.step-dot {
  display: block;
  width: 14px;
  height: 14px;
  border-radius: 50%;
  background: #e0e0e0;
  margin: 0 auto 8px;
  position: relative;
  z-index: 2;
}

/* bước đang active */
.step.active {
  color: #ee4d2d;
  font-weight: 600;
}

.step.active .step-dot {
  background: #ee4d2d;
}

/* line đã hoàn thành */
.step.active::after {
  background: rgba(24, 211, 31, 1);
}

  form label { display:block; margin-top:24px; font-size:14px; font-weight:500; color:#333; }
  form label.required::before { content:"*"; color:#ee4d2d; margin-right:4px; }
  input[type="text"], input[type="email"] { width:300px; height:34px; padding:6px 8px; margin-top:8px; border:1px solid #ddd; border-radius:4px; font-size:14px; }
  input[readonly] { background:#f2f2f2; }
  button.add-address { margin-left:8px; padding:5px 12px; font-size:14px; border:1px solid #ddd; border-radius:4px; background:white; cursor:pointer; }
  button.add-address:hover { background:#f9f9f9; }
  hr { border:none; border-top:1px solid #eee; margin:32px 0 24px; }

  /* modal */
  .modal { display:none; position:fixed; z-index:9999; left:0; top:0; width:100%; height:100%; overflow-y:auto; background-color:rgb(0 0 0 / 0.3); backdrop-filter:blur(2px); padding:40px 0; box-sizing:border-box; }
  .modal-content { background:#fff; margin:0 auto; padding:24px 32px; border-radius:4px; max-width:480px; position:relative; }
  .modal-header { display:flex; justify-content:space-between; align-items:center; font-size:18px; font-weight:600; color:#333; margin-bottom:24px; }
  .close-btn { background:none; border:none; font-size:26px; cursor:pointer; line-height:1; color:#999; transition:color 0.2s; }
  .close-btn:hover { color:#ee4d2d; }
  .modal-content label { display:block; margin-top:12px; font-size:14px; font-weight:500; color:#333; }
  .modal-content input[type="text"], .modal-content select, .modal-content textarea { width:100%; padding:8px 10px; margin-top:6px; border:1px solid #ddd; border-radius:4px; font-size:14px; box-sizing:border-box; }
  .modal-content textarea { resize:vertical; }
  .location-info { margin-top:12px; font-size:12px; color:#666; display:flex; align-items:center; gap:6px; }
  .modal-footer { margin-top:24px; display:flex; justify-content:flex-end; gap:12px; }
  .btn-cancel { background:white; border:1px solid #ddd; border-radius:4px; color:#333; padding:8px 20px; font-size:14px; cursor:pointer; }
  .btn-cancel:hover { background:#f9f9f9; }
  .btn-save { background-color:#ee4d2d; border:none; border-radius:4px; color:white; padding:8px 24px; font-weight:600; cursor:pointer; }
  .btn-save:hover { background-color:#d44125; }

  .buttons { display:flex; justify-content:flex-end; gap:12px; margin-top:32px; }
  .btn-next { background-color:#ee4d2d; border:none; border-radius:4px; color:white; padding:8px 24px; font-weight:600; cursor:pointer; }
  .btn-next:hover { background-color:#d44125; }
</style>
</head>
<body>
<?php
include 'header.php';
?>
<div class="container">
  <div class="progress">
    <div class="step active"><span class="step-dot"></span>Thông tin Shop</div>
    <div class="step"><span class="step-dot" style="background:#eee;"></span>Cài đặt vận chuyển</div>
    <div class="step"><span class="step-dot" style="background:#eee;"></span>Hoàn tất</div>
  </div>
  <hr />

  <form action="dknguoiban2.php" method="post">
    <label class="required" for="shopName">Tên Shop</label>
    <input type="text" id="shopName" name="shopName" placeholder="Nhập vào" maxlength="30" required />
    
    <label class="required" for="address">Địa chỉ lấy hàng</label>
    <button type="button" class="add-address">+ Thêm</button>

    <label class="required" for="email">Email</label>
    <input type="email" id="email" name="email" placeholder="Nhập vào" required />

    <label class="required" for="phone">Số điện thoại</label>
    <input type="text" id="phone" name="phone" placeholder="Nhập vào"
           required pattern="0\d{9,10}" title="Bắt đầu bằng 0 và có 10-11 chữ số">

    <hr />
    <div class="buttons">
      <a href="dknguoiban.php" class="btn-save" style="text-decoration:none;">Quay lại</a>
      <button type="submit" class="btn-next">Tiếp theo</button>
    </div>
  </form>
</div>

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

      <label for="detailedAddress">Địa chỉ chi tiết</label>
      <textarea id="detailedAddress" name="detailedAddress" rows="3" placeholder="Số nhà, tên đường..." required></textarea>

      <div class="location-info"><span>📍 Định vị</span><small>Giúp đơn hàng được giao nhanh nhất</small></div>
      <div class="modal-footer">
        <button type="button" class="btn-cancel">Hủy</button>
        <button type="submit" class="btn-save">Lưu</button>
      </div>
    </form>
  </div>
</div>

<script>
// Modal
const addAddressBtn = document.querySelector('button.add-address');
const modal = document.getElementById('modalAddAddress');
const closeBtn = modal.querySelector('.close-btn');
const cancelBtn = modal.querySelector('.btn-cancel');
const formAddAddress = document.getElementById('formAddAddress');

addAddressBtn.addEventListener('click', ()=>{ modal.style.display='block'; });
function closeModal(){ modal.style.display='none'; formAddAddress.reset(); }
closeBtn.addEventListener('click', closeModal);
cancelBtn.addEventListener('click', closeModal);
window.addEventListener('click', e=>{ if(e.target===modal) closeModal(); });

// AJAX lưu địa chỉ
formAddAddress.addEventListener('submit', function(e){
  e.preventDefault();
  const phoneInput = document.getElementById('phoneNumber');
  const phone = phoneInput.value.trim();
  if(!/^0\d{9,10}$/.test(phone)){ alert('Số điện thoại không hợp lệ. Bắt đầu bằng 0 và có 10-11 số.'); phoneInput.focus(); return; }

  const formData = new FormData(formAddAddress);
  fetch('diachilayhang.php', { method:'POST', body:formData })
    .then(res=>res.json())
    .then(data=>{
      if(data.status==='success'){ alert(data.message); closeModal(); }
      else{ alert(data.message); }
    }).catch(err=>{ console.error(err); alert('Lỗi. Vui lòng thử lại.'); });
});
</script>

</body>
</html>
