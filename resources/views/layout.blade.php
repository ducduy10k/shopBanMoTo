<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Nguyễn Đức Duy ">
    <meta name="robots" content="INDEX,FOLLOW" />
    <meta name="description" content="Chuyên bán moto giá tốt nhất Việt Nam">
    <meta name="keywords" content="" />
    <meta name="robots" content="INDEX,FOLLOW" />
    <link rel="canonical" href="" />
    <link rel="icon" type="image/x-icon" href="{{asset('public/frontend/images/home/motorcycle.png')}}" />

    {{--<meta property="og:image" content="{{$image_og}}" /> --}}

    <meta property="og:site_name" content="http://localhost:8080/shopbanmoto/" />
    <meta property="og:description" content="Chuyên bán moto giá tốt nhất Việt Nam" />
    <meta property="og:title" content="Shop mô tô'" />
    <meta property="og:url" content="" />
    <meta property="og:type" content="website" />


    <title>Shop bán xe Moto </title>

    <script src='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.js'></script>
    <link href="https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.css" rel="stylesheet" />

    <link href="{{asset('public/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/main.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/responsive.css')}}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/535f28fd53.js" crossorigin="anonymous"></script>
    {{-- css modal map --}}
    <link rel="stylesheet" href="{{asset('public/frontend/css/MapBox.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/css/button.css')}}">

</head>
<style>
body {
    margin: 0;
    padding: 0;
}

#map {
    position: absolute;
    top: 0;
    left: 0;
}

.item-language:hover {
    background-color: #ccc;
}

.openOptionLanguage {
    display: block !important;
}



.isactive {
    background-color: yellow;
}

.carousel-inner * {
    color: white;
}

.g-recaptcha {
    transform-origin: 0 0;
    margin-left: 50%;
    transform: translateX(-50%) scale(0.77);
}

.productinfo:hover img {
    transform: scale(1.2);
}

.productinfo img {
    transition: 0.6s cubic-bezier(0, 0.01, 0, 0.99);
}

.panel-title a:hover {
    color: #41a926 !important;
    cursor: pointer;
}

.brands-name a:hover {
    color: #41a926 !important;
    cursor: pointer;
}


.mb-5 {
    margin-bottom: 5px;
}
</style>
<!--/head-->

