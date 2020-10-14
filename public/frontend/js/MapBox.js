var arrs = [{
    id: "VN",
    national: "Việt 1",
    lon: 105.908203,
    lat: 21.04349121680354
}];
var isDrive = false;
var content = '';
var data = {
    "type": "FeatureCollection",
    "features": [{
        "type": "Feature",
        "properties": {
            'description': "Số nhà 17 , ngõ 445 Nguyễn Khang , Cầu Giấy , Hà Nội .",
            'icon': 'theatre'
        },
        "geometry": {
            "type": "Point",
            "coordinates": [
                105.797527, 21.029750
            ]
        }
    }]
}

mapboxgl.accessToken = 'pk.eyJ1IjoiYmV0YXBjaG9pMTBrIiwiYSI6ImNrY2ZuaWEwNjA2ZW0yeWw4bG9yNnUyYm0ifQ.bFCQ-5yq6cSsrhugfxO2_Q';
var map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/betapchoi10k/ckeez49fq1e0w19ntggfba9hs',
    zoom: 2,

    // interactive: false // tắt các điều khiển tương tác thêm bản đồ
});
var id, lon, lat, national;
//Taon mới điểm 
function newPoint() {
    id = document.getElementById('idNational').value;
    national = document.getElementById('national').value;
    lon = document.getElementById('lon').value;
    lat = document.getElementById('lat').value;
    description = document.getElementById('description').value;
    arrs.push({
        id,
        national,
        lon,
        lat
    });
    content = '';
    for (var arr of arrs) {
        content += "<li onclick=flyToLocation('" + arr.id + "')>" + arr.national + "</li>";

    }
    data.features.push({
        'type': 'Feature',
        'geometry': {
            'type': 'Point',
            'coordinates': [lon, lat]
        },
        'properties': {
            'text': arr.national,
            'description': description
        }
    });
    document.getElementById('lstPoint').innerHTML = content;
    map.removeLayer('default');
    map.removeSource('default');
    // map.addImage('default', pulsingDot, { pixelRatio: 2 });
    map.addSource('default', {
        'type': 'geojson',
        'data': data
    });
    map.addLayer({
        'id': 'default',
        'type': 'circle',
        'source': 'default',
        'paint': {
            'circle-radius': 10,
            'circle-color': 'red'
        }
    });
    alert("Thêm mới thành công .");
}

