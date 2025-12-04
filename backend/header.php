<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Header Shopee</title>

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

  /* USER */
  .user {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    color: #444;
    position: relative;
    cursor: pointer;
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

  /* DROPDOWN (hidden by default, use opacity/transform for smooth animation) */
  .dropdown-user {
    position: absolute;
    top: 42px; /* nằm ngay dưới avatar + mũi tên */
    right: 0;
    background: #fff;
    width: 150px;
    border: 1px solid #eee;
    border-radius: 6px;
    box-shadow: 0 6px 18px rgba(0,0,0,0.08);
    padding: 8px 0;
    z-index: 1000;

    /* hidden */
    opacity: 0;
    transform: translateY(-6px);
    visibility: hidden;
    transition: opacity 160ms ease, transform 160ms ease, visibility 160ms;
    pointer-events: none;
  }

  /* when visible */
  .dropdown-user.show,
  .user:hover .dropdown-user { /* hover cũng mở */
    opacity: 1;
    transform: translateY(0);
    visibility: visible;
    pointer-events: auto;
  }

  .dropdown-user a {
    display: block;
    padding: 5px 16px;
    color: #555;
    font-size: 14px;
    text-decoration: none;
  }

  .dropdown-user a:hover {
    background: #f5f5f5;
    color: #ee4d2d;
  }

  /* optional: make the username text not selectable when clicking */
  .user span {
    user-select: none;
  }
</style>

</head>
<body>

<header>
  <div class="logo">
    <img src="../frontend/shopee.jpg" alt="Shopee logo" />
    Đăng ký người bán Shopee
  </div>

  <div class="user" id="userMenu" aria-haspopup="true" aria-expanded="false">
    <div class="avatar" aria-hidden="true">👤</div>
    <span>1bw3d7e77v ▼</span>

    <div class="dropdown-user" id="dropdownUser" role="menu" aria-hidden="true">
      <a href="../frontend/dangNhap bảng mới nhất.php" role="menuitem">Đăng xuất</a>

    </div>
  </div>
</header>

<script>
  const userMenu = document.getElementById("userMenu");
  const dropdown = document.getElementById("dropdownUser");

  // Toggle bằng click: thêm/bỏ class 'show'
  userMenu.addEventListener("click", (e) => {
    e.stopPropagation(); // tránh click lan ra ngoài
    const isShown = dropdown.classList.toggle("show");
    // Cập nhật aria
    userMenu.setAttribute("aria-expanded", isShown ? "true" : "false");
    dropdown.setAttribute("aria-hidden", isShown ? "false" : "true");
  });

  // Ẩn khi click ra ngoài
  document.addEventListener("click", function (event) {
    if (!userMenu.contains(event.target)) {
      if (dropdown.classList.contains("show")) {
        dropdown.classList.remove("show");
        userMenu.setAttribute("aria-expanded", "false");
        dropdown.setAttribute("aria-hidden", "true");
      }
    }
  });

  // Ẩn khi nhấn Esc
  document.addEventListener("keydown", function (e) {
    if (e.key === "Escape") {
      if (dropdown.classList.contains("show")) {
        dropdown.classList.remove("show");
        userMenu.setAttribute("aria-expanded", "false");
        dropdown.setAttribute("aria-hidden", "true");
      }
    }
  });
</script>

</body>
</html>
