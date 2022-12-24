<?php
function handle_Mail($name_product, $price_product, $pty_product) {
    $content = '
                                <tr>
                                    <td style="max-width: 60px; color: #777; text-transform: capitalize; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">'.$name_product.'</td>
                                    <td style="width: 36%; color: #fed330; text-align: right;">
                                        <span>'.number_format((int) $price_product,0,',','.').' đ</span>
                                        <span style="color: #fff; margin: 0 10px;">x</span>
                                        <span>'.$pty_product.'</span></td>
                                </tr>
                ';
    return $content;
}