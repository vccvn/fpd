$(function () {
    $('.mfp-close').click(function () {
        $('.mfp-bg').hide();
        $('.mfp-wrap').hide();
    });
    $('.nav-item-search .nav-link').click(function () {
        $('#header').addClass('navbar-search');
    });
    $('.cancel-search').click(function () {
        $('#header').removeClass('navbar-search');
    });
    $('.filter-button').click(function () {
        $('body').addClass('filter-cateogry');
    });
    $('#list-category').after().click(function () {
        $('body').removeClass('filter-cateogry');
    });

    $(document).on("click", function (e) {
        console.log(e.target);
        if ($(e.target).closest('div[id="listMobile"]').length == 0) {
            $('.mfp-bg').hide();
            $('.mfp-wrap').hide();
        }
    });
});
function loadMobile(elm, id) {
    var textMobile = elm.innerText;
    // $.post('/Ajax/Menus/AjaxLoadMobile', { cateId: id }, function (data) {
    //     $('.title-pop-inop').html(textMobile);
    //     $('#listMobile').html(data);
    //     $('.mfp-bg').show();
    //     $('.mfp-wrap').slideDown(200);
    // });
    $.get('ajax/cate.html', { cateId: id }, function (data) {
        $('.title-pop-inop').html(textMobile);
        $('#listMobile').html(data);
        $('.mfp-bg').show();
        $('.mfp-wrap').slideDown(200);
    });
}
function loadDesign(elm, id) {
    // $.post('/Ajax/Products/AjaxDesign', { cateId: id }, function (data) {
    //     //$('#design-fancy').html(data);
    //     $('#fancy-content').html(data);
    //     //$('html').css('overflow-y', 'hidden');
    //     document.getElementById("popup-form-design").style.display = "block";
    // });
    // $.get('ajax/design/iphone-11-pro-max.html', { cateId: id }, function (data) {
    //     //$('#design-fancy').html(data);
    //     $('#fancy-content').html(data);
    //     //$('html').css('overflow-y', 'hidden');
    //     document.getElementById("popup-form-design").style.display = "block";
    // });
    $.get('ajax/design.html', { cateId: id }, function (data) {
        //$('#design-fancy').html(data);
        $('#fancy-content').html(data);
        //$('html').css('overflow-y', 'hidden');
        document.getElementById("popup-form-design").style.display = "block";
    });
}
function closeForm() {
    //$('html').css('overflow-y', 'scroll');
    var UploadCode = $("#UploadCode").val();
    eraseCookie(UploadCode);
    document.getElementById("popup-form-design").style.display = "none";
    $('#fancy-content').html('');
    $('.fpd-draggable-dialog').remove();
    $('.fpd-element-toolbar-smart').remove();
}
function remove(elm, code) {
    $(elm).parent().parent().remove();
    $.post('/Ajax/Products/AjaxChange', { code: code, isDelete: true }, function (data) {
        if (data !== 0) {
            if (data.discount > 0)
                $('#lb-discount').show();
            else
                $('#lb-discount').hide();
            if (data.totalprice > 0) {
                $('#totalprice').html(data.strtotalprice);
                $('#payment').html(data.strpayment);
            } else {
                $('.tr-none').hide();
                $('#cart-none').show();
            }

        }
    });

    loadcount();
}

function changeMetial(elm, id, code) {
    $.post('/Ajax/Products/AjaxChange', { code: code, idm: id }, function (data) {
        if (data !== 0) {
            if (data.discount > 0)
                $('#lb-discount').show();
            else
                $('#lb-discount').hide();
            $('#totalprice').html(data.strtotalprice);
            $('#payment').html(data.strpayment);
        }
    });
}
function next(code) {
    var ip = '#quantity_' + code;
    var count = $(ip).val() !== '' ? parseInt($(ip).val()) : 1;
    $(ip).val(count + 1);
    $.post('/Ajax/Products/AjaxChange', { code: code, num: count + 1 }, function (data) {
        if (data !== 0) {
            if (data.discount > 0)
                $('#lb-discount').show();
            else
                $('#lb-discount').hide();
            $('#totalprice').html(data.strtotalprice);
            $('#payment').html(data.strpayment);
        }
    });

    loadcount();
}
function back(code) {
    var ip = '#quantity_' + code;
    var count = $(ip).val() !== '' ? parseInt($(ip).val()) : 1;
    if (count > 1) {
        $(ip).val(count - 1);
        $.post('/Ajax/Products/AjaxChange', { code: code, num: count - 1 }, function (data) {
            if (data !== 0) {
                if (data.discount > 0)
                    $('#lb-discount').show();
                else
                    $('#lb-discount').hide();
                $('#totalprice').html(data.strtotalprice);
                $('#payment').html(data.strpayment);
            }

        });
    }

    loadcount();
}
function keyupip(code) {
    var ip = '#quantity_' + code;
    var count = $(ip).val() !== '' ? parseInt($(ip).val()) : 1;
    $.post('/Ajax/Products/AjaxChange', { code: code, num: count }, function (data) {
        if (data !== 0) {
            if (data.discount > 0)
                $('#lb-discount').show();
            else
                $('#lb-discount').hide();
            $('#totalprice').html(data.strtotalprice);
            $('#payment').html(data.strpayment);
        }

    });
}

