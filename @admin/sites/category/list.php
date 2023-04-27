<!-- Material Dashboard by Creative Tim -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Danh Sách Danh Mục - Control Panel
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
                    Danh sách danh mục
                    <button class="btn btn-info btn-fab btn-fab-mini btn-round" title="Thêm" id="btn_add_category">
                    <i class="material-icons">add</i>
                    </button>
                    <button class="btn btn-info btn-fab btn-fab-mini btn-round" title="Cập nhật" id="btn_update_lcategory">
                    <i class="material-icons">repeat</i>
                    </button>
                  </h4>
                  <p class="card-category"></p>
                </div>
                <div class="card-body">
                  <div class="row" id="dtloadingcategory">
                    <p class="text-center">Loading...</p>
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
    <div class="modal fade" id="mdfrmcategoryadd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm Danh Mục</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frmdtaddcategory">
                        <div class="form-group">
                            <label>Tên:</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div>
                            <label>
                                <input type="checkbox" name="actived" value="1">
                                Hoạt động
                            </label>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="btnsb_add" value="Lưu" id="btnsb_add" class="btn btn-primary">
                        </div>
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
  <script>
    loaddingcategory()
    function loaddingcategory() {
      $.post('/admin/category/view.html', function(o){
            $("#dtloadingcategory").html(o)
        })
    }
    var update = false;
  function editcategory(id){
    update = true
    console.log(update)
    var sts = $('button[id-categories="'+id+'"]').attr('sts-view'), name = $('button[id-categories="'+id+'"]').attr('dt-text'),btn = $('input[type="submit"]');
    $('#exampleModalLabel').text('Sửa Danh Mục')
    $('#mdfrmcategoryadd').modal('show')
    btn.attr('name','btnsb_update')
    btn.attr('id','btnsb_update')
    btn.attr('category-id', id)
    $('input[type="text"][name="name"]').val(name)
    $('input[type="checkbox"]').prop('checked', (sts==1)?true:false);
  }
  $(document).ready(function(){
      $("#btn_add_category").on('click', function(){
        update = false
        $("input[name='btnsb_update']").attr('name','btnsb_add')
        $("#frmdtaddcategory").closest('form').find("input[type='text'][name='name'], input[type='checkbox']").val("").prop('checked', false);
        $("#mdfrmcategoryadd").modal('show')
      })
        $("input[name='btnsb_add']").on('click', function(e){
          e.preventDefault()
          if(!update){
            var data = $("#frmdtaddcategory").serialize();
            $.post('/admin/category/list/add', data, function(o){
              if(o.sts==1){
                  md.showNotification('success', o.msg);
                  $("#btn_update_lcategory").click();
              }else{
                  md.showNotification('danger', o.msg);
              }
            }, 'json')
            return false
          }else{
              var actived = 0;
              if ($('input[type="checkbox"]').is(":checked"))
              {
                actived = 1;
              }
                var data = $("#frmdtaddcategory").serialize();
                $.post('/admin/category/list/update', data+'&id='+$('input[type="submit"]').attr('category-id')+'&sts='+actived, function(o){
                  if(o.sts==1){
                      md.showNotification('success', o.msg);
                      loaddingcategory()
                  }else{
                      md.showNotification('danger', o.msg);
                  }
                }, 'json')
                return false
          }
            })
      
      $("#btn_update_lcategory").on('click', function(){
        loaddingcategory()
      });
    })
  function deltecategory(id){
    $.post('/admin/category/list/delete', {id:id}, function(o){
      md.showNotification((o.sts==1)?'success':'error',o.msg)
      if(o.sts==1){
        loaddingcategory()
      }
    }, 'json')
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
    $.post('/admin/category/list/updatests', {id:id,sts:sts}, function(o){
      type = (o.sts==1)?'success':'danger'
      md.showNotification(type, o.msg);
    }, 'json')
  }
  </script>
</body>

</html>