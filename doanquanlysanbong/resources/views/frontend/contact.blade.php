@extends('frontend_layout')
@section('title')
Liên hệ
@endsection
@section('style')
@endsection
@section('content')
<section id="contact-info">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4 col-sm-6 col-md-6">
                <div class="contact-info-block text-center">
                    <i class="pe-7s-map-marker"></i>
                    <h4>Địa chỉ</h4>
                    <p class="lead">Thôn 9 Phùng Xá Thạch Thất Hà Nội</p>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-md-6">
                <div class="contact-info-block text-center">
                    <i class="pe-7s-mail"></i>
                    <h4>Email</h4>
                    <p class="lead">locdybala11@gmail.com</p>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-md-6">
                <div class="contact-info-block text-center">
                    <i class="pe-7s-phone"></i>
                    <h4>Số điện thoại</h4>
                    <p class="lead">036620440</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section style="padding-top: 40px !important" class="section" id="contact">
    <div class="container">
        <div class="row ">
            <div class="col-md-8 col-lg-6">
                <h5>Để lại lời nhắn</h5>
                <!-- Heading -->
               

                <!-- Subheading -->
                <p class="mb-5 ">
                    Cho dù bạn có thắc mắc hay có những góp ý hãy gửi lời nhắn tói chúng tôi
                </p>

            </div>
        </div> <!-- / .row -->

        <div class="row">
            <div class="col-lg-6">
               <!-- form message -->
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-success contact__msg" style="display: none" role="alert">
                            Your message was sent successfully.
                        </div>
                    </div>
                </div>
                <!-- end message -->
                <!-- Contacts Form -->
                <form class="contact_form" action="mail.php">
                    <div class="row">
                        <!-- Input -->
                        <div class="col-sm-6 mb-6">
                            <div class="form-group">
                                <label class="h6 small d-block text-uppercase">
                                    Họ tên
                                    <span class="text-danger">*</span>
                                </label>

                                <div class="input-group">
                                    <input class="form-control" name="name" id="name" required="" placeholder="Lộc Ngô" type="text">
                                </div>
                            </div>
                        </div>
                        <!-- End Input -->

                        <!-- Input -->
                        <div class="col-sm-6 mb-6">
                            <div class="form-group">
                                <label class="h6 small d-block text-uppercase">
                                   Địa chỉ email
                                    <span class="text-danger">*</span>
                                </label>

                                <div class="input-group ">
                                    <input class="form-control" name="email" id="email" required="" placeholder="john@gmail.com" type="email">
                                </div>
                            </div>
                        </div>
                        <!-- End Input -->

                       
                    </div>

                    <!-- Input -->
                    <div class="form-group mb-5">
                        <label class="h6 small d-block text-uppercase">
                            Nội dung ?
                            <span class="text-danger">*</span>
                        </label>

                        <div class="input-group">
                            <textarea class="form-control" rows="4" name="message" id="message" required="" placeholder="Nội dung"></textarea>
                        </div>
                    </div>
                    <!-- End Input -->

                    <div class="">
                       <input name="submit" type="submit" class="btn btn-primary btn-circled" value="Gửi">
                       
                    </div>
                </form>
                <!-- End Contacts Form -->
            </div>

            <div class="col-lg-6 col-md-6">
                <!-- START MAP -->
                <div id="map" >
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.546641685589!2d105.62143476472428!3d21.01080264376749!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313450c157ddc205%3A0x961fe43f1381223a!2zU8OibiBiw7NuZyBsw6BuZyBCw7luZywgUGjDuW5nIFjDoSwgVGjhuqFjaCBUaOG6pXQsIEjDoCBO4buZaSwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1650916213346!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <!-- END MAP -->
            </div>
        </div>
    </div>
</section>
@endsection