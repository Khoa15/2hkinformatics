<?php
$title = 'Không tìm thấy tài khoản';
if(isset($_GET['id']) && !empty($_GET['id'])){
  $id = intval($_GET['id']);
  $sql = 'select * from `users` where `id`='.$id;
  $user = $db->db_get_row($sql);
  $title = 'Thông Tin Tài Khoản '.$user['name'];
  $store = $db->db_get_row('select name from stores where user_id='.$id);
  $store = (!empty($store['name']))?$store['name']:'Không có';
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
    <?=$title?> - Control Panel
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
            <div class="col-md-6 col-sm-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">Thông tin cơ bản: <strong><?=$user['name']?></strong></h4>
                  <p class="card-category"> </p>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-bordered table-hovered">
                        <tbody>
                          <tr>
                            <td>Họ:</td>
                            <td><?=$user['surname']?></td>
                            <td>Tên:</td>
                            <td><?=$user['name']?></td>
                          </tr>
                          <tr>
                            <td>Email:</td>
                            <td><?=$user['email']?></td>
                            <td>Sđt:</td>
                            <td><?=$user['nbp']?></td>
                          </tr>
                          <tr>
                            <td>Giới tính:</td>
                            <td><?=($user['gender']==1)?'Nữ':'Nam'?></td>
                            <td>Sinh Nhật:</td>
                            <td><?=$user['dob']?></td>
                          </tr>
                          <tr>
                          <td>Ngày tham gia:</td>
                          <td><?=$user['created_at']?></td>
                          <td>Hoạt động mới nhất:</td>
                          <td><?=$user['updated_at']?></td>
                          </tr>
                          <tr>
                            
                            <td>Quyền:</td>
                            <td>
                              <?php
                                echo "<strong";
                                  switch($user['permission']){
                                    case 0:
                                      $type = " class='text-danger'>Khóa";
                                      break;
                                    case 2:
                                      $type = " class='text-info'>VIP";
                                      break;
                                    case 3:
                                      $type = " class='text-info'>CTV";
                                      break;
                                    case 4:
                                      $type = " class='text-info'>CTV2";
                                      break;
                                    case 5:
                                      $type = " class='text-info'>Administrator";
                                      break;
                                    default:
                                      $type = " class='text-primary'>Thường";
                                  }
                                  echo $type.'</strong>';
                                ?>
                            </td>
                            <td>Cửa Hàng:</td>
                            <td><?=$store?></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                </div>
              </div>
            </div>
            <div class="col-sm-12 col-md-6">
              <div class="card">
                <div class="card-header  card-header-primary">
                  <h4 class="card-title">Địa Chỉ:</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <th>Tên</th>
                        <th>Số Điện Thoại</th>
                        <th>Địa Chỉ</th>
                        <th>Tỉnh/Thành</th>
                      </thead>
                      <tbody>
                        <?php
                          $sql = 'select * from `address` where `user_id`='.$id;
                          $list = $db->db_get_list($sql);
                          foreach ($list as $address):
                        ?>
                        <tr>
                          <td><?=$address['fullname']?></td>
                          <td><?=$address['nbp']?></td>
                          <td><?=$address['street']?></td>
                          <td><?=$address['city']?></td>
                        </tr>
                      <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-12 col-md-6">
              <div class="card">
                <div class="card-header  card-header-info">
                  <h4 class="card-title">Giỏ hàng:</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <th>Sản Phẩm</th>
                        <th>Giá</th>
                        <th>S.lượng</th>
                        <th>Tổng</th>
                      </thead>
                      <tbody>
                        <?php
                          $sql = 'select * from `spcart` where`status`=1 and `user_id`='.$id;
                          $list = $db->db_get_list($sql);
                          foreach ($list as $spcart):
                            $product = $db->db_get_row('select `name` from `products` where `id`='.$spcart['product_id']);
                        ?>
                        <tr>
                          <td><?=$product['name']?></td>
                          <td><?=number_format($spcart['price'],0,',',',')?><sup>đ</sup></td>
                          <td><?=$spcart['amount']?></td>
                          <td><?=number_format($spcart['amount']*$spcart['price'],0,',',',')?><sup>đ</sup></td>
                        </tr>
                      <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-12 col-md-6">
              <div class="card">
                <div class="card-header  card-header-success">
                  <h4 class="card-title">Đơn hàng:</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <th>Sản Phẩm</th>
                        <th>Trạng Thái</th>
                      </thead>
                      <tbody>
                        <?php
                          $sql = 'select `id`, `amount`, `price`, `status`, `product_id` from `spcart` where `user_id`='.$id;
                          $order = $db->db_get_list($sql);
                          foreach($order as $item){
                              /*$cart = $db->db_get_row('select `amount`, `price`, `product_id` from `spcart` where id='.$cartid);*/
                              $product = $db->db_get_row('select `id`,`name` from `products` where `id`='.$item['product_id']);
                        ?>
                          <tr>
                            
                            <td><a href='/admin/order/view-detail/<?=$id?>.html'><?=$product['name']?></a><a href="/product-detail.html?i=<?=$product['id']?>"><i class="material-icons">open_in_new</i></a></td>
                            <td><?php

                              switch($item['status']){

                                case 0:

                                  $type = "Hủy";

                                  break;

                                case 2:

                                  $type = "Đã xác nhận";

                                  break;

                                case 3:

                                  $type = "Đang vận chuyển";

                                  break;

                                case 4:

                                  $type = "Hàng lỗi";

                                  break;

                                case 5:

                                  $type = "Đổi trả";

                                  break;

                                default:

                                  $type = "Chưa xác nhận đơn hàng";

                              }

                              echo "<strong class='text-info'>".$type.'</strong>';

                            ?></td>
                          </tr>
                          <!-- <tr class="bg-light">
                            <td> <i class="material-icons">minimize</i><a href="/admin/product/edit/<?=$product['id']?>.html" class="text-dark"><?=mb_substr($product['name'],0, 50, 'UTF-8')?><?=(strlen($product['name'])>50)?'...':false?></a></td>
                            <td><?=number_format($item['price'],0,',',',')?> x <?=$item['amount']?></td>
                          </tr> -->
                        <?php

                          }
                        ?>
                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <!-- <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-info">
                  <div class="card-title">Cửa Hàng:</div>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table"></table>
                  </div>
                </div>
              </div>
            </div> -->
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
  <!--  Plugin for Sweet Alert -->
  <script src="/@admin/assets/js/plugins/sweetalert2.js"></script>
  <!--  Notifications Plugin    -->
  <script src="/@admin/assets/js/plugins/bootstrap-notify.js"></script>
  <script src="/@admin/assets/js/material-dashboard.js"></script>
</body>

</html>