@extends('layout')
@section('content')
<div class="features_items">
    <!--features_items-->
    @foreach($brand_name as $key =>$bra)
    <h2 class="title text-center">Thương hiệu {{$bra->brand_name}}</h2>
    @endforeach
    @foreach($brand_by_id as $key =>$pro)
    <div class="col-sm-4">
        <div class="product-image-wrapper">

            <div class="single-products">
                <div class="productinfo text-center">
                    <img src="{{URL::to('public/upload/product/'.$pro->product_image)}}" height='200' alt="" />
                    <h2>{{number_format($pro->product_price).' VND'}} </h2>
                    <p>{{$pro->product_name}}</p>
                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                </div>

                <div class="product-overlay">
                    <div class="overlay-content">
                        <h2>{{number_format($pro->product_price).' VND'}}</h2>
                        <p>{{$pro->product_name}}</p>
                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to
                            cart</a>
                    </div>
                </div>
            </div>

            <div class="choose">
                <ul class="nav nav-pills nav-justified">
                    <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                    <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                </ul>
            </div>

        </div>
    </div>

    @endforeach
</div>
<!--features_items-->

@endsection