function createMarker() {
    var idMarker, lonMarker, latMarker, noteMarker;
    idMarker = document.getElementById('idMarker').value;
    lonMarker = document.getElementById('lonMarker').value;
    latMarker = document.getElementById('latMarker').value;
    noteMarker = document.getElementById('noteMarker').value;
    var popup = new mapboxgl.Popup({
        closeButton: false
    });
    popup.setHTML(noteMarker)
        .setMaxWidth("300px")
    const marker = new mapboxgl.Marker()
        .setLngLat([lonMarker, latMarker])
        .setPopup(popup) // sets a popup on this marker
        .addTo(map);
    const markerDiv = marker.getElement();
    markerDiv.addEventListener('mousemove', () => popup.addTo(map));
    markerDiv.addEventListener('mouseleave', () => popup.remove());
}
// thêm mới ảnh
function createImage() {
    var id, lonAnh, latAnh, linkAnh;
    id = document.getElementById('idAnh').value;
    lonAnh = document.getElementById('lonAnh').value;
    latAnh = document.getElementById('latAnh').value;
    linkAnh = document.getElementById('linkAnh').value;
    console.log(linkAnh);
    map.loadImage('https://cors-anywhere.herokuapp.com/' + linkAnh, function(error, image) {
        if (error) throw error;
        map.addImage(id, image);
    })
    map.addSource(id, {
        'type': 'geojson',
        'data': {
            'type': 'FeatureCollection',
            'features': [{
                'type': 'Feature',
                'geometry': {
                    'type': 'Point',
                    'coordinates': [lonAnh, latAnh]
                }
            }]
        }
    });

    map.addLayer({
        'id': id,
        'type': 'symbol',
        'source': id,
        'layout': {
            'icon-image': id,
            'icon-size': 0.01
        }
    })
}
// Đường bay
function newFlight() {
    var idFly, originLon, originLat, destinationLon, destinationLat;
    idFly = document.getElementById('idFly').value;
    originLon = document.getElementById('originLon').value;
    originLat = document.getElementById('originLat').value;
    destinationLon = document.getElementById('destinationLon').value;
    destinationLat = document.getElementById('destinationLat').value;
    var route = {
        'type': 'Feature',
        'properties': {
            'description': 'Việt Nam - Mỹ'
        },
        'geometry': {
            'type': 'LineString',
            'coordinates': [
                [originLon, originLat],
                [destinationLon, destinationLat]
            ]
        }
    }
    var point = {
        'type': 'FeatureCollection',
        'features': [{
            'type': 'Feature',
            'properties': {},
            'geometry': {
                'type': 'Point',
                'coordinates': [originLon, originLat]
            }
        }]
    };
    var lineDistance = turf.lineDistance(route, 'kilometers');
    var steps = 500;
    var arc = [];
    // Draw an arc between the `origin` & `destination` of the two points
    for (var i = 0; i < lineDistance; i += lineDistance / steps) {
        var segment = turf.along(route, i, 'kilometers');
        arc.push(segment.geometry.coordinates);
    }
    // Update the route with calculated arc coordinates
    route.geometry.coordinates = arc;
    // Used to increment the value of the point measurement against the route.
    var counter = 0;
    map.addSource('fly', {
        'type': 'geojson',
        'data': route
    })
    map.addSource('point', {
        'type': 'geojson',
        'data': point
    })
    map.addLayer({
        'id': 'route',
        'type': 'line',
        'source': 'fly',
        'layout': {
            'line-join': 'round',
            'line-cap': 'round'
        },
        'paint': {
            'line-color': getRandomColor(),
            'line-width': 2
        }
    })
    map.addLayer({
        'id': 'point',
        'source': 'point',
        'type': 'symbol',
        'layout': {
            'icon-image': 'airport-15',
            'icon-rotate': ['get', 'bearing'],
            'icon-rotation-alignment': 'map',
            'icon-allow-overlap': true,
            'icon-ignore-placement': true
        }
    });
    for (var i = 0; i < arc.length; i++) {
        point.features[0].geometry.coordinates = arc[i];
        map.getSource('point').setData(point);
    }
}
// set the bounds of the map
var bounds = [
    [105.040945, 20.626792],
    [106.348476, 21.709620]
];
map.setMaxBounds(bounds);
// initialize the map canvas to interact with later
var canvas = map.getCanvasContainer();
// an arbitrary start will always be the same
// only the end or destination will change
var start = [105.797527, 21.029750];
// this is where the code for the next step will go

function getRoute(end) {
    // make a directions request using cycling profile
    // an arbitrary start will always be the same
    // only the end or destination will change
    var start = [105.803931, 21.028659];
    //mapbox/driving-traffic, mapbox/driving, mapbox/walking, và mapbox/cycling
    var url = 'https://api.mapbox.com/directions/v5/mapbox/walking/' + end[0] + ',' + end[1] + ';' + start[0] + ',' + start[1] + '?steps=true&geometries=geojson&access_token=' + mapboxgl.accessToken;
    // make an XHR request https://developer.mozilla.org/en-US/docs/Web/API/XMLHttpRequest
    var req = new XMLHttpRequest();
    req.open('GET', url, true);
    req.onload = function() {
        var json = JSON.parse(req.response);
        var data = json.routes[0];
        var route = data.geometry.coordinates;
        var geojson = {
            type: 'Feature',
            properties: {},
            geometry: {
                type: 'LineString',
                coordinates: route
            }
        };
        // if the route already exists on the map, reset it using setData
        if (map.getSource('route')) {
            map.getSource('route').setData(geojson);
        } else { // otherwise, make a new request
            map.addLayer({
                id: 'route',
                type: 'line',
                source: {
                    type: 'geojson',
                    data: {
                        type: 'Feature',
                        properties: {},
                        geometry: {
                            type: 'LineString',
                            coordinates: geojson
                        }
                    }
                },
                layout: {
                    'line-join': 'round',
                    'line-cap': 'round'
                },
                paint: {
                    'line-color': '#3887be',
                    'line-width': 5,
                    'line-opacity': 0.75
                }
            });
        }
        // add turn instructions here at the end
        // get the sidebar and add the instructions
        var instructions = document.getElementById('instructions');
        var steps = data.legs[0].steps;
        var tripInstructions = [];
        for (var i = 0; i < steps.length; i++) {
            tripInstructions.push('<br><li>' + steps[i].maneuver.instruction) + '</li>';
            instructions.innerHTML = '<br><span class="duration">Trip duration: ' + Math.floor(data.duration / 60) + ' min 🚴🚶 🚗 🚌 </span>' + tripInstructions;
        }

    };
    req.send();
}

