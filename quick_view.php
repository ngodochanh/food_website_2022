<?php

include_once ('components/connect.php');

session_start();

if(isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
};

include_once ('components/add_cart.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loại Thực Phẩm</title>
    <!-- Use Swiper from CDN, mã nguồn mở -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
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

    <!-- Begin: xem nhanh -->
    <section class="quick-view">
        <h1 class="title">Xem Nhanh</h1>

        <?php 
                $pid = $_GET['pid'];
                $select_products = $conn -> prepare("SELECT * FROM `sanpham` WHERE idsp = ?");
                $select_products -> execute([$pid]);
                if ($select_products -> rowCount() > 0) {
                    // Trả về dữ liệu dạng mảng với key là tên của column (column của các table trong database)
                    while($fetch_products = $select_products -> fetch(PDO::FETCH_ASSOC)) {
            ?>
                <form class="box" action="" method="POST">
                    <input type="hidden" name="pid" value="<?= $fetch_products['idsp']; ?>">
                    <input type="hidden" name="name" value="<?= $fetch_products['tensp']; ?>">
                    <input type="hidden" name="price" value="<?= $fetch_products['giasp']; ?>">
                    <input type="hidden" name="image" value="<?= $fetch_products['anhsp']; ?>">

                    <img class="image" src="uploaded_img/<?= $fetch_products['anhsp']; ?>" alt="">

                    <a href="category.php?category=<?= $fetch_products['loaisp']; ?>"
                        class="cat"><?= $fetch_products['loaisp']; ?></a>

                    <div class="name"><?= $fetch_products['tensp']; ?></div>

                    <div class="flex">
                        <div class="price"><?= number_format($fetch_products['giasp'],0,',','.'); ?>
                            <span> đ</span>
                        </div>

                        <input type="number" name="qty" class="qty" min="1" max="99" value="1"
                            onkeypress="if(this.value.length == 2) return false;">
                    </div>

                    <button type="submit" name="add_to_cart" class="btn cart-btn">
                        Thêm vào giỏ
                    </button>
                </form>
                <?php 
                    }
                } else {
                    echo '<div class="empty">Chưa có sản phẩm nào được thêm vào?</div>';
                }
            ?>
    </section>
    <!-- End: xem nhanh -->

    <!-- Begin: footer -->
    <?php require_once('components/footer.php') ?>
    <!-- End: footer -->

    <div class="loader">
        <img src="images/loader.gif" alt="">
    </div>

    <!-- Initialize Swiper -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <!-- Initialize Swiper -->
    <script>
    var swiper = new Swiper(".mySwiper", {
        effect: "flip",
        grabCursor: true,
        pagination: {
            el: ".swiper-pagination",
            clickable: true
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });
    </script>

    <!-- js -->
    <script src="js/script.js"></script>
</body>

</html>