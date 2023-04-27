
<?php
$store = $db->db_get_row('select id from stores where user_id='.$_SESSION['id']);
?>
<!-- Material Dashboard by Creative Tim -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Danh Sách Hàng Hóa - Control Panel
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
                  <h4 class="card-title ">
                    Danh sách hàng hóa
                    <a class="btn btn-info btn-fab btn-fab-mini btn-round" href="/admin/product/add.html" title="Thêm" id="btn_add_product">
                    <i class="material-icons">add</i>
                    </a>
                    <button class="btn btn-info btn-fab btn-fab-mini btn-round" title="Cập nhật" id="btn_update_lproduct">
                    <i class="material-icons">repeat</i>
                    </button>
                    
                    <button class="btn btn-info btn-fab btn-fab-mini btn-round" id="newImage" data-toggle="modal" data-target="#newprictures"><i class="material-icons">add_photo_alternate</i></button>
                  </h4>
                  <p class="card-category"></p>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-primary">
                        <tr>
                          <th>#ID</th>
                          <th>Tên</th>
                          <?php if($_SESSION['permission']==5): ?>
                          <th>Cửa Hàng</th>
                          <?php endif; ?>
                          <th>Số lượng</th>
                          <th>Giá</th>
                          <th>Giảm</th>
                          <th></th>
                        </tr>
                        <tr>
                          <td colspan="<?=($_SESSION['permission']==5)?7:6?>">
                            <input type="text" placeholder="Nhập tên sản phẩm hoặc tên cửa hàng..." id="searchkey" class="form-control">
                          </td>
                        </tr>
                      </thead>
                      <tbody id="dtloadingproduct">
                        <tr>
                          <td colspan="5">Loading...</td>
                        </tr>
                      </tbody>
                      <tfoot>
                        <tr>
                          <td colspan="<?=($_SESSION['permission']==5)?7:6?>">
                            <nav id="paginationimage">
                              <ul class="pagination justify-content-center">
                                <?php
                                  $sql = 'select `id`, `name`, `amount`, `price`, `actived` from `products` ';
                                  if($_SESSION['permission']!=5){
                                    $sql .= ' where `store_id`='.$store['id'];
                                  }
                                  $sql .= ' order by `id` desc';
                                  $num = $db->num_rows($sql);
                                  $cbtn = ceil($num/15);
                                  $html = '';
                                  $active = ' active';
                                  for ($i=1; $i <= $cbtn; $i++) { 
                                    $html .= '<li class="page-item'.$active.'"><button class="page-link">'.$i.'</button></li>';;
                                    $active = false;
                                  }
                                  echo $html;
                                ?>
                                <!-- <li class="page-item active"><button class="page-link">1</button></li>
                                <li class="page-item"><button class="page-link">2</button></li>
                                <li class="page-item"><button class="page-link">3</button></li> -->
                              </ul>
                            </nav>
                          </td>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">
                    Top Sản Phẩm
                  </h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <th>Hạng</th>
                        <th>Tên</th>
                      </thead>
                      <tbody>
                        <?php
                          $sql='select view, created_at, updated_at, name from products';
                          if($_SESSION['permission']!=5){
                            $sql.=' where store_id='.$store['id'];
                          }
                          $sql .= '  order by (view/(updated_at-created_at)) desc limit 10';
                          $list = $db->db_get_list($sql);
                          $i=0;
                          foreach ($list as $item) {
                            $i++;
                        ?>
                          <tr>
                            <td><?=$i?></td>
                            <td><?=$item['name']?></td>
                          </tr>
                        <?php
                          }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">
                    Top Sale
                  </h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <th>Hạng</th>
                        <th>Tên</th>
                      </thead>
                      <tbody>
                        <?php
                          $sql='select name from products ';
                          $list = $db->db_get_list($sql);
                          if($_SESSION['permission']!=5){
                            $sql.=' where store_id='.$store['id'];
                          }
                          $sql .= ' order by sale desc limit 10';
                          $list = $db->db_get_list($sql);
                          
                          $i=0;
                          foreach ($list as $item) {
                            $i++;
                        ?>
                          <tr>
                            <td><?=$i?></td>
                            <td><?=$item['name']?></td>
                          </tr>
                        <?php
                          }
                        ?>
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
  <div class="modal fade" id="viewproduct">
    <div class="modal-dialog modal-lg modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Xem Sản Phẩm: <strong id="nameproduct"></strong></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body" id="viewProductDetail">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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
  <script>

      var count = 0
    $('#paginationimage .pagination li').on('click', function(){
        dtloadingproduct();
        count = (Number($(this).text()) - 1) * 15
        $('.pagination li.active').removeClass('active')
        $(this).addClass('active');
      })
     var timeout = null;
    function dtloadingproduct(search=null){
      $('#dtloadingproduct').html('<tr align="center"><td colspan="6"><img src="/assets/imgs/overlay.gif" alt=""></td></tr>')
        var search = $('#searchkey').val();
      if(timeout){
        clearTimeout(timeout)
      }
      timeout = setTimeout(function(){
        $.post('/admin/product/view.html', {search:search,rowcount:count}, function(o){
          $('#dtloadingproduct').html(o)
        })
      }, 300)
    }
    $('input#searchkey').on('input', function(o){
        dtloadingproduct();
      })
    loaddingproduct()
    function loaddingproduct(){
      $.post('/admin/product/view.html', function(o){
            $("#dtloadingproduct").html(o)
        })
    }
      $(document).on('click', '#btn_update_lproduct', function(){
        loaddingproduct()
      });

      $("#newImage").click(function(){
        $(".modal-body.newpic").load('/admin/images/add.html');
      });
    function changests(id){
      var  sts = $('button[img-id="'+id+'"]').attr('sts-view'), type, btn = $('button[img-id="'+id+'"]');
      if(sts==1){
        sts = 0
        btn.removeClass('btn-info')
        btn.addClass('btn-warning')
        btn.find('i').text('visibility_off')
        btn.attr('sts-view',sts)
        btn.attr('sts-view', sts)
      }else{
        sts = 1
        btn.removeClass('btn-warning')
        btn.addClass('btn-info')
        btn.find('i').text('visibility')
        btn.attr('sts-view',sts)
        btn.attr('sts-view', sts)
      }
      $.post('/admin/product/list/cstatus', {id:id,sts:sts}, function(o){
        type = (o.sts==1)?'success':'danger'
        md.showNotification(type, o.msg);
        if(o.sts==0){
          if(sts==1){
            sts = 0
            btn.removeClass('btn-info')
            btn.addClass('btn-warning')
            btn.find('i').text('visibility_off')
            btn.attr('sts-view',sts)
            btn.attr('sts-view', sts)
          }else{
            sts = 1
            btn.removeClass('btn-warning')
            btn.addClass('btn-info')
            btn.find('i').text('visibility')
            btn.attr('sts-view',sts)
            btn.attr('sts-view', sts)
          }
        }
      }, 'json')
    }
  function delete_product(id){
    Swal.fire({
      title: 'Bạn chắc chắn muốn xóa?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.isConfirmed) {
        $.post('/admin/product/list/delete', {id:id}, function(o){
          if(o==1){
            Swal.fire('Deleted!', 'Your file has been deleted.','success')
            loaddingproduct();

          }else{
        Swal.fire('Error!', 'Your progress has been cancelled.','error')

          }
        });
      }
    })
  }
  function view(id){
    $('#viewproduct').modal('show');
    $('#viewProductDetail').html('<p class="text-center text-info">Loading...</p>')
    $.post('/admin/product/view-detail.html',{id:id}, function(o){
    //  $('#nameproduct').html(o.title);
      $('#viewProductDetail').html(o);
    })
  }
  </script>
</body>

</html>