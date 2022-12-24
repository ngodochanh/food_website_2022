<?php
include_once ('components/connect.php'); 

$order_id = $_GET['order_id'];
$order_id = filter_var($order_id, FILTER_SANITIZE_STRING);

$payment_status	= 'HỦY ĐƠN THÀNH CÔNG';

$select_orders = $conn -> prepare("SELECT * FROM `donhang` WHERE iddonhang = ?");
$select_orders -> execute([$order_id]);
if ($select_orders -> rowCount() > 0) {
    while($fetch_order = $select_orders -> fetch(PDO::FETCH_ASSOC)) {
        if ($fetch_order['tinhtrang'] == 'đã xử lý') {
            $payment_status	= 'đơn hàng đã xử lý';
        } else {
            $update_status = $conn->prepare("UPDATE `donhang` SET tinhtrang = 'đã hủy' WHERE iddonhang = ?");
            $update_status->execute([$order_id]);
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hủy đơn hàng</title>
    <!-- Link icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <!-- CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>

<body>
    <!-- Begin: thanh toán -->
    <section class="checkout mail">
        <div class="mail__header">
            <h1 class="logo"><a href="home.php">yum yum 😋</a></h1>
            <h1 class="title"><?= $payment_status ?></h1>
        </div>

        <form action="" method="post">
            <div class="cart-items">
                <h3>Mặt hàng giỏ hàng</h3>
                
                <?php 
                    $select = $conn -> prepare("SELECT * FROM `donhang` a, `khachhang` b WHERE iddonhang = ? AND a.idkh = b.idkh");
                    $select -> execute([$order_id]);

                    if ($select -> rowCount() > 0) {
                        while($fetch = $select -> fetch(PDO::FETCH_ASSOC)) {
                            $products = explode(' - ', trim($fetch['cacsp']));
                            $products = str_replace('(', '+', $products);
                            $products = str_replace(')', '', $products);

                            foreach($products as $product ) {
                                $arr_product = explode('+', trim($product));
                                
                                $name_product = trim($arr_product[0]);
                    
                                $arr_info_product = explode('x', $arr_product[1]);
                    
                                $price_product = trim($arr_info_product[0]);
                                $pty_product = trim($arr_info_product[1]);
                ?>

                <div>
                    <span class="name"><?= $name_product ?></span>
                    <span class="price">
                        <p class="money"><?= number_format($price_product,0,',','.'); ?>đ</p>
                        <p class="text">x</p>
                        <p class="qty"><?= $pty_product ?></p>
                    </span>
                </div>

                <?php 
                            }
         
                ?>
                <div class="grand-total">
                    <span class="name">Tổng đơn :</span>
                    <span class="price"><?= number_format($fetch['tongdonhang'],0,',','.'); ?> đ</span>
                </div>
      
            </div>

            <div class="user-info">
                <h3>thông tin của bạn</h3>

                <p>
                    <i class="fas fa-user"></i>
                    <span style="text-transform: capitalize;"><?= $fetch['tenkh']?></span>
                </p>

                <p>
                    <i class="fas fa-phone"></i>
                    <span><?= $fetch['sdtkh']?></span>
                </p>

                <p>
                    <i class="fas fa-envelope"></i>
                    <span><?= $fetch['gmailkh']?></span>
                </p>

                <h3>Địa chỉ nhận hàng</h3>

                <p>

                    <i class="fas fa-map-marker-alt"></i>
                    <span>
                        <?= $fetch['diachikh']?>
                    </span>
                </p>

                <h3>Hình thức thanh toán</h3>

                <p>
                    <i class="fa-solid fa-money-bill"></i>
                    <span><?=  $fetch['phuongthucthanhtoan']?></span>
                </p>
            </div>
            <?php 
                        }
                    }
            ?>
        </form>

    </section>
    <!-- End: thanh toán -->
</body>

</html>