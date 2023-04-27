const not_login = "Bạn chưa đăng nhập."
var timeout = null;
$(document).on('input', 'input#searchkey', function(o){
    if($(this).val()!=""){
        $('div.autocomplete').css('display', 'block')
    }else{
        $('div.autocomplete').css('display', 'none')
    }
    lookfor($(this).val());
})
function lookfor(key)
{    
    if (timeout) {  
        clearTimeout(timeout);
    }
    timeout = setTimeout(function() {
        if(key.length > 0)
        {
          $("#suggestions").fadeIn();
          $("#suggestions").addClass('loading')
          $("#suggestions .results").html('');
            $.ajax({
                url : '/action/product/search/',    
                type: 'POST',
                cache:false,
                data: {key: key},
                success: function(msg){
                    $('ul#autocomplete').html(msg)
                },
            });
        }
    }, 300);
}
$(document).on('click', 'ul#autocomplete li', function(){
    var key = $(this).text();
    if($(this).attr('category')){
        var category = $(this).attr('category');
        $.getJSON('/sites/products.php', {keySearch:category}, function(o){
        $('body *').removeClass('animate__zoomOut').removeClass('animate__shakeY')
            processAjaxData({'html':o.html,'pageTitle':o.title}, '/products.html')
        })
    }
})

$(document).on('click', 'button#changebg', function(){
    var rd = Math.floor(Math.random() * 5) + 1
    $('body').css("background-image", "url(/assets/imgs/bg"+rd+".jpg)")
})

$(document).on('submit', 'form#boxsearch', function(e){
    e.preventDefault();
    $('body *').addClass('animate__animated animate__shakeY')
    setTimeout(()=>{
        $('body *').addClass('animate__zoomOut')
    }, 800)
    setTimeout(()=>{
        $.getJSON('/sites/products.php', {keySearch:$('input[name="q"]').val()}, function(o){
        $('body *').removeClass('animate__zoomOut').removeClass('animate__shakeY')
            processAjaxData({'html':o.html,'pageTitle':o.title}, '/products.html')
        })
    }, 1000)
})

function processAjaxData(response, urlPath){
 document.getElementById('app').innerHTML = response.html;
 document.title = response.pageTitle;

 window.history.pushState({"html":response.html,"pageTitle":response.pageTitle},"", urlPath);
}
$(document).on("click", "#product[product-id]", function(e){
    e.preventDefault()
    var link = $(this).attr('href'), pid = link.replace('/product-detail.html?i=', '');
    $.getJSON('/sites/product-detail.php', {pid:pid},function(o){
        processAjaxData({'html':o.html,'pageTitle':o.title}, link)
    })
    setTimeout(()=>{
        $.post('/action/product/images/', {pid:pid}, function(o){
            $('#loading_images').html(o)
        })
    }, 300)
})
$(document).on("click", "[to][store-id]", function(e){
    e.preventDefault()
    var link = $(this).attr('to'), pid = $(this).attr('store-id');
    link = link+'?i='+pid;
    $.getJSON('/sites/shop.php', {id:pid},function(o){
        processAjaxData({'html':o.html,'pageTitle':o.title}, link)
    })
})
checkurl()
window.onpopstate = function(event) {
  checkurl();
};
function checkurl(){
    var pathArray = window.location.pathname.split('/');
    var locate = pathArray[1];
    if(locate=='products.html'){
        $.getJSON('/sites/products.php', function(o){
            document.title = o.title;
            $('#app').html(o.html)
        })
    } else if(locate=='product-detail.html'){
        var url = new URL(window.location.href);
        var pid = url.searchParams.get("i");
        $.getJSON('/sites/product-detail.php', {pid:pid}, function(o){
            document.title = o.title;
            $('#app').html(o.html)
        })
        setTimeout(()=>{
            $.post('/action/product/images/', {pid:pid}, function(o){
                $('#loading_images').html(o)
            })
        }, 300)
    } else if(locate=='shop.html'){
        var url = new URL(window.location.href);
        var pid = url.searchParams.get("i");
        $.getJSON('/sites/shop.php', {id:pid}, function(o){
            document.title = o.title;
            $('#app').html(o.html)
        })
    } else if(locate=='gio-hang.html'){
        $.getJSON('/sites/gio-hang.php', function(o){
            document.title = o.title;
            $('#app').html(o.html)
        })
    } else if(locate=='dang-xuat.html'){
        var btn = $.getJSON('/sites/dang-xuat.php')
        if(btn){
        setTimeout(()=>{
            window.location.href = '/'
        }, 100)
        }
    } else if(locate=='dang-nhap.html'){
        $.getJSON('/sites/dang-nhap.php', function(o){
            document.title = o.title;
            $('#app').html(o.html)
        })
    } else if(locate=='dang-ky.html'){
        $.getJSON('/sites/dang-ky.php', function(o){
            document.title = o.title;
            $('#app').html(o.html)
        })
        
    } else if(locate==""){
        $.getJSON('/sites/search.php', function(o){
            document.title = o.title;
            $('#app').html(o.html)
        })
    } else {
        var file = locate.replace('.html','').replace('/','');
        var path= '/sites/'+file+'.php';
            $.getJSON(path, function(o){
                document.title = o.title
                $('#app').html(o.html)
                
            })
    }
}
$(document).on('click', 'h1[to="fpage"]', function(){
    $.getJSON('/sites/search.php', function(o){
        processAjaxData({'html':o.html,'pageTitle':o.title}, '/')
    })
})
$(document).on('click', '[single-page="true"]', function(o){
    o.preventDefault()
    var path = '/sites/'+$(this).attr('to').replace('.html','').replace('/','')+'.php', lik = $(this).attr('to')
    $.getJSON(path, function(o){
        processAjaxData({'html':o.html,'pageTitle':o.title}, lik)
    })
})

