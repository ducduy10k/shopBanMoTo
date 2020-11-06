// document.getElementById("language-active").addEventListener("click", function(event) {
//     event.preventDefault()
// })

$(function() {
    console.log('ok')
    var scroll = $.cookie('scroll');
    var modal = $.cookie('modal');

    if (scroll) {
        $('html,body').animate({
            scrollTop: scroll
        }, 0.1);
        $.removeCookie('scroll');
    }

    if (modal) {
        $('#modalMessage').modal('show');
        $.removeCookie('modal');
    }
    // Danh mục sản phẩm 
    $('.category-product-item').click(function(e) {
        $.cookie('scroll', window.pageYOffset);
    });

    // Thương hiệu sản phẩm 
    $('.brand-product-item').click(function(e) {
        $.cookie('scroll', window.pageYOffset);
    })

    // check mã giảm giá
    $('#check-coupon').click(function(e) {
        $.cookie('scroll', window.pageYOffset);
    })

    $('.cart_quantity').click(function(e) {
        $.cookie('scroll', window.pageYOffset);
    })


    // shop info
    $('#shop_info').on('change', function() {
        var x = this.value;
        console.log(this.value);
        arrs.forEach(function(item) {
            if (item.id == x) {
                console.log(item)
                map.flyTo({
                    center: [item.lon, item.lat],
                    essential: true
                });
                locationActive = item;
            }
        });


    });

    // fix loi ajax call 419 (unknown status)
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $('.button-save').click(function(event) {
        $.cookie('scroll', window.pageYOffset);
    })

    $('#button-save-mess').click(function(event) {
        $.cookie('modal', '#modalMessage');
    })

    $('#language-active').click(function(event) {
        console.log("da vao");
        $('#optionLanguage').toggleClass('openOptionLanguage');
    });
    $('#open-modal-zalo').click(function(event) {
        newwindown = window.open('https://zalo.me/0382978706', '_blank');
    })

    $('#open-modal-messeger').click(function(event) {
        newwindown = window.open('https://www.facebook.com/messages/t/102527788259135', '_blank');
    })

    $('.cart_quantity_input').on('keypress', function(e) {
        var id = $(this).next().val();
        console.log(e);
        if (e.which === 13) {
            console.log('oik');
            $.ajax({
                url: urlH + '/update-cart',
                data: {
                    'val': $(this).val(),
                    'id': id
                },
                method: 'POST',
                success: function() {
                    $.cookie('scroll', window.pageYOffset);
                    $(location).attr('href', urlH + '/show-cart');
                    console.log($(location));
                },
                error: function() {
                    alert('error');
                }

            })
            console.log('oik');
        }
    });
    $('.cart_quantity_input').focusout(function() {
        var id = $(this).next().val();
        $.ajax({
            url: urlH + '/update-cart',
            data: {
                'val': $(this).val(),
                'id': id
            },
            method: 'POST',
            success: function() {
                $.cookie('scroll', window.pageYOffset);
                $(location).attr('href', urlH + '/show-cart');
            },
            error: function() {
                alert('error');
            }

        })
    })


})