function changePayment(price, payment) {
    var ship = parseFloat($('#ShipPrice').val());
    if (payment === 1) {
        price = price - (price * 5 / 100) + ship;
        $('#payment').html(formatNumber(price, '.', ',').replace(',', '.') + " đ");
    } else {
        $('#payment').html(formatNumber(price + ship, '.', ',').replace(',', '.') + " đ");
    }
}
function formatNumber(nStr, decSeperate, groupSeperate) {
    nStr += '';
    x = nStr.split(decSeperate);
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + groupSeperate + '$2');
    }
    return x1 + x2;
}

function fnOpen(elm, id) {
    if ($(elm).hasClass('active')) {
        $(elm).removeClass('active');
        $('.cate-child-' + id).hide();
    } else {
        $('.active').removeClass('active')
        $('.m-active').hide();
        $(elm).addClass('active');
        $('.cate-child-' + id).show();
    }
}

function search(elm) {
    var val = $(elm).val();
    if (val.length >= 2) {
        $('#live-search').show();
        $.post('/Ajax/Menus/Search', { name: val, type: 0 }, function (data) {
            $('#search-result').html(data);
        });
    } else {
        $('#search-result').html('');
    }
}

function menusearch(elm) {
    var val = $(elm).val();
    if (val.length >= 2) {
        $('#menu-live-search').show();
        $.post('/Ajax/Menus/Search', { name: val }, function (data) {
            $('#menu-search-result').html(data);
        });
    } else {
        $('#menu-search-result').html('');
    }

}
function showsearch() {
    $('#menu-live-search').show();
}
function showMenusearch() {
    $('#menu-live-search').show();
}

function showBank(type) {
    if (type === 1) {
        $('#paymentbank').show();
        $('#paymentCod').hide();
    } else {
        $('#paymentCod').show();
        $('#paymentbank').hide();
    }
}
function showMetial(id, name) {
    $.post('/Ajax/Products/AjaxMetial', { id: id }, function (data) {
        //$('#listMobile').html(data);
        //$('html').css('overflow-y', 'hidden');
        //$('.mfp-bg').show();
        //$('.mfp-wrap').slideDown(200);

        $("#bodyCartDialog").html(data);
        $('#cartDialog').modal('show');
        $(".btVatlieu").attr("name-option", name);
    });
}

function selectOptionMetial(obj, id) {
    var name = $(obj).attr("name-option");
    $("input[name*='" + name + "']").each(function () {
        if (this.value == id) {
            $(this).prop("checked", true);
        }
    });

    changeMetial(null, id, name);

    $('#cartDialog').modal('hide');
}

function searchOrder(elm) {
    var val = $(elm).val();
    if (val.length >= 2) {
        $('#live-search-order').show();
        $.post('/Ajax/Menus/Search', { name: val, type: 1 }, function (data) {
            $('#search-result-order').html(data);
        });
    } else {
        $('#search-result').html('');
    }
}
function order(elm, pid) {
    var id = $('#ProductId').val();
    if (id !== '') {
        var formdata = new FormData();
        formdata.append('id', id);
        formdata.append('pid', pid);
        formdata.append('name', $('#ProductName').val());
        formdata.append('base64_image', $('#ProductImage').val());
        formdata.append('base64_image_full', $('#ProductDes').val());
        $.ajax({
            method: 'POST',
            processData: false,
            contentType: false,
            cache: false,
            data: formdata,
            enctype: 'multipart/form-data',
            url: '/Ajax/Products/Order',
            success: function (response) {
                window.location.href = '/gio-hang'
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(ajaxOptions);
                console.log(xhr.status);
                console.log(thrownError);
            }
        });
    } else {
        alert('Bạn chưa chọn dòng máy');
    }

}
function loadOrder(id, name) {
    $('#ProductId').val(id);
    $('#ProductName').val(name);
    $('#live-search-order').hide();
}
function showsearchOrder() {
    $('#live-search-order').show();
}

function setCookie(name, value, days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
}
function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}
function eraseCookie(name) {
    document.cookie = name + '=; Max-Age=-99999999;';
}

function loadcount() {

    setTimeout(function () {
        $.get('/home/CountNumberCart', function (data) {
            if (data != undefined && data != null) {
                {
                    $(".numbercart1").html(data);
                    $(".numbercart").html(data);
                };
            }
        });
    }, 500);

    
}