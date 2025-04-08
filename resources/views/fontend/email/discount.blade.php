<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mã giảm giá</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 600px;
        margin: 20px auto;
        background-color: #ffffff;
        border: 1px solid #ddd;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .header {
        background-color: #4CAF50;
        color: #ffffff;
        text-align: center;
        padding: 20px;
    }

    .header h3 {
        margin: 0;
        font-size: 24px;
    }

    .content {
        padding: 20px;
        color: #333;
        line-height: 1.6;
    }

    .content p {
        margin: 0 0 15px;
    }

    .content b {
        color: #4CAF50;
    }

    .footer {
        text-align: center;
        padding: 15px;
        background-color: #f9f9f9;
        border-top: 1px solid #ddd;
    }

    .footer a {
        color: #4CAF50;
        text-decoration: none;
        font-weight: bold;
    }

    .footer a:hover {
        text-decoration: underline;
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h3>Mã giảm giá từ shop COCOONVIETNAM</h3>
        </div>
        <div class="content">
            <?php
            if ($discount->formality == 'percent') {
            ?>
            <p>Cảm ơn quý khách hàng đã đồng hành cùng CocoonVietNam trong thời gian qua. Để quý khách có thể trải
                nghiệm nhiều sản phẩm hơn từ cửa hàng Cocoon, xin gửi tặng quý khách mã <b><i>voucher giảm
                        {{$discount->valuation}}%</i></b> cho tổng hóa đơn tối thiểu 0đ.</p>
            <?php
            } else {
            ?>
            <p>Cảm ơn quý khách hàng đã đồng hành cùng CocoonVietNam trong thời gian qua. Để quý khách có thể trải
                nghiệm nhiều sản phẩm hơn từ cửa hàng Cocoon, xin gửi tặng quý khách mã <b><i>voucher giảm
                        {{$discount->valuation}} VND</i></b> cho tổng hóa đơn tối thiểu 0đ.</p>
            <?php
            }
            ?>
            <p><strong>Mã giảm giá:</strong> {{$discount->code}}</p>
        </div>
        <div class="footer">
            <a href="http://127.0.0.1:8000/" target="_blank">Cửa hàng COCOONVIETNAM</a>
        </div>
    </div>
</body>

</html>