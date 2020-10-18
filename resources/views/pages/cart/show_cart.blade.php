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
            <h3>What would you like to do next?</h3>
            <p>Choose if you have a discount code or reward points you want to use or would like to estimate your
                delivery cost.</p>
        </div>
        <div class="row">
            <!-- <div class="col-sm-6">
                <div class="chose_area">
                    <ul class="user_option">
                        <li>
                            <input type="checkbox">
                            <label>Use Coupon Code</label>
                        </li>
                        <li>
                            <input type="checkbox">
                            <label>Use Gift Voucher</label>
                        </li>
                        <li>
                            <input type="checkbox">
                            <label>Estimate Shipping & Taxes</label>
                        </li>
                    </ul>
                    <ul class="user_info">
                        <li class="single_field">
                            <label>Country:</label>
                            <select>
                                <option>United States</option>
                                <option>Bangladesh</option>
                                <option>UK</option>
                                <option>India</option>
                                <option>Pakistan</option>
                                <option>Ucrane</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>

                        </li>
                        <li class="single_field">
                            <label>Region / State:</label>
                            <select>
                                <option>Select</option>
                                <option>Dhaka</option>
                                <option>London</option>
                                <option>Dillih</option>
                                <option>Lahore</option>
                                <option>Alaska</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>

                        </li>
                        <li class="single_field zip-field">
                            <label>Zip Code:</label>
                            <input type="text">
                        </li>
                    </ul>
                    <a class="btn btn-default update" href="">Get Quotes</a>
                    <a class="btn btn-default check_out" href="">Continue</a>
                </div>
            </div> -->
            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        <li>Tổng <span>{{Cart::subtotal().' '.'VNĐ'}}</span></li>
                        <li>Thuế <span>{{Cart::tax().' '.'VNĐ'}}</span></li>
                        <li>Phí vận chuyển <span>Free</span></li>
                        <li>Thành tiền <span>{{Cart::subtotal().' '.'VNĐ'}}</span></li>
                    </ul>
                    <!-- <a class="btn btn-default update" href="">Update</a> -->
                    <a class="btn btn-default check_out" href="{{URL::to('/login-checkout')}}">Thanh toán</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/#do_action-->
<script>


</script>

@endsection