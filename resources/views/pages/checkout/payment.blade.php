@extends('layout')
@section('content')

<section id="cart_items">
    <div class="">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
                <li class="active">Thanh toán giỏ hàng</li>
            </ol>
        </div>

        <div class="review-payment">
            <h2>Xem lại giỏ hàng</h2>
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
                            <p>{{$v_content->qty}}</p>
                        </td>
                        <td>
                            <p>{{number_format(floatval($v_content->price)*floatval($v_content->qty)).' '.'VNĐ'}}</p>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <h4 style="margin:40px 0;">Hình thức thanh toán</h4>
        <form action="order-place" method="POST">
            {{ csrf_field() }}

            <div class="payment-options" style="margin-bottom:0;">
                <span>
                    <label><input name="payment_option" value="1" type="radio"> ATM</label>
                </span>
                <span>
                    <label><input name="payment_option" value="2" type="radio"> Thanh toán sau khi nhận hàng</label>
                </span>
                <span>
                    <label><input name="payment_option" value="3" type="radio"> Thanh toán qua thẻ ghi nợ</label>
                </span>
            </div>
            <input type="submit" value="Thanh toán" name="send_order_place" class="btn btn-primary btn-sm">
        </form>
    </div>
</section>
<!--/#cart_items-->

@endsection