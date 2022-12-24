<?php 
function header_Mail($title_content) {
    $content = '
    <section style="margin: 0 auto; max-width: 1200px; padding: 20px;">
        <div style="background-color: #fed330; max-width: 600px; margin: 0 auto; border: 2px solid #222; border-bottom: none; color: #222; box-sizing: border-box;">
            <h1 style="font-size: 80px; text-align: center; margin: 0;">yum yum 😋</h1>
            <h1 style="margin-bottom: 0; text-align: center; font-size: 30px; text-transform: uppercase; text-underline-offset: 10px; margin-top: 25px; padding-bottom: 25px; text-decoration: underline;">'.$title_content.'</h1>
        </div>
        <form action="" method="post" style="max-width: 600px; margin: 0 auto; border: 2px solid #222; border-top: none; padding: 20px; box-sizing: border-box;">
            <div style="background-color: #222; padding: 20px; padding-top: 0;">
                <table style="width: 100%; font-size: 20px; padding-top: 20px;">
                    <thead>
                        <tr>
                            <th colspan="2" style="text-align: left; font-size: 25px; text-transform: capitalize; color: #fff; padding-bottom: 15px;">
                                Mặt hàng giỏ hàng
                            </th>
                        </tr>
                    </thead>
                    <tbody > 
        ';
    return $content;
}