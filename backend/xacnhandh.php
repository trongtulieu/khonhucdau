<?php
session_start();
include('../frontend/ketnoi.php');

function trangthai($tt) {
    return match($tt) {
        "cho_xu_li"     => "Chờ xử lý",
        "da_hoan_thanh" => "Đã hoàn thành",
        "da_huy"        => "Đã hủy",
        default         => "Không xác định"
    };
}

// XỬ LÝ AJAX CẬP NHẬT TRẠNG THÁI
if (isset($_POST['action'], $_POST['id'])) {
    $id = (int)$_POST['id'];
    $action = $_POST['action'];

    switch ($action) {
        case "xac_nhan":
            $sql = "UPDATE donhang SET trang_thai='da_hoan_thanh', thoigian=NOW() WHERE MA_DH=$id";
            break;
        case "huy":
            $sql = "UPDATE donhang SET trang_thai='da_huy', thoigian=NOW() WHERE MA_DH=$id";
            break;
        default:
            $sql = "";
    }

    if ($sql && mysqli_query($connect, $sql)) {
        echo json_encode(['success' => true, 'status' => $action]);
    } else {
        echo json_encode(['success' => false]);
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Seller Center — Xác nhận đơn hàng</title>

<!-- Bootstrap & Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

<style>
:root{
  --shopee-orange: #ee4d2d;
  --muted:#6c757d;
  --card-radius:16px;
}
body { font-family: 'Inter', sans-serif; background:#f6f7f9; margin:0; color:#222; }
.topbar { background: linear-gradient(90deg, rgba(238,77,45,0.06), rgba(238,77,45,0.02)); border-bottom:1px solid #eee; }
.topbar .brand { color:var(--shopee-orange); font-weight:700; letter-spacing:0.2px; font-size:20px; }
.container-app { max-width:1200px; margin:28px auto; padding:0 16px; }
.page-title { display:flex; align-items:center; gap:12px; margin-bottom:16px; }
.filter-bar { display:flex; gap:12px; align-items:center; flex-wrap:wrap; margin-bottom:18px; }
.tab-btn { border-radius:999px; padding:8px 14px; border:1px solid transparent; background:white; font-weight:600; cursor:pointer; }
.tab-btn.active { background:var(--shopee-orange); color:white; box-shadow:0 6px 16px rgba(238,77,45,0.12); }
.search-box { border-radius:30px; box-shadow:0 2px 8px rgba(16,24,40,0.04); }
.row-main { display:grid; grid-template-columns: 1fr 320px; gap:20px; }
.order-card { background:white; border-radius:var(--card-radius); padding:18px; border:1px solid #f0f0f0; transition:transform .12s ease, box-shadow .12s ease; }
.order-card:hover { transform: translateY(-4px); box-shadow:0 10px 24px rgba(16,24,40,0.06); }
.order-head { display:flex; justify-content:space-between; gap:12px; align-items:flex-start; }
.order-id { font-weight:700; font-size:16px; }
.order-meta { color:var(--muted); font-size:14px; }
.status-badge { padding:6px 12px; border-radius:20px; font-weight:600; font-size:13px; display:inline-block; }
.s-cho { background:#fff7ed; color:#b75b00; border:1px solid #ffe8ce; }
.s-hoan { background:#eaf9ef; color:#0a663f; border:1px solid #cceed8; }
.s-huy { background:#fcecec; color:#b91c1c; border:1px solid #ffdede; }
.action-row { margin-top:12px; display:flex; gap:8px; flex-wrap:wrap; }
.btn-custom { border-radius:999px; padding:6px 12px; font-weight:600; }
.sidebar { position:relative; top:0; background:white; border-radius:var(--card-radius); padding:18px; border:1px solid #f0f0f0; }
.sidebar h6 { font-weight:700; }
@media (max-width:991px) { .row-main { grid-template-columns: 1fr; } .sidebar { order:2; margin-top:14px;} }
.mobile-bottom-nav { display:none; }
@media (max-width:575px) { .filter-bar { gap:8px; } .page-title .desc { display:none; } .mobile-bottom-nav { display:flex; position:fixed; right:12px; bottom:12px; gap:8px; z-index:1200; } .mobile-bottom-nav .fab { width:52px;height:52px;border-radius:50%;display:flex;align-items:center;justify-content:center;background:var(--shopee-orange); color:white; box-shadow:0 6px 18px rgba(17,24,39,0.15); border:none; } }
.small-muted { color:var(--muted); font-size:13px; }
.empty-placeholder { text-align:center; color:var(--muted); padding:30px 10px; }
</style>
</head>
<body>

<!-- TOPBAR -->
<div class="topbar py-2 shadow-sm">
  <div class="container-app d-flex justify-content-between align-items-center">
    <div class="d-flex align-items-center gap-3">
      <div class="brand d-flex align-items-center gap-2">
        <img src="https://raw.githubusercontent.com/nhox29/images/main/shopee-icon.png" alt="logo" style="width:36px;height:36px;border-radius:8px;object-fit:cover;">
        Seller Center
      </div>
      <div class="small-muted">Quản lý đơn hàng • Giao diện Seller</div>
    </div>
    <div class="d-flex align-items-center gap-3">
      <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-bell"></i></button>
      <div class="d-flex align-items-center gap-2">
        <img src="https://ui-avatars.com/api/?name=Shop&size=32" alt="avatar" style="width:34px;height:34px;border-radius:6px;">
        <div class="d-none d-sm-block">
          <div style="font-weight:700;">Tên Shop</div>
          <div class="small-muted" style="font-size:12px;">Hoạt động</div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- MAIN -->
<div class="container-app">
  <div class="page-title mb-3">
    <div>
      <h3 style="margin:0;">Xác nhận đơn hàng</h3>
      <div class="small-muted desc">Quản lý, xử lý và theo dõi trạng thái đơn hàng</div>
    </div>
  </div>

  <!-- FILTERS -->
  <div class="filter-bar mb-3">
    <div class="d-flex gap-2 align-items-center flex-wrap">
      <button class="tab-btn active" data-filter="all">Tất cả</button>
      <button class="tab-btn" data-filter="cho_xu_li">Chờ xử lý</button>
      <button class="tab-btn" data-filter="da_hoan_thanh">Hoàn thành</button>
      <button class="tab-btn" data-filter="da_huy">Đã hủy</button>
    </div>
    <div class="ms-auto d-flex gap-2 align-items-center" style="flex:1;justify-content:flex-end;">
      <div style="width:320px;">
        <div class="input-group search-box">
          <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
          <input id="searchBox" type="text" class="form-control" placeholder="Tìm mã đơn / người mua / SĐT..." onkeyup="applyFilters()">
        </div>
      </div>
    </div>
  </div>

  <div class="row-main">
    <!-- ORDER LIST -->
    <div>
      <?php
      $sql = "SELECT donhang.*, nguoidung.HOTEN, nguoidung.EMAIL, nguoidung.SDT FROM donhang LEFT JOIN nguoidung ON donhang.MA_ND = nguoidung.MA_ND ORDER BY donhang.MA_DH DESC";
      $ketqua = mysqli_query($connect, $sql);
      $orders = [];
      while ($o = mysqli_fetch_assoc($ketqua)) {
          $o['MA_DH'] = (int)($o['MA_DH'] ?? 0);
          $o['TONGTIEN'] = isset($o['TONGTIEN']) ? (int)$o['TONGTIEN'] : 0;
          $orders[] = $o;
      }
      if (count($orders) === 0): ?>
        <div class="order-card">
          <div class="empty-placeholder">
            <i class="bi bi-inbox" style="font-size:34px;color:var(--muted)"></i>
            <div style="margin-top:8px;">Không có đơn hàng nào.</div>
          </div>
        </div>
      <?php else:
        foreach ($orders as $o):
            $buyerLabel = !empty($o['HOTEN']) ? htmlspecialchars($o['HOTEN']) : (!empty($o['EMAIL']) ? htmlspecialchars($o['EMAIL']) : 'Người dùng #' . (int)$o['MA_ND']);
            $ngaydat = (!empty($o['NGAYDAT']) && $o['NGAYDAT'] !== '0000-00-00 00:00:00') ? date('Y-m-d H:i', strtotime($o['NGAYDAT'])) : '-';
            $status = $o['trang_thai'] ?? 'cho_xu_li';
            $cls = match($status) { "cho_xu_li" => "s-cho", "da_hoan_thanh" => "s-hoan", "da_huy" => "s-huy", default => "s-cho" };
            $data_price = (int)($o['TONGTIEN'] ?? 0);
            $data_id = (int)$o['MA_DH'];
      ?>
      <div class="order-card order-card-item mb-3" data-status="<?= htmlspecialchars($status) ?>" data-id="<?= $data_id ?>" data-price="<?= $data_price ?>">
        <div class="order-head">
          <div>
            <div class="order-id">Đơn hàng #<?= $data_id ?></div>
            <div class="order-meta mt-1">
              <span class="me-3">👤 <?= $buyerLabel ?></span>
              <span class="me-3">📞 <?= !empty($o['SDT']) ? htmlspecialchars($o['SDT']) : 'Không có' ?></span>
              <span>📅 <?= $ngaydat ?></span>
            </div>
            <div class="mt-2" style="font-weight:700;color:var(--shopee-orange);">
              💰 <?= number_format($data_price) ?>₫
            </div>
          </div>
          <div class="text-end">
            <div><span class="status-badge <?= $cls ?>"><?= trangthai($status) ?></span></div>
            <div class="small-muted mt-2">Cập nhật: <?= !empty($o['thoigian']) ? htmlspecialchars($o['thoigian']) : '-' ?></div>
          </div>
        </div>
        <hr>
        <div class="d-flex justify-content-between flex-wrap gap-2">
          <div class="d-flex gap-2 flex-wrap">
            <a href="../frontend/chiTietSanPham.php?ma_dh=<?= $data_id ?>" class="btn btn-outline-secondary btn-sm btn-custom">
              <i class="bi bi-eye"></i> Xem chi tiết
            </a>
            <?php if ($status === 'cho_xu_li'): ?>
              <a href="javascript:void(0);" class="btn btn-orange btn-sm btn-custom" onclick="updateOrder(<?= $data_id ?>,'xac_nhan')"><i class="bi bi-check-circle"></i> Xác nhận</a>
              <a href="javascript:void(0);" class="btn btn-outline-danger btn-sm btn-custom" onclick="updateOrder(<?= $data_id ?>,'huy')"><i class="bi bi-x-circle"></i> Hủy</a>
            <?php elseif ($status === 'da_hoan_thanh'): ?>
              <span class="badge bg-success">Đã hoàn thành</span>
            <?php elseif ($status === 'da_huy'): ?>
              <span class="badge bg-danger">Đã hủy</span>
            <?php endif; ?>
            <button class="btn btn-light btn-sm btn-custom" onclick="window.print();"><i class="bi bi-printer"></i> In vận đơn</button>
          </div>
          <div class="small-muted align-self-center">Mã khách: <?= (int)$o['MA_ND'] ?></div>
        </div>
      </div>
      <?php endforeach; endif; ?>
    </div>

    <!-- SIDEBAR -->
    <div class="sidebar">
      <h6><i class="bi bi-info-circle"></i> Thông tin & Bộ lọc</h6>
      <p class="small-muted">Sử dụng bộ lọc hoặc tìm kiếm để thu hẹp danh sách đơn.</p>
      <div class="mt-3">
        <label class="form-label small-muted">Trạng thái</label>
        <select id="statusSelect" class="form-select" onchange="applyFilters()">
          <option value="all">Tất cả</option>
          <option value="cho_xu_li">Chờ xử lý</option>
          <option value="da_hoan_thanh">Hoàn thành</option>
          <option value="da_huy">Đã hủy</option>
        </select>
      </div>
      <div class="mt-3">
        <label class="form-label small-muted">Sắp xếp</label>
        <select id="sortSelect" class="form-select" onchange="applySort()">
          <option value="new">Mới nhất</option>
          <option value="old">Cũ nhất</option>
          <option value="high">Giá cao → thấp</option>
          <option value="low">Giá thấp → cao</option>
        </select>
      </div>
    </div>
  </div>
</div>

<div class="mobile-bottom-nav">
  <button class="fab" title="Tạo nhanh"><i class="bi bi-plus-lg"></i></button>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
// FILTER & SEARCH
function applyFilters() {
  const q = (document.getElementById('searchBox').value || '').toLowerCase().trim();
  const statusFilter = document.getElementById('statusSelect').value || 'all';
  document.querySelectorAll('.order-card-item').forEach(card => {
    const status = card.getAttribute('data-status') || '';
    const text = card.innerText.toLowerCase();
    card.style.display = ((statusFilter==='all'||status===statusFilter) && (!q||text.includes(q))) ? '' : 'none';
  });
  document.querySelectorAll('.tab-btn').forEach(b => b.classList.toggle('active', b.getAttribute('data-filter')===statusFilter || (statusFilter==='all' && b.getAttribute('data-filter')==='all')));
}
document.querySelectorAll('.tab-btn').forEach(btn => btn.addEventListener('click', function(){
  document.querySelectorAll('.tab-btn').forEach(b=>b.classList.remove('active'));
  this.classList.add('active');
  document.getElementById('statusSelect').value = this.getAttribute('data-filter') || 'all';
  applyFilters();
}));

// SORTING
function applySort() {
  const mode = document.getElementById('sortSelect').value;
  const container = document.querySelector('.row-main > div');
  if (!container) return;
  const cards = Array.from(container.querySelectorAll('.order-card-item'));
  cards.sort((a,b)=>{
    const aPrice = parseInt(a.getAttribute('data-price')||0,10);
    const bPrice = parseInt(b.getAttribute('data-price')||0,10);
    const aId = parseInt(a.getAttribute('data-id')||0,10);
    const bId = parseInt(b.getAttribute('data-id')||0,10);
    if (mode==='new') return bId-aId;
    if (mode==='old') return aId-bId;
    if (mode==='high') return bPrice!==aPrice ? bPrice-aPrice : bId-aId;
    if (mode==='low') return aPrice!==bPrice ? aPrice-bPrice : aId-bId;
    return 0;
  });
  cards.forEach(c=>container.appendChild(c));
}

// AJAX XÁC NHẬN / HỦY ĐƠN
function updateOrder(id, action){
  if(!confirm(`Bạn có chắc muốn ${action==='xac_nhan'?'xác nhận':'hủy'} đơn #${id}?`)) return;
  fetch('', {
    method:'POST',
    headers:{'Content-Type':'application/x-www-form-urlencoded'},
    body:`id=${id}&action=${action}`
  }).then(r=>r.json()).then(data=>{
    if(data.success){
      const card=document.querySelector(`.order-card-item[data-id="${id}"]`);
      if(card){
        const badge=card.querySelector('.status-badge');
        if(action==='xac_nhan'){ badge.className='status-badge s-hoan'; badge.textContent='Đã hoàn thành'; }
        else if(action==='huy'){ badge.className='status-badge s-huy'; badge.textContent='Đã hủy'; }
        card.querySelectorAll('a.btn-orange,a.btn-outline-danger').forEach(b=>b.style.display='none');
      }
    }else alert('Cập nhật thất bại!');
  });
}

// INIT
applyFilters();
</script>
</body>
</html>
