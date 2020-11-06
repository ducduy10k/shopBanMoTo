@extends('layout')
@section('content')

<section id="cart_items">
    <div class="">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
                <li class="active">Thanh toán</li>
            </ol>
        </div>



        <div class="register-req">
            <p>Please use Register And Checkout to easily get access to your order history, or use Checkout as Guest</p>
        </div>
        <!--/register-req-->

        <div class="shopper-informations">
            <div class="row">
                {{--<form action="{{URL::to('/save-checkout-customer')}}" method="POST">--}}
                <form>
                    @csrf
                    <div class="col-sm-6">
                        <div>
                            <p>Điền thông tin</p>
                            <div class="">


                                <input type="text" class='form-control mb-5 shipping_email'  name="shipping_email" placeholder="Email*" required>
                                <input type="text" class='form-control mb-5 shipping_name' name="shipping_name"
                                    placeholder="Họ và tên" required>
                                <input type="text" class='form-control mb-5 shipping_address' name="shipping_address"
                                    placeholder="Địa chỉ" required>
                                <input type="text" class='form-control mb-5 shipping_phone' name="shipping_phone"
                                    placeholder="Số điện thoại" required>
                                <textarea name="shipping_notes" class='shipping_notes'  placeholder="Ghi chú đơn hàng" rows="5" required>
                                                                </textarea>
                                {{--<input type="submit" value="Gửi" name="send_order" class="btn btn-primary btn-sm">--}}
                                <p></p>

                            </div>

                        </div>
                    </div>
                    <div class="col-sm-6">

                        <div class="form-group">
                            <label for="exampleInputPassword1">Chọn thành phố</label>
                            <select name="city" id="city" class="form-control input-sm m-bot15 choose city">
                                <option value="">--Chọn tỉnh thành phố--</option>
                                @foreach($city as $key => $ci)
                                <option value="{{$ci->matp}}">{{$ci->name_city}}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Chọn quận huyện</label>
                            <select name="province" id="province" class="form-control input-sm m-bot15 province choose">
                                <option value="">--Chọn quận huyện--</option>

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Chọn xã phường</label>
                            <select name="wards" id="wards" class="form-control input-sm m-bot15 wards">
                                <option value="">--Chọn xã phường--</option>
                            </select>
                        </div>
                        <input type="button" value="Tính phí vận chuyển" name="calculate_order"
                            class="btn btn-primary btn-sm calculate_delivery">
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!--/#cart_items-->

@endsection