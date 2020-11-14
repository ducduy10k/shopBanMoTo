<!DOCTYPE html>
<html>

<head>
    <title>Real Programmer</title>
</head>

<body>
    <h1>{{ $details['title'] }}</h1>
    <p>{{ $details['body'] }}</p>
    <p>Thank you</p>

    <div style="border-style: double">
        <div style="padding: 40px">
            <div>

                <p>Cảm Ơn quý khách đã tin chọn VIETTEL Store</p>
            </div>
            <hr>
            <div>
                <h2 style="color: red;">Thông tin chi tiết hóa đơn</h2>
                <h3>Hóa đơn số:  </h3>
                <p>Ngày đặt: </p>
            </div>
            <hr>
            <div>
                <h2>Thông tin khách hàng</h2>
                <p>Họ tên khách hàng:  </p>
                <p>Địa chỉ:  </p>
                <p>Số điện thoại:  </p>
                <p>Ghi chú: </p>
            </div>
         {{-- @foreach($order->details as $item)--}}  
            <table style="border: 1px solid">
                <tr style="border: 1px solid">
                    <th style="border: 1px solid">Tên sản phẩm đã đặt</th>
                    <th style="border: 1px solid">Ảnh</th>
                    <th style="border: 1px solid">Số lượng</th>
                    <th style="border: 1px solid">Giá tiền</th>
                </tr>
                <tr style="border: 1px solid">
                    <td style="border: 1px solid"></td>
                    <td style="border: 1px solid"></td>
                    <td style="border: 1px solid"></td>
                    <td style="border: 1px solid"><sup>đ</sup></td>
                </tr>
            </table>
            {{--  @endforeach--}}  

            <ul>
                <li style="color: red">
                    <b>Tổng tiền thanh toán:  <sup>đ</sup></b>
                </li>
            </ul>
            <br>
            <div>
                <h3><img src="/uploads/setting/1597318766_unnamed.png" alt=""></h3>
                <p>Số điện thoại:  | email: </p>
                <p>Địa chỉ:</p>
            </div>
            <br>
            <div style="margin: 0% 0% 5% 60%;width: 300px;">
                <h4 style="text-align: center">Shop Đã Ký</h4>
                <div style="border: 5px solid red; color: red; text-align: center">
                    <h3>VIETTEL Store</h3>
                    <p>Ngày kí:</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>