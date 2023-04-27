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
if($_SESSION['store']){
  $sql = 'select * from `stores` where `user_id` = '.$uid.' limit 1';
  $shop = $db->db_get_row($sql);
  $icon = $db->db_get_row('select `link` from images where id='.$shop['icon']);
  $cover = $db->db_get_row('select `link` from images where id='.$shop['cover']);
  $address = 'select `street`, `city`, `nbp` from address where `user_id`='.$uid.' and `store`=true limit 1';
  $address = $db->db_get_row($address);
}
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
    <link rel="icon" type="image/png" href="<?=$favicon?>">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
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
        <?php if($_SESSION['store']): ?>
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-warning card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">view_module</i>
                  </div>
                  <p class="card-category">Sản phẩm</p>
                  <h3 class="card-title"><?php $total = $db->db_get_row('select COUNT(id) as totalproduct from `products` where `store_id`='.$shop['id']); echo number_format($total['totalproduct'],0,',',',')?>
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
                    <i class="material-icons">store</i>
                  </div>
                  <p class="card-category">Số lượt thích</p>
                  <h3 class="card-title"><?=$db->num_rows('select `id` from `lstfollow` where `store_id`='.$shop['id']);?></h3>
                </div>
                <div class="card-footer">
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-danger card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">person</i>
                  </div>
                  <p class="card-category">ĐH Chưa Xử Lý</p>
                  <h3 class="card-title"><?=$db->num_rows('select `id` from `spcart` where status = 2')?></h3>
                </div>
                <div class="card-footer">
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-info card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">trending_up</i>
                  </div>
                  <p class="card-category">Điểm Đánh Giá</p>
                  <h3 class="card-title" data-toggle="modal" data-target="#commentlist"><?php $s = $db->db_get_row('select AVG(CASE WHEN score!=0 THEN score END) as sc, COUNT(CASE WHEN score!=0 THEN score END) as tt from `spcart` where `status`>=5 and `store_id`='.$shop['id']);echo number_format($s['sc'],1,'.','.')?></h3>
                </div>
                <div class="card-footer">
                  <?=(!empty($s['tt']))?'<strong>'.$s['tt'].'</strong> Lượt đánh giá':false?> 
                </div>
              </div>
            </div>
            <div class="col-md-6 col-sm-12">
              <div class="card">
                <div class="card-header card-header-primary"><h4>Thông tin cửa hàng:</h4></div>
                <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-hover">
                        <tbody>
                          <tr>
                            <td>Trạng thái:</td>
                            <td>
                              <div class="input-group">
                                <select class="form-control" id="status">
                                  <option value="0" <?=($shop['actived']==0)?'selected':false?>>Tạm dừng Bán</option>
                                  <option value="1" <?=($shop['actived']==1)?'selected':false?>>Bán Hàng</option>
                                </select>
                                <div class="input-group-prepend">
                                  <button type="submit" id="acceptstatus" class="btn btn-sm">Xác Nhận</button>
                                </div>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td>Tên cửa hàng:</td>
                            <td>
                              <div class="input-group">
                                <input type="text" id="name" class="form-control" value="<?=$shop['name']?>">
                                <div class="input-group-prepend">
                                  <button type="submit" id="acceptname" class="btn btn-sm">Xác Nhận</button>
                                </div>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td>Ảnh đại diện:</td>
                            <td>
                              <div class="input-group">
                                <input type="number" placeholder="Nhập id của ảnh" id="icon" class="form-control" value="<?=$shop['icon']?>">
                                <div class="input-group-prepend">
                                  <button type="submit" id="accepticon" class="btn btn-sm">Xác Nhận</button>
                                </div>
                              </div>
                              <img src="<?=$icon['link']?>" width="70" height="70" id="preicon">
                            </td>
                          </tr>
                          <tr>
                            <td>Ảnh bìa:</td>
                            <td>
                              <div class="input-group">
                                <input type="number" placeholder="Nhập id của ảnh" id="cover" class="form-control" value="<?=$shop['cover']?>">
                                <div class="input-group-prepend">
                                  <button type="submit" id="acceptcover" class="btn btn-sm">Xác Nhận</button>
                                </div>
                              </div>
                              <img src="<?=$cover['link']?>" width="140" height="80" id="precover">
                            </td>
                          </tr>
                          <tr>
                            <td>Số điện thoại:</td>
                            <td>

                              <div class="input-group">
                                <input type="number"  id="nbp" class="form-control" value="<?=(!empty($address['nbp']))?$address['nbp']:False?>">
                                <div class="input-group-prepend">
                                  <button type="submit" id="acceptstreet" class="btn btn-sm">Xác Nhận</button>
                                </div>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td>Địa chỉ:</td>
                            <td>
                              <div class="input-group">
                                <input type="text"  id="street" class="form-control" value="<?=(!empty($address['street']))?$address['street']:False?>">
                                <div class="input-group-prepend">
                                  <button type="submit" id="acceptstreet" class="btn btn-sm">Xác Nhận</button>
                                </div>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td>Tỉnh/ thành:</td>
                            <td>
                              <div class="input-group">
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
                            </td>
                          </tr>
                          <tr>
                            <td>Tạo lúc:</td>
                            <td><?=$shop['created_at']?></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-sm-12">
              <div class="card">
                <div class="card-header card-header-primary"><h4>Xếp hạng các cửa hàng</h4></div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>

                        <tr>
                          <!-- <td colspan="3">
                            <input type="text" class="form-control" id="searchkey" placeholder="Nhập tên cửa hàng...">
                          </td> -->
                        </tr>
                        <th>Hạng</th>
                        <th>Tên cửa hàng</th>
                        <th>Điểm <i class="material-icons" rel="tooltip" placement="top" title="Đơn hàng thành công + trung bình điểm đánh giá sản phẩm + lượt yêu thích của cửa hàng. Điều kiện cần tối thiểu một giao dịch thành công">error_outline</i></th>
                      </thead>
                      <tbody>
                        <!-- <tr>
                          <td>1</td>
                          <td>NghienDo</td>
                          <td>300</td>
                        </tr> -->
                      </tbody>
                      <tbody id="rank_stores">
                        
                      </tbody>
                      <tfoot>
                        <tr>
                          <td colspan="2">
                            <nav id="paginationimage">
                              <ul class="pagination justify-content-center">
                                <?php
                                  $sql = 'SELECT spcart.store_id, stores.name as name, COUNT(spcart.STATUS=5 OR spcart.STATUS=10)+AVG(spcart.score)+COUNT(CASE WHEN lstfollow.store_id!=0 AND lstfollow.store_id!=NULL Then lstfollow.store_id END) AS score FROM spcart,lstfollow, stores WHERE stores.id=spcart.store_id GROUP BY spcart.store_id ORDER BY score desc';
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
            <div class="col-12">
              <div class="container-fluid">
                <div class="row">
                  <?php
                    $sql = 'select YEAR(spcart.updated_at) as dateyear from `spcart`,`products` where products.store_id='.$shop['id'].' ';
                    if($_SESSION['permission']<5){
                      $sql.=' and spcart.store_id='.$shop['id'];
                    }
                    $sql.=' GROUP BY YEAR(spcart.updated_at)  ORDER BY spcart.id DESC';
                    $list = $db->db_get_list($sql);
                    if(!empty($list)){
                      foreach($list as $year):
                  ?>
                  <div class="col-12" id="chart">
                    <div class="card">
                      <div class="card-header card-header-primary"><h4>Doanh Thu Năm: <?=$year['dateyear']?></h4></div>
                      <div class="card-body">
                        <canvas id="myChart<?=$year['dateyear']?>" year="<?=$year['dateyear']?>"></canvas>
                        <?php
                        /*for($i = 1; $i <= 12 ; $i++){
                          $sql = 'select SUM(price*amount) as total from `spcart` where Month(`updated_at`)='.$i.' and `status`>=5 and `store_id`='.$shop['id'];
                          if($permit<5 && $permit > 2){
                            $sql .= ' and `user_id`='.$uid;
                          }
                          $product = $db->db_get_row($sql);
                          echo '<p>'.number_format($product['total'],0,',',',').' trong tháng <strong>'.$i.'</strong></p>';
                        }*/
                        ?>
                      </div>
                    </div>
                  </div>
                <?php endforeach;  } ?>
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
  <div class="modal fade" id="commentlist">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Danh Sách Hình Ảnh & Bình Luận</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body" style="max-height: 500px;overflow-y: auto">
          <?php
                $sql = 'select `score`, `evaluate`, `user_id`, `product_id` from spcart WHERE score!=0 order by id';
                $list = $db->db_get_list($sql);
                $i = 0;
                $html = null;
                foreach ($list as $item) {
                  $product = $db->db_get_row('select `name`,store_id from products where id='.$item['product_id']);
                  if(!empty($product)){
                          $sql ='select `name` from `users` where `id`='.$item['user_id'].' limit 1';
                          $user = $db->db_get_row($sql);
                          $score = $item['score'];
                          $namep = mb_substr($product['name'],0, 40, 'UTF-8');
                          $namep .= (strlen($product['name'])>40)?'...':false;
                      $html.='
                          <div class="col-12">
                              <div class="card">
                                  <div class="card-body">
                          <div class="author">
                              <img src="/assets/imgs/avatar.jpg" alt="image" class="avatar img-raised">
                              <span>'.$user['name'].' - '.$namep.'</span>
                          </div>
                                          <div class="interfere pb-2">
                                              <div class="score md float-left">';
                                              for($i = 5; $i >= 5-(4-$score); $i--){
                                                  $html .= '<span class="material-icons" score="'.$i.'">star</span>';
                                              }
                                              for($i = $score; $i >= 1; $i--){
                                                  $html .= '<span class="material-icons checked" score="'.$i.'">star</span>';
                                              }
                                                  
                                              $html.='</div>
                                          </div>
                                        <p class="mt-4 pt-2 text-muted">
                                        '.$item['evaluate'].'
                                        </p>                           
                                  </div>
                              </div>
                          </div>';
                    $i++;
                  }
                }
                echo $html;
              ?>
              
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
  <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>
  <script>
    var month = [];
    for(let i = 1; i <= 12; i++ ){
        month.push('Tháng: '+i)
    }
    $(document).ready(function(){
      $('.col-12#chart').each(function(){
        var year = $(this).find('canvas').attr('year');
        income(year)
      })

    })
    function income(year=new Date().getFullYear()){
      var valofmonth = []
      $.post('/admin/shop/income.html', function(o){
        for (var i = 1; i <= 12; i++) {
          valofmonth.push(Number(o[year][i]))
        }
        if(o.sts==1){
          console.log(year)
          var ctx = document.getElementById('myChart'+year).getContext('2d');
          var myChart = new Chart(ctx, {
            type: 'bar',
              data: {
                  labels: month,
                  datasets: [{
                      label: 'Doanh Thu',
                      data: valofmonth,
                      backgroundColor: 'rgba(54, 162, 235, 0.2)',
                      borderColor: 'rgba(54, 162, 235, 1)',
                      borderWidth: 1
                  }
              ]
              }
          });
        }
      }, 'json')
          
    }
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
      $('#rank_stores').html('<tr align="center"><td colspan="3"><img src="/assets/imgs/overlay.gif" alt=""></td></tr>')
        var search = $('#searchkey').val();
      if(timeout){
        clearTimeout(timeout)
      }
      timeout = setTimeout(function(){
        $.post('/admin/shop/rank_stores.html', {search:search,rowcount:count}, function(o){
          $('#rank_stores').html(o)
        })
      }, 300)
    }

    
    $(document).on('click','#acceptstreet', function(e){
      var street = $('#street').val(), nbp= $('#nbp').val(), city = $('#city').val();
      if(street=="" || nbp == "" || city == ""){
        errorfill()
        return false;
      }
      $.post('/admin/shop/setting/updateaddress', {city:city,street:street,nbp:nbp}, function(o){
        md.showNotification((o.sts==1)?'success':'danger',o.msg)
      }, 'json')
    })
    $('#acceptname').on('click', function(e){
      var name = $('#name').val();
      if(name==""){
        errorfill()
        return false;
      }
      $.post('/admin/shop/setting/update', {name:name}, function(o){
        md.showNotification((o.sts==1)?'success':'danger',o.msg)
      }, 'json')
    })

    $('#acceptstatus').on('click', function(e){
      var status = $('#status').val();
      $.post('/admin/shop/setting/update', {status:status}, function(o){
        md.showNotification((o.sts==1)?'success':'danger',o.msg)
      }, 'json')
    })

    $('#accepticon').on('click', function(e){
      var icon = $('#icon').val();
      var cover = $('#cover').val();
      if(icon==""){
        errorfill()
        return false;
      }
      if(cover == icon){
        errorfill('Ảnh đại diện và ảnh bìa phải khác nhau');
        return false;
      }
      $.post('/admin/shop/setting/update', {icon:icon}, function(o){
        md.showNotification((o.sts==1)?'success':'danger',o.msg)
        if(o.icon){
          $('#preicon').attr('src', o.icon);
        }
      }, 'json')
    })
    $('#acceptcover').on('click', function(e){
      var cover = $('#cover').val();
      var icon = $('#icon').val();
      if(cover==""){
        errorfill()
        return false;
      }
      if(cover == icon){
        errorfill('Ảnh đại diện và ảnh bìa phải khác nhau');
        return false;
      }
      $.post('/admin/shop/setting/update', {cover:cover}, function(o){
        md.showNotification((o.sts==1)?'success':'danger',o.msg)
        if(o.cover){
          $('#precover').attr('src', o.cover);
        }
      }, 'json')
    })
    function errorfill(o='Bạn chưa nhập gì cả mà'){
      md.showNotification('danger', o)
    }
  </script>
</body>

</html>