<?php
include_once ('components/connect.php');

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:home.php');
};

if (isset($_POST['update_qty'])) {
    $cart_id = $_POST['cart_id'];
    $cart_id = filter_var($cart_id, FILTER_SANITIZE_STRING);

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    $qty = $_POST['qty'];
    $qty = filter_var($qty, FILTER_SANITIZE_STRING);

    $update_qty = $conn -> prepare("UPDATE `giohang` SET soluong = ? WHERE idgiohang = ?");
    $update_qty -> execute([$qty, $cart_id]);
    $messages[] = 'Cập nhật số lượng sản phẩm '. $name . ' thành công 🥰'; 
}

if (isset($_POST['delete_cart'])) {
    $cart_id = $_POST['cart_id'];
    $cart_id = filter_var($cart_id, FILTER_SANITIZE_STRING);

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    $delete_cart = $conn -> prepare("DELETE FROM `giohang` WHERE idgiohang = ?");
    $delete_cart -> execute([$cart_id]);

    $messages[] = 'xóa sản phẩm '. $name . ' thành công 🥰'; 
}

if (isset($_POST['delete_all'])) {
    $delete_cart = $conn -> prepare("DELETE FROM `giohang` WHERE idkh = ?");
    $delete_cart -> execute([$user_id]);

    $messages[] = 'Làm sạch giỏ hàng thành công 😓'; 
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ Hàng</title>
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
        <h3>Giỏ Hàng</h3>
        <p>
            <a href="home.php">Trang Chủ</a>
            <span>/ giỏ hàng</span>
        </p>
    </div>
    <!-- End: heading -->

    <!-- Begin: giỏ hàng -->
    <section class="products">
        <h1 class="title">giỏ hàng của bạn</h1>

        <div class="box-container">
            <?php 
                $grand_total = 0;
                $select_cart = $conn -> prepare("SELECT * FROM `giohang` a, `sanpham` b WHERE idkh = ? AND a.idsp = b.idsp");
                $select_cart -> execute([$user_id]);
                if ($select_cart -> rowCount() > 0) {
                    while ($fetch_cart = $select_cart -> fetch(PDO::FETCH_ASSOC)) {
                            // tính tổng tiền
                            $sub_total = $fetch_cart['giasp'] * $fetch_cart['soluong'];
                        ?>
            <form class="box" action="" method="POST">
                <input type="hidden" name="cart_id" value="<?= $fetch_cart['idgiohang']; ?>">
                <input type="hidden" name="name" value="<?= $fetch_cart['tensp']; ?>">

                <a href="quick_view.php?pid=<?= $fetch_cart['idsp']; ?>" class="fas fa-eye"></a>
                <button type="submit" class="fas fa-times" name="delete_cart"
                    onclick="return confirm('Bạn có muốn xóa sản phẩm này khỏi giỏ hàng?');"></button>
                <img src="uploaded_img/<?= $fetch_cart['anhsp']; ?>" alt="">
                <div class="name"><?= $fetch_cart['tensp']; ?></div>
                <div class="flex">
                    <div class="price"><?= number_format($fetch_cart['giasp'],0,',','.'); ?>
                        <span> đ</span>
                    </div>

                    <input type="number" name="qty" class="qty" min="1" max="99" value="<?= $fetch_cart['soluong']; ?>"
                        onkeypress="if(this.value.length == 2) return false;">

                    <button type="submit" name="update_qty" class="fas fa-edit"></button>
                </div>
                        
                <div class="sub-total">Tổng cộng :
                    <span><?=  number_format($sub_total ,0,',','.'); ?></span> đ</div>
            </form>
            <?php
                $grand_total += $sub_total;
                    }
                } else {
                    echo '<div class="empty"><p>Giỏ hàng trống 😒</p></div>';
                }
            ?>
        </div>

        <div class="cart-total">
            <p>Tổng đơn : <span><?= number_format($grand_total ,0,',','.'); ?> đ</span></p>
            <a href="checkout.php" class="btn <?= ($grand_total > 1) ? '' : 'disabled'; ?>">Kiểm tra</a>
        </div>

        <div class="more-btn">
            <form action="" method="post">
                <button type="submit" class="delete-btn" name="delete_all"
                    onclick="return confirm('Bạn có muốn xóa tất cả sản phẩm ra khỏi giỏ hàng?');">
                    Xóa tất cả
                </button>
            </form>
        </div>
    </section>
    <!-- End: giỏ hàng -->

    <!-- Begin: footer -->
    <?php require_once('components/footer.php') ?>
    <!-- End: footer -->

    <div class="loader">
        <img src="images/loader.gif" alt="">
    </div>

    <script src="js/script.js"></script>
</body>

</html>