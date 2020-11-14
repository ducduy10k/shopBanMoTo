@extends('layout')
@section('content')
<div class="features_items">

    <!--features_items-->
    @foreach($category_name as $key =>$cate)
    <h2 class="title text-center">Danh mục {{$cate->category_name}}</h2>
    @endforeach


    <form action="" method="POST">
        @csrf
        <div style="    display: flex;
    margin: 20px;
    flex: 1;
    align-items: baseline;
    flex-direction: row-reverse;">

            <div>
                <select name="sort" id="sort">
                    <option value="{{Request::url()}}">Mới nhất</option>
                    <option value="{{Request::url()}}?sort_by=tang_dan">Giá tăng dần</option>
                    <option value="{{Request::url()}}?sort_by=giam_dan">Giá giảm dần</option>
                    <option value="{{Request::url()}}?sort_by=a_z">A - Z</option>
                    <option value="{{Request::url()}}?sort_by=z_a">Z - A</option>

                </select>
            </div>
            <div style="margin: 0 10px;">Sắp xếp</div>
        </div>
    </form>



    @foreach($category_by_id as $key =>$pro)
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
    {{ $category_by_id->render() }}
</div>
<!--features_items-->

@endsection