$(document).on('submit', 'form#frm_login', function(e){
    e.preventDefault();
    var type;
    $.ajax({
        url: '/action/user/login/',
        data: $('form#frm_login').serialize(),
        dataType: 'json',
        cache: false,
        type: 'post',
        error: function(){
            swal('Có lỗi!', 'Đường truyền không ổn định', 'error')
        },
        beforeSend: function () {
            $('button[type="submit"]').css('disabled', true)
        },
        complete: function () {
            $('button[type="submit"]').css('disabled', false)
        },
        success: function (json) {
            if(json.sts==1){
                window.location = '/'
            }
            swal({
                text: json.msg,
                icon: (json.sts==1)?'success':'error',
            })
        }
    })
})
var ispsw = false;
$(document).on('input', "input[name='repsw']", function(){
    var psw = $("input[name='psw']").val(), repsw = $('input[name="repsw"]').val();
    if(psw != repsw){
        $("#error").fadeIn()
        $("#error").text('Mật khẩu không giống nhau!')
        return false
    }
    if(psw == repsw && psw != "")
        $("#error").fadeOut()
        $("#error").text(' ')
        ispsw = true
})
$(document).on('submit', 'form#frm_register', function(e){
    e.preventDefault();
    if(!ispsw){
        $("#error").fadeIn()
        $("#error").text('Kiểm tra lại mật khẩu')
        return false
    }
    var type;
    $.ajax({
        url: '/action/user/register/',
        data: $('form#frm_register').serialize(),
        dataType: 'json',
        cache: false,
        type: 'post',
        error: function(){
            swal('Có lỗi!', 'Đường truyền không ổn định', 'error')
        },
        beforeSend: function () {
            $('button[type="submit"]').css('disabled', true)
        },
        complete: function () {
            $('button[type="submit"]').css('disabled', false)
        },
        success: function (json) {
            type = (json.sts==1)?'success':'warning';
            swal({
                text: json.msg,
                icon: type,
            })
        }
    })
})

