<!-- Material Dashboard by) Creative Tim -->
<?php
if(isset($_GET['id']) && !empty($_GET['id'])){
  $id = intval($_GET['id']);
  $user = $db->db_get_row('SELECT `surname`, `name` FROM `users` WHERE id='.$id);
  // if($product):
  //       $sql = 'select SUM(amount*price) as pricet, amount from `spcart` where `user_id`='.$item['user_id'].' and store_id='.$_SESSION['store'];
  //       if($_SESSION['permission']==5)$sql = 'select SUM(amount*price) as pricet, amount from `spcart` where `user_id`='.$item['user_id'];
  //       $total = $db->db_get_row($sql);
  //       $price = $total['pricet'];
  //       $amount = $total['amount'];
  //       $store = $db->db_get_row('select id from stores where user_id='.$_SESSION['id']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Xem chi tiết đơn hàng - Control Panel
  </title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="icon" type="image/png" href="<?=$favicon?>">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="/@admin/assets/css/material-dashboard.css?v=2.1.2" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="/@admin/assets/demo/demo.css" rel="stylesheet" />
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
                  <h4 class="card-title">Đơn hàng của: <?=$user['surname'].' '.$user['name']?> <!-- <button class="btn btn-sm btn-info" doneall="true">Hoàn Thành</button> --></h4>

                </div>
                <div class="card-body">
                  <div class="row">
                    <?php
                    $col = 12;
                      if($_SESSION['permission']==5){
                    ?>
                    <div class="col-6">
                      <select name="by_shop" id="by_shop" class="form-control" onclick="viewDetail()">
                        <option value="0" selected>Đơn hàng của mình</option>
                        <option value="1">Các đơn hàng khác</option>
                      </select>
                    </div>
                    <?php
                    $col=6;
                      }
                    ?>
                    <div class="col-<?=$col?>">
                      <select name="status_cart" id="status_cart" class="form-control" onclick="viewDetail()">
                        <option value="0">Trạng thái: tất cả</option>
                        <option value="1">Chưa xác nhận</option>
                        <option value="2">Đang giao</option>
                        <option value="3">Hàng lỗi/ yêu cầu đổi trả</option>
                      </select>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive">
                        <table class="table table-hover">
                          <thead>
                            <th>Hình ảnh</th>
                            <th>Tên sản phẩm</th>
                            <th>Giá x Số lượng</th>
                            <th>Trạng thái</th>
                            <th></th>
                          </thead>
                          <tbody id="data_loading"></tbody>
                        </table>
                      </div>
                    </div>
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
  <div class="modal fade" id="modalReason" style="z-index: 1051;">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Lý do</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label>Nội dung:</label>
              <input type="text" class="form-control" id="reason" maxlength="100">
              <small class="text-secondary">Nội dung không quá 100 ký tự!</small>
            </div>
          <button type="button" id="aceptnextstep" class="btn btn-sm btn-gray">Xác Nhận</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="viewdetailorder">
    <div class="modal-dialog modal-lg modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Thông tin đơn hàng: <strong id="nameproduct"></strong></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body" id="viewOrderDetail">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="modalImgs">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Thông tin thêm</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="loadingimages">
          
          </form>
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
  <script type="text/javascript" src="/@admin/assets/js/plugins/nicEdit.js"></script>
  <script>
            
    $(document).ready(function(){
      // Bước kế của đơn hàng
      // $('button#nextstep').on('click', function(e){
      //   e.preventDefault()
      //   var type = 'danger', id = $(this).attr('cart-id'), status = $("#status[cart-id='"+id+"']").val();
      //   if(status==0||status==8){
      //     $('#modalReason').modal('show');
      //     $('button#aceptnextstep').attr('cart-id', id)
      //     return false;
      //   }
      //   $.post('/admin/order/list/update', {id:id, status:status},function(o){
      //     if(o.sts==1){type = 'success'}
      //       md.showNotification(type,o.msg);
      //   }, 'json')
      // })
      $('button#aceptnextstep').on('click', function(e){
        e.preventDefault()
        var type = 'danger', id = $(this).attr('cart-id') , status = $("#status[cart-id='"+id+"']").val(), reason = $('input#reason').val();
        if(reason==""){
          console.log(reason)
            md.showNotification('danger','Lý do của bạn là gì?');
            return false;
        }
        $.post('/admin/order/list/update', {id:$(this).attr('cart-id'), status:status, reason:reason},function(o){
          if(o.sts==1){type = 'success';viewDetail()}
            md.showNotification(type,o.msg);
        }, 'json')
      })
      // Xem lí do hủy, đổi trả
      // $('strong#view-reason').on('click', function(){
      //   var spcartid = $(this).attr('spcart-id')
      //   console.log(spcartid)
      //   $('#modalImgs').modal('show');
      //   $.post('/admin/order/viewimgs.html', {spcartid:spcartid}, function(o){
      //     $('#loadingimages').html(o)
      //   })
      // })
      // Xác nhận các đơn hàng chưa xác nhận
      // $("button[doneall='true']").on('click', function(e){
      //   e.preventDefault();
      //   if(confirm('Đơn hàng chưa xác nhận sẽ được chuyển vào trạng thái đã vận chuyển')){
      //     var uid = <?=(!empty($id))?$id:0?>;
      //     $.post('/admin/order/list/doneall', {uid:uid}, function(o){
      //       md.showNotification((o.sts==1)?'success':'warning',o.msg);
      //     }, 'json')
      //   }
      // })
    })

    function nextstep(id){
      const status = $('select#status[cart-id="'+id+'"]').val()
      var type = 'danger'
      if(status==null)return;
      if(status==0||status==8){
        //$(".modal#viewdetailorder").css({'filter': 'blur(1px)'})
        $('#modalReason').modal('show');
        $('button#aceptnextstep').attr('cart-id', id)
        return false;
      }
      $.post('/admin/order/list/update', {id:id, status:status},function(o){
        if(o.sts==1){type = 'success';viewDetail()}
          md.showNotification(type,o.msg);
      }, 'json')
    }

    function expfile(id){
      $.ajax({
            url: '/admin/order/list/file',
            data: {cartid:id},
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
                md.showNotification((json.sts==1)?'success':'danger', json.msg)
                if(json.sts==1){
                  window.open('/assets/file/'+json.name+'.docx','_blank');
                  $.post('/admin/order/download/'+json.name+'.html')
                }
            }
        })
    }

    viewDetail();
    function viewDetail(){
      const uid = Number(<?=$id?>), sel = $("select#by_shop").val(), status = $("select#status_cart").val()
      $.post('/admin/order/load_view_detail.html',{uid:uid, status:status, sel:sel}, (res)=>{
        $("#data_loading").html(res)
      })
    }

    function view(id){
      $.post('/admin/order/viewDetailOrder.html',{id:id}, (res)=>{
        $("#viewdetailorder").modal("show")
        $("#viewOrderDetail").html(res)
      })
    }
  </script>
</body>

</html>
<?php
}
?>