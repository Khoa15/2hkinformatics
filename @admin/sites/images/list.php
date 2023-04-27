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
                    Danh sách hình ảnh
                    
                    <button class="btn btn-info btn-fab btn-fab-mini btn-round" id="newImage" data-toggle="modal" data-target="#newprictures"><i class="material-icons">add_photo_alternate</i></button>
                    <button class="btn btn-info btn-fab btn-fab-mini btn-round" title="Cập nhật" id="btn_update_lproduct">
                    <i class="material-icons">repeat</i>
                    </button>

                  </h4>
                  <p class="card-category"></p>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <?=($_SESSION['permission']==5)?'<tbody>
                        <tr>
                          <td colspan="5">
                            <select class="form-control" id="typeimage">
                              <option value="1">Sản Phẩm</option>
                              <option value="2">Banner</option>
                              <option value="3">Slide Ảnh</option>
                              <option value="4">Hình Website</option>
                            </select>
                          </td>
                        </tr>
                      </tbody>'
                      :false?>
                      <thead class=" text-primary">
                        <tr>
                          <th>#ID</th>
                          <th>Ảnh</th>
                          <th>Loại ảnh</th>
                          <th>Trạng thái</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody id="dtloadingproduct">
                      <tr>
                        <td colspan="5">Loading...</td>
                      </tr>
                      </tbody>
                      <tfoot>
                    
                        <tr>
                          <p id="rowcount" style="display:none">0</p>
                          <td colspan="5">
                            <nav id="paginationimage">
                              <ul class="pagination justify-content-center">
                                <?php
                                  $sql = 'select `id` from `images`';
                                  if($_SESSION['permission']<5){
                                    $sql .= ' where user_id='.$_SESSION['id'];
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
    var page = <?php if(!isset($_GET['page'])){echo 0;}elseif($_GET['page']==""){echo 0;}else{echo $_GET['page'];} ?>;
    if (page==0)
    {
      $("#newImage").click(function(){
        $(".modal-body.newpic").load('/admin/images/add.html');
      });
    }else{
      $("#newImage").click(function(){
        $(".modal-body.newpic").load('/admin/images/add.html');
      });
    }
      $("#btn_add_product").on('click', function(){
        $("#mdfrmproductadd").modal('show')
      })
      $("#btn_update_lproduct").on('click', function(){
        loaddingimages()
      });
  })
  loaddingimages()

  var count = 0;
  var timeout = null;
  var filter;
  function loaddingimages(){
      if(timeout){
        clearTimeout(timeout)
      }
      timeout = setTimeout(function(){
        $.post('/admin/images/view.html', {filter:filter,rowcount:count},function(o){
            $("#dtloadingproduct").html(o)
        })
      }, 300)
  }
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
    $.post('/admin/images/list/update', {id:id,sts:sts}, function(o){
      type = (o.sts==1)?'success':'danger'
      md.showNotification(type, o.msg);
    }, 'json')
    }
  function delimg(id){
    Swal.fire({
      title: 'Bạn chắc chắn muốn xóa?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.isConfirmed) {
        $.post('/admin/images/list/delete', {id:id}, function(o){
          if(o){
            Swal.fire('Deleted!', 'Your file has been deleted.','success')
            $('#btn_update_lproduct').click()
          }else{
        Swal.fire('Error!', 'Your progress has been cancelled.','error')

          }
        });
      }
    })
  }
      $('#paginationimage .pagination li').on('click', function(){
        loaddingimages();
        count = (Number($(this).text()) - 1) * 15
        $('.pagination li.active').removeClass('active')
        $(this).addClass('active');
      })
  $('select#typeimage').on('change', function(e){
    e.preventDefault();
    filter = $(this).val();
        $.post('/admin/images/view.html', {filter:filter,rowcount:count}, function(o){
            $("#dtloadingproduct").html(o)
          
        });
  })
  </script>
</body>

</html>