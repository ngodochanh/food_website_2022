<?php
include_once ('../components/connect.php');

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['add_product'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);
   $category = $_POST['category'];
   $category = filter_var($category, FILTER_SANITIZE_STRING);

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = '../uploaded_img/'.$image;

   $select_products = $conn->prepare("SELECT * FROM `sanpham` WHERE tensp = ?");
   $select_products->execute([$name]);

   if($select_products->rowCount() > 0){
      $message[] = 'tên thực đơn đã tồn tại';
   }else{
      if($image_size > 2000000){
         $message[] = 'ảnh này nặng quá';
      }else{
         move_uploaded_file($image_tmp_name, $image_folder);

         $insert_product = $conn->prepare("INSERT INTO `sanpham`(tensp, loaisp, giasp, anhsp) VALUES(?,?,?,?)");
         $insert_product->execute([$name, $category, $price, $image]);

         $message[] = 'Thêm thực đơn thành công';
      }
   }
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_product_image = $conn->prepare("SELECT * FROM `sanpham` WHERE idsp = ?");
   $delete_product_image->execute([$delete_id]);
   $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);
   unlink('../uploaded_img/'.$fetch_delete_image['image']);
   $delete_product = $conn->prepare("DELETE FROM `sanpham` WHERE idsp = ?");
   $delete_product->execute([$delete_id]);
   $delete_cart = $conn->prepare("DELETE FROM `giohang` WHERE idsp = ?");
   $delete_cart->execute([$delete_id]);
   header('location:products.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>products</title>

    <!-- Link icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="../css/admin_style.css">

</head>

<body>

    <?php include_once ('../components/admin_header.php') ?>

    <!-- Begin: thêm thực đơn  -->
    <section class="add-products" style="overflow: auto;">

        <form action="" method="POST" enctype="multipart/form-data">
            <h3>Thêm Thực Đơn</h3>
            <input autocomplete="off" type="text" required placeholder="Nhập tên món" name="name" maxlength="100"
                class="box">

            <input autocomplete="off" type="number" min="0" max="9999999999" required placeholder="Nhập đơn giá"
                name="price" onkeypress="if(this.value.length == 10) return false;" class="box">

            <select name="category" class="box" required>
                <option value="" disabled selected>Chọn loại thực đơn</option>
                <option value="Thức ăn nhanh">Thức ăn nhanh</option>
                <option value="Món ăn chính">Món ăn chính</option>
                <option value="Đồ uống">Đồ uống</option>
                <option value="Món tráng miệng">Món tráng miệng</option>
            </select>

            <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png, image/webp" required>

            <input type="submit" value="thêm thực đơn" name="add_product" class="btn">
        </form>

    </section>
    <!-- End: thêm thực đơn -->

    <!-- Begin: thực đơn  -->
    <section class="show-products" style="padding-top: 0;">
        <div class="box-container">

            <?php
            $item_per_page = !empty($_GET['per_page']) ? $_GET['per_page'] : 6;
            $current_page = !empty($_GET['page']) ? $_GET['page'] : 1;
            $offset = ($current_page - 1) * $item_per_page;

            $select_products_all = $conn -> prepare("SELECT * FROM `sanpham`");
            $select_products_all -> execute();

            $total_products = $select_products_all -> rowCount();
            $total_pages = ceil($total_products / $item_per_page);

            $show_products = $conn->prepare("SELECT * FROM `sanpham` ORDER BY idsp DESC LIMIT $item_per_page OFFSET $offset");
            $show_products->execute();
            if($show_products->rowCount() > 0){
               while($fetch_products = $show_products->fetch(PDO::FETCH_ASSOC)){  
?>
            <div class="box">
                <img src="../uploaded_img/<?= $fetch_products['anhsp']; ?>" alt="">
                <div class="flex">
                    <div class="price"><?= number_format($fetch_products['giasp'],0,',','.'); ?><span> đ</span></div>
                    <div class="category"><?= $fetch_products['loaisp']; ?></div>
                </div>
                <div class="name"><?= $fetch_products['tensp']; ?></div>
                <div class="flex-btn">
                    <a href="update_product.php?update=<?= $fetch_products['idsp']; ?>" class="option-btn">Cập nhật</a>
                    <a href="products.php?delete=<?= $fetch_products['idsp']; ?>" class="delete-btn"
                        onclick="return confirm('Bạn muốn xóa sản phẩm này?');">Xóa</a>
                </div>
            </div>
            <?php
   }
}else{
   echo '<p class="empty">Chưa có thực đơn nào!</p>';
}
?>

        </div>
        <div class="page">
            <?php 
            if ($current_page >= 3) {
                $first_page = 1;
                   
        ?>
            <a class="" href="?per_page=<?= $item_per_page ?>&page=<?= $first_page ?>">First</a>
            <?php     
            }  

            if ($current_page > 1) {
               $prev_page = $current_page - 1;
            ?>
               <a class="" href="?per_page=<?= $item_per_page ?>&page=<?= $first_page ?>"><i class="fa-solid fa-chevron-left"></i></a>
            <?php
            }

            for($i = 1; $i <= $total_pages; $i++) {
                if ($current_page != $i) {
                    if ($i > $current_page - 3 && $i < $current_page + 3) {
        ?>
            <a class="" href="?per_page=<?= $item_per_page ?>&page=<?= $i ?>"><?= $i ?></a>
            <?php
                    }
                } else {
        ?>
            <a style="background-color: var(--main-color); color: var(--white);"><?= $i ?></a>
            <?php
                }
            }
            
            if ($current_page < $total_pages) {
               $next_page = $current_page + 1;
            ?>
               <a class="" href="?per_page=<?= $item_per_page ?>&page=<?= $next_page ?>"><i class="fa-solid fa-chevron-right"></i></a>
            <?php
            }

            if ($current_page <= $total_pages - 3) {
                $end_page = $total_pages;
        ?>
            <a class="" href="?per_page=<?= $item_per_page ?>&page=<?= $end_page ?>">Last</a>
            <?php
            }
        ?>
        </div>
    </section>
    <!-- End: thực đơn  -->

    <!-- js -->
    <script src="../js/admin_script.js"></script>

</body>

</html>