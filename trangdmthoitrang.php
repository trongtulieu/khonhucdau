<?php
    include('header.php');
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Shopee-like UI</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">

  <style>
    body { margin: 0; font-family: Arial, sans-serif; background: #f5f5f5; }
    .site { max-width: 1500px; margin: auto; padding: 16px; background: #fff; }
    .banner img { width: 100%; border-radius: 8px; }
    .layout { display: grid; grid-template-columns: 250px 1fr; gap: 20px; margin-top: 20px; }

    .sidebar { background: #fff; border-radius: 8px; padding: 16px; height: fit-content; }
    ul li { cursor: pointer; }

    .sort-bar { background: #fff; padding: 12px; border-radius: 8px; display: flex; align-items: center; gap: 12px; margin-bottom: 20px; }

    .brand-grid { display: grid; grid-template-columns: repeat(6, 1fr); gap: 12px; margin-top: 20px; }
    .brand-box { border: 1px solid #eee; padding: 10px; text-align: center; border-radius: 6px; background: #fff; transition: .15s; }
    .brand-box:hover { border-color: #ee4d2d; transform: translateY(-2px); }
    .brand-box img { width: 60%; }

    .products { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 16px; }
    .product-card { background: #fff; border-radius: 8px; padding: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
    .product-card img { width: 100%; height: 180px; object-fit: cover; border-radius: 6px; }
    .title { font-size: 14px; line-height: 1.3; height: 36px; overflow: hidden; }
    .price { color: #ee4d2d; font-weight: bold; }
  </style>
</head>
<body>
<div class="site">

  <div class="banner">
    <img src="images/sansaledm.png" alt="Banner">
  </div>

  <div class="brand-grid">
    <div class="brand-box">COOLMATE <img src="images/coolmate.png"></div>
    <div class="brand-box">GUZADO <img src="images/guzado.png"></div>
    <div class="brand-box">JBAGY <img src="images/zbagy.png"></div>
    <div class="brand-box">ROWAY <img src="images/roway.png"></div>
    <div class="brand-box">TEELAB <img src="images/teelab.png"></div>
    <div class="brand-box">PEALO <img src="images/pealo.jpg"></div>
    <div class="brand-box">TORANO <img src="images/torano.png"></div>
    <div class="brand-box">LADOS <img src="images/lados.png"></div>
    <div class="brand-box">POLOMANOR <img src="images/polomanor.png"></div>
    <div class="brand-box">LEVENTS <img src="images/levents.png"></div>
    <div class="brand-box">THE BAD GOD <img src="images/thebadgod.png"></div>
    <div class="brand-box">ONOFF <img src="images/onoff.png"></div>
  </div>

  <div class="layout">

    <aside class="sidebar">
<style>
.filter-group { margin-bottom: 18px; }
.filter-group strong { font-size: 15px; display:block; margin-bottom:6px; }
.filter-group ul { list-style:none; padding-left:0; }
.filter-group li { display:flex; align-items:center; gap:8px; margin:6px 0; cursor:pointer; }
.filter-group input[type=checkbox] { width:16px; height:16px; cursor:pointer; }
.price-range { display:flex; align-items:center; gap:6px; }
.price-range input { width:80px; padding:4px 6px; border:1px solid #ccc; border-radius:4px; }
.apply-btn { background:#ee4d2d; color:#fff; padding:6px 10px; border:none; border-radius:4px; cursor:pointer; margin-top:8px; }
.apply-btn:hover { background:#d8431f; }
</style>
      <h3>Tất Cả Danh Mục</h3>
      <ul>
        <li data-category="vest">Áo Vest, Áo Khoác</li>
        <li data-category="thun">Áo Thun Nam</li>
        <li data-category="hoodie">Áo Hoodie, Áo Len & Áo Nỉ</li>
        <li data-category="jean">Quần Jean</li>
        <li data-category="quan-dai">Quần Dài Nam</li>
        <li data-category="polo">Áo Polo</li>
        <li data-category="so-mi">Áo Sơ Mi</li>
        <li data-category="phu-kien">Phụ Kiện Nam</li>
      </ul>

      <h3>Bộ Lọc Tìm Kiếm</h3>

<div class="filter-group">
<strong>Đơn Vị Vận Chuyển</strong>
<ul>
<li><input type="checkbox"> Hỏa Tốc</li>
<li><input type="checkbox"> Nhanh</li>
<li><input type="checkbox"> Tiết Kiệm</li>
</ul>
</div>

<div class="filter-group">
<strong>Thương Hiệu</strong>
<ul>
<li><input type="checkbox"> AVOCADO</li>
<li><input type="checkbox"> COOLMATE</li>
<li><input type="checkbox"> LEVI'S</li>
<li><input type="checkbox"> GENTLEMAN</li>
</ul>
</div>

<div class="filter-group">
<strong>Khoảng Giá</strong>
<div class="price-range">
<label>Từ</label>
<input type="text"> - <input type="text">
</div>
<button class="apply-btn">ÁP DỤNG</button>
</div>

<div class="filter-group">
<strong>Loại Shop</strong>
<ul>
<li><input type="checkbox"> Shopee Mall</li>
<li><input type="checkbox"> Shop Yêu Thích</li>
<li><input type="checkbox"> Shop Yêu Thích+</li>
</ul>
</div>

<div class="filter-group">
<strong>Tình Trạng</strong>
<ul>
<li><input type="checkbox"> Mới</li>
<li><input type="checkbox"> Đã Sử Dụng</li>
</ul>
</div>

<div class="filter-group">
<strong>Đánh Giá</strong>
<ul>
<li><input type="checkbox"> ⭐ trở lên</li>
<li><input type="checkbox"> ⭐⭐ trở lên</li>
<li><input type="checkbox"> ⭐⭐⭐ trở lên</li>
<li><input type="checkbox"> ⭐⭐⭐⭐ trở lên</li>
<li><input type="checkbox"> ⭐⭐⭐⭐⭐</li>
</ul>
</div>
</aside>

    <main>
      <div class="sort-bar">
        <span>Sắp xếp theo:</span>
        <button data-sort="popular">Phổ Biến</button>
        <button data-sort="new">Mới Nhất</button>
        <button data-sort="bestseller">Bán Chạy</button>
        <button data-sort="price">Giá</button>
      </div>

      <section class="products" id="product-list">
        <div class="product-card" data-category="thun">
          <img src="images/áo thun 1.png" />
          <div class="title">Áo Thun Nam Basic</div>
          <div class="price">₫50.000</div>
        </div>
        <div class="product-card" data-category="vest">
          <img src="images/áo thun 2.png" />
          <div class="title">Áo Vest Công Sở</div>
          <div class="price">₫320.000</div>
        </div>
        <div class="product-card" data-category="jean">
          <img src="images/áo thun nữ.png" />
          <div class="title">Quần Jean Nam</div>
          <div class="price">₫199.000</div>
        </div>
        <div class="product-card" data-category="hoodie">
          <img src="images/áo thun nữ 4.png" />
          <div class="title">Áo Hoodie Dày Dặn</div>
          <div class="price">₫150.000</div>
        </div>
      </section>
    </main>
  </div>

</div>

<script>
  const products = document.querySelectorAll('.product-card');
  const categories = document.querySelectorAll('.sidebar ul li[data-category]');

  categories.forEach(cat => {
    cat.addEventListener('click', () => {
      const type = cat.getAttribute('data-category');
      products.forEach(p => {
        p.style.display = p.getAttribute('data-category') === type ? 'block' : 'none';
      });
    });
  });
</script>
</body>
</html>
