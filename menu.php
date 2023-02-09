<?php

include_once ('components/connect.php');

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
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
    <title>Thực Đơn</title>
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
        <h3>Thực Đơn</h3>
        <p>
            <a href="home.html">Trang Chủ</a>
            <span>/ Thực Đơn</span>
        </p>
    </div>
    <!-- End: heading -->

    <!-- Begin: thực đơn -->
    <section class="products" style="overflow: auto;">
        <div class="box-container">
            <?php 
                $item_per_page = !empty($_GET['per_page']) ? $_GET['per_page'] : 3;
                $current_page = !empty($_GET['page']) ? $_GET['page'] : 1;
                $offset = ($current_page - 1) * $item_per_page;

                $select_products_all = $conn -> prepare("SELECT * FROM `sanpham`");
                $select_products_all -> execute();

                $total_products = $select_products_all -> rowCount();
                $total_pages = ceil($total_products / $item_per_page);

                $select_products = $conn -> prepare("SELECT * FROM `sanpham` ORDER BY `idsp` DESC LIMIT $item_per_page OFFSET $offset");
                $select_products -> execute();
                if ($select_products -> rowCount() > 0) {
                    // Trả về dữ liệu dạng mảng với key là tên của column (column của các table trong database)
                    while($fetch_products = $select_products -> fetch(PDO::FETCH_ASSOC)) {
            ?>
            <form class="box" action="" method="POST">
                <input type="hidden" name="pid" value="<?= $fetch_products['idsp']; ?>">
                <input type="hidden" name="name" value="<?= $fetch_products['tensp']; ?>">
                <input type="hidden" name="price" value="<?= $fetch_products['giasp']; ?>">
                <input type="hidden" name="image" value="<?= $fetch_products['anhsp']; ?>">

                <a href="quick_view.php?pid=<?= $fetch_products['idsp']; ?>" class="fas fa-eye"></a>

                <button type="submit" class="fas fa-shopping-cart" name="add_to_cart"></button>

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
            </form>
     
            <?php 
                        }
                    } else {
                        echo '<div class="empty">Chưa có sản phẩm nào được thêm vào?</div>';
                    }
                ?>
        </div>
        <div class="page">
        <?php 
            if ($current_page >= 3) {
                $first_page = 1;
                   
        ?>
            <a class="" href="?per_page=<?= $item_per_page ?>&page=<?= $first_page ?>">First</a>
        <?php     
            }  

            if ($current_page > 1) {
                $prev_page = $current_page - 1;
            ?>
                <a class="" href="?per_page=<?= $item_per_page ?>&page=<?= $prev_page ?>"><i class="fa-solid fa-chevron-left"></i></a>
            <?php
            }

            for($i = 1; $i <= $total_pages; $i++) {
                if ($current_page != $i) {
                    if ($i > $current_page - 3 && $i < $current_page + 3) {
        ?>
                        <a class="" href="?per_page=<?= $item_per_page ?>&page=<?= $i ?>"><?= $i ?></a>
        <?php
                    }
                } else {
        ?>
                    <a style="background-color: var(--black); color: var(--white);"><?= $i ?></a>
        <?php
                }
            }
            if ($current_page < $total_pages) {
                $next_page = $current_page + 1;
            ?>
                <a class="" href="?per_page=<?= $item_per_page ?>&page=<?= $next_page ?>"><i class="fa-solid fa-chevron-right"></i></a>
            <?php
            }

            if ($current_page <= $total_pages - 3) {
                $end_page = $total_pages;
        ?>
            <a class="" href="?per_page=<?= $item_per_page ?>&page=<?= $end_page ?>">Last</a>
        <?php
            }
        ?>
        </div>
    </section>
    <!-- End: thực đơn -->

    <!-- Begin: footer -->
    <?php require_once('components/footer.php') ?>
    <!-- End: footer -->

    <div class="loader">
        <img src="images/loader.gif" alt="">
    </div>

    <script src="js/script.js"></script>
</body>

</html>