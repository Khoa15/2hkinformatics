<?php
$sql_dimiss='select COUNT(`id`) as totalproduct from `spcart` where status=0';
$sql_not_accept = 'select `id` from `spcart` where status=2';
$sql_shipping = 'select `id` from `spcart` where status=4';
$sql_done = 'select id from `spcart` where (`status`=5 or status=10)';

if($_SESSION['permission']!=5){
  $condition = ' AND store_id='.$_SESSION['store'];
  $sql_dimiss .= $condition;
  $sql_not_accept .= $condition;
  $sql_shipping .= $condition;
  $sql_done .= $condition;
}
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

    Đơn Hàng - Control Panel

  </title>

  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />

  <!--     Fonts and icons     -->

  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <link rel="icon" type="image/png" href="<?=$favicon?>">

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
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-warning card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">remove_shopping_cart</i>
                  </div>
                  <p class="card-category">Đã Hủy</p>
                  <h3 class="card-title">
                    <?php
                      $total = $db->db_get_row($sql_dimiss);
                      echo number_format($total['totalproduct'],0,',',',')
                    ?>
                  </h3>
                </div>
                <div class="card-footer">
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-success card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">shopping_cart</i>
                  </div>
                  <p class="card-category">Chưa Xác Nhận</p>
                  <h3 class="card-title"><?=$db->num_rows($sql_not_accept);?></h3>
                </div>
                <div class="card-footer">
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-danger card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">king_bed</i>
                  </div>
                  <p class="card-category">Đang Giao</p>
                  <h3 class="card-title"><?=$db->num_rows($sql_shipping)?></h3>
                </div>
                <div class="card-footer">
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-info card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">download_done</i>
                  </div>
                  <p class="card-category">Đã Giao</p>
                  <h3 class="card-title"><?=$db->num_rows($sql_done)?></h3>
                </div>
                <div class="card-footer">
                </div>
              </div>
            </div>
          </div>

          <div class="row">

            <div class="col-md-12">

              <div class="card">

                <div class="card-header card-header-primary">

                  <h4 class="card-title ">Danh sách đơn hàng</h4>

                  <p class="card-category"> </p>

                </div>

                <div class="card-body">

                  <div class="table-responsive">

                    <table class="table table-hover">

                      <thead class=" text-primary">

                          <th>Tài khoản</th>

                          <th>Tổng tiền GD <i class="material-icons" rel="tooltip" data-placement="top" title="Tổng tiền GD( tổng tiền dịch): giá * số lượng của các đơn hàng đã thực hiện giao dịch thành công">error_outline</i></th>

                          <th>Đơn Chưa Hoàn Thành</th>

                          <th>Tổng giá trị đơn</th>

                          <th>Cập Nhật Mới Nhất</th>

                          <th></th>

                      </thead>

                      <tbody id="loaddtlist">

                      

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

  <!-- Library for adding dinamically elements -->

  <script src="/@admin/assets/js/plugins/arrive.min.js"></script>

  <!--  Google Maps Plugin    -->

  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

  <!-- Chartist JS -->

  <script src="/@admin/assets/js/plugins/chartist.min.js"></script>

  <!--  Notifications Plugin    -->

  <script src="/@admin/assets/js/plugins/bootstrap-notify.js"></script>

  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->

  <script src="/@admin/assets/js/material-dashboard.js?v=2.1.2" type="text/javascript"></script>

  <script>
    view()
  function view(){
    var type = "<?=($_SESSION['permission']==5)?'list':'orders'?>";
    $.post('/admin/order/accessview.html', {type:type}, function(o){
      $('#loaddtlist').html(o);
    })

  }
  $(document).on('click', '#trashorder', function(){
    var id = $(this).attr('order-id')
    $.post('/admin/order/list/trash', {id:id}, function(o){
      md.showNotification((o.sts==1)?'success':'danger', o.msg);
      if(o.sts==1) view();
    }, 'json')
  })
  </script>

</body>



</html>