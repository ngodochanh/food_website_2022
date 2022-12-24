<?php
include_once ('../components/connect.php');

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)) {
   header('location:admin_login.php');
}

if(isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];
   $delete_users = $conn->prepare("DELETE FROM `khachhang` WHERE idkh = ?");
   $delete_users->execute([$delete_id]);
   $delete_order = $conn->prepare("DELETE FROM `donhang` WHERE idkh = ?");
   $delete_order->execute([$delete_id]);
   $delete_cart = $conn->prepare("DELETE FROM `giohang` WHERE idkh = ?");
   $delete_cart->execute([$delete_id]);
   header('location:users_accounts.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tài khoản khách hàng</title>

    <!-- Link icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="../css/admin_style.css">
</head>

<body>
    <?php include_once ('../components/admin_header.php') ?>

    <!-- Begin: tài khoản khách hàng  -->
    <section class="accounts">

        <h1 class="heading">Tài khoản khách hàng</h1>

        <div class="box-container">
            <?php
      $select_account = $conn->prepare("SELECT * FROM `khachhang` ORDER BY idkh DESC");
      $select_account->execute();
      if($select_account->rowCount() > 0) {
         while($fetch_accounts = $select_account->fetch(PDO::FETCH_ASSOC)) {  
   ?>
            <div class="box">
                <p>Mã : <span><?= $fetch_accounts['idkh']; ?></span> </p>
                <p>Tên : <span><?= $fetch_accounts['tenkh']; ?></span> </p>
                <a href="users_accounts.php?delete=<?= $fetch_accounts['idkh']; ?>" class="delete-btn"
                    onclick="return confirm('Bạn muốn xóa tài khoản này 🫠?');">Xóa</a>
            </div>
            <?php
      }
   } else {
      echo '<p class="empty">Chưa có khách hàng đăng ký</p>';
   }
   ?>
        </div>
    </section>
    <!-- End: tài khoản khách hàng  -->

    <!-- js -->
    <script src="../js/admin_script.js"></script>

</body>

</html>