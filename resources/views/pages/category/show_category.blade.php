@extends('layout')
@section('content')
<div class="features_items">
    <!--features_items-->
    @foreach($category_name as $key =>$cate)
    <h2 class="title text-center">Danh mục {{$cate->category_name}}</h2>
    @endforeach
    @foreach($category_by_id as $key =>$pro)
    <a href="{{URL::to('/chi-tiet-san-pham/'.$pro->product_id)}}">
    <div class="col-sm-4">
        <div class="product-image-wrapper">
            
            <div class="single-products">
                <div class="productinfo text-center">
                    <img src="{{URL::to('public/upload/product/'.$pro->product_image)}}" height='200' alt="" />
                    <h2>{{number_format($pro->product_price).' VND'}} </h2>
                    <p>{{$pro->product_name}}</p>
                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
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

@endsection