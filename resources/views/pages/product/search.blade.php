@extends('layout')
@section('content')
<div class="features_items">
    <!--features_items-->
    <h2 class="title text-center">Kết quả tìm kiếm</h2>
    @foreach($search_product as $key =>$pro)
    <a href="{{URL::to('/chi-tiet-san-pham/'.$pro->product_id)}}">
        <div class="col-sm-4">
            <div class="product-image-wrapper">

                <div class="single-products">
                    <div class="productinfo text-center">
                    <?php
                if($pro->product_image !=''){
                ?>
                    <img src="{{URL::to('public/upload/product/'.$pro->product_image)}}" height='200' alt="" />
                    <?php
                }else{
                    ?>
                    <img src="{{URL::to('public/frontend/images/product-details/null.jpg')}}" style="width:100%;height:200px;" alt="" />
                    <?php 
                }

                    ?>
                        
                        <h2>{{number_format($pro->product_price).' VND'}} </h2>
                        <p>{{$pro->product_name}}</p>
                        <form action="{{URL::to('/save-cart')}}" method="post">
                        <input name='productid_hidden' type="hidden" value="{{$pro->product_id}}" />
                        <input name='qty' type="hidden" min='1' value="1" />
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-fefault cart">
                                <i class="fa fa-shopping-cart"></i>
                                Thêm vào giỏ hàng
                            </button>
                        </form>
                    </div>
                </div>

                <div class="choose">
                    <ul class="nav nav-pills nav-justified">
                        <li><a href="#"><i class="fa fa-plus-square"></i>Yêu thích</a></li>
                        <li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
                    </ul>
                </div>

            </div>
        </div>
    </a>

    @endforeach
</div>
<!--features_items-->

<div class="category-tab">
    <!--category-tab-->
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tshirt" data-toggle="tab">T-Shirt</a></li>
            <li><a href="#blazers" data-toggle="tab">Blazers</a></li>
            <li><a href="#sunglass" data-toggle="tab">Sunglass</a></li>
            <li><a href="#kids" data-toggle="tab">Kids</a></li>
            <li><a href="#poloshirt" data-toggle="tab">Polo shirt</a></li>
        </ul>
    </div>
    <div class="tab-content">
        <div class="tab-pane fade active in" id="tshirt">
            <div class="col-sm-3">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="images/home/gallery1.jpg" alt="" />
                            <h2>$56</h2>
                            <p>Easy Polo Black Edition</p>
                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to
                                cart</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="poloshirt">
            <div class="col-sm-3">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="images/home/gallery2.jpg" alt="" />
                            <h2>$56</h2>
                            <p>Easy Polo Black Edition</p>
                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to
                                cart</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/category-tab-->

<div class="recommended_items">
    <!--recommended_items-->
    <h2 class="title text-center">recommended items</h2>

    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="item active">
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="images/home/recommend1.jpg" alt="" />
                                <h2>$56</h2>
                                <p>Easy Polo Black Edition</p>
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add
                                    to cart</a>
                            </div>

                        </div>
                    </div>
                </div>
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