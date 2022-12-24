<?php
if (isset($messages)) {
    foreach ($messages as $messages) {
        echo '
            <div class="message">
                <span>'.$messages.'</span>
                <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
            </div>
            ';
    }
}
?>

<!-- Begin: header -->
<header class="header">
    <section class="flex">
        <a href="home.php" class="logo">yum yum 😋</a>

        <nav class="navbar">
            <a href="home.php">Trang Chủ</a>
            <a href="about.php">Giới Thiệu</a>
            <a href="menu.php">Thực Đơn</a>
            <a href="orders.php">Đặt Hàng</a>
            <a href="contact.php">Liên Hệ</a>
        </nav>

        <div class="icons">
            <?php 
                // truy vấn 
                $count_user_cart_items = $conn -> prepare('SELECT * from `giohang` WHERE idkh = ?');
                // gán giá trị và thực thi
                $count_user_cart_items -> execute([$user_id]);
                $total_user_cart_items = $count_user_cart_items -> rowCount();
            ?>
            <a href="search.php"><i class="fas fa-search"></i></a>
            <a href="cart.php">
                <i class="fas fa-shopping-cart"></i><span>(<?= $total_user_cart_items; ?>)</span>
            </a>
            <div id="user-btn" class="fas fa-user"></div>
            <div id="menu-btn" class="fas fa-bars"></div>
        </div>

        <div class="profile">
            <?php 
            $select_profile = $conn->prepare('SELECT * FROM `khachhang` WHERE idkh = ?');
            $select_profile -> execute([$user_id]);
            if ($select_profile -> rowCount() > 0) {
                // Trả về dữ liệu dạng mảng với key là tên của column (column của các table trong database)
                $fetch_profile = $select_profile -> fetch(PDO::FETCH_ASSOC);
        
            ?>
            <p class="name"><?= $fetch_profile['tenkh'] ?></p>

            <a href="profile.php" class="btn">Trang Cá Nhân</a>
            <a href="components/user_logout.php" class="delete-btn"
                onclick="return confirm ('Bạn muốn đăng xuất?')">Thoát</a>
            <p class="account">
                <a href="login.php" class="">Đăng Nhập</a>
                <span>hoặc</span>
                <a href="register.php" class="">Đăng Ký</a>
            </p>
            <?php
            } else {
             ?>
            <p class="name">Vui lòng đăng nhập trước 😑</p>
            <a href="login.php" class="btn">Đăng Nhập</a>
            <?php 
            }
            ?>
        </div>
    </section>

</header>
<!-- End: header -->