$(document).on('click', '.nav.user .nav-item a.nav-link', function(){
    var action = $(this).attr('aria-controls'), active = $(this).attr("aria-selected");
    if(active=="true") return;
    $('#v-pills-address').addClass('active show')
    $('#v-pills-account').removeClass('active show')
    $.post('/action/user/info/', {action:action}, function(o){
        $('#infoshow').html(o)
    })
})
$(document).on('click', '.nav#shop .nav-item a.nav-link', function(){
    var action = $(this).attr('aria-controls'), sid = $(this).attr('store-id');
    $('#v-pills-address').addClass('active show')
    $('#v-pills-account').removeClass('active show')
    $.post('/action/shop/info/', {sid:sid,action:action}, function(o){
        $('#view-products-shop').html(o)
    })
})

$(document).on('submit', '#frm_register_shop', function(e){
    e.preventDefault()
    var data = $('#frm_register_shop').serialize();
    $.post('/action/shop/register/', data, function(o){
        swal({
            text:o.msg,
            icon:(o.sts==1)?'success':'warning'
        }).then(()=>{
            if(o.sts==1){
                window.location.href = '/shop.html'
            }
        })
    }, 'json')
})

$(document).on('submit', '#frm_add_address', function(e){
    e.preventDefault()
    var address = $('#frm_add_address').serialize(), type = 'warning'
    $.post('/action/user/uaddress/', address, function(o){
        if(o.sts==1){
            
            $('a[aria-controls="address"]').click()
        }
        type = (o.sts==1)?"success":type
        swal({
            text:o.msg,
            icon:type,
            buttons: true,
        })
        if(o.sts==1)    $('.modal-backdrop').removeClass('modal-backdrop fade show')
    }, 'json')
})

$(document).on('click', '#del_address', function(e){
    e.preventDefault();
    var id = $(this).attr('aid'), type="warning"
    $.post('/action/user/dadd/', {id:id}, function(o){
        if(o.sts==1){
            $('a[aria-controls="address"]').click()
        }
        type = (o.sts==1)?"success":type
        swal({
            text:o.msg,
            icon:type
        })
    }, 'json')
})

$(document).on('input', '#address', function(){
    var address = $("#address").val(), city = $('#city').val()
    $("form #addresspre").text(address+((address!="")?', ':'')+city)
})
$(document).on('change', 'select[name="versions"]', function(){
    var selid = $(this).val();
    $.post('/action/product/versions/', {selid:selid}, function(o){
        if(o.sts==1){
            $('#sprice').html(o.price)
        }
    }, 'json')
})
$(document).on('click', '#btn_add_spcart', function(){
    var id = $(this).attr('product-id'),btn = $(this), bal=false,sqty = Number($('#sqty').val()), versions = $('select[name="versions"]'), typeid, keepgoing = true, arr=[];

    if(versions.length!=0){
        versions.each(function(){
            typeid = Number($(this).val());
            if(typeid==0){
                keepgoing = false;
            }else{
                arr.push(typeid)
            }
        })
    }
    if(!keepgoing){
        swal({text:'Hãy chọn loại sản phẩm',icon:'warning'})
    }
    if(keepgoing){
        sqty = (sqty == "")?1:sqty;
            btn.html('Loading...').attr('disabled', true)
        $.post('/action/product/add-cart/', {id:id, sqty:sqty, typeid: arr}, function(o){
            if(btn.attr('buy-now')){
                if(o.sts==1){
                    $('button[to="gio-hang.html"]').click()
                }else{
                    swal({
                        text: o.msg,
                        icon: (o.sts==1)?'success':'warning'
                    })
                }
            btn.html('Mua Hàng').attr('disabled', false)
            }else{
                btn.html('Thêm Vào Giỏ Hàng').attr('disabled', false)
                swal({
                    text: o.msg,
                    icon: (o.sts==1)?'success':'warning'
                })
            }
            
        }, 'json')
    }
})

$(document).on('input', 'input#spcart_amount', function(){
    var spqty = Number($(this).val()), maximun = Number($(this).attr('max')), id = $(this).attr('cart-id');
    if(spqty>=maximun){
        $(this).val(maximun)
        spqty = maximun
    }
    if(spqty<=1){
        $(this).val(1)
        spqty = 1
    }
    setTimeout(function(){
        updateVal(id, spqty)
    }, 1000)
})

