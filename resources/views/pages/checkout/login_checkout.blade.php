@extends('layout')
@section('content')
<section id="form">
    <!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form">
                    <!--login form-->
                    <h2>Đăng nhập</h2>
                    <form action="{{URL::to('login-customer')}}" method="POST">
                        {{ csrf_field() }}
                        <input type="text" name="name_account" placeholder="Tài khoản" />
                        <input type="password" name="pass_account" placeholder="Mật khẩu" />
                        <span>
                            <input type="checkbox" class="checkbox">
                            Ghi nhớ đăng nhập
                        </span>
                        <button type="submit" class="btn btn-default">Đăng nhập</button>
                    </form>
                </div>
                <!--/login form-->
            </div>
            <div class="col-sm-1">
                <h2 class="or">Hoặc</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form">
                    <!--sign up form-->
                    <h2>Đăng ký tài khoản</h2>
                    <form action="{{URL::to('add-customer')}}" method="POST">
                        {{ csrf_field() }}
                        <input type="text" name='customer_name' placeholder="Tên tài khoản" />
                        <input type="email" name='customer_email' placeholder="Địa chỉ email" />
                        <input type="password" name='customer_password' placeholder="Mật khẩu" />
                        <input type="text" name='customer_phone' pattern="\d*" placeholder="Số điện thoại" />
                        <button type="submit" class="btn btn-default">Đăng ký</button>
                    </form>
                </div>
                <!--/sign up form-->
            </div>
        </div>
        <fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
        </fb:login-button>
    </div>
</section>
<!--/form-->

@endsection