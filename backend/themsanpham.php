<?php
require __DIR__ . '/../frontend/ketnoi.php'; 

$msg = '';
$MA_SP = 0;

// Lấy mã sản phẩm hiện tại
$res = $connect->query("SELECT MAX(MA_SP) AS maxid FROM sanpham");
$row = $res->fetch_assoc();
$MA_SP = ($row['maxid'] ?? 0) + 1;

// Hiển thị message sau redirect
if (isset($_GET['success'])) {
    $msg = "✅ Thêm sản phẩm thành công!";
}

// Khi submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $MA_DMSP = intval($_POST['MA_DMSP'] ?? 0);
    $TEN_SP  = trim($_POST['TEN_SP'] ?? '');
    $MOTA    = trim($_POST['MOTA'] ?? '');
    $GIA     = floatval($_POST['GIA'] ?? 0);
    $SL      = intval($_POST['SL_TONKHO'] ?? 0);

    // Upload ảnh
    $imgPath = null;
    if (!empty($_FILES['HINHANH']['name'])) {
        // Đường dẫn từ backend đến frontend/images/ (đã thêm / ở cuối)
        $uploadDir = __DIR__ . '/../frontend/images/';
        
        // Tạo thư mục nếu chưa có
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // Kiểm tra loại file
        $ext = pathinfo($_FILES['HINHANH']['name'], PATHINFO_EXTENSION);
        $allowedExt = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array(strtolower($ext), $allowedExt)) {
            $msg = "❌ Chỉ cho phép upload file ảnh (jpg, png, gif).";
        } elseif ($_FILES['HINHANH']['error'] !== UPLOAD_ERR_OK) {
            // Hiển thị lỗi upload cụ thể
            $uploadErrors = [
                UPLOAD_ERR_INI_SIZE => 'File quá lớn (upload_max_filesize).',
                UPLOAD_ERR_FORM_SIZE => 'File quá lớn (MAX_FILE_SIZE).',
                UPLOAD_ERR_PARTIAL => 'Upload không hoàn thành.',
                UPLOAD_ERR_NO_FILE => 'Không có file được chọn.',
                UPLOAD_ERR_NO_TMP_DIR => 'Thư mục tạm thời không tồn tại.',
                UPLOAD_ERR_CANT_WRITE => 'Không thể ghi file.',
                UPLOAD_ERR_EXTENSION => 'Upload bị chặn bởi extension.',
            ];
            $msg = "❌ Lỗi upload: " . ($uploadErrors[$_FILES['HINHANH']['error']] ?? 'Lỗi không xác định.');
        } else {
            // Tạo tên file duy nhất
            $name = time() . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
            $savePath = $uploadDir . $name;  // Đường dẫn đầy đủ đến file
            
            // Di chuyển file
            if (move_uploaded_file($_FILES['HINHANH']['tmp_name'], $savePath)) {
                $imgPath = $name;  // Lưu tên file vào DB
                $msg = "✅ Upload ảnh thành công!";
            } else {
                $msg = "❌ Lỗi di chuyển file. Kiểm tra quyền thư mục: $uploadDir";
            }
        }
    } else {
        $msg = "⚠️ Không có ảnh được chọn.";
    }

    // Insert vào DB (chỉ nếu không có lỗi upload nghiêm trọng)
    if ($imgPath !== null || empty($_FILES['HINHANH']['name'])) {  // Cho phép insert nếu không upload ảnh
        $stmt = $connect->prepare("
            INSERT INTO sanpham 
            (MA_SP, MA_DMSP, TEN_SP, MOTA, GIA, SL_TONKHO, HINHANH, NGAYDANG)
            VALUES (?, ?, ?, ?, ?, ?, ?, NOW())
        ");

        $stmt->bind_param("iissdis", $MA_SP, $MA_DMSP, $TEN_SP, $MOTA, $GIA, $SL, $imgPath);

        if ($stmt->execute()) {
            // ✅ REDIRECT để tránh F5 tự thêm lại
            header("Location: " . $_SERVER['PHP_SELF'] . "?success=1");
            exit();
        } else {
            $msg = "❌ Lỗi DB: " . $stmt->error;
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Thêm sản phẩm</title>

<style>
    body {
        background: #f5f6f8;
        font-family: Arial;
    }
    .container {
        width: 480px;
        background: white;
        margin: 40px auto;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    }
    h2 { text-align: center; margin-bottom: 20px; }
    label { display:block; margin:10px 0 5px; }
    input, textarea {
        width: 100%;
        padding: 10px;
        border-radius: 8px;
        border: 1px solid #ddd;
    }
    input[type=submit] {
        background: #ee4d2d;
        color: white;
        border: none;
        margin-top: 15px;
        font-weight: bold;
        cursor: pointer;
    }
    input[type=submit]:hover {
        opacity: 0.9;
    }
    .preview {
        max-width: 150px;
        margin-top: 10px;
        display: block;
    }
    .msg {
        text-align: center;
        font-weight: bold;
        color: green;
        margin-bottom: 10px;
    }
</style>

</head>
<body>

<div class="container">

<h2>Thêm sản phẩm</h2>

<?php if($msg): ?>
    <p id="msg" class="msg"><?php echo $msg; ?></p>

<script>
setTimeout(() => {
    const msg = document.getElementById('msg');
    if(msg) msg.style.display = 'none';
}, 3000);
</script>
<?php endif; ?>

<p>Mã sản phẩm kế tiếp: <b><?php echo $MA_SP; ?></b></p>

<form method="post" enctype="multipart/form-data">
    
    <label>Mã danh mục</label>
    <input type="number" name="MA_DMSP" required>
    
    <label>Tên sản phẩm</label>
    <input type="text" name="TEN_SP" required>

    <label>Mô tả</label>
    <textarea name="MOTA"></textarea>

    <label>Giá</label>
    <input type="number" step="0.01" name="GIA" required>

    <label>Số lượng tồn kho</label>
    <input type="number" name="SL_TONKHO" required>

    <label>Ảnh sản phẩm</label>
    <input type="file" name="HINHANH" accept="image/*" onchange="previewImg(event)">

    <img id="preview" class="preview">

    <input type="submit" value="Thêm sản phẩm">

</form>

</div>

<script>
function previewImg(event) {
    const reader = new FileReader();
    reader.onload = function(){
        document.getElementById('preview').src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}
</script>

</body>
</html>