function updateVal(id, amount){
    $('#mainTotalPrice').text('Tính toán...');
    $.post('/action/product/update/', {id:id, amount:amount},function(o){
        $('#totalprice[cart-id="'+id+'"] #ttpprice').attr("value", ((o.sts==1)?o.ntotal:false))
        $('#totalprice[cart-id="'+id+'"] #ttpprice').text((o.sts==1)?o.total:false)
        $('#mainTotalPrice').text((o.sts==1)?o.mainTotal:false)
        $('#mainTotalPrice').attr("value", ((o.sts==1)?o.priceTotal:false))
        if(o.discount!=undefined && o.discount!=""){
            $('#tcoupon[cart-id="'+id+'"]').text((o.sts==1)?o.discount+'%':false)
            $('span#ship[cart-id="'+id+'"]').text(o.ship)
        }
        if(o.sts==1){
            $('#accept_coupon_cart').click()
        }
        /*$('#totalpriceMain').html((o.sts==1)?o.mainTotal+'<sup>đ</sup>':false)
        $('#totalpriceMain').attr('price', o.priceTotal)
        $('#payTotal').html((o.sts==1)?o.mainTotal+'<sup>đ</sup>':false)*/
    }, 'json')
}
var checked = false;
$(document).on('click', '#choose_all', function(){
    var checked = this.checked;
    $('input[type="checkbox"]').each(function() {
      this.checked = checked;
    });
})

$(document).on('click', 'button#checkout', function(){
    var spcartid = [], address= $('select').val(), total = $("#mainTotalPrice").attr("value");
    $('input[type="checkbox"]#choose[cart-id]').each(function(){
        if($(this).prop('checked')){
            spcartid.push($(this).attr('cart-id'));
        }
    })
    $.post('/action/product/corder/', {spcart:spcartid, address:address}, function(o){
        swal({
            text:o.msg,
            icon:(o.sts==1)?'success':'error'
        })
        if(o.sts==1){
            $('input[type="checkbox"]#choose[cart-id]').each(function(){
                if($(this).prop('checked')){
                    var id = $(this).attr('cart-id');
                    total -= $('#totalprice[cart-id="'+id+'"] #ttpprice[value]').attr("value");
                    $($('.bg-light[cart-id="'+id+'"]')).remove()
                }
            })
            $("#mainTotalPrice").text(new Intl.NumberFormat("en-GB").format(total))
            $("#mainTotalPrice").attr("value", total)
        }
    }, 'json')
    
})

$(document).on('click', '#trashthis', function(){
    var cartid = $(this).attr('cart-id'), place = $('.bg-light[cart-id="'+cartid+'"]')
    place.animate({
        height: '0px',
        opacity: '0',
    })
    $.post('/action/product/trash-cart/', {id:cartid}, function(o){
        swal({
            text:o.msg,
            type:(o.sts==1)?'success':'error'
        })
        if(o.sts!=1){
            place.animate({
                height: '200px',
                opacity: '1'
            })
        }
        if(o.sts==1){
            place.remove()
        }
    },'json')
    updateVal(cartid, 0)
})

$(document).on('click', '#btn_love', function(o){
    var id = $(this).attr('product-id'), uid = $(this).attr('user-id'), btn = $(this);
    if(uid==0){
        swal({
            text:not_login,
            icon:'warning'
        })
        return;
    }
    $(this).toggleClass('text-dark').toggleClass('text-danger')
    $.post('/action/product/love/', {id:id}, function(o){
        if(o.sts==1){
            if(btn.attr('info')){
                $('.col-lg-3[product-id="'+id+'"]').animate({left: '-2000px'}).hide(140)
            }
        }else{
            btn.toggleClass('text-dark').toggleClass('text-danger')
        }

    },'json')
})

$(document).on('click', '#cancelcart[cart-id]', function(o){
    var id= $(this).attr('cart-id'), place = $('#cart[cart-id="'+id+'"]')
    place.animate({
        bottom: '-1000px',
    }).hide(150)
    $.post('/action/product/trash-cart/', {id:id}, function(o){
        if(o.sts!=1){
            swal({
                text:o.msg,
                icon:'error'
            })
        }
        if(o.sts!=1){
            place.animate({
                bottom: '0px',
            }).show(300)
        }
    },'json')
})
var cart_id = 0;
$(document).on('click', 'button#vote', function(){
    cart_id = $(this).attr('cart-id');
    $.post('/action/user/vote/', {id:cart_id}, function(o){
        if(o!=""){
            $('#mainvote').html(o)
        }
    })
})