map.on('load', function() {
    // make an initial directions request that
    // starts and ends at the same location
    getRoute(start);
    // Add starting point to the map
    map.addLayer({
        id: 'point',
        type: 'circle',
        source: {
            type: 'geojson',
            data: {
                type: 'FeatureCollection',
                features: [{
                    type: 'Feature',
                    properties: {},
                    geometry: {
                        type: 'Point',
                        coordinates: start
                    }
                }]
            }
        },
        paint: {
            'circle-radius': 10,
            'circle-color': '#3887be'
        }
    });
    // this is where the code from the next step will go
    for (var arr of arrs) {
        content += "<li onclick=flyToLocation('" + arr.id + "')>" + arr.national + "</li>";
    }
    //   document.getElementById('lstPoint').innerHTML = content;
    //  map.addImage('default', pulsingDot, { pixelRatio: 2 });
    map.addSource('default', {
        'type': 'geojson',
        'data': data
    });
    map.addLayer({
        'id': "default",
        'type': 'circle',
        'source': "default",
        'paint': {
            'circle-radius': 10,
            'circle-color': 'red'
        }
    });

    map.setLayoutProperty('country-label', 'text-field', [
        'get',
        'name_' + 'en'
    ]);
    const popup = new mapboxgl.Popup({
        closeButton: false
    });
    map.on('mousemove', function(e) {
        popup.remove();
        const result = map.queryRenderedFeatures(e.point, {
            layers: ['default']
        });
        if (result.length) {
            console.log(e);
            console.log(result)
            popup.remove();
            popup.setLngLat(e.lngLat)
                .setHTML(result[0].properties.description ? result[0].properties.description : '')
                .setMaxWidth("300px")
                .addTo(map);
            map.getCanvas().style.cursor = 'pointer';

        } else {
            map.getCanvas().style.cursor = '';
        }
    })

    map.on('click', function(e) {
        document.querySelector('#instructions').style.display = 'block';
        map.getCanvas().style.cursor = 'grabbing';
        // coding
        var coordsObj = e.lngLat;
        var coords = Object.keys(coordsObj).map(function(key) {
            return coordsObj[key];
        });
        console.log(coords);
        console.log(coordsObj);
        var start = {
            type: 'FeatureCollection',
            features: [{
                type: 'Feature',
                properties: {},
                geometry: {
                    type: 'Point',
                    coordinates: coords
                }
            }]
        };
        if (map.getLayer('start')) {
            map.getSource('start').setData(start);
        } else {
            map.addLayer({
                id: 'start',
                type: 'circle',
                source: {
                    type: 'geojson',
                    data: {
                        type: 'FeatureCollection',
                        features: [{
                            type: 'Feature',
                            properties: {},
                            geometry: {
                                type: 'Point',
                                coordinates: coords
                            }
                        }]
                    }
                },
                paint: {
                    'circle-radius': 10,
                    'circle-color': '#f30'
                }
            });
        }
        getRoute(coords);
    })


    // auto complate
    map.addSource('single-point', {
        'type': 'geojson',
        'data': {
            'type': 'FeatureCollection',
            'features': []
        }
    });

    map.addLayer({
        'id': 'timKiem',
        'source': 'single-point',
        'type': 'circle',
        'paint': {
            'circle-radius': 10,
            'circle-color': 'yellow'
        }
    });

    // Listen for the `result` event from the Geocoder // `result` event is triggered when a user makes a selection
    //  Add a marker at the result's coordinates
    geocoder.on('result', function(e) {
        document.querySelector('#instructions').style.display = 'block';
        map.getSource('single-point').setData(e.result.geometry);
        //console.log(e);
        //console.log(e.result.geometry.coordinates);
        getRoute(e.result.geometry.coordinates);
    });
});

