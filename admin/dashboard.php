<?php
include_once ('../components/connect.php');

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bảng điều khiển</title>

    <!-- Link icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="../css/admin_style.css">
</head>

<body>
    <?php include_once ('../components/admin_header.php') ?>

    <!-- Begin: bảng điều khiển -->
    <section class="dashboard">
        <h1 class="heading">Bảng điều khiển</h1>

        <div class="box-container">
            <!-- Begin: Xin chào ! -->
            <div class="box">
                <h3>Xin chào!</h3>
                <p><?= $fetch_profile['tentk'];?></p>
                <a href="update_profile.php" class="btn">Cập nhật</a>
            </div>
            <!-- End: Xin chào ! -->

            <!-- Begin: Tổng đơn chưa xử lý -->
            <div class="box">
                <?php
         $total_pendings = 0;
         $select_pendings = $conn->prepare("SELECT * FROM `donhang` WHERE tinhtrang = ?");
         $select_pendings->execute(['chưa xử lý']);
         while($fetch_pendings = $select_pendings->fetch(PDO::FETCH_ASSOC)){
            $total_pendings += $fetch_pendings['tongdonhang'];
         }
      ?>
                <h3><?= number_format($total_pendings,0,',','.'); ?><span> đ</span> / <?= $select_pendings -> rowCount() ?></h3>
                <p>Tổng đơn chưa xử lý</p>
                <a href="pending_orders.php" class="btn">Xem đơn hàng</a>
            </div>
        <!-- End: Tổng đơn chưa xử lý -->

        <!-- Begin: Tổng đơn đã xử lý -->
            <div class="box">
                <?php
         $total_completes = 0;
         $select_completes = $conn->prepare("SELECT * FROM `donhang` WHERE tinhtrang = ?");
         $select_completes->execute(['đã xử lý']);
         while($fetch_completes = $select_completes->fetch(PDO::FETCH_ASSOC)){
            $total_completes += $fetch_completes['tongdonhang'];
         }
      ?>
                <h3><?= number_format($total_completes,0,',','.'); ?><span> đ</span> / <?= $select_completes -> rowCount() ?></h3>
                <p>Tổng số đơn đã xử lý</p>
                <a href="complete_orders.php" class="btn">Xem đơn hàng</a>
            </div>
        <!-- End: Tổng đơn đã xử lý -->

        <!-- Begin: Tổng số đơn đặt hàng -->
            <div class="box">
                <?php
         $select_orders = $conn->prepare("SELECT * FROM `donhang`");
         $select_orders->execute();
         $numbers_of_orders = $select_orders->rowCount();
      ?>
                <h3><?= $numbers_of_orders; ?></h3>
                <p>Tổng số đơn đặt hàng</p>
                <a href="placed_orders.php" class="btn">Xem đơn hàng</a>
            </div>
        <!-- End: Tổng số đơn đặt hàng -->

        <!-- Begin: Thực đơn -->
            <div class="box">
                <?php
         $select_products = $conn->prepare("SELECT * FROM `sanpham`");
         $select_products->execute();
         $numbers_of_products = $select_products->rowCount();
      ?>
                <h3><?= $numbers_of_products; ?></h3>
                <p>Thực đơn</p>
                <a href="products.php" class="btn">Xem thực đơn</a>
            </div>
        <!-- End: Thực đơn -->

        <!-- Begin: Tài khoản khách hàng -->
            <div class="box">
                <?php
         $select_users = $conn->prepare("SELECT * FROM `khachhang`");
         $select_users->execute();
         $numbers_of_users = $select_users->rowCount();
      ?>
                <h3><?= $numbers_of_users; ?></h3>
                <p>Tài khoản khách hàng</p>
                <a href="users_accounts.php" class="btn">Xem tài khoản</a>
            </div>
        <!-- End: Tài khoản khách hàng -->

        <!-- Begin: Tài khoản admin -->
            <div class="box">
                <?php
         $select_admins = $conn->prepare("SELECT * FROM `admin`");
         $select_admins->execute();
         $numbers_of_admins = $select_admins->rowCount();
      ?>
                <h3><?= $numbers_of_admins; ?></h3>
                <p>admins</p>
                <a href="admin_accounts.php" class="btn">Xem Admins</a>
            </div>
        <!-- End: Tài khoản admin -->

        <!-- Begin: Tin nhắn -->
            <div class="box">
                <?php
         $select_messages = $conn->prepare("SELECT * FROM `tinnhan`");
         $select_messages->execute();
         $numbers_of_messages = $select_messages->rowCount();
      ?>
                <h3><?= $numbers_of_messages; ?></h3>
                <p>tin nhắn mới</p>
                <a href="messages.php" class="btn">Xem tin nhắn</a>
            </div>
        </div>
        <!-- End: Tin nhắn -->
    </section>
    <!-- End: bảng điều khiển -->

    <!-- js -->
    <script src="../js/admin_script.js"></script>
</body>

</html>