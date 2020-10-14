<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.css' rel='stylesheet' />
    <script src="https://kit.fontawesome.com/535f28fd53.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://gserver.cloudgis.vn/developers/dist/lib/ol.css" />
    <script type="text/javascript" src="https://gserver.cloudgis.vn/developers/dist/lib/ol.js"></script>
    <!-- gclient -->
    <link rel="stylesheet" href="https://gserver.cloudgis.vn/developers/dist/gclient.min.css" />
    <script type="text/javascript" src="https://gserver.cloudgis.vn/developers/dist/gclient.min.js"></script>

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-2577926-1"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.js"></script>
    <script src="https://unpkg.com/lz-string@1.4.4/libs/lz-string.min.js"></script>



    <script src="{{asset('resources/js/html2canvas.min.js')}}"></script>



    <style>
    body {
        margin: 0;
        padding: 0;
    }

    #map {
        position: absolute;
        top: 0;
        right: 0;
        width: 50%;
        height: 50%;
    }

    td {
        padding: 5px;
    }

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

    .option-active {
        background-color: yellow;
    }
    </style>

</head>


<body>


    <button value="" id="showMap" onclick="openPrint()">
        In
    </button>
    <div id="map"></div>

    <div id="modal-printer" style="display:none;width: 90%;height: 80vh;background: white;border-radius:5px;position: fixed;left: 5%;top:10vh;z-index: 0; box-shadow: 2px 2px 2px 0px rgba(255, 255, 255, .5), 7px 7px 20px 0px rgba(0, 0, 0, .1), 4px 4px 15px 0px rgba(0, 0, 0, .1);
        ">
        <div class="header-content" style="padding: 0px 15px;cursor: move;margin-right: 15%;">
            <!-- <h5> Định dạng in</h5> -->
            <h5 onmousedown=" moveModalWithMouse()" onmouseup="stopMoveModalWithMouse()" onclick="clickHeader()"> Định
                dạng in</h5>

            <i id="minimizeScreen" class="fas fa-compress-arrows-alt"
                style='position: absolute; top: 7px; right: 30px; padding: 5px;display:none;'
                onclick="minimizeScreen()"></i>
            <i id="fullScreen" class="fas fa-expand" style='position: absolute; top: 7px; right: 30px; padding: 5px;'
                onclick="fullScreen()"></i>
            <i class="fas fa-times" style='position: absolute; top: 7px; right: 10px; padding: 5px;'
                onclick="hideModalPrinter()"></i>
        </div>
        <div class="main-content" style="height: calc(100% - 50px);width: 100%;">
            <div class="">
                <div class=""
                    style="height:calc(100% - 4px);width:calc(30% - 4px);display:inline-block;float:left;position: relative;margin:2px;">
                    <div style="margin : 20px 20px;">
                        <span>Bố cục : </span>
                        <select name="" id="" style="width:50%; display : inline-block;" class="form-control">
                            <option value="">A4</option>
                            <option value="">A3</option>
                        </select>
                    </div>
                    <div style="margin:10px auto;width:60%;">
                        <span class="print-style-option  option-active"
                            style="padding: 5px;cursor: pointer;margin : 10px;">A4 trái phải </span>
                        <span class="print-style-option " style="padding: 5px;cursor: pointer;margin : 10px;" onclick="onChange(1)">A4 trên
                            xuống </span>

                    </div>
                    <div style="position: absolute;bottom: 5px;right: 5px;">
                        <button onclick="thucHienIn()">Thực hiện in</button>
                    </div>
                </div>
                <div class=" "
                    style="border:1px solid black;padding: 0;height:calc(100% - 4px);width:calc(70% - 4px); display:inline-block;float:left;background-color:#ccc;margin:2px;">
                    <iframe src="http://localhost:8080/shopbanmoto/iframe_printer" width="100%" height="100%"
                        id="printf" name="printf">
                    </iframe>
                </div>
            </div>
        </div>

    </div>
    <div id="testPrint" style="display: none;">
        <button>Type 1</button>
        <button>Type 2</button>

        <img src="" id="anh" width="50px" height="50px" alt="">
    </div>

    <div style="position: fixed;top:20px;
    right: 20px;">

    </div>


</body>
<script>
// mapboxgl.accessToken =
//     'pk.eyJ1IjoiYmV0YXBjaG9pMTBrIiwiYSI6ImNrY2ZuaWEwNjA2ZW0yeWw4bG9yNnUyYm0ifQ.bFCQ-5yq6cSsrhugfxO2_Q';
// var map = new mapboxgl.Map({
//     container: 'map',
//     style: 'mapbox://styles/betapchoi10k/ckeez49fq1e0w19ntggfba9hs',
//     zoom: 2,
//     center: [0, 0],
//     // interactive: false // tắt các điều khiển tương tác thêm bản đồ
// });

var map = new gclient.Map({
    target: 'map',
    layers: [
        new ol.layer.Tile({
            baseLayer: true,
            source: new gclient.source.RoadMap({
                apikey: '1-d9Dz7b8YG52NwMYXZpLPoCbAEq1Nm8QT'
            })
        })
    ]
});


