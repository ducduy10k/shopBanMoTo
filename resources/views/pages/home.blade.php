@extends('layout')
@section('content')
<div class="features_items">
    <!--features_items-->
    <h2 class="title text-center">Sản phẩm mới</h2>
    @foreach($all_product as $key =>$pro)
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
                    
                </div>

            </div>
        </div>
    </a>
    @endforeach
</div>
<!--features_items-->
@endsection