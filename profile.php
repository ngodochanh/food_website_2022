<?php
include_once ('components/connect.php');

session_start();

if(isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
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
    <title>Trang Cá Nhân</title>
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

    <!-- Begin: thông tin cá nhân -->
    <section class="user-details">
        <div class="user">
            <img src="images/user-icon.png" alt="">

            <p>
                <i class="fas fa-user"></i>
                <span><?= $fetch_profile['tenkh'] ?></span>
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



            <p class="address">
                <i class="fas fa-map-marker-alt"></i>
                <span>
                    <?php if ($fetch_profile['diachikh'] == '') {echo 'Nhập địa chỉ của bạn';} 
                    else {echo $fetch_profile['diachikh'];} ?>
                </span>
            </p>

            <a href="updata_address.php" class="btn">Cập nhật địa chỉ</a>
        </div>
    </section>
    <!-- End: thông tin cá nhân -->

    <!-- Begin: footer -->
    <?php require_once('components/footer.php') ?>
    <!-- End: footer -->

    <div class="loader">
        <img src="images/loader.gif" alt="">
    </div>

    <script src="js/script.js"></script>
</body>

</html>