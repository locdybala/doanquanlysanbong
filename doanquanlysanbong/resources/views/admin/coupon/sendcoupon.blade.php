<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
        }
        .coupon{
            border:5px dotted #bbb;
            width:80%;
            border-radius: 15px;
            margin: 0px auto;
            max-width: 600px;
        }
        .container{
            padding: 2px 15px;
            background-color: #f1f1f1;

        }
        .promo{
            background-color: #ccc;
            padding: 3px;
        }
        .expire{
            color: red;
        }
        p.code{
            text-align: center;
            font-size: 20px;
        }
        p.expire{
            text-align: center;
        }
        h2.note{
            text-align: center;
            font-size: large;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="coupon">
        <div class="container">
            <h3>Mã khuyến mãi từ sân bóng <a target="_blank" href="http://127.0.0.1:8000/">Phùng Xá</a></h3>
        </div>
        <div style="background-color:white;" class="container">
            <h2 class="note"><b><i>Giảm 10% cho các khách hàng vip của sân bóng</i></b></h2>
            <p>Qúy khách đã từng đặt sân tại <a target="_blank" style="color: red;" href="http://127.0.0.1:8000/">Sân bóng Phùng Xá</a>
            nếu đã có tài khoản vui lòng <a target="_blank" style="color: red;" href="http://127.0.0.1:8000/login_checkout">đăng nhập </a>để có thể sử dụng mã khuyến mãi, xin cảm ơn quý khách. Chúc quý khách thật nhiều sức khỏe</p>
        </div>
        <div class="container">
            <p class="code">Sử dụng code sau <span class="promo">1312321</span></p>
            <p class="expire">Ngày hết hạn code </p>
        </div>
    </div>
</body>
</html>