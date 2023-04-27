<!-- Material Dashboard by Creative Tim -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Chỉnh Sửa Thông Tin - Control Panel
  </title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="/@admin/assets/css/material-dashboard.css?v=2.1.2" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="/@admin/assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="">

  <?php
    if(isset($_GET['id']) && !empty($_GET['id'])){
      $id = intval($_GET['id']);
      $sql = 'select * from `users` where `id`='.$id;
      $item = $db->db_get_row($sql);
  ?>
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
                  <h4 class="card-title ">Chỉnh Sửa Tài Khoản: <strong><?=$item['name']?></strong></h4>
                  <p class="card-category"> </p>
                </div>
                <div class="card-body">
                    <form id="frmdatauser">
                            <div class="form-row">
                              <input type="hidden" name="uid" value="<?=$id?>">
                                <div class="form-group col-md-6">
                                  <label class="bmd-label-floating">Họ:</label>
                                  <input type="text" class="form-control" name="ho" value="<?=$item['surname']?>">
                                </div>
                                <div class="form-group col-md-6">
                                  <label class="bmd-label-floating">Tên:</label>
                                  <input type="text" class="form-control" name="ten" value="<?=$item['name']?>">
                                </div>
                                <div class="form-group col-md-6">
                                  <label class="bmd-label-floating">Email:</label>
                                  <input type="email" class="form-control" name="email" value="<?=$item['email']?>">
                                </div>
                                <div class="form-group col-md-3">
                                  <label class="bmd-label-floating">Số điện thoại:</label>
                                  <input type="number" class="form-control" name="sdt" maxlength="10" value="<?=$item['nbp']?>">
                                </div>
                                <div class="form-group col-md-3">
                                  <input type="text" class="form-control" disabled placeholder="Mật khẩu của tài khoản">
                                </div>
                                <div class="form-group col-md-3">
                                  <label>Giới tính</label>
                                  <label><input type="radio" name="sex" value="0" <?=(!$item['gender'])?'checked':false?>>Nam</label>
                                  <label><input type="radio" name="sex" value="1" <?=($item['gender'])?'checked':false?>>Nữ</label>
                                </div>
                                <div class="form-group col-md-3">
                                  <label class="bmd-label-floating">Sinh nhật:</label>
                                  <input type="date" class="form-control" name="dob" value="<?=$item['dob']?>">
                                </div>
                                <div class="form-group col-md-3">
                                  <label class="bmd-label-floating">Ngày tạo:</label>
                                  <input type="text" disabled class="form-control" value="<?=$item['created_at']?>">
                                </div>
                                <div class="form-group col-md-3">
                                  <label class="bmd-label-floating">Ngày cập nhật:</label>
                                  <input type="text" disabled class="form-control" value="<?=$item['updated_at']?>">
                                </div>
                            </div>
                            <div class="form-group">
                              <label>Quyền <i class="material-icons" rel="tooltip" data-placement="top" title="CTV cho phép người dùng đăng tải các sản phẩm để bán, CTV2 sẽ có được chứng nhận uy tín">error_outline</i></label>
                              <select class="form-control" name="permission">
                                <option value="0" <?=($item['permission']==0)?'selected':false?>>Khóa</option>
                                <option value="1" <?=($item['permission']==1)?'selected':false?>>Thường</option>
                                <option value="2" <?=($item['permission']==2)?'selected':false?> disabled>VIP - không phát triển</option>
                                <option value="3" <?=($item['permission']==3)?'selected':false?>>CTV</option>
                                <option value="4" <?=($item['permission']==4)?'selected':false?>>CTV2</option>
                                <option value="5" <?=($item['permission']==5)?'selected':false?>>Administator</option>
                              </select>
                            </div>
                            <?php
                              }
                            ?>
                        <input type="submit" class="btn btn-primary" value="Lưu" id="btnus_save">
                    </form>

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
  <script>
    $(document).ready(function(){
      $("input[type='submit']").on('click', function(e){
        e.preventDefault()
        var data = $("#frmdatauser").serialize()
        $.post('/admin/user/list/update', data, function(o){
          type = (o.sts==1)?'success':'danger'
          md.showNotification(type, o.msg)
        }, 'json')
      })
    })
  </script>
</body>

</html>