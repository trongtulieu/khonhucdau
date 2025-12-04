<?php
// Kết nối database
include '../frontend/ketnoi.php';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Thông tin Người bán Shopee</title>
<style>
body { font-family: Arial, sans-serif; background-color: #f5f5f5; margin:0; padding:0; }
header { height:56px; background:#fff; border-bottom:1px solid #eee; display:flex; justify-content:space-between; align-items:center; padding:0 24px; font-size:16px; color:#333; }
.container { max-width:960px; margin:24px auto; background:#fff; padding:40px 56px 56px 56px; border-radius:6px; box-shadow:0 2px 12px rgb(0 0 0 / 0.1); }
label.required::before { content:"*"; color:#ee4d2d; margin-right:4px; }
input[type="text"], input[type="email"], textarea, select { width:300px; height:34px; padding:6px 8px; margin-top:8px; border:1px solid #ddd; border-radius:4px; font-size:14px; }
textarea { resize: vertical; width:100%; }
button.add-address { margin-left:8px; padding:5px 12px; font-size:14px; border:1px solid #ddd; border-radius:4px; background:white; cursor:pointer; }
button.add-address:hover { background:#f9f9f9; }
.buttons { display:flex; justify-content:flex-end; gap:12px; margin-top:32px; }
.btn-save, .btn-next { padding:8px 20px; border-radius:4px; font-weight:600; cursor:pointer; border:none; }
.btn-save { background:#fff; border:1px solid #ddd; color:#333; }
.btn-save:hover { background:#f9f9f9; }
.btn-next { background:#ee4d2d; color:#fff; }
.btn-next:hover { background:#d44125; }
/* Modal */
.modal { display:none; position:fixed; z-index:9999; left:0; top:0; width:100%; height:100%; overflow-y:auto; background-color:rgb(0 0 0 / 0.3); backdrop-filter:blur(2px); padding:40px 0; box-sizing:border-box; }
.modal-content { background:#fff; margin:0 auto; padding:24px 32px; border-radius:4px; max-width:480px; position:relative; }
.modal-header { display:flex; justify-content:space-between; align-items:center; font-size:18px; font-weight:600; color:#333; margin-bottom:24px; }
.close-btn { background:none; border:none; font-size:26px; cursor:pointer; color:#999; }
.close-btn:hover { color:#ee4d2d; }
.modal-footer { margin-top:24px; display:flex; justify-content:flex-end; gap:12px; }
#listAddresses div { padding:6px 0; border-bottom:1px solid #eee; }
</style>
</head>
<body>

<div class="container">
  <h2>Thông tin Shop</h2>
  <form id="mainForm" action="info.php" method="post">
    <label class="required" for="shopName">Tên Shop</label>
    <input type="text" id="shopName" name="shopName" maxlength="30" placeholder="Nhập tên shop" required>

    <label class="required" for="email">Email</label>
    <input type="email" id="email" name="email" placeholder="Nhập email" required>

    <label class="required" for="phone">Số điện thoại</label>
    <input type="text" id="phone" name="phone" placeholder="Nhập số điện thoại" required pattern="0\d{9,10}" title="Bắt đầu bằng 0, 10-11 số">

    <label class="required">Địa chỉ lấy hàng</label>
    <button type="button" class="add-address">+ Thêm</button>

    <div id="listAddresses"></div>

    <div class="buttons">
      <button type="submit" class="btn-next">Tiếp theo</button>
    </div>
  </form>
</div>

<!-- Modal Thêm Địa Chỉ -->
<div id="modalAddAddress" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <span>Thêm Địa Chỉ Mới</span>
      <button class="close-btn">&times;</button>
    </div>
    <form id="formAddAddress">
      <label>Họ & Tên</label>
      <input type="text" name="fullName" required>
      <label>Số điện thoại</label>
      <input type="text" name="phoneNumber" required pattern="0\d{9,10}" title="Bắt đầu bằng 0, 10-11 số">
      <label>Địa chỉ chi tiết</label>
      <textarea name="detailedAddress" rows="3" required></textarea>
      <div class="modal-footer">
        <button type="button" class="btn-cancel">Hủy</button>
        <button type="submit" class="btn-save">Lưu</button>
      </div>
    </form>
  </div>
</div>

<script>
// Modal
const addBtn = document.querySelector('.add-address');
const modal = document.getElementById('modalAddAddress');
const closeBtn = modal.querySelector('.close-btn');
const cancelBtn = modal.querySelector('.btn-cancel');
const formModal = document.getElementById('formAddAddress');
const listAddresses = document.getElementById('listAddresses');

addBtn.addEventListener('click', ()=> modal.style.display='block');
function closeModal(){ modal.style.display='none'; formModal.reset(); }
closeBtn.addEventListener('click', closeModal);
cancelBtn.addEventListener('click', closeModal);
window.addEventListener('click', e=>{ if(e.target===modal) closeModal(); });

// AJAX lưu địa chỉ
formModal.addEventListener('submit', function(e){
  e.preventDefault();
  const fullName = formModal.fullName.value.trim();
  const phone = formModal.phoneNumber.value.trim();
  const detailed = formModal.detailedAddress.value.trim();
  if(!/^0\d{9,10}$/.test(phone)){ alert('Số điện thoại không hợp lệ'); return; }

  const data = new FormData(formModal);
  fetch('save_address.php', {method:'POST', body:data})
    .then(res=>res.json())
    .then(res=>{
      if(res.status==='success'){
        alert(res.message);
        closeModal();
        const div = document.createElement('div');
        div.innerHTML = `<strong>${fullName}</strong> - ${phone}<br><small>${detailed}</small>`;
        listAddresses.prepend(div);
      } else alert(res.message);
    }).catch(err=>{ console.error(err); alert('Lỗi hệ thống'); });
});

// Form chính
document.getElementById('mainForm').addEventListener('submit', function(e){
  if(!this.checkValidity()) return;
  e.preventDefault();
  alert('Form chính gửi thành công! Bạn có thể redirect sang trang tiếp theo.');
});
</script>

</body>
</html>
