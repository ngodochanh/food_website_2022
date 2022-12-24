<?php

include_once ('components/connect.php');

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('Location:home.php');
};

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);

    $number = $_POST['number'];
    $number = filter_var($number, FILTER_SANITIZE_STRING);

    if (!empty($name)) {
        $update_name = $conn -> prepare("UPDATE `khachhang` SET tenkh = ? WHERE idkh = ?");
        $update_name -> execute([$name, $user_id]);
        $messages[] = 'Cập nhật tên thành công 🥳';
    }

    if (!empty($email)) {
        $select_email = $conn -> prepare("SELECT * FROM `khachhang` WHERE gmailkh = ?");
        $select_email -> execute([$email]);
        if ($select_email -> rowCount() > 0) {
            $messages[] = 'gmail đã tồn tại 😵';
        } else {
            $update_email = $conn -> prepare("UPDATE `khachhang` SET gmailkh = ? WHERE idkh = ?");
            $update_email -> execute([$email, $user_id]);
            $messages[] = 'Cập nhật gmail thành công 🥳';
        }
    }

    if (!empty($number)) {
        $select_number = $conn -> prepare("SELECT * FROM `khachhang` WHERE sdtkh = ?");
        $select_number -> execute([$number]);
        if ($select_number -> rowCount() > 0) {
            $messages[] = 'số điện thoại đã tồn tại 😵';
        } else {
            $update_number = $conn -> prepare("UPDATE `khachhang` SET sdtkh = ? WHERE idkh = ?");
            $update_number -> execute([$number, $user_id]);
            $messages[] = 'Cập nhật số điệnt thoại thành công 🥳';
        }
    }

    $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
    $select_prev_pass = $conn->prepare("SELECT matkhaukh FROM `khachhang` WHERE idkh = ?");
    $select_prev_pass->execute([$user_id]);
    $fetch_prev_pass = $select_prev_pass->fetch(PDO::FETCH_ASSOC);
    $prev_pass = $fetch_prev_pass['matkhaukh'];

    $old_pass = sha1($_POST['old_pass']);
    $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);

    $new_pass = sha1($_POST['new_pass']);
    $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);

    $confirm_pass = sha1($_POST['confirm_pass']);
    $confirm_pass = filter_var($confirm_pass, FILTER_SANITIZE_STRING);

    if($old_pass != $empty_pass) {
        if($old_pass != $prev_pass) {
            $messages[] = 'Mật khẩu cũ không đúng 😏';
        } elseif ($new_pass != $confirm_pass) {
            $messages[] = 'Mật khẩu mới không trùng nhau 🫥!';
        } else {
         if ($new_pass != $empty_pass) {
            $update_pass = $conn->prepare("UPDATE `khachhang` SET matkhaukh = ? WHERE idkh = ?");
            $update_pass->execute([$confirm_pass, $user_id]);
            $messages[] = 'đã cập nhật mật khẩu thành công 🥴';
         } else {
            $messages[] = 'vui lòng nhập mật khẩu mới 🙄';
         }
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
    <title>Cập Nhật Thông Tin Cá Nhân</title>
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

    <!-- Begin: Cập nhật thông tin -->
    <section class="form-container">
        <form action="" method="post">
            <h3>Cập nhật thông tin</h3>

            <input autocomplete="off" type="text" placeholder="<?= $fetch_profile['tenkh'] ?>" class="box"
                maxlength="50" name="name">

            <input autocomplete="off" type="email" placeholder="<?= $fetch_profile['gmailkh'] ?>" class="box"
                maxlength="50" name="email">

            <input autocomplete="off" type="number" placeholder="<?= $fetch_profile['sdtkh'] ?>" class="box"
                max="9999999999" min="0" maxlength="10" name="number">

            <input type="password" name="old_pass" placeholder="Nhập mật khẩu cũ" class="box" maxlength="50"
                oninput="this.value = this.value.replace(/\s/g,'')">

            <input type="password" name="new_pass" placeholder="Nhập mật khẩu mới" class="box" maxlength="50"
                oninput="this.value = this.value.replace(/\s/g,'')">

            <input type="password" name="confirm_pass" placeholder="Nhập lại mật khẩu mới" class="box" maxlength="50"
                oninput="this.value = this.value.replace(/\s/g,'')">

            <input type="submit" value="Cập nhật" name="submit" class="btn">
        </form>
    </section>
    <!-- End: Cập nhật thông tin -->

    <!-- Begin: footer -->
    <?php require_once('components/footer.php') ?>
    <!-- End: footer -->

    <div class="loader">
        <img src="images/loader.gif" alt="">
    </div>

    <script src="js/script.js"></script>
</body>

</html>