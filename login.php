<?php

include_once ('components/connect.php');

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if (isset($_POST['submit'])) {
    // Hàm filter_var có chức năng kiểm tra sự phù hợp của dữ liệu, chức năng lọc biến đổi dữ liệu cho phù hợp, 
    //      như có phải là một số nguyên không, có phải là một địa chỉ URL, loại bỏ chữ giữ lại số ...,
    // FILTER_SANITIZE_STRING: Xóa thẻ / ký tự đặc biệt khỏi chuỗi
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $pass = sha1($_POST['pass']);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);

    $select_user = $conn -> prepare("SELECT * FROM `khachhang` WHERE gmailkh = ? AND matkhaukh = ?");
    $select_user -> execute([$email, $pass]);
    $row = $select_user -> fetch(PDO::FETCH_ASSOC);

    if ($select_user -> rowCount() > 0) {
        $_SESSION['user_id'] = $row['idkh'];
        header('location:home.php');
       
    } else {
        $messages[] = 'gmail hoặc mật khẩu không đúng 🤧';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
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

    <!-- Begin: đăng nhập -->
    <section class="form-container">
        <form action="" method="post">
            <h3>Đăng Nhập</h3>

            <input autocomplete="off" type="email" name="email" required placeholder="Nhập gmail" class="box" maxlength="50"
                oninput="this.value = this.value.replace(/\s/g,'')">

            <input type="password" name="pass" required placeholder="Nhập mật khẩu" class="box" maxlength="50"
                oninput="this.value = this.value.replace(/\s/g,'')">

            <input type="submit" value="đăng nhập" name="submit" class="btn">

            <p>
                Bạn chưa có tài khoản?
                <a href="register.php">Đăng ký</a>
            </p>
        </form>
    </section>
    <!-- End: đăng nhập -->

    <!-- Begin: footer -->
    <?php require_once('components/footer.php') ?>
    <!-- End: footer -->

    <div class="loader">
        <img src="images/loader.gif" alt="">
    </div>
    
    <script src="js/script.js"></script>
</body>

</html>