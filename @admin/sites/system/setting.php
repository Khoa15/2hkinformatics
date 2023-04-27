<?php
$uid = (int)$_SESSION['id'];
if($uid != $_SESSION['id']){
  $uid = 0;
}
$permit = $_SESSION['permission'];
if(!isset($_SESSION['permission']) || !$_SESSION['permission']>=3 || $uid == 0){
  echo "The request not found";
  exit();
}
$user = 'select id, permission from users where id='.$uid.' and permission=5 limit 1';
$user = $db->db_get_row($user);
if(empty($user['id']) || $user['permission']!=5){
  echo "The request not found".$user['id'].'  '.$user['permission'];
  //header("Location: /dang-xuat.html");
  exit();
}
$_SESSION['id'] = $user['id'];
$_SESSION['permission'] = $user['permission'];
$sql = 'select * from system where id = 1 limit 1';
$system = $db->db_get_row($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Cửa Hàng - Control Panel
  </title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <link rel="icon" type="image/png" href="<?=$favicon?>">
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
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <td colspan="2" class="text-warning">Lưu ý: Bạn đang tiến vào trang tùy chỉnh hệ thống website</td>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td colspan="2">
                              <form class="input-group">
                                <input type="password" placeholder="Xác nhận mật khẩu tài khoản" id="psw" class="form-control">
                                <div class="input-group-prepend">
                                  <button type="submit" class="btn btn-sm btn-primary">Xác Nhận</button>
                                </div>
                              </form>
                            </td>
                          </tr>
                        </tbody>
                        <tr class="overlay"></tr>
                        <tbody id="hidden" class="hide">
                          <tr>
                            <td>Tên Website:</td>
                            <td>
                                <input type="text" id="name" class="form-control" placeholder="Nhập tên website" value="<?=$system['name']?>">
                            </td>
                          </tr>
                          <tr>
                            <td>Mô tả ngắn:</td>
                            <td>
                                <input type="text" id="description" class="form-control" value="<?=$system['description']?>">
                            </td>
                          </tr>
                          <tr>
                            <td>Email hỗ trợ:</td>
                            <td>
                                <input type="text" id="email" class="form-control" value="<?=$system['email']?>">
                            </td>
                          </tr>
                          <tr>
                            <td>Sđt hỗ trợ:</td>
                            <td>
                                <input type="text" id="nbp" class="form-control" value="<?=$system['nbp']?>">
                            </td>
                          </tr>
                          <tr>
                            <td>Favicon:</td>
                            <td>
                                <input type="text" id="favicon" class="form-control" value="<?=$system['favicon']?>">
                            </td>
                          </tr>
                          <tr>
                            <td>Poster:</td>
                            <td>
                                <input type="text" id="poster" class="form-control" value="<?=$system['poster']?>">
                            </td>
                          </tr>
                          <tr>
                            <td>Tiền vận chuyển:</td>
                            <td>
                              <input type="number" id="ship" class="form-control" value="<?=$system['ship']?>">
                            </td>
                          </tr>
                          <tr>
                            <td>Trạng thái:</td>
                            <td>
                              <label>
                                <input type="checkbox" value="1" id="actived" <?=($system['actived'])?'checked':false?>>
                                Hoạt động
                              </label>
                            </td>
                          </tr>
                          <tr>
                            <td>Thời gian tạo website:</td>
                            <td><?=$system['created_at']?></td>
                          </tr>
                          <tr>
                            <td>Lần cập nhật gần nhất:</td>
                            <td><?=$system['updated_at']?></td>
                          </tr>
                        </tbody>
                        <tfoot id="hidden" class="hide">
                          <tr align="right">
                            <td colspan="2"><button class="btn btn-sm pr-4 pl-4" id="save">Lưu</button></td>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="card">
                <div class="card-header card-header-primary"><h4>Danh Sách Các Cửa Hàng</h4></div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead>

                        <tr>
                          <td colspan="2">
                            <input type="text" class="form-control" id="searchkey" placeholder="Nhập tên cửa hàng...">
                          </td>
        
                        </tr>

                      </thead>
                      <tbody id="lstore">
                        
                      </tbody>
                      <tfoot>
                        <tr>
                          <td colspan="2">
                            <nav id="paginationimage">
                              <ul class="pagination justify-content-center">
                                <?php
                                  $sql = 'select * from `stores` order by id desc';
                                  $num = $db->num_rows($sql);
                                  $cbtn = ceil($num/5);
                                  $html = '';
                                  $active = ' active';
                                  for ($i=1; $i <= $cbtn; $i++) { 
                                    $html .= '<li class="page-item'.$active.'"><button class="page-link">'.$i.'</button></li>';;
                                    $active = false;
                                  }
                                  echo $html;
                                ?>
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
  <!--  Notifications Plugin    -->
  <script src="/@admin/assets/js/plugins/bootstrap-notify.js"></script>
  <script src="/@admin/assets/js/material-dashboard.js"></script>
  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
  <script>
    $('#save').on('click',function(e){
      var name = $('#name').val(), description = $('#description').val(), email = $('#email').val(), nbp = $('#nbp').val(), favicon = $('#favicon').val(), poster = $('#poster').val(), ship = $('#ship').val(), actived = 0
      if ($('#actived').is(":checked"))
      {
        actived = 1
      }

      $.ajax({
          url: '/admin/system/setting/update',
          data: {
            name : name,
            description : description,
            email : email,
            nbp : nbp,
            favicon : favicon,
            poster : poster,
            ship: ship,
            actived: actived
          },
          dataType: 'json',
          cache: false,
          type: 'post',
          error: function(){
              swal('Có lỗi!', 'Đường truyền không ổn định', 'danger')
          },
          beforeSend: function () {
              $(this).css('disabled', true)
          },
          complete: function () {
              $(this).css('disabled', false)
          },
          success: function (json) {
              md.showNotification((json.sts==1)?'success':'danger', json.msg)
          }
      })
    })
    $('input#psw').on('input', (e)=>{
      e.preventDefault();
      $('.hide').css('display', 'none')
    })
    $('button[type="submit"]').on('click', function(e){
      e.preventDefault();
      var psw = $('input#psw').val();
      $.ajax({
          url: '/admin/system/setting/acept',
          data: {
            psw:psw
          },
          dataType: 'json',
          cache: false,
          type: 'post',
          error: function(){
              swal('Có lỗi!', 'Đường truyền không ổn định', 'danger')
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
                $('.hide').css('display', 'contents')
              }
          }
      })

    })


    var count = 0
    $('input#searchkey').on('input', function(o){
        dtloadingproductname();
      })
      $('#paginationimage .pagination li').on('click', function(){
        dtloadingproductname();
        count = ((Number($(this).text()) - 1) * 5) 
        $('.pagination li.active').removeClass('active')
        $(this).addClass('active');
      })
      dtloadingproductname();
    var timeout = null;
    function dtloadingproductname(search=null){
      $('#lstore').html('<tr align="center"><td colspan="3"><img src="/assets/imgs/overlay.gif" alt=""></td></tr>')
        var search = $('#searchkey').val();
      if(timeout){
        clearTimeout(timeout)
      }
      timeout = setTimeout(function(){
        $.post('/admin/system/lstores.html', {search:search,rowcount:count}, function(o){
          $('#lstore').html(o)
        })
      }, 300)
    }

    
    function stop(id){
      var store = $('button[store-id="'+id+'"]');
      store.html('Loading...').attr('disabled', true)
      $.post('/admin/shop/setting/stopstore',{id:id}, function(o){
        md.showNotification((o.sts==1)?'success':'danger',o.msg)
        if(o.btn!=undefined){
          if(o.btn){
            store.html('Hoạt động').removeClass('btn-warning').addClass('btn-info')
          }else{
            store.html('Dừng').removeClass('btn-info').addClass('btn-warning')
          }
        }else{
          store.html('Hoạt động')
        }
      }, 'json')
      store.attr('disabled', false)
    }
  </script>
</body>

</html>