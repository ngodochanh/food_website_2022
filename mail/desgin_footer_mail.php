<?php 
    function footer_Mail($method, $total_price, $name, $number, $email, $address, $iddonhang) {
        $content = '
                        </tbody>
                    </table>

                    <table style="width: 100%; font-size: 20px; padding-top: 20px;">
                        <thead>
                            <tr>
                                <th colspan="2" style="text-align: left; font-size: 25px; text-transform: capitalize; color: #fff; padding-bottom: 15px;">
                                    Hình thức thanh toán
                                </th>
                            </tr>
                        </thead>
                        <tbody >
                            <tr>
                                <td style="color: #777; text-transform: capitalize;">'.$method.'</td>
                                <td style="width: 36%; color: #fed330; text-align: right;">
                                    0 đ
                            </tr>
                        </tbody>
                    </table>

                    <table style="width: 100%; font-size: 20px; padding: 15px; background-color: #fff; margin-top: 20px;">
                        <tbody >
                            <tr>
                                <td style="margin: 5px 0; color: #777; text-transform: capitalize;  overflow: hidden; display: -webkit-box; -webkit-box-orient: vertical; -webkit-line-clamp: 1;">Tổng đơn :</td>
                                <td style="color: #e74c3c;; text-align: right;">
                                    '.number_format($total_price ,0,',','.').' đ
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="user-info">
                    <h3 style="margin: 0; font-size: 25px; text-transform: capitalize; padding-top: 20px; color: #222;">thông tin của bạn</h3>
                    <p style="margin:0; font-size: 20px; line-height: 1.5; padding-top: 10px;">
                        <span style="color: #222; text-transform: capitalize;">'.$name.'</span>
                    </p>

                    <p style="margin:0; font-size: 20px; line-height: 1.5; padding-top: 10px;">
                        <span style="color: #222;">'.$number.'</span>
                    </p>

                    <p style="margin:0; font-size: 20px; line-height: 1.5; padding-top: 10px;">
                        <span style="color: #222;">'.$email.'</span>
                    </p>

                    <h3 style="margin: 0; font-size: 25px; text-transform: capitalize; padding-top: 20px; color: #222;">Địa chỉ nhận hàng</h3>
                    <p style="margin:0; font-size: 20px; line-height: 1.5; padding-top: 10px;">
                        <span style="color: #222;">
                            '.$address.'
                        </span>
                    </p>
                </div>
            ';
            if ($iddonhang != '') {
                $content .= '
                    <p style="margin:0; padding-top: 20px; color: #222; font-size: 22px; font-weight: bold;">Bạn muốn hủy đơn?</p>
                    <a style="display: block; font-size: 20px; padding-top: 10px; color: #777;" href="http://localhost:81/food_website_2022/order_cancellation.php?order_id='.$iddonhang.'">Hủy đơn</a>
                </form>
            </section>';
            } else {
                $content .= '
                </form>
            </section>';
            }

        return $content;
    }