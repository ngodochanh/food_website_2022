<?php

include_once ('components/connect.php');

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('Location:home.php');
};

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt Hàng</title>
    <!-- Link icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <!-- CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>

<body>
    <!-- Begin: header -->
    <?php require_once('components/user_header.php') ?>
    <!-- End: header -->

    <!-- Begin: heading -->
    <div class="heading">
        <h3>Đặt hàng</h3>
        <p>
            <a href="home.php">Trang Chủ</a>
            <span>/ đặt hàng</span>
        </p>
    </div>
    <!-- End: heading -->

    <!-- Begin: đặt hàng -->
    <section class="orders">
        <h1 class="title">Đơn Hàng Của Bạn</h1>

        <div class="box-container">
            <?php 
                $select_orders = $conn -> prepare("SELECT * FROM `donhang` WHERE idkh = ? ORDER BY `iddonhang` DESC");
                $select_orders -> execute([$user_id]);
                if ($select_orders -> rowCount() > 0) {
                    while($fetch_orders = $select_orders -> fetch(PDO::FETCH_ASSOC)) {
                        ?>
            <div class="box">
                <p>
                    Đặt ngày:
                    <span><?= $fetch_orders['ngaydat']; ?></span>
                </p>

                <p>
                    Họ tên:
                    <span><?= $fetch_orders['tenkh']; ?></span>
                </p>

                <p>
                    Số điện thoại:
                    <span><?= $fetch_orders['sdtkh']; ?></span>
                </p>

                <p>
                    Email:
                    <span><?= $fetch_orders['gmailkh']; ?></span>
                </p>

                <p>
                    Địa chỉ:
                    <span><?= $fetch_orders['diachi']; ?></span>
                </p>

                <p>
                    Đơn đặt hàng của bạn:
                    <span><?= $fetch_orders['cacsp']; ?></span>
                </p>

                <p>
                    Tổng cộng:
                    <span><?= number_format($fetch_orders['tongdonhang'],0,',','.'); ?> đ</span>
                </p>

                <p>
                    Phương thức thanh toán:
                    <span><?= $fetch_orders['phuongthucthanhtoan']; ?></span>
                </p>

                <p>
                    Tình trạng thanh toán:
                    <span style="color: <?= $fetch_orders['tinhtrang'] == 'chưa xử lý' ? 'red' : 'green' ?>"><?= $fetch_orders['tinhtrang']; ?></span>
                </p>
            </div>
            <?php
                    }
                } else {
                    echo '<p class="empty">chưa có đơn hàng nào 🥹</p>';
                }
            ?>
        </div>
    </section>
    <!-- End: đặt hàng -->

    <!-- Begin: footer -->
    <?php require_once('components/footer.php') ?>
    <!-- End: footer -->

    <div class="loader">
        <img src="images/loader.gif" alt="">
    </div>

    <script src="js/script.js"></script>
</body>

</html>