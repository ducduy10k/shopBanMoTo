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
                            {{--   <!-- <button id="btnSignUp" >Thêm hàng</button>
                        <?php
  
                        if(isset($_POST['btnSignUp']))
                        {
                          increase_cart($v_content->id);        
                          }
                        ?> -->--}}

                            <p>{{number_format($v_content->price).' đ'}}</p>
                        </td>
                        <td>
                            <p>{{$v_content->qty}}</p>
                        </td>
                        <td>
                            <p>{{number_format(floatval($v_content->price)*floatval($v_content->qty)).' '.'đ'}}</p>
                        </td>

                    </tr>

                    @endforeach
                    <tr>
                        <td colspan="4">
                            <form action="{{URL::to('/check-coupon')}}" method="POST">
                                {{ csrf_field() }}
                                @if(Session::get('coupon'))
                                @foreach(Session::get('coupon') as $key =>$cou)
                                <input type="text" class="form-control" value="{{$cou['coupon_code']}}" name="coupon"
                                    placeholder="Nhập mã giảm giá">
                                @endforeach
                                @else
                                <input type="text" class="form-control" name="coupon" placeholder="Nhập mã giảm giá">
                                @endif
                                <br>
                                <input type="submit" id="check-coupon" class="btn btn-default check_coupon"
                                    name="check_coupon" value='Kiểm tra'>
                            </form>
                            <?php
			$message = Session::get('message');
			if($message){
				echo '<span style="color:green;">'. $message.'</span>';
				Session::put('message',null);
            }
            
            $error = Session::get('error');
			if($error){
				echo '<span style="color:red;">'. $error.'</span>';
				Session::put('error',null);
            }
            
			?>
                        </td>
                        <td colspan="2">
                            <table class="table table-condensed total-result">
                                <tr>
                                    <td>Tổng tiền đơn hàng</td>
                                    <td>{{number_format(((float)(preg_replace("/[^-0-9\.]/","",Cart::priceTotal())))).' '.'đ'}}
                                    </td>
                                </tr>
                                {{-- <tr>
                                    <td>Thuế</td>
                                    <td>{{number_format(((float)(preg_replace("/[^-0-9\.]/","",Cart::tax())))).' '.'đ'}}
                        </td>
                    </tr>--}}


                    <tr class="shipping-cost">
                        <td>Mã giảm giá</td>
                        <td>
                            @if(Session::get('coupon'))
                            @foreach(Session::get('coupon') as $key =>$cou)

                            @if($cou['coupon_condition'] == 1)
                            {{$cou['coupon_number']}} %
                            @php
                            Cart::setGlobalDiscount($cou['coupon_number']);
                            @endphp

                            @elseif($cou['coupon_condition'] == 2)
                            {{$cou['coupon_number']}} đ
                            @php
                            if((float)(preg_replace("/[^-0-9\.]/","",Cart::subTotal()))!=0)
                            Cart::setGlobalDiscount($cou['coupon_number']*100/(float)(preg_replace("/[^-0-9\.]/","",Cart::subTotal())));
                            echo '
                        </td>
                        '
                        @endphp
                        @endif

                        @endforeach
                        @else
                        @php
                        Cart::setGlobalDiscount(0);
                        @endphp
                        @endif



                    <tr class="shipping-cost">
                        <td>Phí vận chuyển</td>
                        <td>
                            @if(Session::get('fee')==0)
                            @php
                            echo 'free';
                            Cart::setGlobalTax(0);
                            @endphp
                            @else
                            @php
                            echo Session::get('fee');
                            if( (float)(preg_replace("/[^-0-9\.]/","",Cart::priceTotal()))!=0 ){
                                 Cart::setGlobalTax(Session::get('fee')*100/(float)(preg_replace("/[^-0-9\.]/","",Cart::priceTotal())));
                            }
                            @endphp
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td>Thành tiền</td>
                        <td>
                            @if(Session::get('coupon'))
                            @foreach(Session::get('coupon') as $key =>$cou)

                            @if($cou['coupon_condition'] == 2)
                            @php
                            echo '';
                            echo ''.number_format(round(floatval(preg_replace("/[^-0-9\.]/","",Cart::priceTotal())) + Session::get('fee') - $cou['coupon_number'],-3));
                            echo ' đ'
                            @endphp

                            @elseif($cou['coupon_condition'] == 1)
                            @php
                            echo '';
                            echo ''.number_format(round(
                            floatval(preg_replace("/[^-0-9\.]/","",Session::get('fee')))*$cou['coupon_number']/100 +
                            floatval(preg_replace("/[^-0-9\.]/","",Cart::total())),-0));
                            echo ' đ'
                            @endphp
                            @endif
                            @endforeach
                            @else
                            @php
                            echo '';
                            echo ''.number_format(round(floatval(preg_replace("/[^-0-9\.]/","",Cart::total())),-4));
                            echo ' đ';
                            @endphp
                            @endif
                        </td>
                    </tr>
            </table>
            </td>
            </tr>
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
        <p></p>
    </div>
</section>
<!--/#cart_items-->

@endsection