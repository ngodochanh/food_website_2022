<?php
include_once ('components/connect.php');

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giới Thiệu</title>
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

    <!-- Begin: heading -->
    <div class="heading">
        <h3>Chúng tôi là?</h3>
        <p>
            <a href="home.html">Trang Chủ</a>
            <span>/ Giới Thiệu</span>
        </p>
    </div>
    <!-- End: heading -->

    <!-- Begin: Giới thiệu -->
    <div class="about">
        <div class="row">
            <div class="image">
                <img src="images/about-img.svg" alt="">
            </div>

            <div class="content">
                <h3>Tại sao lại chọn yum yum 😋?</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit cum quae laboriosam
                    recusandae nobis quis odio sed nesciunt ab iusto explicabo, illo ducimus modi doloribus.
                    Quas quod quae blanditiis vitae.
                </p>
                <a href="menu.html" class="btn">Thực Đơn</a>
            </div>
        </div>
    </div>

    <!-- Begin: Các bước -->
    <section class="steps">
        <h1 class="title">Các bước đơn giản</h1>
        <div class="box-container">
            <div class="box">
                <img src="images/step-1.png" alt="">
                <h3>Chọn đặt hàng</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis, labore!</p>
            </div>

            <div class="box">
                <img src="images/step-2.png" alt="">
                <h3>Giao hàng nhanh</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis, labore!</p>
            </div>

            <div class="box">
                <img src="images/step-3.png" alt="">
                <h3>Thưởng thức thức ăn</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis, labore!</p>
            </div>
        </div>
    </section>
    <!-- End: Các bước -->

    <!-- Begin: đánh giá -->
    <section class="reviews">
        <h1 class="title">Đánh giá</h1>
        <div class="reviews-slider mySwiper swiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide slide">
                    <img src="images/pic-1.png" alt="">
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae, facere! Est error,
                        eligendi laborum cum possimus quod ipsa sunt molestiae.
                    </p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <h3>Nhật Nam</h3>
                </div>

                <div class="swiper-slide slide">
                    <img src="images/pic-2.png" alt="">
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae, facere! Est error,
                        eligendi laborum cum possimus quod ipsa sunt molestiae.
                    </p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <h3>Lữ Định</h3>
                </div>

                <div class="swiper-slide slide">
                    <img src="images/pic-3.png" alt="">
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae, facere! Est error,
                        eligendi laborum cum possimus quod ipsa sunt molestiae.
                    </p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <h3>Hữu Phúc</h3>
                </div>

                <div class="swiper-slide slide">
                    <img src="images/pic-4.png" alt="">
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae, facere! Est error,
                        eligendi laborum cum possimus quod ipsa sunt molestiae.
                    </p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <h3>Xuân Nhân</h3>
                </div>

                <div class="swiper-slide slide">
                    <img src="images/pic-5.png" alt="">
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae, facere! Est error,
                        eligendi laborum cum possimus quod ipsa sunt molestiae.
                    </p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <h3>Dương Thuận</h3>
                </div>

                <div class="swiper-slide slide">
                    <img src="images/pic-6.png" alt="">
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae, facere! Est error,
                        eligendi laborum cum possimus quod ipsa sunt molestiae.
                    </p>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <h3>Trung Thành</h3>
                </div>
            </div>

            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </div>
    </section>
    <!-- End: đánh giá -->

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
        grabCursor: true,
        pagination: {
            el: ".swiper-pagination",
            clickable: true
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },

        spaceBetween: 20,
        breakpoints: {
            0: {
                slidesPerView: 1,
            },
            700: {
                slidesPerView: 2,
            },
            1024: {
                slidesPerView: 3,
            },
        },
    });
    </script>

    <!-- js -->
    <script src="js/script.js"></script>
</body>

</html>