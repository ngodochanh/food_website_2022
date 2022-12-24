<?php 
    include_once ('connect.php');
    session_start();
    session_unset();
    // phá hủy tất cả dữ liệu được liên kết với phiên hiện tại
    session_destroy();

    header('location: ../home.php');