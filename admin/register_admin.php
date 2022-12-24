<?php
include_once ('../components/connect.php');

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)) {
   header('location:admin_login.php');
};

if(isset($_POST['submit'])) {

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = sha1($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   $select_admin = $conn->prepare("SELECT * FROM `admin` WHERE tentk = ?");
   $select_admin->execute([$name]);
   
   if($select_admin->rowCount() > 0) { 
      $message[] = 'tên tài khoản đã tồn tại 😣';
   } else {
      if($pass != $cpass) { 
         $message[] = 'mật khẩu không trùng nhau 😖';
      } else {
         $insert_admin = $conn->prepare("INSERT INTO `admin`(tentk, mk) VALUES(?,?)");
         $insert_admin->execute([$name, $cpass]);
         $message[] = 'tạo tài khoản thành công 🤗';
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
   <title>Đăng Ký Admin</title>

   <!-- Link icon -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- CSS -->
   <link rel="stylesheet" href="../css/admin_style.css">
</head>

<body>
   <?php include_once ('../components/admin_header.php') ?>

   <!-- Begin: đăng ký admin -->
   <section class="form-container">

      <form action="" method="POST">
         <h3>Đăng ký</h3>
         <input autocomplete="off" type="text" name="name" maxlength="20" required placeholder="Nhập tên tài khoản" class="box"
               oninput="this.value = this.value.replace(/\s/g, '')">
         <input autocomplete="off" type="password" name="pass" maxlength="20" required placeholder="Nhập mật khẩu" class="box"
               oninput="this.value = this.value.replace(/\s/g, '')">
         <input autocomplete="off" type="password" name="cpass" maxlength="20" required placeholder="Nhập lại mật khẩu" class="box"
               oninput="this.value = this.value.replace(/\s/g, '')">
         <input autocomplete="off" type="submit" value="Đăng ký" name="submit" class="btn">
      </form>

   </section>
   <!-- End: đăng ký admin -->

   <!-- js  -->
   <script src="../js/admin_script.js"></script>
</body>

</html>