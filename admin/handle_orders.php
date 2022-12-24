<?php
include_once ('../components/connect.php');

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)) {
   header('location:admin_login.php');
};

if(isset($_POST['update_payment'])) {
    $order_id = $_POST['order_id'];
    $payment_status = $_POST['payment_status'];
    $update_status = $conn->prepare("UPDATE `donhang` SET tinhtrang = ? WHERE iddonhang = ?");
    $update_status->execute([$payment_status, $order_id]);
    $message[] = 'cập nhật trạng thái thanh toán thành công 🤑';

    if ($payment_status == 'đã xử lý') {
        $name = $_POST['name'];
        $name = filter_var($name, FILTER_SANITIZE_STRING);

        $email = $_POST['email'];
        $email = filter_var($email, FILTER_SANITIZE_STRING);

        $number = $_POST['number'];
        $number = filter_var($number, FILTER_SANITIZE_STRING);

        $address = $_POST['address'];
        $address = filter_var($address, FILTER_SANITIZE_STRING);

        $total_products = $_POST['total_products'];
        $total_products = filter_var($total_products, FILTER_SANITIZE_STRING);

        $total_price = $_POST['total_price'];
        $total_price = filter_var($total_price, FILTER_SANITIZE_STRING);

        $method = $_POST['method'];
        $method = filter_var($method, FILTER_SANITIZE_STRING);

        require_once ('../mail/send_mail.php');
        require_once ('../mail/desgin_header_mail.php');
        require_once ('../mail/desgin_handle_mail.php');
        require_once ('../mail/desgin_footer_mail.php');
        $mail = new Mailer();

        $title = 'Đang giao đơn hàng tại yum yum 😋';
        $title_content = 'Đơn hàng đang được giao';
        
        $content = header_Mail($title_content);

        $products = explode(' - ', trim($total_products));
        $products = str_replace('(', '+', $products);
        $products = str_replace(')', '', $products);

        foreach($products as $product ) {
            $arr_product = explode('+', trim($product));
            
            $name_product = trim($arr_product[0]);

            $arr_info_product = explode('x', $arr_product[1]);

            $price_product = trim($arr_info_product[0]);
            $pty_product = trim($arr_info_product[1]);
            
            $content .= handle_Mail($name_product,  $price_product, $pty_product);
        }
        
        $content .= footer_Mail($method, $total_price, $name, $number, $email, $address, '');

        $mail -> dathangmail($title, $content, $email, $name);
    }

}

if(isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_order = $conn->prepare("DELETE FROM `donhang` WHERE iddonhang = ?");
    $delete_order->execute([$delete_id]);
    header('location:placed_orders.php');
}
?>