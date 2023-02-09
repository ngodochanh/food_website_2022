<?php
include_once ('components/connect.php');

session_start();

if(isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
   header('Location:home.php');
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);

    $number = $_POST['number'];
    $number = filter_var($number, FILTER_SANITIZE_STRING);

    $address = $_POST['address'];
    $address = filter_var($address, FILTER_SANITIZE_STRING);

    $total_products = $_POST['total_products'];
    $total_products = filter_var($total_products, FILTER_SANITIZE_STRING);

    $total_price = $_POST['total_price'];
    $total_price = filter_var($total_price, FILTER_SANITIZE_STRING);

    $method = $_POST['method'];
    $method = filter_var($method, FILTER_SANITIZE_STRING);

    $check_cart = $conn->prepare("SELECT * FROM `giohang` WHERE idkh = ?");
    $check_cart->execute([$user_id]);

    if ($check_cart -> rowCount() > 0) {
        if ($address == '') {
            $messages[] = 'mời nhập địa chỉ 😚';
        } else {
            $insert_order = $conn -> prepare("INSERT INTO `donhang` (idkh, 	tenkh, gmailkh, sdtkh, 
            phuongthucthanhtoan, diachi, cacsp, tongdonhang) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $insert_order -> execute([$user_id, $name, $email, $number, $method, $address, $total_products, 
                $total_price]);

            $last_id = $conn->lastInsertId();

            $messages[] = 'đặt hàng thành công 🤑';

            require_once ('mail/send_mail.php');
            require_once ('mail/desgin_header_mail.php');
            require_once ('mail/desgin_handle_mail.php');
            require_once ('mail/desgin_footer_mail.php');
            // xử lý gmail
            $mail = new Mailer();

            $title = 'Đơn hàng tại yum yum 😋 đã được đặt thành công!';
            $title_content = 'cảm ơn bạn đã đặt hàng';

            $content = header_Mail($title_content);

            $grand_total = 0;
            $select_cart = $conn -> prepare("SELECT * FROM `giohang` a, `sanpham` b WHERE idkh = ? AND a.idsp = b.idsp");
            $select_cart -> execute([$user_id]);
            
            if ($select_cart -> rowCount() > 0) {
                while ($fetch_cart = $select_cart -> fetch(PDO::FETCH_ASSOC)) {
                    // tính tổng tiền
                    $sub_total = $fetch_cart['giasp'] * $fetch_cart['soluong'];
                    $grand_total += $sub_total;
                    $content .= handle_Mail($fetch_cart['tensp'], $fetch_cart['giasp'], $fetch_cart['soluong']);
                }
                $content .= footer_Mail($method, $grand_total, $name, $number, $email, $address, $last_id);
            }
            // xóa giỏ hàng rồi mới gửi mail
            $delete_cart = $conn -> prepare("DELETE FROM `giohang` WHERE idkh = ?");
            $delete_cart -> execute([$user_id]);

            $mail -> dathangmail($title, $content, $email, $name);
        }
    } else {
        $messages[] = 'giỏ hàng trống 🙂';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh Toán</title>
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
        <h3>Thanh Toán</h3>
        <p>
            <a href="home.php">Trang Chủ</a>
            <span>/ thanh toán</span>
        </p>
    </div>
    <!-- End: heading -->

    <!-- Begin: thanh toán -->
    <section class="checkout">
        <h1 class="title">Đơn Đặt Hàng</h1>

        <form action="" method="post">
            <div class="cart-items">
                <h3>Mặt hàng giỏ hàng</h3>
                <?php 
                $grand_total = 0;
                $cart_items[] = '';
                $select_cart = $conn -> prepare("SELECT * FROM `giohang` a, `sanpham` b WHERE idkh = ? AND a.idsp = b.idsp");
                $select_cart -> execute([$user_id]);
                if ($select_cart -> rowCount() > 0) {
                    while ($fetch_cart = $select_cart -> fetch(PDO::FETCH_ASSOC)) {
                            // tính tổng tiền
                            $sub_total = $fetch_cart['giasp'] * $fetch_cart['soluong'];
                            $grand_total += $sub_total;

                            $cart_items[] = $fetch_cart['tensp'].' ('.$fetch_cart['giasp'].' x '. $fetch_cart['soluong'].') - ';
                            // trong php dùng để gộp (nối) các phần tử mảng thành chuỗi
                            $total_products = implode($cart_items);
                            $total_products = rtrim($total_products,'- ');
                        ?>

                <div>
                    <span class="name"><?= $fetch_cart['tensp']; ?></span>
                    <span class="price">
                        <p class="money"><?=  number_format($fetch_cart['giasp'] ,0,',','.'); ?> đ </p>
                        <p class="text">x</p>
                        <p class="qty"><?= $fetch_cart['soluong']; ?></p>
                    </span>
                </div>

                <?php
  
                    }
                } else {
                    echo '<div class="empty"><p>Giỏ hàng trống 😒</p></div>';
                }
            ?>
                <div class="grand-total">
                    <span class="name">Tổng đơn :</span>
                    <span class="price"><?=  number_format($grand_total ,0,',','.'); ?> đ</span>
                </div>
                <a href="cart.php" class="btn">Xem giỏ hàng</a>

                <input type="hidden" name="total_products" value="<?= $total_products ?>">
                <input type="hidden" name="total_price" value="<?= $grand_total ?>">
                <input type="hidden" name="name" value="<?= $fetch_profile['tenkh']; ?>">
                <input type="hidden" name="number" value="<?= $fetch_profile['sdtkh']; ?>">
                <input type="hidden" name="email" value="<?= $fetch_profile['gmailkh']; ?>">
                <input type="hidden" name="address" value="<?= $fetch_profile['diachikh']; ?>">
            </div>

            <div class="user-info">
                <h3>thông tin của bạn</h3>
                <p>
                    <i class="fas fa-user"></i>
                    <span style="text-transform: capitalize;"><?= $fetch_profile['tenkh'] ?></span>
                </p>

                <p>
                    <i class="fas fa-phone"></i>
                    <span><?= $fetch_profile['sdtkh'] ?></span>
                </p>

                <p>
                    <i class="fas fa-envelope"></i>
                    <span><?= $fetch_profile['gmailkh'] ?></span>
                </p>

                <a href="updata_profile.php" class="btn">Cập nhật thông tin</a>

                <h3>Địa chỉ nhận hàng</h3>

                <p>
                    
                    <i class="fas fa-map-marker-alt"></i>
                    <span>
                        <?php if ($fetch_profile['diachikh'] == '') {echo 'Nhập địa chỉ của bạn';} 
                            else {echo $fetch_profile['diachikh'];} ?>
                    </span>
                </p>

                <a href="updata_address.php" class="btn">Cập nhật địa chỉ</a>

                <select name="method" class="box" required>
                    <option value="" disabled selected>Chọn phương thức thanh toán</option>
                    <option value="thanh toán khi giao hàng">thanh toán khi giao hàng</option>
                    <option value="thẻ tín dụng">thẻ tín dụng</option>
                    <option value="paytm">paytm</option>
                    <option value="paypal">paypal</option>
                </select>
               
                <input type="submit"
                    class="btn <?= $fetch_profile['diachikh'] == '' || $grand_total < 1 ? 'disabled' : '' ?>"
                    value="Đặt hàng" name="submit" style="width: 100%; background: var(--red); color: var(--white);">
            </div>
        </form>

    </section>
    <!-- End: thanh toán -->

    <!-- Begin: footer -->
    <?php require_once('components/footer.php') ?>
    <!-- End: footer -->

    <div class="loader">
        <img src="images/loader.gif" alt="">
    </div>

    <script src="js/script.js"></script>
</body>

</html>