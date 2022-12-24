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
    if (!empty($_POST['flat'])) {
        $address = $_POST['flat']. ', '. $_POST['street']. ', phường '. $_POST['ward']. ', quận '
        . $_POST['district']. ', thành phố '. $_POST['city']. ' - '. $_POST['pin_code'];
    } else {
        $address = $_POST['street']. ', phường '. $_POST['ward']. ', quận '. $_POST['district']
        . ', thành phố '. $_POST['city']. ' - '. $_POST['pin_code'];
    }
    $address = filter_var($address, FILTER_SANITIZE_STRING);

    $update_address = $conn -> prepare("UPDATE `khachhang` SET diachikh = ? WHERE idkh = ?");
    $update_address -> execute([$address, $user_id]);
    $messages[] = 'cập nhật địa chỉ thành công 😶‍🌫️';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập Nhật Địa Chỉ</title>
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

    <!-- Begin: cập nhật địa chỉ -->
    <section class="form-container">
        <form action="" method="post" id="update_address">
            <h3>Địa chỉ của bạn</h3>

            <input autocomplete="off" type="text" class="box" placeholder="Nhập tòa nhà chung cư" name="flat"
                maxlength="50">

            <input autocomplete="off" type="text" class="box" placeholder="Nhập tên đường số nhà" name="street" 
                required maxlength="50">

            <input autocomplete="off" type="text" class="box" placeholder="Nhập phường" name="ward" 
                required maxlength="50">

            <input autocomplete="off" type="text" class="box" placeholder="Nhập quận" name="district" 
                required maxlength="50">

            <input autocomplete="off" type="text" class="box" placeholder="Nhập thành phố" name="city" 
                required maxlength="50">

            <input autocomplete="off" type="number" class="box" placeholder="Mã pin" required max="999999" 
                min="0" name="pin_code" onkeydown="if(this.value.length == 6) return false;">

            <input type="submit" value="Lưu địa chỉ" name="submit" class="btn">
        </form>
    </section>
    <!-- End: cập nhật địa chỉ -->

    <!-- Begin: footer -->
    <?php require_once('components/footer.php') ?>
    <!-- End: footer -->

    <div class="loader">
        <img src="images/loader.gif" alt="">
    </div>

    <script src="js/script.js"></script>
</body>

</html>