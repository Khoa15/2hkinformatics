<?php
if(isset($_GET['id']) && !empty($_GET['id'])){
  $product = true;
  $id = htmlspecialchars($_GET['id']);
  $sql = 'select * from `products` where `id`='.$id;
  $item = $db->db_get_row($sql);
  if(empty($item)){
    $product = false;
  }
  $warning = false;
  if($_SESSION['store'] != $item['store_id'] && $_SESSION['permission']==5){
    $warning = 'Bạn không đăng mặt hàng này! Bạn có chắc muốn sửa chứ?';
  }elseif($_SESSION['permission']!=5 and $_SESSION['store'] != $item['store_id']){
    echo "<h1>Không tìm thấy sản phẩm</h1>";
    exit();
  }
?>
<!-- Material Dashboard by) Creative Tim -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Chỉnh Sửa Thông Tin Sản Phẩm - Control Panel
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
                    <form id="frmdtaddproduct">
                      <?php
                              if($product):

                                $sql = 'select `name` from `stores` where `id`='.$item['store_id'];
                                $info = $db->db_get_row($sql);
                                $discount = preg_replace('/[0-9]+/', '', $item['discount']);
                          ?>
                            <div class="form-group">
                              <div class="row">
                                <label class="col-12">Danh mục:</label>

                                <?php
                                    $sql = 'select `id`, `name` from `categories` where `actived`=true order by `id`';
                                    $list = $db->db_get_list($sql);
                                    $hidden = (empty($list))?"hidden":false;
                                    foreach($list as $ncategory):
                                    ?>
                                    <label class="col-lg-3 col-md-4 col-sm-5 col-6"><input type="radio" name="category" <?=($item['category_id']==$ncategory['id'])?'checked':false?> value="<?=$ncategory['id']?>" id="categories"><?=$ncategory['name']?></label>
                                <?php endforeach; ?>
                              </div>
                            </div>
                            <?=($hidden)?"Cần có danh mục để thực hiện":false?>
                        <div class="row <?=$hidden?>">
                          
                          <input type="hidden" value="<?=$id?>" name="id">
                            <div class="col-md-3 form-group">
                              <input type="text" class="form-control" maxlength="120" value="<?=$item['name']?>" placeholder="Tên sản phẩm" name="nproduct">
                            </div>
                            <div class="col-md-3 form-group">
                              <input type="number" class="form-control" name="sale" placeholder="% Khuyến mãi" value="<?=$item['sale']?>">
                              <span class="text-right form-text text-muted">
                                %
                              </span>
                            </div>
                            <div class="col-md-3 form-group">
                                <div class="input-group mb-3">
                                  <input type="number" placeholder="Giá bán" value="<?=$item['price']?>" class="form-control" name="price">
                                  <div class="input-group-append">
                                    <span class="input-group-text"><sub>đ</sub></span>
                                  </div>
                                </div>
                            </div>
                            <div class="col-md-3 form-group">
                                <input type="number" class="form-control" value="<?=$item['amount']?>" name="amount" placeholder="Số lượng">
                            </div>
                            <div class="col-md-12 form-group">
                                <textarea style="white-space: pre-wrap;" name="description" id="area-text" class="form-control" cols="30" rows="15" placeholder="Mô tả chi tiết"><?=strip_tags($item['description'])?></textarea>
                            </div>
                            <div class="col-md-4 form-group">
                              <label>Cửa hàng thêm:</label>
                              <input type="text" disabled class="form-control" value="<?=$info['name']?>">
                            </div>
                            <div class="col-md-4 form-group">
                              <label>Thêm lúc:</label>
                              <input type="text" disabled class="form-control" value="<?=$item['created_at']?>">
                            </div>
                            <div class="col-md-4 form-group">
                              <label>Cập nhật lúc:</label>
                              <input type="text" disabled class="form-control" value="<?=$item['updated_at']?>">
                            </div>
                            <hr>
                        </div>
                        <?php
                          $sql = 'select * from types_of_products where `product_id`='.$id.' GROUP BY name ORDER BY id ASC';
                          $list = $db->db_get_list($sql);
                          if(empty($list)){
                        ?>

                          <div class="form-row <?=$hidden?>" id="typeproduct">
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
                        <?php
                          }else{
                          $i = 1;
                        ?>
                        <div class="form-row" id="typeproduct">
                          <?php
                          foreach ($list as $type) {
                        ?>
                            <div class="form-row col-12 <?=$hidden?>" id="group<?=($i-1)?>" <?=($i>1)?'del-box="'.($i+1).'"':false?>>
                              <div class="col-md-3 form-group">
                                  <input type="text" placeholder="Tên nhóm phân loại, vd: màu sắc" class="form-control" value="<?=$type['name']?>" id="namegroup[]">
                              </div>
                              <div class="form-row col-6" id="grouptype" id-btn="<?=$i?>">
                                <div class="col-md-6 form-group">
                                      <input type="text" id-btn="<?=$i?>" placeholder="Tên phân loại, vd: vàng" class="form-control" value="<?=$type['type']?>" id="codeproduct[]">
                                </div>
                                <div class="col-md-6 form-group">
                                    <div class="input-group mb-3">
                                      <input type="number" id-btn="<?=$i?>" placeholder="Giá bán" class="form-control" value="<?=$type['price']?>" id="productprice[]">
                                      <div class="input-group-append">
                                        <span class="input-group-text"><sub>đ</sub></span>
                                      </div>
                                    </div>

                                <input type="hidden" id="idtype" value="<?=$type['id']?>">
                                </div>
                              <?php
                                $sql = 'select `type`, `price` from types_of_products where `product_id`='.$id.' and id!='.$type['id'].' and name = "'.$type['name'].'"';
                                $list = $db->db_get_list($sql);
                                foreach ($list as $type) {
                              ?>
                              <div class="form-row col-12" del-box="<?=$i?>">
                                <div class="col-md-6 form-group">
                                    <input type="text" placeholder="Tên phân loại, vd: vàng, đỏ" class="form-control" id-btn="<?=$i?>" value="<?=$type['type']?>" id="codeproduct[]">
                                </div>
                                <div class="col-md-4 form-group">
                                    <div class="input-group mb-3">
                                        <input type="number" id-btn="<?=$i?>" placeholder="Giá bán" class="form-control" value="<?=$type['price']?>" id="productprice[]">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><sub>đ</sub></span>
                                        </div>
                                    </div>

                                <input type="hidden" id="idtype" id-btn="<?=$i?>" value="<?=$type['id']?>">
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-sm btn-primary" id="deletecodeandval" id-btn="<?=$i?>">
                                        <span class="material-icons">delete_outline</span>
                                    </button>
                                </div>
                            </div>
                              <?php } ?>
                              </div>

                              
                              <!-- <div class="col-md-3 form-group">
                                    <button type="button" class="btn btn-sm btn-primary" id="addcodeandval" id-btn="<?=$i?>">
                                      <span class="material-icons">add</span>
                                    </button>
                              </div> -->
                              <div class="col-md-3 form-group <?=$hidden?>">
                                <button type="button" class="btn btn-sm btn-primary" id="addcodeandval" id-btn="<?=$i?>">
                                  <span class="material-icons">add</span>
                                </button>
                                <?php if($i>1): ?>
                                <button class="btn btn-sm btn-primary" id="deletecodeandval" id-btn="<?=$i?>">
                                  <span class="material-icons">delete_outline</span></button>
                                <?php endif; ?>
                              </div>
                            </div>
                          <?php
                             $i++;} 
                          ?>

                          </div>
                          <?php
                            }
                          ?>
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
                                            <option <?=(!empty($item['fcity']) && $item['fcity'] == 'An Giang')? 'selected':false?>>An Giang</option>
                                            <option <?=(!empty($item['fcity']) && $item['fcity'] == 'Bà Rịa - Vũng Tàu')? 'selected':false?>>Bà Rịa - Vũng Tàu</option>
                                            <option <?=(!empty($item['fcity']) && $item['fcity'] == 'Bắc Kạn')? 'selected':false?>>Bắc Kạn</option>
                                            <option <?=(!empty($item['fcity']) && $item['fcity'] == 'Bắc Giang')? 'selected':false?>>Bắc Giang</option>
                                            <option <?=(!empty($item['fcity']) && $item['fcity'] == 'Bạc Liêu')? 'selected':false?>>Bạc Liêu</option>
                                            <option <?=(!empty($item['fcity']) && $item['fcity'] == 'Bắc Ninh')? 'selected':false?>>Bắc Ninh</option>
                                            <option <?=(!empty($item['fcity']) && $item['fcity'] == 'Bến Tre')? 'selected':false?>>Bến Tre</option>
                                            <option <?=(!empty($item['fcity']) && $item['fcity'] == 'Bình Dương')? 'selected':false?>>Bình Dương</option>
                                            <option <?=(!empty($item['fcity']) && $item['fcity'] == 'Bình Định')? 'selected':false?>>Bình Định</option>
                                            <option <?=(!empty($item['fcity']) && $item['fcity'] == 'Bình Phước')? 'selected':false?>>Bình Phước</option>
                                            <option <?=(!empty($item['fcity']) && $item['fcity'] == 'Bình Thuận')? 'selected':false?>>Bình Thuận</option>
                                            <option <?=(!empty($item['fcity']) && $item['fcity'] == 'Cà Mau')? 'selected':false?>>Cà Mau</option>
                                            <option <?=(!empty($item['fcity']) && $item['fcity'] == 'Cần Thơ')? 'selected':false?>>Cần Thơ</option>
                                            <option <?=(!empty($item['fcity']) && $item['fcity'] == 'Cao Bằng')? 'selected':false?>>Cao Bằng</option>
                                            <option <?=(!empty($item['fcity']) && $item['fcity'] == 'Đà Nẵng')? 'selected':false?>>Đà Nẵng</option>
                                            <option <?=(!empty($item['fcity']) && $item['fcity'] == 'Đắk Lắk')? 'selected':false?>>Đắk Lắk</option>
                                            <option <?=(!empty($item['fcity']) && $item['fcity'] == 'Đắk Nông')? 'selected':false?>>Đắk Nông</option>
                                            <option <?=(!empty($item['fcity']) && $item['fcity'] == 'Điện Biên')? 'selected':false?>>Điện Biên</option>
                                            <option <?=(!empty($item['fcity']) && $item['fcity'] == 'Đồng Nai')? 'selected':false?>>Đồng Nai</option>
                                            <option <?=(!empty($item['fcity']) && $item['fcity'] == 'Đồng Tháp')? 'selected':false?>>Đồng Tháp</option>
                                            <option <?=(!empty($item['fcity']) && $item['fcity'] == 'Gia Lai')? 'selected':false?>>Gia Lai</option>
                                            <option <?=(!empty($item['fcity']) && $item['fcity'] == 'Hà Giang')? 'selected':false?>>Hà Giang</option>
                                            <option <?=(!empty($item['fcity']) && $item['fcity'] == 'Hà Nam')? 'selected':false?>>Hà Nam</option>
                                            <option <?=(!empty($item['fcity']) && $item['fcity'] == 'Hà Nội')? 'selected':false?>>Hà Nội</option>
                                            <option <?=(!empty($item['fcity']) && $item['fcity'] == 'Hà Tĩnh')? 'selected':false?>>Hà Tĩnh</option>
                                            <option <?=(!empty($item['fcity']) && $item['fcity'] == 'Hải Dương')? 'selected':false?>>Hải Dương</option>
                                            <option <?=(!empty($item['fcity']) && $item['fcity'] == 'Hải Phòng')? 'selected':false?>>Hải Phòng</option>
                                            <option <?=(!empty($item['fcity']) && $item['fcity'] == 'Hậu Giang')? 'selected':false?>>Hậu Giang</option>
                                            <option <?=(!empty($item['fcity']) && $item['fcity'] == 'TP. Hồ Chí Minh')? 'selected':false?>>TP. Hồ Chí Minh</option>
                                            <option <?=(!empty($item['fcity']) && $item['fcity'] == 'Hòa Bình')? 'selected':false?>>Hòa Bình</option>
                                            <option <?=(!empty($item['fcity']) && $item['fcity'] == 'Hưng Yên')? 'selected':false?>>Hưng Yên</option>
                                            <option <?=(!empty($item['fcity']) && $item['fcity'] == 'Khánh Hòa')? 'selected':false?>>Khánh Hòa</option>
                                            <option <?=(!empty($item['fcity']) && $item['fcity'] == 'Kiên Giang')? 'selected':false?>>Kiên Giang</option>
                                            <option <?=(!empty($item['fcity']) && $item['fcity'] == 'Kon Tum')? 'selected':false?>>Kon Tum</option>
                                            <option <?=(!empty($item['fcity']) && $item['fcity'] == 'Lai Châu')? 'selected':false?>>Lai Châu</option>
                                            <option <?=(!empty($item['fcity']) && $item['fcity'] == 'Lâm Đồng')? 'selected':false?>>Lâm Đồng</option>
                                            <option <?=(!empty($item['fcity']) && $item['fcity'] == 'Lạng Sơn')? 'selected':false?>>Lạng Sơn</option>
                                            <option <?=(!empty($item['fcity']) && $item['fcity'] == 'Lào Cai')? 'selected':false?>>Lào Cai</option>
                                            <option <?=(!empty($item['fcity']) && $item['fcity'] == 'Long An')? 'selected':false?>>Long An</option>
                                            <option <?=(!empty($item['fcity']) && $item['fcity'] == 'Nam Định')? 'selected':false?>>Nam Định</option>
                                            <option <?=(!empty($item['fcity']) && $item['fcity'] == 'Nghệ An')? 'selected':false?>>Nghệ An</option>
                                            <option <?=(!empty($item['fcity']) && $item['fcity'] == 'Ninh Bình')? 'selected':false?>>Ninh Bình</option>
                                            <option <?=(!empty($item['fcity']) && $item['fcity'] == 'Ninh Thuận')? 'selected':false?>>Ninh Thuận</option>
                                            <option <?=(!empty($item['fcity']) && $item['fcity'] == 'Phú Thọ')? 'selected':false?>>Phú Thọ</option>
                                            <option <?=(!empty($item['fcity']) && $item['fcity'] == 'Phú Yên')? 'selected':false?>>Phú Yên</option>
                                            <option <?=(!empty($item['fcity']) && $item['fcity'] == 'Quảng Bình')? 'selected':false?>>Quảng Bình</option>
                                            <option <?=(!empty($item['fcity']) && $item['fcity'] == 'Quảng Nam')? 'selected':false?>>Quảng Nam</option>
                                            <option <?=(!empty($item['fcity']) && $item['fcity'] == 'Quảng Ngãi')? 'selected':false?>>Quảng Ngãi</option>
                                            <option <?=(!empty($item['fcity']) && $item['fcity'] == 'Quảng Ninh')? 'selected':false?>>Quảng Ninh</option>
                                            <option <?=(!empty($item['fcity']) && $item['fcity'] == 'Quảng Trị')? 'selected':false?>>Quảng Trị</option>
                                            <option <?=(!empty($item['fcity']) && $item['fcity'] == 'Sóc Trăng')? 'selected':false?>>Sóc Trăng</option>
                                            <option <?=(!empty($item['fcity']) && $item['fcity'] == 'Sơn La')? 'selected':false?>>Sơn La</option>
                                            <option <?=(!empty($item['fcity']) && $item['fcity'] == 'Tây Ninh')? 'selected':false?>>Tây Ninh</option>
                                            <option <?=(!empty($item['fcity']) && $item['fcity'] == 'Thái Bình')? 'selected':false?>>Thái Bình</option>
                                            <option <?=(!empty($item['fcity']) && $item['fcity'] == 'Thái Nguyên')? 'selected':false?>>Thái Nguyên</option>
                                            <option <?=(!empty($item['fcity']) && $item['fcity'] == 'Thanh Hóa')? 'selected':false?>>Thanh Hóa</option>
                                            <option <?=(!empty($item['fcity']) && $item['fcity'] == 'Thừa Thiên Huế')? 'selected':false?>>Thừa Thiên Huế</option>
                                            <option <?=(!empty($item['fcity']) && $item['fcity'] == 'Tiền Giang')? 'selected':false?>>Tiền Giang</option>
                                            <option <?=(!empty($item['fcity']) && $item['fcity'] == 'Trà Vinh')? 'selected':false?>>Trà Vinh</option>
                                            <option <?=(!empty($item['fcity']) && $item['fcity'] == 'Tuyên Quang')? 'selected':false?>>Tuyên Quang</option>
                                            <option <?=(!empty($item['fcity']) && $item['fcity'] == 'Vĩnh Long')? 'selected':false?>>Vĩnh Long</option>
                                            <option <?=(!empty($item['fcity']) && $item['fcity'] == 'Vĩnh Phúc')? 'selected':false?>>Vĩnh Phúc</option>
                                            <option <?=(!empty($item['fcity']) && $item['fcity'] == 'Yên Bái')? 'selected':false?>>Yên Bái</option>
                                        </select>
                                </div>
                                <div class="form-group mt-5 col-md-3 ">
                                    <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" name="freeship" type="checkbox" value="1" <?=($item['freeship'])?'checked':false?>>
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
                                    <input type="number" id="buy" value="<?=$item['bfrom']?>" min="0" oninput="helptext()" name="buy" class="form-control">
                                  </div>
                                  <div class="form-group col-6">
                                    <label for="buy">Giảm:</label>
                                    <div class="input-group">
                                      <input type="number" name="valsaledown" value="<?=(int)trim('%đ',$item['discount'])?>" min="0" oninput="helptext()" id="valsaledown" class="form-control">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text">
                                          <select name="tsaledown" onchange="helptext()" id="tsaledown">
                                            <option value="%" <?=($discount=='%')?'selected':false?>>%</option>
                                            <option value="đ" <?=($discount=='đ')?'selected':false?>>đ</option>
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
                                    <input class="form-check-input" name="actived" <?=($item['actived'])?'checked':false?> type="checkbox" value="1">
                                    Hiện
                                    <span class="form-check-sign">
                                        <span class="check"></span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <strong><p class="text-danger <?=$hidden?>"><?=$warning?></p></strong>
                        <input type="submit" class="btn btn-primary <?=$hidden?>" value="Lưu" id="btnsb_update">
                          <?php
                        else:
                          echo '<p class="text-danger">Sản phẩm không tồn tại</p>';
                              endif;
                            }
                          ?>
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
  <script type="text/javascript" src="/@admin/assets/js/plugins/nicEdit.js"></script>
  <script>
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
    })
    $(document).on('click', 'button#addcodeandval', function(e){
      e.preventDefault()
      idBtn = $(this).attr('id-btn');
      $('#grouptype[id-btn="'+idBtn+'"]').append('<div class="form-row col-12" del-box="'+idBtn+'"><div class="col-md-6 form-group"><input type="text" placeholder="Tên phân loại, vd: vàng, đỏ" class="form-control" id-btn="'+idBtn+'" id="codeproduct[]"></div><div class="col-md-4 form-group"><div class="input-group mb-3"><input type="number" id-btn="'+idBtn+'" placeholder="Giá bán" class="form-control" id="productprice[]"><div class="input-group-append"><span class="input-group-text"><sub>đ</sub></span></div></div></div><div class="col-md-2"><button class="btn btn-sm btn-primary" id="deletecodeandval" id-btn="'+idBtn+'"><span class="material-icons">delete_outline</span></button></div></div>')
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
      //var myNicEditor = new nicEditor({buttonList : ['image', 'upload', 'link', 'unlink', 'removeformat'], iconsPath : '/@admin/assets/js/nicEditorIcons.gif'})
      //myNicEditor.panelInstance('area-text');

      $("input[id='btnsb_update']").on('click', function(e){
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
          var nproduct = $("input[name='nproduct']").val(), sale = $('input[name="sale"]').val(), amount = $('input[name="amount"]').val(), description = $('textarea[name="description"]').val(), city = $('select[name="city"]').val(), buy = $('input[name="buy"]').val(), valsaledown = $('input[name="valsaledown"]').val(), tsaledown = $('select[name="tsaledown"]').val(), actived = Number($("input[name='actived']").prop("checked")), category = $('input[name="category"]:checked').val(), price = $('input[name="price"]').val(), id = $("input[name='id']").val()
          var data = $("#frmdtaddproduct").serialize(), type;
          if(amount==0||amount==""){md.showNotification('danger', 'Kiểm tra số lượng bán hàng');return}
          $.post('/admin/product/list/update', {id:id,nproduct:nproduct, sale:sale, price:price, amount:amount, description:description, city:city, buy:buy, valsaledown:valsaledown, tsaledown:tsaledown, actived:actived,category:category,type_product:array_values}, function(o){
            type = (o.sts==1)?'success':'danger';
            md.showNotification(type, o.msg);
          }, 'json')
      })
    })
  </script>
</body>

</html>