$(document).on('click', '.ratings .star', function(){
      var star = '.star',
          selected = '.selected';
        $(selected).each(function(){
          $(this).removeClass('selected');
        });
        $(this).addClass('selected');
})

$(document).on('click', '#accept', function (e) {
    e.preventDefault()
    var content = $('textarea[name="contentv"]').val(), score = $('.ratings .star.selected').attr('score')
    $.post('/action/product/vote/', {content:content, score:score, id:cart_id}, function(o){
        if(o.sts==0){
            $(".form-group #success").fadeOut()
            $(".form-group #error").fadeIn()
            $(".form-group #error").text(o.msg)
        }else{  
            $(".form-group #error").fadeOut()
            $(".form-group #success").fadeIn()
            $(".form-group #success").text(o.msg)
            $('a[aria-controls="order"]').click()
        }
    }, 'json')
})

$(document).on('click', '#like_shop', function(){
    var id = $(this).attr('store-id'), uid = $(this).attr('user-id');
    if(uid==0){
        swal({
            text:not_login,
            icon:"warning"
        })
        //$('button#signin').click()
        return false;
    }
    checkLikeStore(id)
    $.post('/action/shop/love/', {id:id}, function(o){
        if(o.sts==0){
            checkLikeStore(id)
        }
        if(o.sts==1){
            $('.col-lg-3[store-id="'+id+'"]').hide(300)
        }
    }, 'json')
})

function checkLikeStore(id){
    if($('button#like_shop[store-id="'+id+'"]').text()=='Thích'){
        $('button#like_shop[store-id="'+id+'"]').text('Đã Thích')
    }else{
        $('button#like_shop[store-id="'+id+'"]').text('Thích')
    }
}
var count = 0;
$(document).on('click', '#paginationimage .pagination li', function(){
    dtloadingproductname();
    count = ((Number($(this).text()) - 1) * 24) 
    $('.pagination li.active').removeClass('active')
    $(this).addClass('active');
})

function dtloadingproductname(search=null){
  $('#loadingproducts').html('<div class="col-12 text-center"><img src="/assets/imgs/overlay.gif" style="width: 300px;margin:auto;height: 300px" alt=""></div>')
    var search = $('input[name="q"]').val();
  if(timeout){
    clearTimeout(timeout)
  }
  timeout = setTimeout(function(){
    $.post('/action/product/pagination/', {search:search,rowcount:count}, function(o){
      $('#loadingproducts').html(o)
    })
  }, 300)
}

$(document).on('submit', '#boxchanginfouser', function(e){
    e.preventDefault()
    var data = $(this).serialize()
    $.post('/action/user/update/', data, function(o){
        swal({
            text: o.msg,
            icon: (o.sts==1)?'success':'error'
        })
    }, 'json')
})

$(document).on('submit', '#boxchangepsw', (e)=>{
    e.preventDefault()
    var data = $('form#boxchangepsw').serialize();
        $('input[name="psw"]').css('box-shadow', 'none')
        $('input[name="repsw"]').css('box-shadow', 'none')
    if(!ispsw){
        $('input[name="psw"]').css('box-shadow', '0px 0px 5px 1px red')
        $('input[name="repsw"]').css('box-shadow', '0px 0px 5px 1px red')
        return false;
    }
    $.post('/action/user/changepsw/', data, function(o){
        swal({
            text: o.msg,
            icon: (o.sts==1)?'success':'error'
        })
    }, 'json')
})

