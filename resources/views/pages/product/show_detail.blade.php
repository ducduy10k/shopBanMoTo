@extends('layout')
@section('content')

@foreach($detail_product as $key =>$deltail_pro)
<div class="product-details">
    <!--product-details-->
    <div class="col-sm-5">
        <div class="view-product">
            <img src="{{URL::to('public/upload/product/'.$deltail_pro->product_image)}}" alt="" />
        </div>
        <div id="similar-product" class="carousel slide" data-ride="carousel">
            <!-- Controls -->
            <a class="left item-control" href="#similar-product" data-slide="prev">
                <i class="fa fa-angle-left"></i>
            </a>
            <a class="right item-control" href="#similar-product" data-slide="next">
                <i class="fa fa-angle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-sm-7">
        <div class="product-information">
            <!--/product-information-->
            <img src="images/product-details/new.jpg" class="newarrival" alt="" />
            <h2>{{$deltail_pro->product_name}}</h2>
            <p>Web ID:{{$deltail_pro->product_id}} </p>
            <img src="images/product-details/rating.png" alt="" />
            <form action="{{URL::to('/save-cart')}}" method="post">
                {{ csrf_field() }}
                <span>
                    <span>{{number_format($deltail_pro->product_price)}} VND</span>
                    <label>Số lượng:</label>
                    <input name='qty' type="number" min='1' value="1" />
                    <input name='productid_hidden' type="hidden" value="{{$deltail_pro->product_id}}" />
                    <button type="submit" class="btn btn-fefault cart">
                        <i class="fa fa-shopping-cart"></i>
                        Thêm vào giỏ hàng
                    </button>
                </span>
            </form>
            <p><b>Khả dụng :</b> Còn hàng</p>
            <p><b>Tình trạng :</b> Mới</p>
            <p><b>Thương hiệu:</b> {{$deltail_pro->brand_name}}</p>
            <p><b>Danh mục:</b> {{$deltail_pro->category_name}}</p>
            <a href=""><img src="images/product-details/share.png" class="share img-responsive" alt="" /></a>
        </div>
        <!--/product-information-->
    </div>
</div>
<!--/product-details-->
<div class="category-tab shop-details-tab">
    <!--category-tab-->
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#description" data-toggle="tab">Mô tả </a></li>
            <li><a href="#details" data-toggle="tab">Chi tiết </a></li>
            <li><a href="#reviews" data-toggle="tab">Đánh giá(5)</a></li>
        </ul>
    </div>
    <div class="tab-content">
        <div class="tab-pane fade active in " id="description">
            <p>{!!$deltail_pro->product_desc!!}</p>
        </div>

        <div class="tab-pane fade " id="details">
            <p>{!!$deltail_pro->product_content!!}</p>
        </div>
        <div class="tab-pane fade " id="reviews">
            <div class="col-sm-12">
                <ul>
                    <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                    <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                    <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
                </ul>
                <p></p>
                <form action="#">
                    <span>
                        <input type="text" placeholder="Your Name" />
                        <input type="email" placeholder="Email Address" />
                    </span>
                    <textarea name=""></textarea>
                    <b>Rating: </b> <img src="images/product-details/rating.png" alt="" />
                    <button type="button" class="btn btn-default pull-right">
                        Submit
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="fb-comments" data-href="http://localhost:8080/shopbanmoto/chi-tiet-san-pham/{{$deltail_pro->product_id}}" data-numposts="20" data-width=""></div>
<!--/category-tab-->
@endforeach
<div class="recommended_items">
    <!--recommended_items-->
    <h2 class="title text-center">Sản phẩm liên quan</h2>
    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="item active">
                @foreach($related_product as $key => $pro)
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{URL::to('public/upload/product/'.$pro->product_image)}}" height='200'
                                    alt="" />
                                <h2>{{number_format($pro->product_price).' VND'}} </h2>
                                <p>{{$pro->product_name}}</p>
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add
                                    to cart</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
            <i class="fa fa-angle-left"></i>
        </a>
        <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
            <i class="fa fa-angle-right"></i>
        </a>
    </div>
</div>
<!--/recommended_items-->

@endsection