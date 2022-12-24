<?php
include_once ('../components/connect.php');

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)) {
   header('location:admin_login.php');
}

if(isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];
   $delete_admin = $conn->prepare("DELETE FROM `admin` WHERE id = ?");
   $delete_admin->execute([$delete_id]);
   header('location:admin_accounts.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tài Khoản Admins</title>

    <!-- Link icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="../css/admin_style.css">
</head>

<body>
    <?php include_once ('../components/admin_header.php') ?>

    <!-- Begin: Quản lý admin  -->
    <section class="accounts">
        <h1 class="heading">Tài khoản Admins</h1>

        <div class="box-container">

            <div class="box">
                <p>đăng ký admin mới</p>
                <a href="register_admin.php" class="option-btn">Đăng ký</a>
            </div>

            <?php
   $select_account = $conn->prepare("SELECT * FROM `admin`");
   $select_account->execute();
   if($select_account->rowCount() > 0){
      while($fetch_accounts = $select_account->fetch(PDO::FETCH_ASSOC)) {  
?>
            <div class="box">
                <p> admin id : <span><?= $fetch_accounts['id']; ?></span> </p>
                <p> tên tài khoản : <span><?= $fetch_accounts['tentk']; ?></span> </p>
                <div class="flex-btn">
                    <a href="admin_accounts.php?delete=<?= $fetch_accounts['id']; ?>" class="delete-btn"
                        onclick="return confirm('Bạn muốn xóa tài khoản này?');">Xóa</a>
                    <?php
         if($fetch_accounts['id'] == $admin_id) {
            echo '<a href="update_profile.php" class="option-btn">Cập nhật</a>';
         }
      ?>
                </div>
            </div>
            <?php
      }
   } else {
      echo '<p class="empty">Không có tài khoản</p>';
   }
?>

        </div>
    </section>
    <!-- End: Quản lý admin  -->

    <!-- js  -->
    <script src="../js/admin_script.js"></script>
</body>

</html>