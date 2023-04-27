<?php
if(isset($_SESSION['id']) && isset($_SESSION['permission'])){
    $id = $_SESSION['id'];
    $permit = $_SESSION['permission'];
    if(empty($id) || empty($permit) || $permit<3){
        echo "The request not found";
        return false;
    }
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

    Chỉnh Sửa Thông Tin Hình Ảnh - Control Panel

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

            <div class="col-md-12">

              <div class="card">

                <div class="card-body">

                    <form id="frmdtsaveimage">
                        <div class="row">
                          <?php

                            if(isset($_GET['id']) && !empty($_GET['id'])){

                              $id = htmlspecialchars($_GET['id']);

                              $sql = 'select * from `images` where `id`='.$id;

                              $list = $db->db_get_list($sql);

                              foreach($list as $item):

                                $sql = 'select `name` from `users` where `id`='.$item['user_id'];

                                $row = $db->db_get_row($sql);

                                $sql = 'select `name` from `products` where `id`='.$item['product_id'];

                                $name = $db->db_get_row($sql);
                                $name['name'] = (empty($name['name']))?'Không có sản phẩm nào':$name['name'];

                          ?>

                            <div class="table-responsive">
                              <input type="hidden" value="<?=$id?>" name="id">

                              <table class="table table-bordered">

                                <tbody>

                                  <tr>

                                    <td colspan="2">

                                      <img src="<?=$item['link']?>" width="100">

                                    </td>

                                  </tr>

                                  <tr id="boximg">

                                    <td>Sản phẩm liên kết:</td>

                                    <td>

                                      <input type="number" min="0" placeholder="Nhập ID sản phẩm cần liên kết" name="pid" value="<?=$item['product_id']?>" class="form-control" placeholder="ID Sản phẩm">

                                      <p class="help-text"><?=mb_substr($name['name'],0, 30, 'UTF-8')?><?=(strlen($name['name'])>30)?'...':false?></p>

                                    </td>

                                  </tr>

                                  <tr>

                                    <td>Loại ảnh:</td>

                                    <td>

                                      <select name="type" id="typeGame" class="form-control" onchange="choose()">

                                        <option value="1" <?=($item['type']==1)?'selected':false?>>Sản Phẩm</option>

                                        <option value="2" <?=($item['type']==2)?'selected':false?> <?=($permit<5)?'disabled':false?>>Banner</option>

                                        <option value="3" <?=($item['type']==3)?'selected':false?> <?=($permit<5)?'disabled':false?>>Slide Ảnh</option>

                                        <option value="4" <?=($item['type']==4)?'selected':false?>>Hình Website</option>

                                      </select>

                                    </td>

                                  </tr>

                                  <tr id="boxPosition">

                                    <td>Vị trí ảnh:</td>

                                    <td>

                                      <select name="pos" class="form-control" id="type">

                                        <option value="1" <?=($item['pos']==1)?'selected':false?>>Hình ảnh bình thường</option>

                                        <option value="2" <?=($item['pos']==2)?'selected':false?>>Hình ảnh đại diện</option>

                                      </select>

                                    </td>

                                  </tr>

                                  <tr>

                                    <td>Trạng thái:</td>

                                    <td>

                                      <label><input type="checkbox" <?=($item['status'])?'checked':false?> name="status" value="1">Hiện</label>

                                    </td>

                                  </tr>

                                  <tr>

                                    <td>Cập nhật lúc:</td>

                                    <td>

                                      <p>

                                        <span><?=$item['updated_at']?></span>

                                        <span>Bởi: <strong><?=$row['name']?></strong></span>

                                      </p>

                                    </td>

                                  </tr>

                                </tbody>

                              </table>

                            </div>

                          <?php

                              endforeach;

                            }

                          ?>

                        </div>

                        <input type="submit" class="btn btn-primary" value="Lưu" id="btnsb_save">

                    </form>

                </div>

              </div>

              <div class="table-responsive">

                <table class="table table-primary">

                  <thead>

                    <tr>

                      <td>#ID</td>
                      <td colspan="2">
                        <input type="text" class="form-control" id="searchkey" placeholder="Nhập thông tin cần tìm: ID, tên sản phẩm,...">
                      </td>
    
                    </tr>

                  </thead>

                  <tbody id="dtloadingproductname">

                    

                  </tbody>

                  <tfoot>
                    
                    <tr>
                      <p id="rowcount" style="display:none">0</p>
                      <td colspan="3">
                        <nav id="paginationimage">
                          <ul class="pagination justify-content-center">
                            <?php
                              $sql = 'select `id` from `products`';
                                  if($_SESSION['permission']<5){
                                    $sql .= ' where store_id='.$_SESSION['store'];
                                  }
                                  $sql .= ' order by `id` desc';
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

  <script type="text/javascript" src="/@admin/assets/js/plugins/nicEdit.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.6/clipboard.min.js"></script>



  <script>
    $(document).ready(function(){
      var count = $("#rowcount");
      $('button#copy').on('click', function(){
        $(this).fadeOut(0);
        $(this).fadeIn();
      })
      document.addEventListener("keydown", function(e) {
          if ((window.navigator.platform.match("Mac") ? e.metaKey : e.ctrlKey)  && e.keyCode == 83) {
            e.preventDefault();
            $('input#btnsb_save').click();
          }
        }, false);
      /*var isCtrl = false;
      document.onkeyup=function(e){
          if(e.keyCode == 17) isCtrl=false;
      }

      document.onkeydown=function(e){
          if(e.keyCode == 17) isCtrl=true;
          if(e.keyCode == 83 && isCtrl == true) {
              $('input#btnsb_save').click();
              return false;
          }
      }*/
      $('input#btnsb_save').on('click', function(e){
        e.preventDefault();
        var form = $('#frmdtsaveimage').serialize(), type = 'danger';
        $.ajax({
          url: '/admin/images/list/save',
          type: 'POST',
          dataType:'json',
          data: form,
          success: function(o){
            if(o.sts==1){
              type = 'success'
            }
            md.showNotification(type, o.msg);
          }
        })
      })
      $('input#searchkey').on('input', function(o){
        dtloadingproductname();
      })
      $('#paginationimage .pagination li').on('click', function(){
        dtloadingproductname();
        count.text((Number($(this).text()) - 1) * 5) 
        $('.pagination li.active').removeClass('active')
        $(this).addClass('active');
      })
    })
    var clipboard = new ClipboardJS('#copy');

    clipboard.on('success', function (e) {

      console.log(e);

    });
    choose();dtloadingproductname();
    function choose(){

      var sel = $('#typeGame').val();

      if(sel==2 || sel==4 || sel==3){

        $("#boximg").css('display', "none");

        $("#boxPosition").css('display','none')

      }else{

        $("#boximg").css('display', "table-row");

        $("#boxPosition").css('display','table-row');

      }

    }
    var timeout = null;
    function dtloadingproductname(search=null){
      $('#dtloadingproductname').html('<tr align="center"><td colspan="3"><img src="/assets/imgs/overlay.gif" alt=""></td></tr>')
        var search = $('#searchkey').val();
      if(timeout){
        clearTimeout(timeout)
      }
      timeout = setTimeout(function(){
        $.post('/admin/images/viewpname.html', {search:search,rowcount:$("#rowcount").text()}, function(o){
          $('#dtloadingproductname').html(o)
        })
      }, 300)
    }
  </script>

</body>



</html>