<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="{{asset('resources/js/qrcode.min.js')}}"></script>
    <style>
    .page {
        width: 21cm;
        min-height: 29.7cm;
        /* padding: 2cm; */
        padding: 1cm;
        margin: 1cm auto;
        border: 1px #D3D3D3 solid;
        border-radius: 5px;
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }

    .layout-d {
        width: 100%;
        margin: 0 auto;
        border: dotted 1px #000;
    }

    .layout-d-column {
        /* width: 50%; */
        float: left;
        padding: 0 0 5px 0;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }
    </style>
</head>

<body onload='onReady()'>
    <!-- <form action="">
        <div class="book">
            <div class="page">
                <div class="layout-d">
                    <div class="layout-d-column" style="height: 100%;width: 50%;">
                        <table style="background-color: white;border: 1px solid black;height: 100%;">
                            <tr>
                                <th style="width: 40%;">
                                    Tên thuộc tính
                                </th>
                                <th>
                                    Giá trị
                                </th>
                            </tr>
                            <tr>
                                <td>Mã chợ</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Tên chợ</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>xDaiDien</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>yDaiDien</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Diện tích(m2) </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Hạng</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Nguồn vốn đầu tư </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Tổng vốn đầu tư(tỷ đồng) </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Năm xây dựng </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Năm hoàn thành </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Hình thức quản lý </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Địa chỉ </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Quận/ Huyện </td>
                                <td></td>
                            </tr>



                            <tr>
                                <td>Nguồn vốn đầu tư </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Tổng vốn đầu tư(tỷ đồng) </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Năm xây dựng </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Năm hoàn thành </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Hình thức quản lý </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Địa chỉ </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Quận/ Huyện </td>
                                <td></td>
                            </tr>


                        </table>
                    </div>
                    <div class="layout-i-map" id="anh-i-map" style="float:left;width: 50%;">
                       

                        
                    </div>

                    <span style="position:absolute;bottom:0;right:5px;">
                        <div id="id_qrcode1"></div>
                    </span>

                </div>
            </div>
        </div>
    </form> -->
    <form action="">
        <div class="book">
            <div class="page">
                <div class="layout-d">
                    <div class="layout-d-column" style="height: 100%;width: 100%;">
                        <div class="layout-i-map" id="anh-i-map" style="float:left;width: 100%;">
                            <img src="{{('public/frontend/images/home/z1000.jpg')}}" width="100%" alt="">
                        </div>
                        <table style="background-color: white;border: 1px solid black;height: 100%;">
                            <tr>
                                <th style="width: 40%;">
                                    Tên thuộc tính
                                </th>
                                <th>
                                    Giá trị
                                </th>
                            </tr>
                            <tr>
                                <td>Mã chợ</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Tên chợ</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>xDaiDien</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>yDaiDien</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Diện tích(m2) </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Hạng</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Nguồn vốn đầu tư </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Tổng vốn đầu tư(tỷ đồng) </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Năm xây dựng </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Năm hoàn thành </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Hình thức quản lý </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Địa chỉ </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Quận/ Huyện </td>
                                <td></td>
                            </tr>



                            <tr>
                                <td>Nguồn vốn đầu tư </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Tổng vốn đầu tư(tỷ đồng) </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Năm xây dựng </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Năm hoàn thành </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Hình thức quản lý </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Địa chỉ </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Quận/ Huyện </td>
                                <td></td>
                            </tr>


                        </table>
                    </div>
                    <div class="layout-i-map" id="anh-i-map" style="float:left;width: 50%;">



                    </div>

                    <span style="position:absolute;bottom:0;right:5px;">
                        <div id="id_qrcode1"></div>
                    </span>

                </div>
            </div>
        </div>
    </form>
    <script>
    function onReady() {
        var qrcode = new QRCode("id_qrcode1", {
            text: "http://localhost:8080/shopbanmoto/printer",
            width: 50,
            height: 50,
            colorDark: "#000000",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H
        });
    }
    </script>
</body>

</html>