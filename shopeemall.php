<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Shopee Mall - Demo</title>
<style>
  body {
    font-family: 'Arial', sans-serif;
    background-color: #f5f5f5;
    margin: 0;
    padding: 20px;
  }
  .shopee-mall-wrapper {
    max-width: 1200px;
    margin: 0 auto;
    background: white;
    padding: 20px;
    border-radius: 6px;
  }
  .shopee-mall-header {
    display: flex;
    align-items: center;
    font-weight: 700;
    font-size: 14px;
    color: #ea4d2d;
    margin-bottom: 15px;
  }
  .shopee-mall-header span {
    margin-right: 15px;
    display: flex;
    align-items: center;
  }
  .shopee-mall-header .separator {
    width: 4px;
    height: 4px;
    background-color: #ea4d2d;
    border-radius: 50%;
    margin: 0 8px;
  }
  .shopee-mall-header .view-all {
    margin-left: auto;
    font-weight: normal;
    font-size: 13px;
    cursor: pointer;
    color: #ea4d2d;
  }
  .shopee-mall-content {
    display: flex;
    gap: 20px;
  }
  .promo-banner {
    width: 300px;
    height: 300px;
    background: radial-gradient(circle at center, #ff6f00, #f44336);
    color: white;
    border-radius: 8px;
    position: relative;
    font-weight: 700;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    padding: 20px;
    box-shadow: 0 3px 8px rgba(0,0,0,0.15);
  }
  .promo-banner .shopee-logo {
    background: white;
    color: #ff6f00;
    font-weight: 700;
    font-size: 20px;
    padding: 6px 12px;
    margin-bottom: 15px;
    border-radius: 20px;
  }
  .promo-banner .headline {
    font-size: 28px;
    margin-bottom: 12px;
  }
  .promo-banner .subheadline {
    font-size: 18px;
    margin-bottom: 15px;
  }
  .promo-banner .voucher-text {
    font-size: 16px;
    background-color: #ff8533;
    padding: 8px 16px;
    border-radius: 20px;
    margin: 5px 0;
  }
  .products-list {
    flex-grow: 1;
    display: flex;
    flex-wrap: wrap;
    gap: 18px;
  }
  .product-item {
    width: 120px;
    background: #fff;
    border-radius: 6px;
    box-shadow: 0 1px 3px rgb(0 0 0 / 0.1);
    padding: 10px;
    text-align: center;
    cursor: pointer;
  }
  .product-item img {
    max-width: 80px;
    height: 80px;
    object-fit: contain;
    margin-bottom: 8px;
  }
  .product-name {
    font-size: 13px;
    font-weight: 600;
    margin-bottom: 4px;
    color: #333;
  }
  .promo-text {
    font-size: 12px;
    color: #ea4d2d;
  }
</style>
</head>
<body>

<div class="shopee-mall-wrapper">
  <div class="shopee-mall-header">
    <span>SHOPEE MALL</span>
    <div class="separator"></div>
    <span>Trả Hàng Miễn Phí 15 Ngày</span>
    <div class="separator"></div>
    <span>Hàng Chính Hãng 100%</span>
    <div class="separator"></div>
    <span>Miễn Phí Vận Chuyển</span>
    <div class="view-all">Xem Tất Cả &gt;</div>
  </div>
  <div class="shopee-mall-content">
    <div class="promo-banner">
      <div class="shopee-logo">Shopee</div>
      <div class="headline">SĂN DEAL</div>
      <div class="headline" style="font-size:36px;">SIÊU HOT</div>
      <div class="subheadline">GIẢM ĐẾN 50%</div>
      <div class="voucher-text">VOUCHER SHOPEE</div>
      <div class="voucher-text">VOUCHER SHOP</div>
    </div>
    <div class="products-list">
      <div class="product-item">
        <img src="imgshpmall/loreal.jpg" alt="L'Oreal" />
        <div class="product-name">L'OREAL</div>
        <div class="promo-text">Ưu đãi đến 50%</div>
      </div>
      <div class="product-item">
        <img src="imgshpmall/cocoon.jpg" alt="Cocoon" />
        <div class="product-name">Cocoon</div>
        <div class="promo-text">Mua 1 tặng 1</div>
      </div>
      <div class="product-item">
        <img src="imgshpmall/unilever.jpg" alt="Unilever" />
        <div class="product-name">Unilever</div>
        <div class="promo-text">Mua 1 tặng 1</div>
      </div>
      <div class="product-item">
        <img src="imgshpmall/thienlong.jpg" alt="Thiên Long" />
        <div class="product-name">THIÊN LONG</div>
        <div class="promo-text">Giảm đến 50%</div>
      </div>
      <div class="product-item">
        <img src="imgshpmall/unilever1.jpg" alt="Unilever" />
        <div class="product-name">Unilever</div>
        <div class="promo-text">Mua 1 được 2</div>
      </div>
      <div class="product-item">
        <img src="imgshpmall/unilever2.jpg" alt="Unilever" />
        <div class="product-name">Unilever</div>
        <div class="promo-text">Mua 1 tặng 1</div>
      </div>
      <div class="product-item">
        <img src="imgshpmall/posay.jpg" alt="La Roche Posay" />
        <div class="product-name">LA ROCHE-POSAY</div>
        <div class="promo-text">Quà mọi đơn</div>
      </div>
      <div class="product-item">
        <img src="imgshpmall/watsons.jpg" alt="Watsons" />
        <div class="product-name">Watsons</div>
        <div class="promo-text">Mua là có quà</div>
      </div>
    </div>
  </div>
</div>

</body>
</html>
