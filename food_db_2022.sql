-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th1 09, 2023 lúc 07:09 AM
-- Phiên bản máy phục vụ: 10.4.21-MariaDB
-- Phiên bản PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `food_db_2022`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `tentk` varchar(20) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `mk` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`id`, `tentk`, `mk`) VALUES
(1, 'admin', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
(3, 'ngodochanh', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
(5, 'empty', '40bd001563085fc35165329ea1ff5c5ecbdbbeef');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `donhang`
--

CREATE TABLE `donhang` (
  `iddonhang` int(11) NOT NULL,
  `idkh` int(11) NOT NULL,
  `tenkh` varchar(20) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `gmailkh` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `sdtkh` varchar(10) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `phuongthucthanhtoan` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `diachi` varchar(500) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `cacsp` varchar(1000) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `tongdonhang` int(11) NOT NULL,
  `ngaydat` date NOT NULL DEFAULT current_timestamp(),
  `tinhtrang` varchar(20) COLLATE utf8mb4_vietnamese_ci NOT NULL DEFAULT 'chưa xử lý'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `donhang`
--

INSERT INTO `donhang` (`iddonhang`, `idkh`, `tenkh`, `gmailkh`, `sdtkh`, `phuongthucthanhtoan`, `diachi`, `cacsp`, `tongdonhang`, `ngaydat`, `tinhtrang`) VALUES
(1, 1, 'cao hữu phúc', 'phucchp@gmail.com', '0147258366', 'thanh toán khi giao hàng', '160 Hồ Tùng Mậu, phường Hòa Minh, quận Liên Chiển, thành phố Đà Nẵng - 123456', 'Thịt kho bào ngư (100000 x 2) - muffins (49000 x 1)', 149000, '2022-12-14', 'đã hoàn thành'),
(2, 2, 'Trần Duy Tân', 'tranduyytan@gmail.com', '0147852258', 'thanh toán khi giao hàng', 'Căn hộ 606, Hoàng Văn Thái, phường Hòa khánh nam, quận liên chiểu, thành phố đà nẵng - 123456', 'muffins (49000 x 2) - Bánh waffle (6000 x 2) - Lasagne Pastitsio Hawaiian pizza (150000 x 1) - Gà rán (101000 x 1)', 261000, '2022-12-14', 'đã hoàn thành'),
(3, 2, 'Trần Duy Tân', 'tranduyytan@gmail.com', '0147852258', 'thanh toán khi giao hàng', 'Căn hộ 606, Hoàng Văn Thái, phường Hòa khánh nam, quận liên chiểu, thành phố đà nẵng - 123456', 'Thịt kho bào ngư (100000 x 1) - Thịt kho tàu (100000 x 1)', 200000, '2022-12-14', 'đã xử lý'),
(4, 2, 'Trần Duy Tân', 'tranduyytan@gmail.com', '0147852258', 'thanh toán khi giao hàng', 'Căn hộ 606, Hoàng Văn Thái, phường Hòa khánh nam, quận liên chiểu, thành phố đà nẵng - 123456', 'Bánh Mỳ (20000 x 2) - Lasagne Pastitsio Hawaiian pizza (150000 x 2)', 240000, '2022-12-14', 'đã xử lý'),
(5, 2, 'Trần Duy Tân', 'tranduyytan@gmail.com', '0147852258', 'thanh toán khi giao hàng', 'Căn hộ 606, Hoàng Văn Thái, phường Hòa khánh nam, quận liên chiểu, thành phố đà nẵng - 123456', 'Gà rán (101000 x 2) - Kimbap  (160000 x 2) - muffins (49000 x 1)', 571000, '2022-12-15', 'đã xử lý'),
(6, 1, 'cao hữu phúc', 'phucchp@gmail.com', '0147258366', 'thanh toán khi giao hàng', '160 Hồ Tùng Mậu, phường Hòa Minh, quận Liên Chiển, thành phố Đà Nẵng - 123456', 'Nước chanh (20000 x 1) - muffins (49000 x 1)', 69000, '2022-12-15', 'đã xử lý'),
(7, 1, 'cao hữu phúc', 'phucchp@gmail.com', '0147258366', 'thẻ tín dụng', '160 Hồ Tùng Mậu, phường Hòa Minh, quận Liên Chiển, thành phố Đà Nẵng - 123456', 'Hamburger (60000 x 2) - Nước cam (20000 x 3)', 180000, '2022-12-15', 'đã xử lý'),
(8, 1, 'cao hữu phúc', 'phucchp@gmail.com', '0147258366', 'paytm', '160 Hồ Tùng Mậu, phường Hòa Minh, quận Liên Chiển, thành phố Đà Nẵng - 123456', 'Gà rán (101000 x 2) - Bánh waffle (60000 x 1) - Thịt kho bào ngư (100000 x 2)', 462000, '2022-12-17', 'đã xử lý'),
(9, 2, 'Trần Duy Tân', 'tranduyytan@gmail.com', '0147852258', 'paypal', 'Căn hộ 606, Hoàng Văn Thái, phường Hòa khánh nam, quận liên chiểu, thành phố đà nẵng - 123456', 'Gà rán (101000 x 3) - Mì xào (50000 x 3) - Nước chanh (20000 x 2) - Nước cam (20000 x 1)', 513000, '2022-12-17', 'đã xử lý'),
(10, 2, 'Trần Duy Tân', 'tranduyytan@gmail.com', '0147852258', 'paypal', 'Căn hộ 606, Hoàng Văn Thái, phường Hòa khánh nam, quận liên chiểu, thành phố đà nẵng - 123456', 'Nước chanh (20000 x 2) - Lasagne Pastitsio Hawaiian pizza (150000 x 2)', 340000, '2022-12-17', 'đã xử lý'),
(11, 2, 'Trần Duy Tân', 'tranduyytan@gmail.com', '0147852258', 'thanh toán khi giao hàng', 'Căn hộ 606, Hoàng Văn Thái, phường Hòa khánh nam, quận liên chiểu, thành phố đà nẵng - 123456', 'Thịt kho tàu (100000 x 2) - muffins (49000 x 2) - coffee (20000 x 2)', 338000, '2022-12-17', 'đã hủy'),
(12, 1, 'cao hữu phúc', 'phucchp@gmail.com', '0147258366', 'paytm', '160 Hồ Tùng Mậu, phường Hòa Minh, quận Liên Chiển, thành phố Đà Nẵng - 123456', 'Bánh waffle (60000 x 1) - Lasagne Pastitsio Hawaiian pizza (150000 x 2) - Mì xào (50000 x 2)', 460000, '2022-12-17', 'chưa xử lý'),
(13, 1, 'cao hữu phúc', 'phucchp@gmail.com', '0147258366', 'paytm', '160 Hồ Tùng Mậu, phường Hòa Minh, quận Liên Chiển, thành phố Đà Nẵng - 123456', 'Bánh waffle (60000 x 1) - Lasagne Pastitsio Hawaiian pizza (150000 x 2) - Mì xào (50000 x 2)', 460000, '2022-12-17', 'chưa xử lý'),
(14, 1, 'cao hữu phúc', 'phucchp@gmail.com', '0147258366', 'thẻ tín dụng', '160 Hồ Tùng Mậu, phường Hòa Minh, quận Liên Chiển, thành phố Đà Nẵng - 123456', 'Mì xào (50000 x 2) - Thịt kho bào ngư (100000 x 1) - Thịt kho tàu (100000 x 1) - Nước chanh (20000 x 4) - Nước cam (20000 x 4)', 460000, '2022-12-17', 'chưa xử lý'),
(15, 1, 'cao hữu phúc', 'phucchp@gmail.com', '0147258366', 'paypal', '160 Hồ Tùng Mậu, phường Hòa Minh, quận Liên Chiển, thành phố Đà Nẵng - 123456', 'muffins (49000 x 1) - Bánh waffle (60000 x 2) - Hamburger (60000 x 1)', 229000, '2022-12-17', 'chưa xử lý'),
(16, 1, 'cao hữu phúc', 'phucchp@gmail.com', '0147258366', 'thanh toán khi giao hàng', '160 Hồ Tùng Mậu, phường Hòa Minh, quận Liên Chiển, thành phố Đà Nẵng - 123456', 'Thịt kho bào ngư (100000 x 2)', 200000, '2022-12-17', 'chưa xử lý'),
(17, 1, 'cao hữu phúc', 'phucchp@gmail.com', '0147258366', 'paypal', '160 Hồ Tùng Mậu, phường Hòa Minh, quận Liên Chiển, thành phố Đà Nẵng - 123456', 'Thịt kho tàu (100000 x 1)', 100000, '2022-12-17', 'chưa xử lý'),
(18, 1, 'cao hữu phúc', 'phucchp@gmail.com', '0147258366', 'paytm', '160 Hồ Tùng Mậu, phường Hòa Minh, quận Liên Chiển, thành phố Đà Nẵng - 123456', 'Mì xào (50000 x 1)', 50000, '2022-12-17', 'đã hủy'),
(19, 1, 'cao hữu phúc', 'phucchp@gmail.com', '0147258366', 'thanh toán khi giao hàng', '160 Hồ Tùng Mậu, phường Hòa Minh, quận Liên Chiển, thành phố Đà Nẵng - 123456', 'Bánh waffle (60000 x 3) - Nước chanh (20000 x 4)', 260000, '2022-12-20', 'chưa xử lý'),
(20, 3, 'phạm xuân nhân', 'jonhpham@gmail.com', '0147741147', 'paytm', '160 Hồ Tùng Mậu, phường Hòa minh, quận liên chiểu, thành phố đà nẵng - 123456', 'Nước chanh (20000 x 2) - Thịt kho bào ngư (100000 x 1) - Nước cam (20000 x 2) - Thịt kho tàu (100000 x 3)', 480000, '2022-12-21', 'đã hủy'),
(21, 3, 'phạm xuân nhân', 'jonhpham@gmail.com', '0147741147', 'thẻ tín dụng', '160 Hồ Tùng Mậu, phường Hòa Minh , quận Liên Chiểu, thành phố Đà Nẵng - 123456', 'Thịt kho bào ngư (100000 x 2) - Mì xào (50000 x 17)', 1050000, '2022-12-21', 'đã xử lý'),
(22, 3, 'phạm xuân nhân', 'jonhpham@gmail.com', '0147741147', 'paytm', '160 Hồ Tùng Mậu, phường Hòa Minh , quận Liên Chiểu, thành phố Đà Nẵng - 123456', 'Bánh waffle (60000 x 5)', 300000, '2022-12-21', 'đã hoàn thành'),
(23, 3, 'phạm xuân nhân', 'jonhpham@gmail.com', '0147741147', 'thẻ tín dụng', '160 Hồ Tùng Mậu, phường Hòa Minh , quận Liên Chiểu, thành phố Đà Nẵng - 123456', 'Mì xào (50000 x 1)', 50000, '2022-12-21', 'đã xử lý'),
(24, 3, 'phạm xuân nhân', 'jonhpham@gmail.com', '0147741147', 'paypal', '160 Hồ Tùng Mậu, phường Hòa Minh , quận Liên Chiểu, thành phố Đà Nẵng - 123456', 'Mì xào (50000 x 4) - Thịt kho bào ngư (100000 x 2)', 400000, '2022-12-21', 'đã hủy'),
(25, 1, 'cao hữu phúc', 'phucchp@gmail.com', '0147258366', 'thanh toán khi giao hàng', '160 Hồ Tùng Mậu, phường Hòa Minh, quận Liên Chiển, thành phố Đà Nẵng - 123456', 'muffins (49000 x 3) - Thịt kho tàu (100000 x 1) - Mì xào (50000 x 2) - Kem Dâu Tây (30000 x 2) - Thịt kho bào ngư (100000 x 2)', 607000, '2023-01-06', 'đã hủy'),
(26, 1, 'cao hữu phúc', 'phucchp@gmail.com', '0147258366', 'thẻ tín dụng', '160 Hồ Tùng Mậu, phường Hòa Minh, quận Liên Chiển, thành phố Đà Nẵng - 123456', 'Kem Dâu Tây (30000 x 2) - Mì xào (50000 x 1)', 110000, '2023-01-06', 'đã hủy'),
(27, 1, 'cao hữu phúc', 'phucchp@gmail.com', '0147258366', 'thanh toán khi giao hàng', '160 Hồ Tùng Mậu, phường Hòa Minh, quận Liên Chiển, thành phố Đà Nẵng - 123456', 'Humburger Đôi (100000 x 2) - Gà Nướng (150000 x 1)', 350000, '2023-01-06', 'chưa xử lý'),
(28, 3, 'phạm xuân nhân', 'jonhpham@gmail.com', '0147741147', 'thẻ tín dụng', '160 Hồ Tùng Mậu, phường Hòa Minh , quận Liên Chiểu, thành phố Đà Nẵng - 123456', 'Bánh waffle (60000 x 3)', 180000, '2023-01-09', 'đã hoàn thành');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giohang`
--

CREATE TABLE `giohang` (
  `idgiohang` int(11) NOT NULL,
  `idkh` int(11) NOT NULL,
  `idsp` int(11) NOT NULL,
  `soluong` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `giohang`
--

INSERT INTO `giohang` (`idgiohang`, `idkh`, `idsp`, `soluong`) VALUES
(52, 2, 13, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachhang`
--

CREATE TABLE `khachhang` (
  `idkh` int(11) NOT NULL,
  `tenkh` varchar(20) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `gmailkh` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `sdtkh` varchar(10) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `matkhaukh` varchar(50) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `diachikh` varchar(500) COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `khachhang`
--

INSERT INTO `khachhang` (`idkh`, `tenkh`, `gmailkh`, `sdtkh`, `matkhaukh`, `diachikh`) VALUES
(1, 'cao hữu phúc', 'phucchp@gmail.com', '0147258366', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '160 Hồ Tùng Mậu, phường Hòa Minh, quận Liên Chiển, thành phố Đà Nẵng - 123456'),
(2, 'Trần Duy Tân', 'tranduyytan@gmail.com', '0147852258', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Căn hộ 606, Hoàng Văn Thái, phường Hòa khánh nam, quận liên chiểu, thành phố đà nẵng - 123456'),
(3, 'phạm xuân nhân', 'jonhpham@gmail.com', '0147741147', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '160 Hồ Tùng Mậu, phường Hòa Minh , quận Liên Chiểu, thành phố Đà Nẵng - 123456');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

CREATE TABLE `sanpham` (
  `idsp` int(11) NOT NULL,
  `tensp` varchar(100) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `loaisp` varchar(100) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `giasp` int(11) NOT NULL,
  `anhsp` varchar(100) COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`idsp`, `tensp`, `loaisp`, `giasp`, `anhsp`) VALUES
(1, 'Gà rán', 'Thức ăn nhanh', 101000, 'garan-1.png'),
(2, 'Kimbap ', 'Thức ăn nhanh', 160000, 'gimbap.png'),
(3, 'Lasagne Pastitsio Hawaiian pizza', 'Thức ăn nhanh', 150000, 'LasagnePastitsioHawaiianpizza.png'),
(4, 'Bánh Mỳ', 'Thức ăn nhanh', 20000, 'bread.png'),
(5, 'Hamburger', 'Thức ăn nhanh', 60000, 'hamburger.png'),
(6, 'coffee', 'Đồ uống', 20000, 'cofee.png'),
(7, 'Nước cam', 'Đồ uống', 20000, 'orange-juice.png'),
(8, 'Nước chanh', 'Đồ uống', 20000, 'lemonade.png'),
(9, 'muffins', 'Món tráng miệng', 49000, 'muffins.png'),
(10, 'Bánh waffle', 'Món tráng miệng', 60000, 'waffle.png'),
(11, 'Thịt kho tàu', 'Món ăn chính', 100000, 'thitkhotau.png'),
(12, 'Thịt kho bào ngư', 'Món ăn chính', 100000, 'thitkhobaongu.png'),
(13, 'Mì xào', 'Món ăn chính', 50000, 'mixao.png'),
(14, 'Pizza Hải Sản Sốt Cà Chua', 'Thức ăn nhanh', 100000, 'home-img-1.png'),
(15, 'Humburger Đôi', 'Thức ăn nhanh', 100000, 'home-img-2.png'),
(16, 'Gà Nướng', 'Món ăn chính', 150000, 'home-img-3.png'),
(17, 'Kem Dâu Tây', 'Món tráng miệng', 30000, 'dessert-5.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tinnhan`
--

CREATE TABLE `tinnhan` (
  `idtinnhan` int(11) NOT NULL,
  `idkh` int(11) NOT NULL,
  `tenkh` varchar(100) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `gmailkh` varchar(100) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `sdtkh` varchar(20) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `tinnhan` varchar(500) COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `tinnhan`
--

INSERT INTO `tinnhan` (`idtinnhan`, `idkh`, `tenkh`, `gmailkh`, `sdtkh`, `tinnhan`) VALUES
(1, 1, 'cao hữu phúc', 'phucchp@gmail.com', '0147258366', 'Hello. I&#39;m Phúc. \r\nHow are you!'),
(2, 2, 'Trần Duy Tân', 'tranduyytan@gmail.com', '0147852258', 'I&#39;m American. Are you here on vacation?'),
(3, 0, 'Nguyễn Quốc Trung', 'ngodochanh@gmail.com', '0988070900', 'How are you?');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `donhang`
--
ALTER TABLE `donhang`
  ADD PRIMARY KEY (`iddonhang`);

--
-- Chỉ mục cho bảng `giohang`
--
ALTER TABLE `giohang`
  ADD PRIMARY KEY (`idgiohang`);

--
-- Chỉ mục cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`idkh`);

--
-- Chỉ mục cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`idsp`);

--
-- Chỉ mục cho bảng `tinnhan`
--
ALTER TABLE `tinnhan`
  ADD PRIMARY KEY (`idtinnhan`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `donhang`
--
ALTER TABLE `donhang`
  MODIFY `iddonhang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT cho bảng `giohang`
--
ALTER TABLE `giohang`
  MODIFY `idgiohang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `idkh` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `idsp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `tinnhan`
--
ALTER TABLE `tinnhan`
  MODIFY `idtinnhan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