$(document).on('click', 'button#setDefaultAddress', function(o){
    var aid = $(this).attr('address-id')
    if($(this).attr('disabled')){
        return false;
    }
    $.post('/action/user/setDefaultAddress/', {aid:aid}, function(o){
        swal({
            text: o.msg,
            icon: (o.sts==1)?'success':'error'
        })
        if(o.sts==1){
            $('#setDefaultAddress[disabled]').prop('disabled', false);
            $('[address-id="'+aid+'"]').prop('disabled', true)
        }
    }, 'json')
})
$(document).on('click', 'button[cart-id][data-target="#formcallback"]', function(){
    var cartid = $(this).attr('cart-id');
    $('input[type="submit"][cart-id][id="send"]').attr('cart-id', cartid)
})
$(document).on('submit', 'form#mainback', function(e){
    e.preventDefault()
    var file_data = $('#files').prop('files'), form_data = new FormData();
   var totalfiles = document.getElementById('files').files.length;
   for (var index = 0; index < totalfiles; index++) {
      form_data.append("files[]", document.getElementById('files').files[index]);
   }
    form_data.append('content', $('textarea#contentReason').val())
    form_data.append('id', $('input[type="submit"][cart-id][id="send"]').attr('cart-id'))
    $.ajax({
        method: 'post',
        url: '/action/product/reback/',
        data: form_data,
        contentType: false,
        processData: false,
        dataType:'json',
        success: function(o){
            swal({
                text:o.msg,
                icon:(o.sts==1)?'success':'warning'
            })
            $("#formcallback").modal('hide')
            $("form#mainback").trigger("reset")
        }
    })
})

$(document).on('click', '#versions input:checkbox', function(){
    var idsel = $(this).attr('id-select');
    var $box = $(this);
  if ($box.is(":checked")) {
    var group = "input:checkbox[id-select='" + idsel + "']";
    $(group).prop("checked", false);
        $box.prop("checked", true);
    } else {
        $box.prop("checked", false);

    }
})
$(document).on('click', '#oflex-box-shop', function(){
    $('#oflex-box-shop').toggleClass('bg-warning');
    $('.card#box-shop-info').toggleClass("actived")
})

$(document).on('click', '#accept_coupon', function(e){
    e.preventDefault();
    var cartid = $(this).attr('cart-id'), coupon = $('#coupon[cart-id="'+cartid+'"]').val(), cart = $(this).attr('cart');
    $.ajax({
        url: '/action/product/coupon/',
        data: {cartid:cartid,coupon:coupon},
        dataType: 'json',
        cache: false,
        type: 'post',
        error: function(){
            swal('Có lỗi!', 'Đường truyền không ổn định', 'error')
        },
        beforeSend: function () {
            $(this).css('disabled', true)
        },
        complete: function () {
            $(this).css('disabled', false)
        },
        success: function (json) {
            if(json.sts==1){
                updateVal(cartid, $('input[cart-id="'+cartid+'"]').val(), cart)
            }
            swal({
                text: json.msg,
                icon: (json.sts==1)?'success':'error',
            })
            $('#tcoupon[cart-id="'+cartid+'"]').text('')
        }
    })
})

$(document).on('change', 'select#filter', function(e){
    e.preventDefault();
    var name = $(this).val(), key = $('input#searchkey').val();
    var max_price = Number($('input#price-max').val()), min_price = Number($('input#price-min').val())
    if(min_price > max_price){
        swal({text:'Giá trị không hợp lệ',icon:'error'})
        return;
    }
    $.getJSON('/sites/products.php', {keySearch:key,filter:name,aprice:max_price,iprice:min_price}, function(o){
        processAjaxData({'html':o.html,'pageTitle':o.title}, '/products.html')
    })
})

$(document).on('click', 'input#acept', (e)=>{
    e.preventDefault();
    var max_price = Number($('input#price-max').val()), min_price = Number($('input#price-min').val())
    if(min_price > max_price){
        swal({text:'Giá trị không hợp lệ',icon:'error'})
        return;
    }
    var name = $('select#filter option:selected').val(), key = $('input#searchkey').val();
    $.getJSON('/sites/products.php', {keySearch:key,filter:name,aprice:max_price,iprice:min_price}, function(o){
        processAjaxData({'html':o.html,'pageTitle':o.title}, '/products.html')
    })
})

$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})
