<?php
include_once ('../components/connect.php');

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)) {
   header('location:admin_login.php');
}

if(isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];
   $delete_message = $conn->prepare("DELETE FROM `tinnhan` WHERE idtinnhan = ?");
   $delete_message->execute([$delete_id]);
   header('location:messages.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tin nhắn</title>

    <!-- Link icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="../css/admin_style.css">
</head>

<body>

    <?php include_once ('../components/admin_header.php') ?>

    <!-- Begin: tin nhắn  -->
    <section class="messages">

        <h1 class="heading">Tin nhắn</h1>

        <div class="box-container">

            <?php
      $select_messages = $conn->prepare("SELECT * FROM `tinnhan` ORDER BY idtinnhan DESC");
      $select_messages->execute();
      if($select_messages->rowCount() > 0){
         while($fetch_messages = $select_messages->fetch(PDO::FETCH_ASSOC)) {
   ?>
            <div class="box">
                <p> Tên : <span><?= $fetch_messages['tenkh']; ?></span> </p>
                <p> Số điện thoại : <span><?= $fetch_messages['sdtkh']; ?></span> </p>
                <p> Gnail : <span><?= $fetch_messages['gmailkh']; ?></span> </p>
                <p> Tin nhắn : <span><?= $fetch_messages['tinnhan']; ?></span> </p>
                <a href="messages.php?delete=<?= $fetch_messages['idtinnhan']; ?>" class="delete-btn"
                    onclick="return confirm('Xóa tin nhắn này 😒');">Xóa</a>
            </div>
            <?php
         }
      } else {
         echo '<p class="empty">Không có tin nhắn 🫡</p>';
      }
   ?>
        </div>
    </section>
    <!-- End: tin nhắn  -->

    <!-- js -->
    <script src="../js/admin_script.js"></script>

</body>

</html>