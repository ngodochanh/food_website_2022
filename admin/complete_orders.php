<?php require_once ('handle_orders.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đơn hàng</title>

    <!-- Link icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="../css/admin_style.css">

</head>

<body>
    <?php include_once ('../components/admin_header.php') ?>

    <!-- Begin: đơn hàng  -->
    <section class="placed-orders">

        <h1 class="heading">Đơn hàng</h1>

        <div class="box-container">

            <?php
                $select_orders = $conn->prepare("SELECT * FROM `donhang` WHERE tinhtrang = 'đã xử lý' ORDER BY iddonhang DESC");
                $select_orders->execute();
                if($select_orders->rowCount() > 0){
                    while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
                        include ('orders.php');
                    }
                } else {
                    echo '<p class="empty">chưa có đơn đặt hàng 😓</p>';
                }
            ?>
        </div>

    </section>
    <!-- End: đơn hàng -->

    <!-- js  -->
    <script src="../js/admin_script.js"></script>
</body>

</html>