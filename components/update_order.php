<?php
    include_once ('connect.php');
    
    if (isset($_GET['payment_status']) || isset($_GET['order_id'])) {
        $method = $_GET['payment_status'];
        $method = filter_var($method, FILTER_SANITIZE_STRING);

        $order_id = $_GET['order_id'];
        $order_id = filter_var($order_id, FILTER_SANITIZE_STRING);

        $update_status = $conn->prepare("UPDATE `donhang` SET tinhtrang = ? WHERE iddonhang = ?");
        $update_status->execute([$method, $order_id]);

        header('location:http://localhost:81/food_website_2022/order_cancellation.php?order_id='.$order_id);
    }
   