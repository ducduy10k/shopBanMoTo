@extends('layout')
@section('content')
<div class="features_items">
    <!--features_items-->
    @foreach($brand_name as $key =>$bra)
    <h2 class="title text-center">Thương hiệu {{$bra->brand_name}}</h2>
    @endforeach
    @foreach($brand_by_id as $key =>$pro)
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
                        <img src="{{URL::to('public/frontend/images/product-details/null.jpg')}}"
                            style="width:100%;height:200px;" alt="" />
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
    {{ $brand_by_id->links() }}
</div>
<!--features_items-->

@endsection