<div class="box">
    <p> Mã khách hàng: <span><?= $fetch_orders['idkh']; ?></span> </p>
    <p> Ngày đặt : <span><?= $fetch_orders['ngaydat']; ?></span> </p>
    <p> Tên: <span><?= $fetch_orders['tenkh']; ?></span> </p>
    <p> Gmail: <span><?= $fetch_orders['gmailkh']; ?></span> </p>
    <p> Số điện thoại : <span><?= $fetch_orders['sdtkh']; ?></span> </p>
    <p> Địa chỉ : <span><?= $fetch_orders['diachi']; ?></span> </p>
    <p> Các sản phẩm : <span><?= $fetch_orders['cacsp']; ?></span> </p>
    <p> Tổng đơn hàng : <span><?= number_format($fetch_orders['tongdonhang'],0,',','.'); ?> đ</span> </p>
    <p> Phương thức thanh toán : <span><?= $fetch_orders['phuongthucthanhtoan']; ?></span> </p>
    <form action="" method="POST">
        <input type="hidden" name="order_id" value="<?= $fetch_orders['iddonhang']; ?>">
        <input type="hidden" name="total_products" value="<?= $fetch_orders['cacsp'] ?>">
        <input type="hidden" name="total_price" value="<?= $fetch_orders['tongdonhang'] ?>">
        <input type="hidden" name="name" value="<?= $fetch_orders['tenkh']; ?>">
        <input type="hidden" name="number" value="<?= $fetch_orders['sdtkh']; ?>">
        <input type="hidden" name="email" value="<?= $fetch_orders['gmailkh']; ?>">
        <input type="hidden" name="address" value="<?= $fetch_orders['diachi']; ?>">
        <input type="hidden" name="method" value="<?= $fetch_orders['phuongthucthanhtoan']; ?>">

        <select name="payment_status" class="drop-down">
            <option value="chưa xử lý" <?= $fetch_orders['tinhtrang'] == 'chưa xử lý' ? 'selected' : '' ?>>chưa xử lý
            </option>
            <option value="đã xử lý" <?= $fetch_orders['tinhtrang'] == 'đã xử lý' ? 'selected' : ''?>>đã xử lý</option>
            <option value="đã hủy" <?= $fetch_orders['tinhtrang'] == 'đã hủy' ? 'selected' : ''?>>đã hủy</option>
            <option value="đã hoàn thành" <?= $fetch_orders['tinhtrang'] == 'đã hoàn thành' ? 'selected' : ''?>>đã hoàn thành</option>
        </select>
        <div class="flex-btn">
            <input type="submit" value="cập nhật" class="btn" name="update_payment">
            <a href="placed_orders.php?delete=<?= $fetch_orders['iddonhang']; ?>" class="delete-btn"
                onclick="return confirm('Xóa đơn đặt hàng này 😣?');">Xóa</a>
        </div>
    </form>
</div>