function openPrint() {
    document.getElementById('modal-printer').style.display = 'block';
    var doc = document.getElementById('printf').contentWindow.document;
    // var img = "{{('public/frontend/images/home/z1000.jpg')}}";
    // doc.getElementById('anh-i-map').innerHTML = '<img src="' + img + '" width="100%" alt="">';

    doc.getElementById('anh-i-map').insertAdjacentHTML("afterend", "<p><div id='id_qrcode1'></div></p>");
    // doc.body.append('<div id="qr-code">abc</div>');
    // doc.open();
    // doc.write('Test');
    // doc.close();


}
document.getElementById('showMap').addEventListener('click', function() {
    var doc = document.getElementById('printf').contentWindow.document;
    var img = "{{('public/frontend/images/home/z1000.jpg')}}";
    // doc.getElementById('anh-i-map').innerHTML = '<img src="' + img + '" width="100%" alt="">';

    map.once('rendercomplete', function() {
        var mapCanvas = document.createElement('canvas');
        var size = map.getSize();
        mapCanvas.width = size[0];
        mapCanvas.height = size[1];
        var mapContext = mapCanvas.getContext('2d');
        Array.prototype.forEach.call(
            document.querySelectorAll('.ol-layer canvas'),
            function(canvas) {
                if (canvas.width > 0) {
                    var opacity = canvas.parentNode.style.opacity;
                    mapContext.globalAlpha = opacity === '' ? 1 : Number(opacity);
                    var transform = canvas.style.transform;
                    // Get the transform parameters from the style's transform matrix
                    var matrix = transform
                        .match(/^matrix\(([^\(]*)\)$/)[1]
                        .split(',')
                        .map(Number);
                    // Apply the transform to the export map context
                    CanvasRenderingContext2D.prototype.setTransform.apply(
                        mapContext,
                        matrix
                    );
                    mapContext.drawImage(canvas, 0, 0);
                }
            }
        );
        if (navigator.msSaveBlob) {
            // link download attribuute does not work on MS browsers
            navigator.msSaveBlob(mapCanvas.msToBlob(), 'map.png');
        } else {
            //var link = document.getElementById('image-download');
            // console.log(mapCanvas.toDataURL());
            // link.href = mapCanvas.toDataURL();
            // link.click();
            // doc.getElementById('anh-i-map').innerHTML = '<img src="' + mapCanvas.toDataURL() +
            //     '" width="100%" alt="">';

        }
    });
    map.renderSync();
});

function thucHienIn() {
   // let frame = document.getElementById('printf');
    // window.print();
    // window.frames["printf"].focus();
    // window.frames["printf"].print();
    var frm = document.getElementById("printf").contentWindow;
    frm.focus(); // focus on contentWindow is needed on some ie versions
    frm.print();
    // // window.frames["iframe-a"].print();
    // var idframe = document.getElementById("iframe-a");
    // if (idframe != null) {
    //     window.frames["iframe-a"].focus();
    //     window.frames["iframe-a"].print();
    // } else {
    //     showMsgClick('Có lỗi xảy ra trong khi in !', false);
    // }
}

function onChange(a){
    var doc = document.getElementById('printf').contentWindow.document;
    doc.getElementById('anh-i-map').style.float = 'letf';
    doc.getElementsByClassName('layout-d-column')[0].style.width = '100%';
    doc.getElementsByClassName('layout-d-column')[0].style.float = 'right';
}
function hideModalPrinter() {
    document.getElementsById('modal-printer').style.display = 'none';
}

var wCurrent, hCurrent, tCurrent, lCurrent;
wCurrent = document.getElementById('modal-printer').style.width;
lCurrent = document.getElementById('modal-printer').style.left;
hCurrent = document.getElementById('modal-printer').style.height;
tCurrent = document.getElementById('modal-printer').style.top;

function fullScreen() {
    document.getElementById('fullScreen').style.display = 'none';
    document.getElementById('minimizeScreen').style.display = 'block';
    document.getElementById('modal-printer').style.width = "100%";
    document.getElementById('modal-printer').style.left = '0%';
    document.getElementById('modal-printer').style.height = '100vh';
    document.getElementById('modal-printer').style.top = '0';
}

function minimizeScreen() {
    document.getElementById('fullScreen').style.display = 'block';
    document.getElementById('minimizeScreen').style.display = 'none';
    document.getElementById('modal-printer').style.width = wCurrent;
    document.getElementById('modal-printer').style.left = lCurrent;
    document.getElementById('modal-printer').style.height = hCurrent;
    document.getElementById('modal-printer').style.top = tCurrent;
}

var moveObj = 0;

// di chuyển đối tượng theo con trỏ chuột bằng các ấn dị chuột
function moveModalWithMouse() {
    moveObj = 1;
    let node = document.getElementById("modal-printer");
    //console.log(moveObj);
    var lc = parseFloat(lCurrent.replace('%', ''));
    var mrgX = window.innerWidth * lc / 100;

    var kc = event.screenX - lc;

    var cursorX;
    var cursorY;
    console.log(kc);
    console.log(event.screenX);
    document.onmousemove = function(e) {
        cursorX = e.pageX;
        cursorY = e.pageY;
        if (moveObj) {
            node.style.top = cursorY - 10 + "px";
            node.style.left = cursorX - kc + 0 + "px";
        }
    }
   

}

// mouse up
function stopMoveModalWithMouse() {
    moveObj = 0;
    //console.log(moveObj);
    let node = document.getElementById("modal-printer");
     wCurrent = document.getElementById('modal-printer').style.width;
    lCurrent = document.getElementById('modal-printer').style.left;
    hCurrent = document.getElementById('modal-printer').style.height;
    tCurrent = document.getElementById('modal-printer').style.top;
}

function clickHeader() {
    moveObj = 0;
}

$(function() {
    $('.print-style-option').click(function() {
        $('.print-style-option').removeClass('option-active');
        $(this).addClass('option-active');
    })
})
</script>

</html>