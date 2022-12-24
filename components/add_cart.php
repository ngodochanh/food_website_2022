<?php 
    if (isset($_POST['add_to_cart'])) {
        if ($user_id == '') {
            header('Location:login.php');
        } else {
            $pid = $_POST['pid'];
            $pid = filter_var($pid, FILTER_SANITIZE_STRING);
            
            $qty = $_POST['qty'];
            $qty = filter_var($qty, FILTER_SANITIZE_STRING);
    
            $check_cart_number = $conn -> prepare('SELECT * FROM `giohang` WHERE idkh = ? AND idsp = ?');
            $check_cart_number -> execute([$user_id, $pid]);
    
            if ($check_cart_number -> rowCount() > 0) {
                $messages[] = 'đã có trong giỏ hàng 😋';
            } else {
                $insert_cart = $conn -> prepare('INSERT INTO `giohang` (idkh, idsp, soluong)
                    VALUES (?, ?, ?)');
                $insert_cart -> execute([$user_id, $pid, $qty]);
                $messages[] = 'thêm giỏ hàng thành công 😋';
            }
        }

        $check_cart_number = $conn -> prepare('SELECT * FROM `giohang` WHERE idkh = ?');
        
    }