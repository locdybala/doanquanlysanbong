@extends('frontend_layout')
@section('title')
    <title>Chi tiết sân</title>
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('frontend/assets/owlCarousel/assets/owl.theme.default.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/product.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/contact.css') }}">

    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css">
@endsection
@section('content')
    <div class="grid wide">
        <div class="productInfo">
            <div class="row">
                <div class="col l-5 m-12 s-12">
                    <div class="owl-carousel owl-theme" id="sync1">
                        <a href="{{ url('/upload/pitch/' . $pitchdetail->image) }}" class="product">
                            <div class="product__avt"
                                style="background-image: url(/upload/pitch/{{ $pitchdetail->image }})">
                            </div>
                        </a>
                        @foreach ($gallery as $gallery)
                            <a href="{{ url('/upload/gallery/' . $gallery->gallery_image) }}" class="product">
                                <div class="product__avt"
                                    style="background-image: url(/upload/gallery/{{ $gallery->gallery_image }})">
                                </div>
                            </a>
                        @endforeach


                    </div>
                    {{-- <div class="owl-carousel owl-theme" id="sync2">
                        <a href="#" class="product">
                            <div class="product__avt"
                                style="background-image: url(/upload/pitch/{{ $pitchdetail->image }})">
                            </div>
                        </a>
                        @foreach ($gallery as $galleri)
                        
                        <a href="#" class="product">
                            <div class="product__avt" 
                            style="background-image: url(/upload/gallery/{{ $galleri->gallery_image }})">
                            </div>
                        </a>
                        @endforeach
                        
                       
                    </div> --}}

                </div>
                <div class="col l-7 m-12s s-12 pl">
                    <div class="main__breadcrumb">
                        <div class="breadcrumb__item">
                            <a href="#" class="breadcrumb__link">Trang chủ</a>
                        </div>
                        <div class="breadcrumb__item">
                            <a href="#" class="breadcrumb__link">Sân bóng</a>
                        </div>
                        <div class="breadcrumb__item">
                            <a href="#" class="breadcrumb__link">{{ $pitchdetail->category->name }}</a>
                        </div>
                    </div>
                    <h3 class="productInfo__name">
                        {{ $pitchdetail->name }}
                    </h3>
                    {{-- <div class="productInfo__price">
                    330.000 <span class="priceInfo__unit">đ</span>
                </div> --}}
                    {{-- <div class="productInfo__description">
                    {{ $pitchdetail->description }}
                </div> --}}


                    <div class="productInfo__addToCart">
                        <form action="{{ route('savecart') }}" method="POST">
                            @csrf
                            <?php
                            date_default_timezone_set('Asia/Ho_Chi_Minh');
                            $data = date('d-m-Y');
                            ?>
                            <input type="date" id="ngaysudung" name="ngay_dat" value="<?php echo date('Y-m-d'); ?>"
                                class="form-control" id="">

                            <div style="display: flex" id="order-details">
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($pitchprice as $pitch)
                                    <div id="form_check{{ $i++ }}" style="width:120px;height:120px;margin:5px;" class="form-check 
                                        {{ ($pitch->status == 'Hết sân') ? 'bg-red' : 'bg-green' }}">
                                        <input class="form-check-input" {{ ($pitch->status == 'Hết sân') ? 'hidden' : '' }} style="margin-bottom:20px;" type="checkbox"
                                            name="pitch_prices_id" value="{{ $pitch->id }}" id="flexCheckDefault">
                                        <br>
                                        <div style="font-size: 16px">
                                            <h2 class="timeframe">{{ $pitch->timeframe }}</h2>
                                            <p id="type">{{ $pitch->status }}</p>
                                            <p>{{ $pitch->price }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <input id="pitchid_hidden" name="pitchid_hidden" value="{{ $pitchdetail->id }}"
                                type="hidden">
                            <button type="submit" class=" btn btn--default  ">
                                <i class="fa fa-shopping-cart"></i>
                                Đặt sân</button>
                        </form>
                    </div>

                    <div class="productIndfo__category ">
                        <p class="productIndfo__category-text"> Danh mục : <a href="# "
                                class="productIndfo__category-link ">{{ $pitchdetail->category->name }}</a></p>
                        {{-- <p class="productIndfo__category-text"> Hãng : <a href="# " class="productIndfo__category-link ">The
                                Face Shop</a></p>
                        <p class="productIndfo__category-text"> Số lượng đã bán : 322</p>
                        <p class="productIndfo__category-text"> Số lượng trong kho : 322</p> --}}

                    </div>
                </div>
            </div>
        </div>
        <div class="productDetail ">
            <div class="main__tabnine ">
                <div class="grid wide ">
                    <!-- Tab items -->
                    <div class="tabs ">
                        <div class="tab-item active ">
                            Mô tả
                        </div>
                        <div class="tab-item ">
                            Đánh giá
                        </div>
                        <div class="line "></div>
                    </div>
                    <!-- Tab content -->
                    <div class="tab-content ">
                        <div class="tab-pane active ">
                            <div class="productDes ">
                                <div class="productDes__title "></div>
                                <p class="productDes__text "> <a href="# "
                                        class="productDes__link ">{!! $pitchdetail->description !!}
                                </p>

                            </div>
                        </div>
                        <div class="tab-pane">

                            <div style="cursor: default" class="productDes__ratting ">
                                <div class="productDes__ratting-title ">Đánh giá của bạn</div>
                                <form action="">
                                    @csrf
                                <div class="productDes__ratting-wrap">
                                    
                                        <div id="rating">
                                            <input type="radio" id="star5" name="rating" value="5" />
                                            <label class="full" for="star5" title="Awesome - 5 stars"></label>

                                            <input type="radio" id="star4half" name="rating" value="4 and a half" />
                                            <label class="half" for="star4half"
                                                title="Pretty good - 4.5 stars"></label>

                                            <input type="radio" id="star4" name="rating" value="4" />
                                            <label class="full" for="star4" title="Pretty good - 4 stars"></label>

                                            <input type="radio" id="star3half" name="rating" value="3 and a half" />
                                            <label class="half" for="star3half" title="Meh - 3.5 stars"></label>

                                            <input type="radio" id="star3" name="rating" value="3" />
                                            <label class="full" for="star3" title="Meh - 3 stars"></label>

                                            <input type="radio" id="star2half" name="rating" value="2 and a half" />
                                            <label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>

                                            <input type="radio" id="star2" name="rating" value="2" />
                                            <label class="full" for="star2" title="Kinda bad - 2 stars"></label>

                                            <input type="radio" id="star1half" name="rating" value="1 and a half" />
                                            <label class="half" for="star1half" title="Meh - 1.5 stars"></label>

                                            <input type="radio" id="star1" name="rating" value="1" />
                                            <label class="full" for="star1" title="Sucks big time - 1 star"></label>

                                            <input type="radio" id="starhalf" name="rating" value="half" />
                                            <label class="half" for="starhalf"
                                                title="Sucks big time - 0.5 stars"></label>
                                        </div>
                                            
                                </div>
                                <div class="form-group">
                                    <input id="account" name="account" type="text"
                                        placeholder="Nhập họ tên"  class="comment_name form-control">
                                </div>
                                <div class="form-group">
                                <textarea class="form-control comment_content"  placeholder="Vui lòng viết đánh giá của bạn " name="" id="" cols="30" rows="10"></textarea>
                            </div>
                                <input type="submit "  class="send-comment btn btn--default" value="Đánh giá">
                                <div id="notify_comment">
                                    </div>    
                            </form>
                            </div>

                            <ul id="comment_show" class="rate__list">
                           


                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="main__frame ">
            <div class="grid wide ">
                <h3 class="category__title ">Danh sách các sân</h3>
                <h3 class="category__heading ">Các sân tương tự</h3>
                <div class="owl-carousel hight owl-theme ">
                    @foreach ($related_pitch as $related_pitch)
                        <a href="# " class="product ">
                            <div class="product__avt"
                                style="background-image: url(/upload/pitch/{{ $related_pitch->image }});">
                            </div>
                            <div class="product__info ">
                                <h3 class="product__name ">{{ $related_pitch->name }}</h3>

                            </div>

                        </a>
                    @endforeach


                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascrip')
    {{-- <script>
    var chatbox = document.getElementById('fb-customer-chat');
    chatbox.setAttribute("page_id", "105913298384666");
    chatbox.setAttribute("attribution", "biz_inbox");
    window.fbAsyncInit = function() {
        FB.init({
            xfbml: true,
            version: 'v10.0'
        });
    };

    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script> --}}
    <script>
        $(document).ready(function() {
            $('.send-comment ').click(function () { 
                var comment_name=$('.comment_name').val();  
                var pitchid_hidden = $('#pitchid_hidden').val();
                var commemt_content=$('.comment_content').val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: '{{ url('/sendcomment') }}',
                    method: 'POST',
                    data: {
                        comment_name: comment_name,
                        commemt_content: commemt_content,
                        _token: _token,
                        pitchid_hidden: pitchid_hidden,
                    },
                    success: function(data) {
                        load_comment();
                        $('#notify_comment').html('<p class="text text-success">Thêm bình luận thành công và đang chờ duyệt</p>');
                        $('#notify_comment').fadeOut(9000);
                        $('.comment_name').val('');
                        $('.comment_content').val('');

                    }
                });          
            });
            load_comment();

            function load_comment() {

                var pitchid_hidden = $('#pitchid_hidden').val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: '{{ url('/loadcomment') }}',
                    method: 'POST',
                    data: {
                        _token: _token,
                        pitchid_hidden: pitchid_hidden,
                    },
                    success: function(data) {
                        $('#comment_show').html(data);
                    }
                });
            }
            // loaddata();

            function loaddata() {
                // $('.timeframe').each(function() {
                //     var ngaysudung = $('#ngaysudung').val();
                //     var pitchid_hidden = $('#pitchid_hidden').val();
                //     var timeframe = $(this).text();
                //     var i = 1;
                //     var _token = $('input[name="_token"]').val();

                //     $.ajax({
                //         url: '{{ url('/checktinhtrang') }}',
                //         method: 'POST',
                //         data: {
                //             timeframe: timeframe,
                //             ngaysudung: ngaysudung,
                //             _token: _token,
                //             pitchid_hidden: pitchid_hidden,
                //         },
                //         dataType: "JSON",
                //         success: function(data) {
                //             if (data == 1) {
                //                 document.getElementById('form_check1').style.background =
                //                     'rgb(6, 199, 6)';
                //                 document.getElementById('form_check2').style.background = 'red';
                //             } else if (data == 0) {
                //                 document.getElementById('form_check1').style.background =
                //                     'rgb(6, 199, 6)';
                //                 document.getElementById('form_check2').style.background =
                //                     'rgb(6, 199, 6)';
                //             }

                //         }
                //     });
                // });
                
                $('.form-check').remove();

                var ngaysudung = $('#ngaysudung').val();
                var pitchid_hidden = $('#pitchid_hidden').val();
                // var timeframe = $(this).text();
                // var i = 1;
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: '{{ url('/get-order-details') }}',
                    method: 'POST',
                    data: {
                        // timeframe: timeframe,
                        ngaysudung: ngaysudung,
                        _token: _token,
                        pitchid_hidden: pitchid_hidden,
                    },
                    dataType: "JSON",
                    success: function(data) {
                        console.log(data);
                            var html = '';
                        $.each(data, function( key, value ) {
                            var bg = '';
                            var hidden = '';
                            if (value.status == 'Hết sân') {
                                bg = 'bg-red';
                                hidden = 'hidden';
                            }
                            else {
                                bg = 'bg-green';
                                hidden = '';
                            }
                            html += `
                                <div style="width:120px;height:120px;margin:5px;" class="form-check 
                                    ${bg}">
                                    <input class="form-check-input" ${hidden} style="margin-bottom:20px;" type="checkbox"
                                        name="pitch_prices_id" value="${value.id}" id="flexCheckDefault">
                                    <br>
                                    <div style="font-size: 16px">
                                        <h2 class="timeframe">${value.timeframe}</h2>
                                        <p id="type">${value.status}</p>
                                        <p>${value.price}</p>
                                    </div>
                                </div>`;
                        });

                        $(`#order-details`).append(html);

                    }
                });
            }

            $('#ngaysudung').change(function() {
                loaddata();
            });

            var sync1 = $("#sync1 ");
            var sync2 = $("#sync2 ");
            var slidesPerPage = 4;
            var syncedSecondary = true;
            sync1.owlCarousel({
                items: 1,
                loop: true,
                margin: 20,
                nav: true,
                dots: false,
                autoplay: true,
                autoplayTimeout: 4000,
                autoplayHoverPause: true
            })
            sync2
                .on('initialized.owl.carousel', function() {
                    sync2.find(".owl-item ").eq(0).addClass("current ");
                })
                .owlCarousel({
                    items: 4,
                    dots: false,
                    nav: false,
                    margin: 30,
                    smartSpeed: 200,
                    slideSpeed: 500,
                    slideBy: 4,
                    responsiveRefreshRate: 100
                }).on('changed.owl.carousel', syncPosition2);

            function syncPosition(el) {
                var count = el.item.count - 1;
                var current = Math.round(el.item.index - (el.item.count / 2) - .5);

                if (current < 0) {
                    current = count;
                }
                if (current > count) {
                    current = 0;
                }

                //end block

                sync2
                    .find(".owl-item ")
                    .removeClass("current ")
                    .eq(current)
                    .addClass("current ");
                var onscreen = sync2.find('.owl-item.active').length - 1;
                var start = sync2.find('.owl-item.active').first().index();
                var end = sync2.find('.owl-item.active').last().index();

                if (current > end) {
                    sync2.data('owl.carousel').to(current, 100, true);
                }
                if (current < start) {
                    sync2.data('owl.carousel').to(current - onscreen, 100, true);
                }
            }

            function syncPosition2(el) {
                if (syncedSecondary) {
                    var number = el.item.index;
                    sync1.data('owl.carousel').to(number, 100, true);
                }
            }

            sync2.on("click ", ".owl-item ", function(e) {
                e.preventDefault();
                var number = $(this).index();
                sync1.data('owl.carousel').to(number, 300, true);
            });
        });

        $('.owl-carousel.hight').owlCarousel({
            loop: true,
            margin: 20,
            nav: true,
            dots: false,
            autoplay: false,
            autoplayTimeout: 500,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 0
                },
                600: {
                    items: 2
                },
                1200: {
                    items: 3
                }
            }
        })
    </script>
    {{-- <script>
        function calcRate(r) {
            const f = ~~r, //Tương tự Math.floor(r)
                id = 'star' + f + (r % f ? 'half' : '')
            id && (document.getElementById(id).checked = !0)
        }
    </script> --}}
@endsection
