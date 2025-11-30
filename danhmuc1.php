<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Danh Mục</title>
<style>
    .category-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(110px, 1fr));
  gap: 15px 10px;
  align-items: center;
}

.category-item {
  display: flex;
  flex-direction: column;
  align-items: center;
  color: #222;
  transition: color 0.3s ease;
}

.category-item:hover {
  color: #ff5722;
}

.category-icon {
  width: 70px;
  height: 70px;
  margin-bottom: 8px;
  border-radius: 50%;
  background: #fff;
  display: flex;
  justify-content: center;
  align-items: center;
  box-shadow: 0 1px 6px rgba(0,0,0,0.1);
  transition: box-shadow 0.3s ease;
}

.category-icon img {
  max-width: 100px;
  max-height:100px;
  object-fit: contain;
  border-radius: 50%;
}

.category-item:hover .category-icon {
  box-shadow: 0 2px 12px rgba(255, 87, 34, 0.5);
}

.category-name {
  font-size: 13px;
  font-weight: 600;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  max-width: 100px;
}
</style>
<body>
<!-- Danh mục sản phẩm -->
  <?php
// Mảng ánh xạ mã thể loại đến tên file icon
$iconMap = [
    13 => 'thoitrang.jpg',
    14 => 'suckhoe.jpg',
    15 => 'thethao.jpg',
    16 => 'thietbidientu.jpg',
    17 => 'sacdep.jpg',      // Nếu có thêm thể loại thêm ở đây
];

// Lấy danh mục từ DB
    $sqltheloai = "SELECT * FROM theloai";
    $ketquatheloai = mysqli_query($connect, $sqltheloai);
    ?>

    <div class="container-xl my-4">
      <h4 class="mb-3" style="border-bottom: 2px solid #ddd; padding-bottom: 8px;">DANH MỤC</h4>
      <div class="category-grid">
        <?php
          while($row = mysqli_fetch_assoc($ketquatheloai)){
            $id = intval($row['matheloai']);
            $tentheloai = htmlspecialchars($row['tentheloai']);
            $iconFile = isset($iconMap[$id]) ? $iconMap[$id] : 'default.jpg'; // Ảnh mặc định nếu chưa có
            $iconPath = "hinhanh/icons/" . $iconFile;
            // Xác định link dựa trên id
        if ($id == 13) {
          // Trang riêng cho thời trang
          $link = 'trangdmthoitrang.php'; }
        elseif  ($id == 14) {
          // Trang riêng cho thời trang
          $link = 'trangdmsuckhoe.php'; }
        elseif  ($id == 15) {
          // Trang riêng cho thời trang
          $link = 'trangdmthethao.php'; }
        elseif ($id == 16) {
          // Trang riêng cho thời trang
          $link = 'trangdmtbdt.php'; }
        elseif  ($id == 17) {
          // Trang riêng cho thời trang
          $link = 'trangdmsacdep.php'; }
          

        else {
          // Giữ nguyên cho các thể loại khác
          $link = 'trangchu.php?idTheLoai=' . $id;
        }

            echo "
              <a href='$link' class='category-item text-center text-decoration-none'>
                <div class='category-icon'>
                  <img src='$iconPath' alt='$tentheloai' />
                </div>
                <div class='category-name'>$tentheloai</div>
              </a>
            ";
          }
        ?>
      </div>
    </div>
      <!--Kết thúc danh mục-->
        </body>
    </html>