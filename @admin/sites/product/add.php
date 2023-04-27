<?php
$uid = (int)$_SESSION['id'];
if($uid != $_SESSION['id']){
  $uid = 0;
}
$address = 'select `street`, `city`, `nbp` from address where `user_id`='.$uid.' and `store`=true limit 1';
$address = $db->db_get_row($address);
?><!-- Material Dashboard by Creative Tim -->
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
        
        <?php if($_SESSION['store']): ?>
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                    <form id="frmdtaddproduct">

                            <div class="form-group">
                              <div class="row">
                                
                                <label class="col-12">Danh mục:</label>
                                <?php
                                $sql = 'select `id`, `name` from `categories` where `actived`=true order by `id`';
                                $list = $db->db_get_list($sql);
                                $hidden = (empty($list))?"hidden":false;
                                foreach($list as $item):
                                ?>
                                <label class="col-lg-3 col-md-4 col-sm-5 col-6"><input type="radio" name="category" value="<?=$item['id']?>" id="categories"><?=$item['name']?></label>
                                <?php
                                endforeach;
                                ?>
                              </div>
                            </div>
                            <?=($hidden)?"Cần có danh mục để thực hiện":false?>
                        <div class="row <?=$hidden?>">
                            <div class="col-md-3 form-group">
                              <input type="text" class="form-control" maxlength="120" placeholder="Tên sản phẩm" name="nproduct">
                              <small class="text-right form-text text-muted">
                                <span id="text-name-pre">0</span>/120
                              </small>
                            </div>
                            <div class="col-md-3 form-group">
                              <input type="number" class="form-control" name="sale" placeholder="% Khuyến mãi">
                              <span class="text-right form-text text-muted">
                                %
                              </span>
                            </div>
                            <div class="col-md-3 form-group bmd-form-group">
                                <div class="input-group mb-3">
                                  <input type="number" placeholder="Giá bán" class="form-control" name="price">
                                  <div class="input-group-append">
                                    <span class="input-group-text"><sub>đ</sub></span>
                                  </div>
                                </div>
                            </div>
                            <div class="col-md-3 form-group">
                                <input type="number" class="form-control" name="amount" placeholder="Số lượng">
                            </div>
                            <div class="col-md-12 form-group">
                              <!-- <p class="text-help">Hãy ấn <code>windows + ;</code> để thêm emoji</p> -->
                                <textarea id="area-text" name="description" class="form-control" maxlength="4000" cols="30" rows="10" placeholder="Mô tả chi tiết"></textarea>
                                <small class="form-text text-right text-muted"><span id="text-area-pre">0</span>/4000</small>
                            </div>
                            <hr>
                          </div>
                          <div class="form-row  <?=$hidden?>" id="typeproduct">
                            <div class="form-row col-12" id="group0">
                              <div class="col-md-3 form-group">
                                  <input type="text" placeholder="Tên nhóm phân loại, vd: màu sắc" class="form-control" id="namegroup[]">
                              </div>
                              <div class="form-row col-6" id="grouptype" id-btn="1">
                                <div class="col-md-6 form-group">
                                      <input type="text" id-btn="1" placeholder="Tên phân loại, vd: vàng" class="form-control" id="codeproduct[]">
                                </div>
                                <div class="col-md-6 form-group">
                                    <div class="input-group mb-3">
                                      <input type="number" id-btn="1" placeholder="Giá bán" class="form-control" id="productprice[]">
                                      <div class="input-group-append">
                                        <span class="input-group-text"><sub>đ</sub></span>
                                      </div>
                                    </div>
                                </div>
                              </div>
                              <div class="col-md-3 form-group">
                                    <button type="button" class="btn btn-sm btn-primary" id="addcodeandval" id-btn="1">
                                      <span class="material-icons">add</span>
                                    </button>
                              </div>
                            </div>
                          </div>
                            <div class="col-12 <?=$hidden?>">
                              <button type="button" class="btn btn-sm btn-primary" id="addtypeproduct">
                                <span class="material-icons">add</span>
                              </button>
                              <small class="text-muted">Để trống nếu không có</small>
                            </div>
                              <div class="form-row <?=$hidden?>">
                                <div class="col-md-3 form-group">
                                  <label for="city">Giao từ:</label>
                                  <select name="city" id="city" class="form-control">
                                      <option></option>
                                            <option <?=(!empty($address['city']) && $address['city'] == 'An Giang')? 'selected':false?>>An Giang</option>
                                            <option <?=(!empty($address['city']) && $address['city'] == 'Bà Rịa - Vũng Tàu')? 'selected':false?>>Bà Rịa - Vũng Tàu</option>
                                            <option <?=(!empty($address['city']) && $address['city'] == 'Bắc Kạn')? 'selected':false?>>Bắc Kạn</option>
                                            <option <?=(!empty($address['city']) && $address['city'] == 'Bắc Giang')? 'selected':false?>>Bắc Giang</option>
                                            <option <?=(!empty($address['city']) && $address['city'] == 'Bạc Liêu')? 'selected':false?>>Bạc Liêu</option>
                                            <option <?=(!empty($address['city']) && $address['city'] == 'Bắc Ninh')? 'selected':false?>>Bắc Ninh</option>
                                            <option <?=(!empty($address['city']) && $address['city'] == 'Bến Tre')? 'selected':false?>>Bến Tre</option>
                                            <option <?=(!empty($address['city']) && $address['city'] == 'Bình Dương')? 'selected':false?>>Bình Dương</option>
                                            <option <?=(!empty($address['city']) && $address['city'] == 'Bình Định')? 'selected':false?>>Bình Định</option>
                                            <option <?=(!empty($address['city']) && $address['city'] == 'Bình Phước')? 'selected':false?>>Bình Phước</option>
                                            <option <?=(!empty($address['city']) && $address['city'] == 'Bình Thuận')? 'selected':false?>>Bình Thuận</option>
                                            <option <?=(!empty($address['city']) && $address['city'] == 'Cà Mau')? 'selected':false?>>Cà Mau</option>
                                            <option <?=(!empty($address['city']) && $address['city'] == 'Cần Thơ')? 'selected':false?>>Cần Thơ</option>
                                            <option <?=(!empty($address['city']) && $address['city'] == 'Cao Bằng')? 'selected':false?>>Cao Bằng</option>
                                            <option <?=(!empty($address['city']) && $address['city'] == 'Đà Nẵng')? 'selected':false?>>Đà Nẵng</option>
                                            <option <?=(!empty($address['city']) && $address['city'] == 'Đắk Lắk')? 'selected':false?>>Đắk Lắk</option>
                                            <option <?=(!empty($address['city']) && $address['city'] == 'Đắk Nông')? 'selected':false?>>Đắk Nông</option>
                                            <option <?=(!empty($address['city']) && $address['city'] == 'Điện Biên')? 'selected':false?>>Điện Biên</option>
                                            <option <?=(!empty($address['city']) && $address['city'] == 'Đồng Nai')? 'selected':false?>>Đồng Nai</option>
                                            <option <?=(!empty($address['city']) && $address['city'] == 'Đồng Tháp')? 'selected':false?>>Đồng Tháp</option>
                                            <option <?=(!empty($address['city']) && $address['city'] == 'Gia Lai')? 'selected':false?>>Gia Lai</option>
                                            <option <?=(!empty($address['city']) && $address['city'] == 'Hà Giang')? 'selected':false?>>Hà Giang</option>
                                            <option <?=(!empty($address['city']) && $address['city'] == 'Hà Nam')? 'selected':false?>>Hà Nam</option>
                                            <option <?=(!empty($address['city']) && $address['city'] == 'Hà Nội')? 'selected':false?>>Hà Nội</option>
                                            <option <?=(!empty($address['city']) && $address['city'] == 'Hà Tĩnh')? 'selected':false?>>Hà Tĩnh</option>
                                            <option <?=(!empty($address['city']) && $address['city'] == 'Hải Dương')? 'selected':false?>>Hải Dương</option>
                                            <option <?=(!empty($address['city']) && $address['city'] == 'Hải Phòng')? 'selected':false?>>Hải Phòng</option>
                                            <option <?=(!empty($address['city']) && $address['city'] == 'Hậu Giang')? 'selected':false?>>Hậu Giang</option>
                                            <option <?=(!empty($address['city']) && $address['city'] == 'TP. Hồ Chí Minh')? 'selected':false?>>TP. Hồ Chí Minh</option>
                                            <option <?=(!empty($address['city']) && $address['city'] == 'Hòa Bình')? 'selected':false?>>Hòa Bình</option>
                                            <option <?=(!empty($address['city']) && $address['city'] == 'Hưng Yên')? 'selected':false?>>Hưng Yên</option>
                                            <option <?=(!empty($address['city']) && $address['city'] == 'Khánh Hòa')? 'selected':false?>>Khánh Hòa</option>
                                            <option <?=(!empty($address['city']) && $address['city'] == 'Kiên Giang')? 'selected':false?>>Kiên Giang</option>
                                            <option <?=(!empty($address['city']) && $address['city'] == 'Kon Tum')? 'selected':false?>>Kon Tum</option>
                                            <option <?=(!empty($address['city']) && $address['city'] == 'Lai Châu')? 'selected':false?>>Lai Châu</option>
                                            <option <?=(!empty($address['city']) && $address['city'] == 'Lâm Đồng')? 'selected':false?>>Lâm Đồng</option>
                                            <option <?=(!empty($address['city']) && $address['city'] == 'Lạng Sơn')? 'selected':false?>>Lạng Sơn</option>
                                            <option <?=(!empty($address['city']) && $address['city'] == 'Lào Cai')? 'selected':false?>>Lào Cai</option>
                                            <option <?=(!empty($address['city']) && $address['city'] == 'Long An')? 'selected':false?>>Long An</option>
                                            <option <?=(!empty($address['city']) && $address['city'] == 'Nam Định')? 'selected':false?>>Nam Định</option>
                                            <option <?=(!empty($address['city']) && $address['city'] == 'Nghệ An')? 'selected':false?>>Nghệ An</option>
                                            <option <?=(!empty($address['city']) && $address['city'] == 'Ninh Bình')? 'selected':false?>>Ninh Bình</option>
                                            <option <?=(!empty($address['city']) && $address['city'] == 'Ninh Thuận')? 'selected':false?>>Ninh Thuận</option>
                                            <option <?=(!empty($address['city']) && $address['city'] == 'Phú Thọ')? 'selected':false?>>Phú Thọ</option>
                                            <option <?=(!empty($address['city']) && $address['city'] == 'Phú Yên')? 'selected':false?>>Phú Yên</option>
                                            <option <?=(!empty($address['city']) && $address['city'] == 'Quảng Bình')? 'selected':false?>>Quảng Bình</option>
                                            <option <?=(!empty($address['city']) && $address['city'] == 'Quảng Nam')? 'selected':false?>>Quảng Nam</option>
                                            <option <?=(!empty($address['city']) && $address['city'] == 'Quảng Ngãi')? 'selected':false?>>Quảng Ngãi</option>
                                            <option <?=(!empty($address['city']) && $address['city'] == 'Quảng Ninh')? 'selected':false?>>Quảng Ninh</option>
                                            <option <?=(!empty($address['city']) && $address['city'] == 'Quảng Trị')? 'selected':false?>>Quảng Trị</option>
                                            <option <?=(!empty($address['city']) && $address['city'] == 'Sóc Trăng')? 'selected':false?>>Sóc Trăng</option>
                                            <option <?=(!empty($address['city']) && $address['city'] == 'Sơn La')? 'selected':false?>>Sơn La</option>
                                            <option <?=(!empty($address['city']) && $address['city'] == 'Tây Ninh')? 'selected':false?>>Tây Ninh</option>
                                            <option <?=(!empty($address['city']) && $address['city'] == 'Thái Bình')? 'selected':false?>>Thái Bình</option>
                                            <option <?=(!empty($address['city']) && $address['city'] == 'Thái Nguyên')? 'selected':false?>>Thái Nguyên</option>
                                            <option <?=(!empty($address['city']) && $address['city'] == 'Thanh Hóa')? 'selected':false?>>Thanh Hóa</option>
                                            <option <?=(!empty($address['city']) && $address['city'] == 'Thừa Thiên Huế')? 'selected':false?>>Thừa Thiên Huế</option>
                                            <option <?=(!empty($address['city']) && $address['city'] == 'Tiền Giang')? 'selected':false?>>Tiền Giang</option>
                                            <option <?=(!empty($address['city']) && $address['city'] == 'Trà Vinh')? 'selected':false?>>Trà Vinh</option>
                                            <option <?=(!empty($address['city']) && $address['city'] == 'Tuyên Quang')? 'selected':false?>>Tuyên Quang</option>
                                            <option <?=(!empty($address['city']) && $address['city'] == 'Vĩnh Long')? 'selected':false?>>Vĩnh Long</option>
                                            <option <?=(!empty($address['city']) && $address['city'] == 'Vĩnh Phúc')? 'selected':false?>>Vĩnh Phúc</option>
                                            <option <?=(!empty($address['city']) && $address['city'] == 'Yên Bái')? 'selected':false?>>Yên Bái</option>
                                        </select>
                                </div>
                                <div class="form-group mt-5 col-md-3">
                                    <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" name="freeship" type="checkbox" value="1">
                                        Miễn Phí Vận Chuyển
                                        <span class="form-check-sign">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                  </div>
                                </div>
                                <div class="form-row col-md-6 col-12">
                                  <div class="form-group col-6">
                                    <label for="buy">Mua từ:</label>
                                    <input type="number" id="buy" value="0" min="0" oninput="helptext()" name="buy" class="form-control">
                                  </div>
                                  <div class="form-group col-6">
                                    <label for="buy">Giảm:</label>
                                    <div class="input-group">
                                      <input type="number" name="valsaledown" value="0" min="0" oninput="helptext()" id="valsaledown" class="form-control">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text">
                                          <select name="tsaledown" onchange="helptext()" id="tsaledown">
                                            <option value="%">%</option>
                                            <option value="đ">đ</option>
                                          </select>
                                        </span>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-12">
                                    <p class="text-help" id="help"></p>
                                  </div>
                                </div>
                                  
                              </div>
                                
                            <div class="form-group <?=$hidden?>">
                              <div class="form-check">
                                  <label class="form-check-label">
                                      <input class="form-check-input" name="actived" type="checkbox" value="1">
                                      Hiện
                                      <span class="form-check-sign">
                                          <span class="check"></span>
                                      </span>
                                  </label>
                              </div>
                            </div>
                        <input type="reset" class="btn btn-warning <?=$hidden?>" value="Reset">
                        <input type="submit" class="btn btn-primary <?=$hidden?>" value="Lưu" id="btnsb_add">
                    </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php else: ?>
          <div class="container-fluid">
            <div class="row">
              <div class="col-12">
                <div class="card card-stats">
                  <div class="card-header card-header-warning">
                    <h5 class="card-title">
                      <a class="btn btn-info" href="/mo-shop.html">Mở Cửa Hàng</a>
                    </h5>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php endif; ?>
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
  <script>
    $('div.nicEdit-main').on('paste', function (e) {
        e.preventDefault();
        document.execCommand('inserttext', false, prompt('Paste something.'));
    });
    $('textarea[name="description"]').on('input', function(e){
      var l = $(this).val()
      $('span#text-area-pre').html(l.length)
      if(l.length>=4000){md.showNotification('warning','Đã đạt giới hạn') 
      }
    })
    $('input[name="nproduct"]').on('input', function(e){
        l = $(this).val()
        $('span#text-name-pre').html(l.length)
        if(l.length>=120){md.showNotification('warning','Đã đạt giới hạn') 
        }
    })
    var idBtn = 0, typen=0;
    $('button#addtypeproduct').on('click', function(e){
      e.preventDefault()
      //var list = document.getElementById("addcodeandval").lastElementChild.innerHTML;
      idBtn = Number($('#typeproduct .form-row #grouptype').last().attr('id-btn'));
      idBtn= (idBtn<2)?idBtn+1:2;
      if(idBtn==2){md.showNotification('warning','Đã đạt giới hạn') 
      }
      if(idBtn<2){
        $('#typeproduct').append('<div class="form-row col-12" id="group'+(idBtn-1)+'" del-box="'+idBtn+'"><div class="col-md-3 form-group" id="moreee"><input type="text" placeholder="Tên nhóm phân loại" class="form-control" id="namegroup[]"></div><div class="form-row col-6" id="grouptype" id-btn="'+idBtn+'"><div class="col-md-6 form-group"><input type="text" placeholder="Tên phân loại, vd: vàng, đỏ" class="form-control" id-btn="'+idBtn+'" id="codeproduct[]"></div><div class="col-md-6 form-group"><div class="input-group mb-3"><input type="number" id-btn="'+idBtn+'" placeholder="Giá bán" class="form-control" id="productprice[]"><div class="input-group-append"><span class="input-group-text"><sub>đ</sub></span></div></div></div></div><div class="col-md-3 form-group"><button type="button" class="btn btn-sm btn-primary" id="addcodeandval" id-btn="'+idBtn+'"><span class="material-icons">add</span></button><button class="btn btn-sm btn-primary" id="deletecodeandval" id-btn="'+idBtn+'"><span class="material-icons">delete_outline</span></button></div></div>')
      }
    })
    $('#frmdtaddproduct').on('click', '#deletecodeandval', function(e){
      e.preventDefault();
      idBtn = $(this).attr('id-btn');
      $(this).closest('div[del-box]').remove()
      idBtn=idBtn-1;
      typen=(typen>0)?typen-10:0;
    })
    $(document).on('click', 'button#addcodeandval', function(e){
      e.preventDefault()
      idBtn = $(this).attr('id-btn');
      typen = (typen<10)?typen+1:10
      if(typen==10){md.showNotification('warning','Đã đạt giới hạn') 
      }
      if(typen<10){
      $('#grouptype[id-btn="'+idBtn+'"]').append('<div class="form-row col-12" del-box="'+idBtn+'"><div class="col-md-6 form-group"><input type="text" placeholder="Tên phân loại, vd: vàng, đỏ" class="form-control" id-btn="'+idBtn+'" id="codeproduct[]"></div><div class="col-md-4 form-group"><div class="input-group mb-3"><input type="number" id-btn="'+idBtn+'" placeholder="Giá bán" class="form-control" id="productprice[]"><div class="input-group-append"><span class="input-group-text"><sub>đ</sub></span></div></div></div><div class="col-md-2"><button class="btn btn-sm btn-primary" id="deletecodeandval" id-btn="'+idBtn+'"><span class="material-icons">delete_outline</span></button></div></div>')
      }
    })
    function helptext(){
      var buy = $('input#buy').val(), saledown = $("#valsaledown").val(), type = $('#tsaledown').val();
      if(type=='%' && Number(saledown)>100){
          saledown = 100
          $('#valsaledown').val('100')
        }
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
      $('p.text-help').text('Mua từ '+buy+' giảm '+saledown+type);
    }
  $(document).ready(function(){

    //var myNicEditor = new nicEditor({buttonList : ['image', 'upload', 'link', 'unlink'], iconsPath : '/@admin/assets/js/nicEditorIcons.gif'})
    //myNicEditor.panelInstance('area-text');

      $("#btn_add_product").on('click', function(){
        $("#mdfrmproductadd").modal('show')
      })

      $('input[type="reset"]').on('click', function(){
        nicEditors.findEditor('area-text').setContent('');
      })

      $("input[id='btnsb_add']").on('click', function(e){
        e.preventDefault();
          var array_values = new Array()
          var lengthh = (idBtn==0)?0:idBtn-1
          for(let i = 0; i<=lengthh;i++){
            var valThis = $("#group"+i).find('input[id="namegroup[]"]').val().replace(/[&\/\\#,+()$~%.'":*?<>{}]/g, "");
            if(valThis!=""){
              array_values[i] = [valThis]
            var arr = [], price = '';
              var codeproduct = $('input[id="codeproduct[]"][id-btn="'+(i+1)+'"]').each(function(){
                var namecode = $(this).val().replace(/[&\\\#,+()$~%.'":*?<>{}]/g, "")
                  arr.push(namecode+price)
              })
              var j = 0;
              var productprice = $('input[id="productprice[]"][id-btn="'+(i+1)+'"]').each(function(){
                    if($(this).val()!=null){
                      var price = $(this).val()
                      price = (price!="")?'. '+price:'';

                      arr[j] += price
                    }
                    j = j + 1;
                })
              
                array_values[i].push(arr)
            }
          }

          var nproduct = $("input[name='nproduct']").val(), sale = $('input[name="sale"]').val(), amount = $('input[name="amount"]').val(), description = $('textarea[name="description"]').val(), city = $('select[name="city"]').val(), buy = $('input[name="buy"]').val(), valsaledown = $('input[name="valsaledown"]').val(), tsaledown = $('select[name="tsaledown"]').val(), actived = $('input[name="actived"]').val(), category = $('input[name="category"]:checked').val(), price = $('input[name="price"]').val()
          console.log(nproduct, sale, amount, description, city, buy, valsaledown, tsaledown)
            console.log(array_values, lengthh)
          /*var namegroup = $('input[name="namegroup[]"]').each(function(){
            var valThis = $(this).val();
            array_values.push(valThis)
            var box = $('#grouptype[id-btn]').each(function(){
              var id = Number($(this).attr('id-btn'))-1;
              var codeproduct = $('input[name="codeproduct[]"]').each(function(){
                console.log(id)
                console.log(array_values)
                console.log($(this).val())
                array_values.push($(this).val())
              })
            })
            i = i+1;
          })*/
          /*var arr = [
          ["Khổ giấy", ["A4", "A3"]],
          ["Mẫu", ["#1", "#2"]]
          ];
          console.log(arr[0][0])*/
          /*$('input[type=checkbox][id="categories"]').each( function() {
              if( $(this).is(':checked') ) {
                  array_values.push( $(this).val() );
              }
          });
          var arrayValues = array_values.join(',');*/
          if(array_values.length==0){
            console.log("Array is empty")
          }
          $.post('/admin/product/list/add', {nproduct:nproduct, sale:sale, price:price, amount:amount, description:description, city:city, buy:buy, valsaledown:valsaledown, tsaledown:tsaledown, actived:actived,category:category,type_product:array_values}, function(o){
            if(o.sts==1){
                md.showNotification('success', o.msg);
                $("#btn_update_lproduct").click();
            }else{
                md.showNotification('danger', o.msg);
            }
          }, 'json')
      })
      $("#btn_update_lproduct").on('click', function(){
        $.post('/admin/product/view.html', function(o){
            $("#dtloadingproduct").html(o)
        })
      });
    })
  </script>
</body>

</html>