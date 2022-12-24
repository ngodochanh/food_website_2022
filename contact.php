<?php

include_once ('components/connect.php');

session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
};

if (isset($_POST['send'])) {
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    $number = $_POST['number'];
    $number = filter_var($number, FILTER_SANITIZE_STRING);

    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);

    $msg = $_POST['msg'];
    $msg = filter_var($msg, FILTER_SANITIZE_STRING);

    $select_messages = $conn -> prepare("SELECT * FROM tinnhan WHERE tenkh = ? AND gmailkh = ? AND sdtkh = ? 
        AND tinnhan = ?");

    $select_messages -> execute([$name , $email, $number, $msg]);

    if ($select_messages -> rowCount() > 0) {
        $messages[] = 'tin nhắn đã gửi rồi 😍';
    } else {
        $insert_messages = $conn -> prepare("INSERT INTO `tinnhan` (idkh, tenkh, gmailkh, sdtkh, tinnhan) VALUES (?,?,?,?,?)");
        $insert_messages -> execute([$user_id, $name, $email, $number, $msg]);
        $messages[] = 'tin nhắn gửi thành công 😍';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liên Hệ</title>
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
        <h3>Liên hệ</h3>
        <p>
            <a href="home.html">Trang Chủ</a>
            <span>/ Liên hệ</span>
        </p>
    </div>
    <!-- End: heading -->

    <!-- Begin: liên hệ -->
    <section class="contact">
        <div class="row">
            <div class="image">
                <img src="images/contact-img.svg" alt="">
            </div>
            <form action="" method="post">
                <h3>Liên lạc với chúng tôi!</h3>
                <input type="text" name="name" maxlength="50" class="box" placeholder="Nhập họ tên"
                    value="<?= $user_id == '' ? '' : $fetch_profile['tenkh'] ?>" required>

                <input type="number" name="number" min="0" max="9999999999" class="box" placeholder="Nhập số điện thoại"
                    value="<?= $user_id == '' ? '' : $fetch_profile['sdtkh'] ?>" required
                    onkeypress="if(this.value.length == 10) return false;">

                <input type="email" name="email" maxlength="50" class="box" placeholder="Nhập gmail"
                    value="<?= $user_id == '' ? '' : $fetch_profile['gmailkh'] ?>" required>

                <textarea name="msg" class="box" placeholder="Nhập tin nhắn" required maxlength="50" cols="30"
                    rows="10"></textarea>
                <input type="submit" value="Gửi đi" name="send" class="btn">

            </form>
        </div>
    </section>
    <!-- End: liên hệ -->

    <!-- Begin: footer -->
    <?php require_once('components/footer.php') ?>
    <!-- End: footer -->

    <div class="loader">
        <img src="images/loader.gif" alt="">
    </div>

    <script src="js/script.js"></script>
</body>

</html>