<body>
    <header id="header">
        <!--header-->
        <div class="header_top">
            <!--header_top-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="contactinfo">
                            <ul class="nav nav-pills">
                                <li><a href="#"><i class="fa fa-phone"></i> +84 168 297 8706</a></li>
                                <li><a href="#"><i class="fa fa-envelope"></i> ducduy10k@gmail.com</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="social-icons pull-right">
                            <ul class="nav navbar-nav">
                                <li style="font-size: 12px;color: #696763;font-family: 'Roboto', sans-serif;">
                                    <div class="" id="language-active" style="padding: 10px 15px;">
                                        <img width="16px" height="16px" style="border-radius:50%;"
                                            src="{{asset('public/frontend/images/home/vietnam-flag-icon-256.png')}}"
                                            alt="">&nbsp
                                        <span>Việt Nam</span>
                                    </div>
                                    <div id='optionLanguage' class=""
                                        style="background-color: white;display: none;position: absolute;z-index: 1;border: 1px solid #ccc;padding: 5px;top: 33px; right: -30px;">
                                        <a href="" class="item-language" style="display:block;padding:2px">
                                            <img width="16px" height="16px"
                                                src="{{asset('public/frontend/images/home/united-states-of-america-flag-xl.png')}}"
                                                alt="">&nbsp
                                            <span>USA</span>
                                        </a>

                                        <a href="" class="item-language" style="display:block;padding:2px;">
                                            <img width="16px" height="16px"
                                                src="{{asset('public/frontend/images/home/vietnam-flag-icon-256.png')}}"
                                                alt="">&nbsp
                                            <span>Việt Nam</span>
                                        </a>
                                    </div>
                                </li>
                                <li>
                                    <div class="fb-share-button" data-href="http://localhost:8080/shopbanmoto/"
                                        data-layout="button_count" data-size="small"><a target="_blank"
                                            href="https://www.facebook.com/sharer/sharer.php?u={{'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']}}&amp;src=sdkpreparse"><i
                                                class="fa fa-facebook"></i></a></div>
                                </li>

                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/header_top-->

        <div class="header-middle">
            <!--header-middle-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="logo pull-left">
                            <a href="{{URL::to('/trang-chu')}}"><img src="{{'public/frontend/images/home/logo.png'}}"
                                    alt="" /></a>
                        </div>

                    </div>
                    <div class="col-sm-8">
                        <div class="shop-menu pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href="#"><i class="fa fa-star"></i> Yêu thích</a></li>
                                </li>
                                <?php
                                    $customer_id =Session::get('customer_id');
                                    $shipping_id =Session::get('shipping_id');
                                    if($customer_id!=NULL && $shipping_id==NULL){

                                    
                                ?>

                                <li><a href="{{URL::to('/checkout')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a>
                                </li>
                                <?php
                                    }elseif($customer_id!=NULL && $shipping_id!=NULL){
                                ?>

                                <li><a href="{{URL::to('/payment')}}"><i class="fa fa-crosshairs"></i> Thanh
                                        toán</a>
                                </li>
                                <?php
                                    }else{
                                ?>
                                <li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-crosshairs"></i> Thanh
                                        toán</a>
                                </li>
                                <?php
                                    }
                                ?>

                                <li><a href="{{URL::to('/show-cart')}}"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a>
                                </li>
                                <?php
                                    $customer_id =Session::get('customer_id');
                                    if($customer_id!=NULL){
                                ?>
                                <li><a href="{{URL::to('/logout-checkout')}}"><i class="fa fa-lock"></i> Đăng xuất</a>
                                </li>
                                <?php
                                    }else{
                                ?>
                                <li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-lock"></i> Đăng nhập</a>
                                </li>
                                <?php
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/header-middle-->

        <div class="header-bottom">
            <!--header-bottom-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse"
                                data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="{{URL::to('/trang-chu')}}" class="active">Trang chủ</a></li>
                                @foreach($brand as $key =>$bra)
                                <li>
                                    <a href="{{URL::to('/thuong-hieu-san-pham/'.$bra->brand_id)}}"
                                        class='brand-product-item'>{{$bra->brand_name}}</a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <form action="{{URL::to('search')}}" method="POST">
                            {{ csrf_field() }}
                            <div class="search_box pull-right">
                                <input type="text" name="keywords" placeholder="Tìm kiếm" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--/header-bottom-->
    </header>
    <!--/header-->

    {{-- information --}}
    <div class="information"
        style="display: block;width: 50px;height: 100px;right: 20px;top: 40vh;position: fixed;z-index:1;">
        <!-- location -->
        <div class="item-infor" id='openMap'
            style="cursor: pointer;position: absolute;width:48px;border-radius: 50%;background: aqua; transform: translateY(-115px);height: 48px;border:2px solid white;">
            <i style="font-size: 2.6rem;color: white;margin: 0 auto;position: absolute;top: 50%;transform: translateY(-13px) translateX(67%);"
                class="fas fa-map-marker-alt"></i>
        </div>
        <!-- Send message -->
        <div class="item-infor" id='open-modal-mail' data-toggle="modal" data-target="#modalMessage"
            style="cursor: pointer;position: absolute;width:48px;border-radius: 50%;background: orange; transform: translateY(-55px);height: 48px;border:2px solid white;">
            <i style="font-size: 2.6rem;color: white;margin: 0 auto;position: absolute;top: 50%;transform: translateY(-50%) translateX(35%);"
                class="fas fa-envelope"></i>
        </div>
        <!-- Phone call -->
        <div class="item-infor" id='open-modal-call' data-toggle="modal" data-target="#modalPhone"
            style="cursor: pointer;position: absolute;width:48px;border-radius: 50%;background: #22f028; transform: translateY(5px);height: 48px;border:2px solid white;">
            <i style="font-size: 2.6rem;color:white ;margin: 0 auto;position: absolute;top: 50%;transform: translateY(-50%) translateX(36%);"
                class="fas fa-phone-alt"></i>
        </div>
        <!-- Messenger -->
        <div class="item-infor" id='open-modal-messeger'
            style="cursor: pointer;position: absolute;width:48px;border-radius: 50%;background: #3871f5; transform: translateY(65px);height: 48px;border:2px solid white;">
            <i style="font-size: 2.6rem;color:white ;margin: 0 auto;position: absolute;top: 50%;transform: translateY(-50%) translateX(36%);"
                class="fab fa-facebook-messenger"></i>
        </div>
        <!-- Zalo -->
        <div class="item-infor" id='open-modal-zalo'
            style="cursor: pointer;position: absolute;width:48px;border-radius: 50%;background:url('../public/frontend/images/home/logo-zalo-vector.png') ; transform: translateY(125px);height: 48px;border:2px solid white;overflow: hidden;">
            <img style="width: 52px;height: 52px;border-radius: 50px;transform: translate(-2px, -7px);"
                src="{{asset('public/frontend/images/home/logo-zalo-vector.png')}}" alt="" id="contactZalo">
        </div>

    </div>


    {{--  map location --}}


    <div class="" id="map-infor"
        style="position: fixed;width:50vw;height: calc(70vh - 55px);top :10%; right: 0 ;z-index: 2;transform:translateX(100%);transition: all 0.9s ease 0.1s;box-shadow: rgb(204, 204, 204) 5px 5px 5px;border: 1px solid #ccc;">
        <div class='modal-title-x'
            style="width: 100%;height: 30px;background: white;/* bottom: 100%; */;padding:5px 15px;   ">
            Vị trí
            <span onclick="closemap()"><i class='fa fa-times'
                    style="right: 0;position: absolute;padding: 9px 13px;"></i></span>
        </div>
        <div class='modal-body-x' style="position:Relative;height: calc(100% - 30px);width:100%;">
            <div style=" height:100% !important;width:100% !important;" id="map"></div>
            <div id="M3D" onclick="M3D()">3D</div>
            <div id="shop-position">
                <select name="" id="shop_info">
                    @foreach($all_shop as $key => $shop)
                    <option value="{{$shop->shop_id}}">{{$shop->shop_name}}</option>
                    @endforeach
                </select>
            </div>
            <div id="vehicles-option">
                <div class='vehicles-item isactive' value='walking'>
                    <i class="fas fa-walking"></i>
                </div>
                <div class='vehicles-item' value='cycling'>
                    <i class="fas fa-bicycle"></i>
                </div>
                <div class='vehicles-item' value='driving'>
                    <i class="fas fa-car"></i>
                </div>
                <div class='vehicles-item' value='driving-traffic'>
                    <i class="fas fa-bus-alt"></i>
                </div>

            </div>
            <!-- Instruction -->
            <div style="display: none;" id="instructions">hello</div>
        </div>
    </div>

    {{-- end map location --}}
    <!-- Modal send message -->

    <div class="modal" id="modalMessage" tabindex="-1" role="dialog" aria-labelledby="modalMessageLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{URL::to('/send-message')}}" method="POST">
                    {{ csrf_field() }}

                    <div class="modal-header">
                        <h3 class="modal-title" id="modalMessageLabel" style="text-align:center;">Gửi tin nhắn cho chúng
                            tôi
                        </h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            style="margin-top:-18px;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php
			        $message = Session::get('message');
			        if($message){
				        echo '<span style="color:green;">'. $message.'</span>';
				        Session::put('message',null);
			            }
                        ?>
                        <ul>
                            @foreach($errors->all() as $val)
                            <li>{{$val}}</li>

                            @endforeach
                        </ul>
                        <div>
                            <p style="margin-top:5px;">&nbsp Phone number (*)</p>
                            <input type="tel" name="customer_phone" placeholder='Enter your phone number ... '
                                class="form-control">
                            <p style="margin-top:5px;">&nbsp Content (*)</p>
                            <textarea id="content-message" placeholder='Leave a message for us .' class='form-control'
                                name="content_message" rows="4" cols="50"></textarea>
                            <p style="margin-top:5px;">&nbsp Your name </p>
                            <input type="text" id='yourName' name="customer_name" placeholder="Your name ..."
                                class='form-control'>
                        </div>
                        <br>
                        <div class="g-recaptcha" data-sitekey="{{env('CAPTCHA_KEY')}}"></div>
                        <br />
                        @if($errors->has('g-recaptcha-response'))
                        <span class="invalid-feedback" style="display:block">
                            <strong>{{$errors->first('g-recaptcha-response')}}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary button-save" id="button-save-mess"
                            style="margin-top:0px;">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- End Modal send message -->
    <!-- Modal Phone  -->
    <!-- Modal -->
    <div class="modal fade" id="modalPhone" tabindex="-1" role="dialog" aria-labelledby="modalPhoneTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{URL::to('/send-phone')}}" method="POST">
                    {{ csrf_field() }}
                    <div class="modal-header">
                        <h3 class="modal-title" id="modalPhoneTitle" style="text-align:center;">Để lại số điện thoại của
                            bạn
                        </h3>
                        <h5 style="text-align:center;">Chúng tôi sẽ gọi lại cho bạn trog thời gian ngắn nhất </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            style="margin-top: -46px;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div
                            style="height: 32px;border: 1px solid #ccc;width: 255px;display:inline-block;margin-left: 95px;border-bottom-left-radius:5px;border-top-left-radius:5px;">
                            <i class="fas fa-phone-alt" style=" font-size: 17px; margin: 5px 10px;"></i>
                            <input type="text" class='input-none-outline' name="phone_number"
                                style="border:none;margin: 5px 10px;width: 190px;"
                                placeholder="Nhập số điện thoại của bạn ...">

                        </div>
                        <button type="submit" class="btn custom-btn btn-15"
                            style="display: inline-block;margin-top: -5px;margin-left: -4px;border-bottom-left-radius: 0px;border-top-left-radius: 0px;">Yêu
                            cầu gọi lại</button>
                        <div style=" margin :10px auto;width:50%;">
                            <span
                                style="width:100px; height:2px;border-top:1px solid #ccc;display:inline-block;"></span>&nbsp&nbsp<span>Hoặc</span>&nbsp&nbsp<span
                                style="width:100px; height:2px;border-top:1px solid #ccc;display:inline-block;"></span>
                        </div>
                        <br>
                        <div style="text-align:center;">
                            <h4>Liên hệ với chúng tôi qua Hotline :</h4>
                            <h2>038 297 8706</h2>
                        </div>
                        <br>
                        <div class="g-recaptcha" data-sitekey="{{env('CAPTCHA_KEY')}}"></div>
                        <br />
                        @if($errors->has('g-recaptcha-response-phone'))
                        <span class="invalid-feedback" style="display:block">
                            <strong>{{$errors->first('g-recaptcha-response-phone')}}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End modal phone  -->
    <section id="slider">
        <!--slider-->

        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <?php
                            $i = 0;
                        ?>
                            @foreach($all_slide as $key =>$slide)
                            <?php
                             if($i==1){
                               echo '<li data-target="#slider-carousel" data-slide-to="'.$i.'" class="active"></li>';
                             }
                             else{
                                echo '<li data-target="#slider-carousel" data-slide-to="'.$i.'" ></li>';
                             }
                             $i=$i+1;
                             ?>
                            @endforeach
                        </ol>
                        <div class="carousel-inner">
                            <?php
                            $i = 0;
                        ?>
                            @foreach($all_slide as $key =>$slide)
                            <?php
                         $i=$i+1;
                         if($i==1){
                             echo ' <div class="item active" style="position:relative;">';
                         }else {
                            echo ' <div class="item" style="position:relative;">';
                         }
                        ?>
                            <div class="col-sm-6" style="z-index:10;color:white;height:400px">
                                <h1 style="color:#ffbf80">Shop Mô tô</h1>
                                <h2 style="color:#ffd9b3">{{$slide->slide_title}}</h2>
                                <p style="color:#fff2e6">{{$slide->slide_desc}} </p>
                            </div>
                            <div style="position:absolute;width:85%;height:100%;z-index:1">
                                <img src="{{URL::to('public/upload/product/'.$slide->slide_image)}}"
                                    style="object-fit:cover;" class="girl img-responsive" alt="" />
                                <!-- <img src="images/home/pricing.png"  class="pricing" alt="" /> -->
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>
            </div>
        </div>
        </div>

    </section>
    <!--/slider-->

    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        <h2>Danh mục sản phẩm</h2>
                        <div class="panel-group category-products" id="accordian">
                            <!--category-productsr-->
                            @foreach($category as $key =>$cate)
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a href="{{URL::to('/danh-muc-san-pham/'.$cate->category_id)}}"
                                            class='category-product-item'>{{$cate->category_name}}</a>
                                    </h4>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <!--/category-products-->
                        <!--brands_products
                        <div class="brands_products">
                            <h2>Thương hiệu</h2>
                            <div class="brands-name">
                                @foreach($brand as $key =>$bra)
                                <ul class="nav nav-pills nav-stacked">
                                    <li>
                                        <a href="{{URL::to('/thuong-hieu-san-pham/'.$bra->brand_id)}}"
                                            class='brand-product-item'>{{$bra->brand_name}}</a>
                                    </li>
                                </ul>
                                @endforeach
                            </div>
                        </div>
                        brands_products-->

                       
                    </div>
                </div>

                <div class="col-sm-9 padding-right">
                    @yield('content')
                </div>
            </div>
        </div>
    </section>

    <footer class="footer  ">

        <div class="top-footer">
            <div class="container-fluid">
                <div class="row" style="margin-right: 0;margin-left: 0;">

                    <div class="col-xs-12 col-sm-12 col-md-8">
                    </div>


                    <div class="col-xs-12 col-sm-12 col-md-4">
                        <div class="area_phone_contact">
                            <p class="number_phone">
                                <i class="fa fa-phone "></i>
                                <span>Hỗ trợ / Mua hàng:</span>
                                <a href="tel:0382978706">
                                    038.297.8706
                                </a>
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="title-expand visible-xs text-center">
            <a class="btn-fter" data-toggle="collapse" href="#fter-content" role="button" aria-expanded="true"
                aria-controls="fter-content">
                Thông tin khác<span class="fa fa-angle-down"> </span>
            </a>
        </div>
        <div class="main-footer collapse" style="padding:0;" id="fter-content">
            <div class="container-fluid">
                <div class="row" style="margin:0;">

                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg">
                        <div class="footer-col footer-content1">
                            <h4 class="footer-title">
                                Giới thiệu
                            </h4>
                            <div class="footer-content">

                                <p>ShopBanMoTo.vn Shop mô tô - Hệ thống phân phối xe mô tô phân khối lớn uy tín tại Việt
                                    Nam </p>


                                <div class="logo-footer">
                                    <img src="//theme.hstatic.net/1000241714/1000477078/14/logo-bct.png?v=188"
                                        alt="Bộ Công Thương">
                                </div>

                            </div>
                        </div>
                    </div>


                    <div class="col-xs-12 col-sm-6 col-md-2 col-lg">
                        <div class="footer-col footer-block">
                            <h4 class="footer-title">
                                Liên kết
                            </h4>
                            <div class="footer-content toggle-footer">
                                <ul>
                                    <li class="item">
                                        <a href="" title="Liên Hệ">Facebook</a>
                                    </li>
                                    <li class="item">
                                        <a href="" title="Khách hàng">Zalo</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg">
                        <div class="footer-col">
                            <h4 class="footer-title">
                                Hệ thống showroom
                            </h4>
                            <div class="footer-content footer-contact">
                                <ul>
                                    <li style="display:flex;flex:1;align-items: center;">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <p style="margin:0;padding-left:10px;">
                                            + Số nhà 17, ngõ 445 Nguyễn Khang, Cầu Giấy, Hà Nội <br>
                                            + Xóm 3, Ân Hòa, Kim Sơn, Ninh Bình
                                        </p>
                                    </li>
                                    <li style="display:flex;flex:1;align-items: center;">
                                        <i class="fas fa-mobile-alt"></i>
                                        <p style="margin:0;padding-left:10px;"> 038 297 8706</p>
                                    </li>
                                    <li style="display:flex;flex:1;align-items: center;">
                                        <i class="far fa-envelope"></i>
                                        <p style="margin:0;padding-left:10px;">
                                            ducduy10k@gmail.com
                                        </p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>


                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg">
                        <div class="footer-col">
                            <h4 class="footer-title">
                                Fanpage
                            </h4>
                            <div class="footer-content footer-contact">
                                <!-- Facebook widget -->
                                <div class="fb-page"
                                    data-href="https://www.facebook.com/Shop-Moto-C%E1%BA%A7u-Gi%E1%BA%A5y-102527788259135"
                                    data-tabs="timeline" data-width="300" data-height="90" data-small-header="false"
                                    data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                                    <blockquote
                                        cite="https://www.facebook.com/Shop-Moto-C%E1%BA%A7u-Gi%E1%BA%A5y-102527788259135"
                                        class="fb-xfbml-parse-ignore"><a
                                            href="https://www.facebook.com/Shop-Moto-C%E1%BA%A7u-Gi%E1%BA%A5y-102527788259135">Shop
                                            Moto Cầu Giấy</a></blockquote>
                                </div>
                                <!-- #Facebook widget -->

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="bottom-footer text-center">
            <div class="container-fluid">
                <p>Copyright © 2020 <a href="http://localhost:8080/shopbanmoto/"> Shop Moto</a>.Powered by Haravan</a>
                </p>
            </div>
        </div>
    </footer>



    <script src="{{asset('public/frontend/js/jquery.js')}}"></script>
    <script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.scrollUp.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/price-range.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('public/frontend/js/main.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"
        integrity="sha512-3j3VU6WC5rPQB4Ld1jnLV7Kd5xr+cq9avvhwqzbH/taCRNURoeEpoPBK9pDyeukwSxwRPJ8fDgvYXd6SkaZ2TA=="
        crossorigin="anonymous"></script>
    {{-- map js --}}

    <script src="https://api.tiles.mapbox.com/mapbox.js/plugins/turf/v2.0.0/turf.min.js" charset="utf-8"></script>
    <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.js">
    </script>
    <link rel="stylesheet"
        href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.css"
        type="text/css" />
    <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.2.0/mapbox-gl-geocoder.min.js">
    </script>
    <link rel="stylesheet"
        href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.2.0/mapbox-gl-geocoder.css"
        type="text/css" />
    <!-- Capcha -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <script src="{{asset('public/frontend/js/MapBox.js')}}"></script>
    <script src="{{asset('public/frontend/js/custom.js')}}"></script>
    <script>
    var urlH = 'http://localhost:8080/shopbanmoto';
    var m = <?php echo json_encode($all_shop);?>;
    console.log(arrs);
    for (var key in m) {
        var item = m[key];
        console.log(item);
        arrs.push({
            id: item.shop_id,
            name: item.shop_name,
            lon: item.longtitude,
            lat: item.latitude
        });
        data.features.push({
            'type': 'Feature',
            'geometry': {
                'type': 'Point',
                'coordinates': [item.longtitude, item.latitude]
            },
            'properties': {
                'text': item.shop_name,
                'description': item.address
            }
        });
    }
    locationActive = arrs[0];
    </script>

    <script>
    $(function() {

        $('.choose').on('change', function() {
            var action = $(this).attr('id');
            var ma_id = $(this).val();
            var _token = $('input[name="_token"]').val();
            var result = '';

            if (action == 'city') {
                result = 'province';
            } else {
                result = 'wards';
            }
            $.ajax({
                url: "{{url('/select-delivery-home')}}",
                method: 'POST',
                data: {
                    action: action,
                    ma_id: ma_id,
                    _token: _token
                },
                success: function(data) {
                    $('#' + result).html(data);
                }
            });
        });


    })
    </script>

    
    <script type = "text/javascript" >
        $(document).ready(function() {
            $('.calculate_delivery').click(function() {
               var shipping_name= $('.shipping_name').val();
               var shipping_email= $('.shipping_email').val();
               var shipping_address= $('.shipping_address').val();
               var  shipping_notes= $('.shipping_notes').val();
               var  shipping_phone= $('.shipping_phone').val();
                var matp = $('.city').val();
                var maqh = $('.province').val();
                var xaid = $('.wards').val();
                var _token = $('input[name="_token"]').val();
                if (matp == '' && maqh == '' && xaid == ''||shipping_name == ''||shipping_email == ''||shipping_address == ''||shipping_notes == ''||shipping_phone == '') {
                    alert('Làm ơn chọn để tính phí vận chuyển');
                } else {
                    $.ajax({
                        url: "{{url('/save-checkout-customer')}}",
                        method: 'POST',
                        data: {
                            shipping_name:shipping_name,
                            shipping_email:shipping_email,
                            shipping_address:shipping_address,
                            shipping_notes:shipping_notes,
                            shipping_phone:shipping_phone,
                            matp: matp,
                            maqh: maqh,
                            xaid: xaid,
                            _token: _token,
                        },
                        success: function() {
                            $(location).attr('href', urlH + '/payment');
                        }
                    });
                }
            });
        });
    </script>

  
    <div id="fb-root"></div>
    <!-- Shase facebook -->
    <script async defer crossorigin="anonymous"
        src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v8.0&appId=309062063469898&autoLogAppEvents=1"
        nonce="Q3owmaXK"></script>

    <!-- Login facebook -->
    <script>
    window.fbAsyncInit = function() {
        FB.init({
            appId: '309062063469898',
            cookie: true,
            xfbml: true,
            version: '9a983b41ce5d3e108353b4d19b949d11'
        });

        FB.AppEvents.logPageView();

    };

    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {
            return;
        }
        js = d.createElement(s);
        js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    function checkLoginState() {
        FB.getLoginStatus(function(response) {
            if (response.status == "connected") {
                console.log(response)
                $.ajax({
                    url: urlH + '/login-facebook-home/' + response.authResponse.userID,
                    method: 'GET',
                    success: function() {
                        //  $(location).attr('href', urlH + '');
                    },
                    error: function() {
                        alert('error');
                    }
                })
            }
            statusChangeCallback(response);
        });
    }
    </script>

    <!-- <script src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js'></script> -->

</body>

</html>