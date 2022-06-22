<!DOCTYPE html>
<html lang="en">
<!-- https://cocoshop.vn/ -->
<!-- http://mauweb.monamedia.net/vanihome/ -->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="robots" content="INDEX,FOLLOW" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('title')

    <!-- Font roboto -->
    @yield('style')
    <link rel="preconnect" href="https://fonts.gstatic.com">

    <link rel="icon" type="image/x-icon" href=" " />
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <!-- Icon fontanwesome -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <!-- Reset css & grid sytem -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/library.css') }}">
    <link href="{{ asset('frontend/assets/owlCarousel/assets/owl.carousel.min.css') }}" rel="stylesheet" />
    <!-- Layout -->

    <link rel="stylesheet" href="{{ asset('frontend/assets/css/common.css') }}">

    <!-- index -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Owl caroucel Js-->
    <script src="{{ asset('frontend/assets/owlCarousel/owl.carousel.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/sweetalert.css') }}">


</head>

<body>
    <div class="header scrolling" id="myHeader">
        <div class="grid wide">
            <div class="header__top">
                <div class="navbar-icon">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <a href="index.html" class="header__logo">
                    <img style="height:100px ; margin-top:10px;" src="frontend/assets/logo.png" alt="">
                </a>
                <div class="header__search">

                    <div style="border: 1px solid;" class="header__search-wrap">
                        <form action="{{ URL::to('/search') }}" method="POST">
                            @csrf
                            <input type="text" class="header__search-input" name="keyword_submit" placeholder="Tìm kiếm">
                            <button style="margin-left: 150px" type="submit" class="header__search-icon">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="header__account">
                    <?php
                        $customer_id=Session::get('customer_id');
                        $shipping_id=Session::get('shipping_id');

                        if($customer_id!=  NULL&&$shipping_id==NULL){
                        
                    ?>
                    <a href="{{ route('checkout') }}" class="header__account-logout">Thanh toán</a>
                    <?php
                }elseif($customer_id!=  NULL&&$shipping_id!=NULL) {
                    
            ?>
                    <a href="{{ route('payment') }}" class="header__account-logout">Thanh toán</a>

                    <?php
                        }else {
                            
                    ?>
                    <a href="{{ route('login_checkout') }}" class="header__account-logout">Thanh toán</a>


                    <?php }?>

                    <?php
                        $customer_id=Session::get('customer_id');
                        if($customer_id!=  NULL){
                        
                    ?>
                    <a href="{{ route('logout_checkout') }}" class="header__account-logout">Đăng Xuất</a>
                    <?php
                        }else {
                            
                    ?>
                    <a href="{{ route('login_checkout') }}" class="header__account-logout">Đăng Nhập</a>

                    <?php }?>
                    {{-- <a href="#my-Register" class="header__account-register">Đăng Xuất</a> --}}
                </div>
                <!-- Cart -->
                <a class="header__cart have" href="{{ route('showcart') }}">
                    <i style="color: black" class="fas fa-shopping-basket"></i>
                    {{-- <div class="header__cart-amount">
                        3
                    </div> --}}
                    {{-- <div class="header__cart-wrap">
                        <ul class="order__list">
                            <li class="item-order">
                                <div class="order-wrap">
                                    <a href="product.html" class="order-img">
                                        <img src="frontend/assets/img/product/product1.jpg" alt="">
                                    </a>
                                    <div class="order-main">
                                        <a href="product.html" class="order-main-name">Áo sơ mi caro kèm belt caro kèm
                                            belt Áo sơ mi caro kèm belt</a>
                                        <div class="order-main-price">2 x 45,000 ₫</div>
                                    </div>
                                    <a href="product.html" class="order-close"><i
                                            class="far fa-times-circle"></i></a>
                                </div>
                            </li>
                            <li class="item-order">
                                <div class="order-wrap">
                                    <a href="product.html" class="order-img">
                                        <img src="frontend/assets/img/product/product1.jpg" alt="">
                                    </a>
                                    <div class="order-main">
                                        <a href="product.html" class="order-main-name">Áo sơ mi caro kèm belt caro kèm
                                            belt Áo sơ mi caro kèm belt</a>
                                        <div class="order-main-price">2 x 45,000 ₫</div>
                                    </div>
                                    <a href="product.html" class="order-close"><i
                                            class="far fa-times-circle"></i></a>
                                </div>
                            </li>
                            <li class="item-order">
                                <div class="order-wrap">
                                    <a href="product.html" class="order-img">
                                        <img src="frontend/assets/img/product/product1.jpg" alt="">
                                    </a>
                                    <div class="order-main">
                                        <a href="product.html" class="order-main-name">Áo sơ mi caro kèm belt caro kèm
                                            belt Áo sơ mi caro kèm belt</a>
                                        <div class="order-main-price">2 x 45,000 ₫</div>
                                    </div>
                                    <a href="product.html" class="order-close"><i
                                            class="far fa-times-circle"></i></a>
                                </div>
                            </li>
                        </ul>
                        <div class="total-money">Tổng cộng: 120.000đ</div>
                        <a href="cart.html" class="btn btn--default cart-btn">Xem giỏ hàng</a>
                        <a href="pay.html" class="btn btn--default cart-btn orange">Thanh toán</a>
                        <!-- norcart -->
                        <!-- <img class="header__cart-img-nocart" src="http://www.giaybinhduong.com/images/empty-cart.png" alt=""> -->
                    </div> --}}
                </a>
            </div>
        </div>
        <!-- Menu -->
        <div class="header__nav">

            @include('frontend.header')
        </div>
    </div>
    <div class="main">
        @yield('content')

    </div>
    <div class="footer">
        <div class="grid wide">
            <div class="row">
                <div class="col l-3 m-6 s-12">
                    <h3 class="footer__title">Menu</h3>
                    <ul class="footer__list">
                        <li class="footer__item">
                            <a href="#" class="footer__link">Sân 5</a>
                        </li>
                        <li class="footer__item">
                            <a href="#" class="footer__link">Sân 7</a>
                        </li>
                        <li class="footer__item">
                            <a href="#" class="footer__link">Sân 9</a>
                        </li>

                    </ul>
                </div>
                <div class="col l-3 m-6 s-12">
                    <h3 class="footer__title">Hỗ trợ khách hàng</h3>
                    <ul class="footer__list">
                        <li class="footer__item">
                            <a href="#" class="footer__link">Hướng dẫn đặt sân</a>
                        </li>
                        <li class="footer__item">
                            <a href="#" class="footer__link">Giải đáp thắc mắc</a>
                        </li>
                        <li class="footer__item">
                            <a href="#" class="footer__link">Chính sách đặt sân</a>
                        </li>

                    </ul>
                </div>
                <div class="col l-3 m-6 s-12">
                    <h3 class="footer__title">Liên hệ</h3>
                    <ul class="footer__list">
                        <li class="footer__item">
                            <span class="footer__text">
                                <i class="fas fa-map-marked-alt"></i> Thôn Bùng, Phùng Xá, Thạch Thất, Thành Phố Hà Nội
                            </span>
                        </li>
                        <li class="footer__item">
                            <a href="#" class="footer__link">
                                <i class="fas fa-phone"></i> 0366280440
                            </a>
                        </li>
                        <li class="footer__item">
                            <a href="#" class="footer__link">
                                <i class="fas fa-envelope"></i> locdybala11@gmail.com
                            </a>
                        </li>
                        <li class="footer__item">
                            <div class="social-group">
                                <a href="https://www.facebook.com/locdybala11" class="social-item"><i
                                        class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#" class="social-item"><i class="fab fa-twitter"></i>
                                </a>
                                <a href="#" class="social-item"><i class="fab fa-pinterest-p"></i>
                                </a>
                                <a href="#" class="social-item"><i class="fab fa-invision"></i>
                                </a>
                                <a href="#" class="social-item"><i class="fab fa-youtube"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col l-3 m-6 s-12">
                    <h3 class="footer__title">Đăng kí</h3>
                    <ul class="footer__list">
                        <li class="footer__item">
                            <span class="footer__text">Đăng ký để nhận được được thông tin ưu đãi mới nhất từ chúng
                                tôi.</span>
                        </li>
                        <li class="footer__item">
                            <div class="send-email">
                                <input class="send-email__input" type="email" placeholder="Nhập Email...">
                                <a href="#" class="send-email__link">
                                    <i class="fas fa-paper-plane"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="copyright">
            <span class="footer__text"> &copy Bản quyền thuộc về <a class="footer__link" href="#"> Sân bóng Phùng
                    Xá</a></span>
        </div>
    </div>
 <!-- Messenger Plugin chat Code -->
 <div id="fb-root"></div>

 <!-- Your Plugin chat code -->
 <div id="fb-customer-chat" class="fb-customerchat">
 </div>

    <script>
        $('.owl-carousel.hight').owlCarousel({
            loop: true,
            margin: 20,
            nav: true,
            dots: false,
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 2
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 5
                }
            }
        })
        $('.owl-carousel.news').owlCarousel({
            loop: true,
            margin: 20,
            nav: true,
            dots: false,
            autoplay: true,
            autoplayTimeout: 4000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 2
                }
            }
        })
        $('.owl-carousel.bands').owlCarousel({
            loop: true,
            margin: 20,
            nav: false,
            dots: false,
            autoplay: true,
            autoplayTimeout: 2000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 2
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 6
                }
            }
        })
    </script>
    <!-- Script common -->
    <script src="{{ asset('frontend/assets/js/commonscript.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/sweetalert.js') }}"></script>

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    @yield('javascrip')
   
    <script>
        var chatbox = document.getElementById('fb-customer-chat');
        chatbox.setAttribute("page_id", "1705586239677674");
        chatbox.setAttribute("attribution", "biz_inbox");
    </script>
 

</body>

</html>
