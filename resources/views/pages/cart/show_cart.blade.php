@extends('layout')
@section('content')
<style>
.del-Item {
    margin: 10px;
    padding: 5px;
}

.del-Item:hover {
    color: red;
    cursor: pointer;
}

.header-cart-customer {
    background-color: #FE980F;
}

.header-cart-customer .title-header-customer {
    font-size: 1.4em;
    font-weight: bold;
}

input.cart_quantity_input {
    max-width: 80px;
}
</style>
<section id="cart_items">
    <div>
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
                <li class="active">Giỏ hàng</li>
            </ol>
        </div>
        <?php
                $content = Cart::content();
                function increase_cart($rowId){
					Cart::update($rowId, Cart::get($rowId)->qty + 1);
					return Redirect::to('/show-cart');
				   }
            ?>
        <div class="table-responsive cart_info">
            <table class="table table-striped">
                <thead class='header-cart-customer'>
                    <tr>
                        <td class='title-header-customer'></td>
                        <td class='title-header-customer'>Hình ảnh</td>
                        <td class='title-header-customer'>Mô tả</td>
                        <td class='title-header-customer'>Giá</td>
                        <td class='title-header-customer'>Số lượng</td>
                        <td class='title-header-customer'>Tổng tiền</td>

                    </tr>
                </thead>
                <tbody>
                    @foreach($content as $v_content)
                    <tr>
                        <td>
                            <a href="{{URL::to('/delete-cart/'.$v_content->rowId)}}"><i title="Xóa"
                                    class="fa fa-times del-Item"></i></a>
                        </td>
                        <td>
                            <a href=""><img src="{{URL::to('public/upload/product/'.$v_content->options->image)}}"
                                    widgth='50' height='50' alt=""></a>
                        </td>
                        <td>
                            <h4><a href="">{{$v_content->name}}</a></h4>
                            <p>Web ID: {{$v_content->id}}</p>
                        </td>
                        <td>
                            <p>{{number_format($v_content->price).' VNĐ'}}</p>
                        </td>

                        <td>
                            <div class="cart_quantity_button">
                                <a class="cart_quantity cart_quantity_up"
                                    href="{{URL::to('/increase-cart/'.$v_content->rowId)}}"> +
                                </a>
                                <input class="cart_quantity_input" type="number" name="quantity"
                                    value="{{$v_content->qty}}" min='1' autocomplete="off" size="2">
                                <input type="hidden" id='id_cart' value="{{$v_content->rowId}}">

                                <a class="cart_quantity cart_quantity_down"
                                    href="{{URL::to('/reduce-cart/'.$v_content->rowId)}}"> -
                                </a>
                            </div>
                        </td>
                        <td>
                            <p>{{number_format(floatval($v_content->price)*floatval($v_content->qty)).' '.'VNĐ'}}</p>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
<!--/#cart_items-->
<section id="do_action">
    <div>
        <div class="heading">
            <h3></h3>
            <p></p>
        </div>
        <div class="row">

            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        <li>Thành tiền :<span>{{Cart::subtotal().' '.'VNĐ'}}</span></li>
                    </ul>
                    <?php
                                    $customer_id =Session::get('customer_id');
                                    if($customer_id!=NULL){
                                ?>
                    <li> <a class="btn btn-default check_out" href="{{URL::to('/checkout')}}">Thanh toán</a>
                    </li>
                    <?php
                                    }else{
                                ?>
                    <li> <a class="btn btn-default check_out" href="{{URL::to('/login-checkout')}}">Thanh toán</a>
                    </li>
                    <?php
                                    }
                                ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/#do_action-->
<script>


</script>

@endsection