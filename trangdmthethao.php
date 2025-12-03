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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css"> <!-- Thêm cho icon -->

  <style>
    /* Giữ nguyên toàn bộ CSS của bạn */
    body { margin: 0; font-family: Arial, sans-serif; background: #f5f5f5; }
    .site { max-width: 1500px; margin: auto; padding: 16px; background: #fff; }
    .banner img { width: 100%; border-radius: 8px; }
    .layout { display: grid; grid-template-columns: 250px 1fr; gap: 20px; margin-top: 20px; }

    .sidebar { background: #fff; border-radius: 8px; padding: 16px; height: fit-content; }
    ul li { cursor: pointer; }

    .sort-bar { background: #fff; padding: 12px; border-radius: 8px; display: flex; align-items: center; gap: 12px; margin-bottom: 20px; flex-wrap: wrap; }
    .sort-bar button { background: #fff; border: 1px solid #ccc; padding: 6px 12px; border-radius: 4px; cursor: pointer; transition: background 0.2s; }
    .sort-bar button:hover, .sort-bar button.active { background: #ee4d2d; color: #fff; }

    .brand-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 12px; margin-top: 20px; }
    .brand-box { border: 1px solid #eee; padding: 10px; text-align: center; border-radius: 6px; background: #fff; transition: .15s; }
    .brand-box:hover { border-color: #ee4d2d; transform: translateY(-2px); }
    .brand-box img { width: 100%; height: 60px; object-fit: contain; }

    .products { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 16px; }
    .product-card { background: #fff; border-radius: 8px; padding: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); cursor: pointer; transition: .15s; position: relative; }
    .product-card:hover { box-shadow: 0 4px 8px rgba(0,0,0,0.2); }
    .product-card img { width: 100%; height: 180px; object-fit: cover; border-radius: 6px; }
    .title { font-size: 14px; line-height: 1.3; height: 36px; overflow: hidden; }
    .price { color: #ee4d2d; font-weight: bold; }
    .buy-now-btn { position: absolute; bottom: 12px; right: 12px; background: #ee4d2d; color: #fff; border: none; padding: 6px 10px; border-radius: 4px; cursor: pointer; opacity: 0; transition: opacity 0.3s; }
    .product-card:hover .buy-now-btn { opacity: 1; }
    .buy-now-btn:hover { background: #d8431f; }

    @media (max-width: 768px) {
      .layout { grid-template-columns: 1fr; }
      .brand-grid { grid-template-columns: repeat(2, 1fr); }
      .sort-bar { flex-direction: column; align-items: flex-start; }
    }

    .filter-group { margin-bottom: 18px; }
    .filter-group strong { font-size: 15px; display:block; margin-bottom:6px; }
    .filter-group ul { list-style:none; padding-left:0; }
    .filter-group li { display:flex; align-items:center; gap:8px; margin:6px 0; cursor:pointer; }
    .filter-group input[type=checkbox] { width:16px; height:16px; cursor:pointer; }
    .price-range { display:flex; align-items:center; gap:6px; }
    .price-range input { width:80px; padding:4px 6px; border:1px solid #ccc; border-radius:4px; }
    .apply-btn { background:#ee4d2d; color:#fff; padding:6px 10px; border:none; border-radius:4px; cursor:pointer; margin-top:8px; transition: background 0.2s; }
    .apply-btn:hover { background:#d8431f; }
  </style>
</head>
<body>
<div class="site">

  <div class="banner">
    <img src="images/sansaledm.png" alt="Banner khuyến mãi Shopee">
  </div>

  <div class="brand-grid">
    <div class="brand-box">PRAZA <img src="logo/praza.png" alt="Logo PRAZA"></div>
    <div class="brand-box">SUNNY VALI <img src="logo/sunnyvali.png" alt="Logo SUNNY VALI"></div>
    <div class="brand-box">DECATHLON <img src="logo/decathlon.png" alt="Logo DECATHLON"></div>
    <div class="brand-box">POPO <img src="logo/popo.png" alt="Logo POPO"></div>
    <div class="brand-box">ONETWOFIT <img src="logo/one.png" alt="Logo ONETWOFIT"></div>
    <div class="brand-box">CERA-Y <img src="logo/cera.png" alt="Logo CERA-Y"></div>
    <div class="brand-box">ANTA <img src="logo/anta.png" alt="Logo ANTA"></div>
    <div class="brand-box">LAZA <img src="logo/laza.png" alt="Logo LAZA"></div>
    <div class="brand-box">PEAK VIETNAM <img src="logo/peak.png" alt="Logo PEAK VIETNAM"></div>
    <div class="brand-box">SUPER SPORTS <img src="logo/super.png" alt="Logo SUPER SPORTS"></div>
    <div class="brand-box">MACK'S <img src="logo/mack.png" alt="Logo MACK'S"></div>
    <div class="brand-box">ADIDAS <img src="logo/adidas.png" alt="Logo ADIDAS"></div>
  </div>

  <div class="layout">

    <aside class="sidebar" role="complementary" aria-label="Bộ lọc sản phẩm">
      <h3>Tất Cả Danh Mục</h3>
      <ul>
        <li data-category="dungcu">Dụng cụ thể thao</li>
        <li data-category="phukien">Phụ kiện thể thao</li>
        <li data-category="aoquan">Quần áo thể thao</li>
        <li data-category="hotro">Dụng cụ hỗ trợ</li>
      </ul>

      <h3>Bộ Lọc Tìm Kiếm</h3>

      <div class="filter-group">
        <strong>Đơn Vị Vận Chuyển</strong>
        <ul>
          <li><input type="checkbox" data-filter="shipping" value="Hỏa Tốc"> Hỏa Tốc</li>
          <li><input type="checkbox" data-filter="shipping" value="Nhanh"> Nhanh</li>
          <li><input type="checkbox" data-filter="shipping" value="Tiết Kiệm"> Tiết Kiệm</li>
        </ul>
      </div>

      <div class="filter-group">
        <strong>Thương Hiệu</strong>
        <ul>
          <li><input type="checkbox" data-filter="brand" value="Adidas"> Adidas</li>
          <li><input type="checkbox" data-filter="brand" value="Fitme"> Fitme</li>
          <li><input type="checkbox" data-filter="brand" value="Nike"> Nike</li>
          <li><input type="checkbox" data-filter="brand" value="Yonex"> Yonex</li>
        </ul>
      </div>

      <div class="filter-group">
        <strong>Khoảng Giá</strong>
        <div class="price-range">
          <label>Từ</label>
          <input type="number" min="0" placeholder="0"> - <input type="number" min="0" placeholder="Max">
        </div>
        <button class="apply-btn">ÁP DỤNG</button>
      </div>

      <div class="filter-group">
        <strong>Loại Shop</strong>
        <ul>
          <li><input type="checkbox" data-filter="shop-type" value="Shopee Mall"> Shopee Mall</li>
          <li><input type="checkbox" data-filter="shop-type" value="Shop Yêu Thích"> Shop Yêu Thích</li>
          <li><input type="checkbox" data-filter="shop-type" value="Shop Yêu Thích+"> Shop Yêu Thích+</li>
        </ul>
      </div>

      <div class="filter-group">
        <strong>Tình Trạng</strong>
        <ul>
          <li><input type="checkbox" data-filter="condition" value="Mới"> Mới</li>
          <li><input type="checkbox" data-filter="condition" value="Đã Sử Dụng"> Đã Sử Dụng</li>
        </ul>
      </div>

      <div class="filter-group">
        <strong>Đánh Giá</strong>
        <ul>
          <li><input type="checkbox" data-filter="rating" value="1"> ⭐ trở lên</li>
          <li><input type="checkbox" data-filter="rating" value="2"> ⭐⭐ trở lên</li>
          <li><input type="checkbox" data-filter="rating" value="3"> ⭐⭐⭐ trở lên</li>
          <li><input type="checkbox" data-filter="rating" value="4"> ⭐⭐⭐⭐ trở lên</li>
          <li><input type="checkbox" data-filter="rating" value="5"> ⭐⭐⭐⭐⭐</li>
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
        <!-- Thêm onclick cho toàn bộ product-card để chuyển đến đặt mua -->
        <div class="product-card" data-category="dungcu" data-ma-sp="1" data-price="750000" data-brand="Adidas" data-rating="4" data-shipping="Nhanh" data-condition="Mới" data-shop-type="Shopee Mall" onclick="buyNow(1)">
          <img src="images/thể thao1.png" alt="Kumpoo Sakura" />
          <div class="title">Kumpoo Sakura</div>
          <div class="price">₫750.000</div>
          <button class="buy-now-btn" onclick="event.stopPropagation(); buyNow(1)">
            <i class="bi bi-cart-check"></i> Đặt mua
          </button>
        </div>
        <div class="product-card" data-category="phukien" data-ma-sp="2" data-price="320000" data-brand="Nike" data-rating="5" data-shipping="Hỏa Tốc" data-condition="Mới" data-shop-type="Shop Yêu Thích" onclick="buyNow(2)">
          <img src="images/thể thao 2.png" alt="Giày bóng đã" />
          <div class="title">Giày bóng đã</div>
          <div class="price">₫320.000</div>
          <button class="buy-now-btn" onclick="event.stopPropagation(); buyNow(2)">
            <i class="bi bi-cart-check"></i> Đặt mua
          </button>
        </div>
        <div class="product-card" data-category="dungcu" data-ma-sp="3" data-price="200000" data-brand="Yonex" data-rating="3" data-shipping="Tiết Kiệm" data-condition="Đã Sử Dụng" data-shop-type="Shopee Mall" onclick="buyNow(3)">
          <img src="images/thể thao 3.png" alt="Bóng chuyền Thăng Long" />
          <div class="title">Bóng chuyền Thăng Long</div>
          <div class="price">₫200.000</div>
          <button class="buy-now-btn" onclick="event.stopPropagation(); buyNow(3)">
            <i class="bi bi-cart-check"></i> Đặt mua
          </button>
        </div>
        <div class="product-card" data-category="phukien" data-ma-sp="4" data-price="150000" data-brand="Fitme" data-rating="4" data-shipping="Nhanh" data-condition="Mới" data-shop-type="Shop Yêu Thích+" onclick="buyNow(4)">
          <img src="images/thể thao 4.png" alt="Kính lặn" />
          <div class="title">Kính lặn</div>
          <div class="price">₫150.000</div>
          <button class="buy-now-btn" onclick="event.stopPropagation(); buyNow(4)">
            <i class="bi bi-cart-check"></i> Đặt mua
          </button>
        </div>
      </section>
    </main>
  </div>

</div>

<script>
  const products = document.querySelectorAll('.product-card');
  const categories = document.querySelectorAll('.sidebar ul li[data-category]');
  const productCards = document.querySelectorAll('.product-card');
  const sortButtons = document.querySelectorAll('.sort-bar button');
  const applyBtn = document.querySelector('.apply-btn');
  const checkboxes = document.querySelectorAll('input[type="checkbox"]');

  // Hàm buyNow: Chuyển đến chiTietSanPham.php với buy_now=1 (kích hoạt đặt mua)
  function buyNow(ma_sp) {
    window.location.href = 'chiTietSanPham.php?MA_SP=' + ma_sp + '&buy_now=1';
  }

  // Hàm áp dụng filters (kết hợp tất cả)
  function applyFilters() {
    const selectedShipping = Array.from(document.querySelectorAll('input[data-filter="shipping"]:checked')).map(cb => cb.value);
    const selectedBrands = Array.from(document.querySelectorAll('input[data-filter="brand"]:checked')).map(cb => cb.value);
    const selectedShopTypes = Array.from(document.querySelectorAll('input[data-filter="shop-type"]:checked')).map(cb => cb.value);
    const selectedConditions = Array.from(document.querySelectorAll('input[data-filter="condition"]:checked')).map(cb => cb.value);
    const selectedRatings = Array.from(document.querySelectorAll('input[data-filter="rating"]:checked')).map(cb => cb.value);
    const minPrice = parseInt(document.querySelector('.price-range input:first-child').value) || 0;
    const maxPrice = parseInt(document.querySelector('.price-range input:last-child').value) || Infinity;

    productCards.forEach(card => {
      const shipping = card.getAttribute('data-shipping');
      const brand = card.getAttribute('data-brand');
      const shopType = card.getAttribute('data-shop-type');
      const condition = card.getAttribute('data-condition');
      const rating = parseInt(card.getAttribute('data-rating'));
      const price = parseInt(card.getAttribute('data-price'));

      const matchesShipping = selectedShipping.length === 0 || selectedShipping.includes(shipping);
      const matchesBrand = selectedBrands.length === 0 || selectedBrands.includes(brand);
      const matchesShopType = selectedShopTypes.length === 0 || selectedShopTypes.includes(shopType);
      const matchesCondition = selectedConditions.length === 0 || selectedConditions.includes(condition);
      const matchesRating = selectedRatings.length === 0 || selectedRatings.some(r => rating >= parseInt(r));
      const matchesPrice = price >= minPrice && price <= maxPrice;

      if (matchesShipping && matchesBrand && matchesShopType && matchesCondition && matchesRating && matchesPrice) {
        card.style.display = 'block';
      } else {
        card.style.display = 'none';
      }
    });
  }

  // Event listeners
  categories.forEach(li => {
    li.addEventListener('click', () => {
      const category = li.getAttribute('data-category');
      productCards.forEach(card => {
        if (card.getAttribute('data-category') === category) {
          card.style.display = 'block';
        } else {
          card.style.display = 'none';
        }
      });
    });
  });

  sortButtons.forEach(btn => {
    btn.addEventListener('click', () => {
      const sortBy = btn.getAttribute('data-sort');
      // Thêm logic sắp xếp nếu cần (ví dụ: sắp xếp theo giá)
      // Hiện tại chỉ là placeholder
    });
  });

  applyBtn.addEventListener('click', applyFilters);

  checkboxes.forEach(cb => {
    cb.addEventListener('change', applyFilters);
  });
</script>
</body>
</html>