function M3D() {
    if (document.getElementById('M3D').innerHTML == '3D') {
        map.setPitch(40); // nghiêng 
        map.setBearing(0); //trục xoay
        document.getElementById('M3D').innerHTML = '2D'
        document.getElementById('M3D').style.backgroundColor = 'yellow';
    } else {
        map.setPitch(0);
        map.setBearing(0);
        document.getElementById('M3D').innerHTML = '3D';
        document.getElementById('M3D').style.backgroundColor = 'violet';
    }
}

function flyToLocation(id) {
    for (var i = 0; i < this.arrs.length; i++) {
        if (arrs[i].id == id) {
            map.flyTo({
                center: [arrs[i].lon, arrs[i].lat],
                essential: true
            });
            break;
        }
    }
}

function changesLaguage() {
    var value = document.getElementById("changeLaguage").value;
    map.setLayoutProperty('country-label', 'text-field', [
        'get',
        'name_' + value
    ]);
}

// thay đổi style map
radioG = document.getElementsByName("styleMap");
for (var i = 0; i < radioG.length; i++) {
    radioG[i].onclick = function() {
        var id_Style = $(this).attr("id");
        console.log(id_Style);
        if ($(this).val() == 'Default') {
            map.setStyle('mapbox://styles/betapchoi10k/ckdle9q2b21bh1iny043vsp9q');
            //load 1 lần 
            map.once('render', () => {
                console.log("render")
                map.addSource('default', {
                    'type': 'geojson',
                    'data': data
                });
                map.addLayer({
                    'id': 'default',
                    'type': 'circle',
                    'source': 'default',
                    'paint': {
                        'circle-radius': 10,
                        'circle-color': 'red'
                    }
                });
            })
        } else {
            map.setStyle('mapbox://styles/mapbox/' + id_Style);
            //load 1 lần 
            map.once('render', () => {
                console.log("render")
                map.addSource('default', {
                    'type': 'geojson',
                    'data': data
                });
                map.addLayer({
                    'id': 'default',
                    'type': 'circle',
                    'source': 'default',
                    'paint': {
                        'circle-radius': 10,
                        'circle-color': 'red'
                    }
                });
            })
        };
    }
}
var ctrl = new MapboxDirections({
    accessToken: mapboxgl.accessToken
});

function closemap() {
    console.log('da vao 1');
    document.getElementById('map-infor').style.transform = "translateX(100%)";
}

function driving() {
    if (isDrive == false) {
        map.addControl(
            ctrl, 'top-left');
        isDrive = true;
    } else {
        map.removeControl(ctrl);
        isDrive = false;
    }
}
// hàm sử lý ngoài lề
function getRandomColor() {
    var letters = '0123456789ABCDEF';
    var color = '#';
    for (var i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}

// search location in mapbox
var geocoder = new MapboxGeocoder({
    // Initialize the geocoder
    accessToken: mapboxgl.accessToken, // Set the access token
    mapboxgl: mapboxgl, // Set the mapbox-gl instance
    marker: true, // Do not use the default marker style
    placeholder: 'Nhập vị trí bắt đầu của bạn tại Hà Nội', // Placeholder text for the search bar
    //bbox: [105.040945, 20.626792, 106.348476, 21.709620],
    proximity: {
        longitude: 105.803931,
        latitude: 21.028659
    } // Coordinates of university
});
map.addControl(geocoder);
// full screen
map.addControl(new mapboxgl.FullscreenControl());
//xoay bản đồ
map.addControl(new mapboxgl.NavigationControl());
// current location
map.addControl(
    new mapboxgl.GeolocateControl({
        positionOptions: {
            enableHighAccuracy: true
        },
        trackUserLocation: true
    })
);


//*********                 Advanced          *************
$(function() {
    $('.noidung').css("display", "none"); // ẩn các nội dung lên
    $('.noidung').slideUp(); // ẩn các nội dung lên
    $('.motkhoi h5').click(function(event) {
        /* Act on the event */
        $('.noidung').slideUp(); // đống tất các thẻ nội dung lại nhằm mục đích chỉ mở nội dung được click 
        $('.motkhoi h5').removeClass('backgroundyellow')
        $(this).next('.noidung').slideToggle();
        $(this).toggleClass('backgroundyellow');
    });


    $('#openMap').click(function(event) {
        /* Act on the event */
        $('#map-infor').css("transform", "translateX(-40px)");
    });

});