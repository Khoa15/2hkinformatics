<!-- Material Dashboard by Creative Tim -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Danh Sách Mã Giảm Giá - Control Panel
  </title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="icon" type="image/png" href="<?=$favicon?>">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="/@admin/assets/css/material-dashboard.css?v=2.1.2" rel="stylesheet" />

</head>

<body class="">
  <div class="wrapper ">
    <?php require_once('@admin/templates/sidebar.php') ?>
    <div class="main-panel">
      <!-- Navbar -->
      <?php require_once('@admin/templates/navbar.php') ?>
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">
                    Tất cả mã giảm giá:
                    <button class="btn btn-info btn-fab btn-fab-mini btn-round" title="Thêm" id="btn_add_coupon">
                    <i class="material-icons">add</i>
                    </button>
                    <button class="btn btn-info btn-fab btn-fab-mini btn-round" title="Cập nhật" id="btn_update_lcoupon">
                    <i class="material-icons">repeat</i>
                    </button>
                  </h4>
                  <p class="card-category"></p>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-primary">
                        <tr>
                          <th>#ID</th>
                          <th>Mã</th>
                          <th>Giảm%</th>
                          <th>Số lượng</th>
                          <th>Trạng Thái</th>
                          <th>Hạn</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody id="dtloadingcoupon">
                          <tr>
                            <td colspan="7">Loading...</td>
                          </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <footer class="footer">
        <div class="container-fluid">
          <nav class="float-left">
            <ul>
              <li>
                <a href="https://www.creative-tim.com">
                  Creative Tim
                </a>
              </li>
              <li>
                <a href="https://creative-tim.com/presentation">
                  About Us
                </a>
              </li>
              <li>
                <a href="http://blog.creative-tim.com">
                  Blog
                </a>
              </li>
              <li>
                <a href="https://www.creative-tim.com/license">
                  Licenses
                </a>
              </li>
            </ul>
          </nav>
          <div class="copyright float-right">
            &copy;
            <script>
              document.write(new Date().getFullYear())
            </script>, made with <i class="material-icons">favorite</i> by
            <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a> for a better web.
          </div>
        </div>
      </footer>
    </div>
  </div>
  <div class="modal fade" id="newprictures">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Thêm Hình Ảnh</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body newpic">
        Loading..
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
    <div class="modal fade" id="mdfrmcouponadd" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm Mã Giảm Giá</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frmdtaddcategory" autocomplete="off">
                        <div class="input-group">
                          <input type="number"  oninput="helptext()" class="form-control" name="value" min="0" max="100" placeholder="% giảm giá">
                          <div class="input-group-prepend">
                            <span class="input-group-text">
                                %
                            </span>
                          </div>
                        </div>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Mã giảm giá" maxlength="20" name="code" value="<?=strtoupper($secret->RandomString(5))?>">
                            <div class="input-group-prepend">
                              <p class="text-muted"><span id="lengthnow">5</span>/20<button class="btn btn-sm btn-info btn-fab btn-fab-mini btn-round" id="randomcoupon"><i class="material-icons">shuffle</i></button></p>
                            </div>
                        </div>
                        <div class="form-row">
                          <label class="col-12">Áp dụng cho:</label>
                          <label><input type="checkbox" name="allc" id="allc">Tất cả</label>
                          <div class="container">
                            <div id="typec" class="row">
                              <label class="col-lg-3 col-md-6 m-0 p-0 col-sm-12"><input type="checkbox" name="ccategory" id="category">Danh mục</label>
                              <label class="col-lg-3 col-md-6 m-0 p-0 col-sm-12"><input type="checkbox" name="cproduct" id="product">Sản phẩm</label>
                              <label class="col-lg-3 col-md-6 m-0 p-0 col-sm-12"><input type="checkbox" name="cfee" id="fee">Phí vận chuyển</label>
                            </div>
                          </div>
                            
                        </div>
                        <div class="form-group hide" id="category">
                          
                        </div>
                        <div class="form-group hide" id="product"></div>
                        <div class="form-group">
                          <label>Số lượng:</label><label><input type="checkbox" name="infinite">Không giới hạn</label>
                          <input type="number" class="form-control" name="amount" value="100">
                        </div>
                        <div class="form-group">
                          <label>Lượt dùng:</label>
                          <input type="number" class="form-control" min="1" value="1" name="damount" placeholder="">
                        </div>
                        <div class="form-group">
                          <label>Hạn:</label>
                          <input type="date" class="form-control" name="died_at" min="<?=date('Y-m-d')?>">
                        </div>
                            <label>
                                <input type="checkbox" name="actived" value="1">
                                Hoạt động
                            </label>
                        <div class="form-group">
                          <input type="reset" class="btn btn-warning">
                            <input type="submit" name="btnsb_add" value="Lưu" id="btnsb_add" class="btn btn-primary">
                        </div>
                </form>
            </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="viewcoupon" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Xem mã giảm giá</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="loadmat">
                Loading...
            </div>
            </div>
        </div>
    </div>
  <!--   Core JS Files   -->
  <script src="/@admin/assets/js/core/jquery.min.js"></script>
  <script src="/@admin/assets/js/core/popper.min.js"></script>
  <script src="/@admin/assets/js/core/bootstrap-material-design.min.js"></script>
  <script src="/@admin/assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!-- Plugin for the momentJs  -->
  <script src="/@admin/assets/js/plugins/moment.min.js"></script>
  <!--  Plugin for Sweet Alert -->
  <script src="/@admin/assets/js/plugins/sweetalert2.js"></script>
  <!-- Forms Validations Plugin -->
  <script src="/@admin/assets/js/plugins/jquery.validate.min.js"></script>
  <!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
  <script src="/@admin/assets/js/plugins/jquery.bootstrap-wizard.js"></script>
  <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
  <script src="/@admin/assets/js/plugins/bootstrap-selectpicker.js"></script>
  <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
  <script src="/@admin/assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
  <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
  <script src="/@admin/assets/js/plugins/jquery.dataTables.min.js"></script>
  <!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
  <script src="/@admin/assets/js/plugins/bootstrap-tagsinput.js"></script>
  <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
  <script src="/@admin/assets/js/plugins/jasny-bootstrap.min.js"></script>
  <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
  <script src="/@admin/assets/js/plugins/fullcalendar.min.js"></script>
  <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
  <script src="/@admin/assets/js/plugins/jquery-jvectormap.js"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="/@admin/assets/js/plugins/nouislider.min.js"></script>
  <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
  <!--  Notifications Plugin    -->
  <script src="/@admin/assets/js/plugins/bootstrap-notify.js"></script>
  <script src="/@admin/assets/js/material-dashboard.js"></script>
  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.6/clipboard.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
  <script>
    const faout = function(){ $('button').fadeOut(0) };
    const fain = function() { $('button').fadeIn() } ;
    var clipboard = new ClipboardJS('#copy');

    clipboard.on('success', function (e) {});
    onloading();
    function onloading(){
        $('#dtloadingcoupon').load('/admin/coupon/view.html');
    }
    function shownoti(){
      md.showNotification('success', 'Đã sao chép')
    }
    $('input[name="damount"]').on('input', function(){
      var disamount = $(this).val();
      console.log(disamount)
      if(disamount<1 && disamount!=""){
        $(this).val(1)
      }
    })
    function helptext(){
      var buy = $('input#buy').val(), saledown = $('input[name="value"]').val()
        if(Number(saledown)<0){
          saledown = 0;
          $('#valsaledown').val('0')
        }
        if(Number(buy)<0){
          buy = 0;
          $('input#buy').val('0')
        }
        buy = (buy=="")?0:buy;
        saledown = (saledown=="")?0:saledown
      $('small.text-help').text('Tổng đơn hàng từ '+buy+'đ giảm '+saledown+'%');
    }
    function codecheck(){
        var valcode = $('input[name="code"]').val();
        $('#lengthnow').text(valcode.length)
    }
    $(document).ready(function(){
      /*$('button').on('click', function(){
        $(this).fadeOut(0);
        $(this).fadeIn();
      })*/
      $('#btn_add_coupon').on('click', function(){
        $('#mdfrmcouponadd').modal('show')
      })
      $('#btn_update_lcoupon').on('click', function(){
        onloading();
      })
      $('input[name="code"]').on('input', function(){
        codecheck();
      })
      $('#randomcoupon').on('click', function(e){
        e.preventDefault();
        $.post('/admin/coupon/randomCoupon.html', function(o){
          $('input[name="code"]').val(o)
          codecheck();
        })
      })
      $('#btnsb_add').on('click', function(e){
        e.preventDefault();
        $('#btnsb_add').val('Loading...').attr('disabled', true)
        var form = $('form').serialize();
        $.post('/admin/coupon/list/add', form, function(o){
          var type = 'danger';
          if(o.sts==1){
              type = 'success';
              onloading();
            }
            md.showNotification(type, o.msg);
        $('#btnsb_add').val('Lưu').attr('disabled', false)
        }, 'json');
        
      })
    })


  $('#category').on('click', function(e){
    $('.form-group#category').toggle().attr('show', true).load('lcate.html');
  })
  $('#product').on('click', function(e){
    $('.form-group#product').toggle().attr('show', true).load('lpros.html');
  })
  $('input[name="infinite"]').on('click', function(e){
    $('input[name="amount"]').toggle()
  })
  $('#allc').on('click', function(e){
    $('#typec').toggle()
    var spcart = $('.form-group#spcart'), inpspcart = $('input#spcart');
    if(!inpspcart.is(':checked')){
      spcart.toggle()
    }
  })

  function view(id){
    $('#viewcoupon').modal('show');
    $.post('/admin/coupon/viewCoupon.html', {id:id},function(o){
      $('#loadmat').html(o)
    })
  }
  </script>
</body>

</html>