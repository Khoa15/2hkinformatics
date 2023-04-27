<?php
session_start();
    $html ='<div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
          <div class="content-wrapper bg-transparent d-flex align-items-center auth">
            <div class="row w-100">
              <div class="col-lg-6 mx-auto">
                <div class="form-main">
                    <div class="title">
                        <h3>Mở Cửa Hàng Của Chính Bạn</h3>
                    </div>
                    <form class="form" id="frm_register_shop" enctype="multipart/form-data" method="post">
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-danger" id="error"></div>
                                <div class="alert alert-success" id="success"></div>
                            </div>

                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label>Tên cửa hàng<span>*</span></label>
                                    <input required name="name" class="form-control" type="text" placeholder="">
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label>Số Điện Thoại<span>*</span></label>
                                    <input required name="phone" class="form-control" type="text" placeholder="">
                                </div>
                            </div>
                            <div class="col-lg-12 col-12">
                                <div class="form-group">
                                    <label>Email<span>*</span></label>
                                    <input required name="email" class="form-control" type="email" disabled="true" value="'.$_SESSION['email'].'" >
                                </div>	
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Địa chỉ:<span>*</span></label>
                                    <input required type="text" class="form-control" id="address" name="address">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Tỉnh/ thành:<span>*</span></label>
                                    <select name="city" id="city" class="form-control">
                                        <option>An Giang</option>
                                        <option>Bà Rịa - Vũng Tàu</option>
                                        <option>Bắc Kạn</option>
                                        <option>Bắc Giang</option>
                                        <option>Bạc Liêu</option>
                                        <option>Bắc Ninh</option>
                                        <option>Bến Tre</option>
                                        <option>Bình Dương</option>
                                        <option>Bình Định</option>
                                        <option>Bình Phước</option>
                                        <option>Bình Thuận</option>
                                        <option>Cà Mau</option>
                                        <option>Cần Thơ</option>
                                        <option>Cao Bằng</option>
                                        <option>Đà Nẵng</option>
                                        <option>Đắk Lắk</option>
                                        <option>Đắk Nông</option>
                                        <option>Điện Biên</option>
                                        <option>Đồng Nai</option>
                                        <option>Đồng Tháp</option>
                                        <option>Gia Lai</option>
                                        <option>Hà Giang</option>
                                        <option>Hà Nam</option>
                                        <option>Hà Nội</option>
                                        <option>Hà Tĩnh</option>
                                        <option>Hải Dương</option>
                                        <option>Hải Phòng</option>
                                        <option>Hậu Giang</option>
                                        <option selected>TP. Hồ Chí Minh</option>
                                        <option>Hòa Bình</option>
                                        <option>Hưng Yên</option>
                                        <option>Khánh Hòa</option>
                                        <option>Kiên Giang</option>
                                        <option>Kon Tum</option>
                                        <option>Lai Châu</option>
                                        <option>Lâm Đồng</option>
                                        <option>Lạng Sơn</option>
                                        <option>Lào Cai</option>
                                        <option>Long An</option>
                                        <option>Nam Định</option>
                                        <option>Nghệ An</option>
                                        <option>Ninh Bình</option>
                                        <option>Ninh Thuận</option>
                                        <option>Phú Thọ</option>
                                        <option>Phú Yên</option>
                                        <option>Quảng Bình</option>
                                        <option>Quảng Nam</option>
                                        <option>Quảng Ngãi</option>
                                        <option>Quảng Ninh</option>
                                        <option>Quảng Trị</option>
                                        <option>Sóc Trăng</option>
                                        <option>Sơn La</option>
                                        <option>Tây Ninh</option>
                                        <option>Thái Bình</option>
                                        <option>Thái Nguyên</option>
                                        <option>Thanh Hóa</option>
                                        <option>Thừa Thiên Huế</option>
                                        <option>Tiền Giang</option>
                                        <option>Trà Vinh</option>
                                        <option>Tuyên Quang</option>
                                        <option>Vĩnh Long</option>
                                        <option>Vĩnh Phúc</option>
                                        <option>Yên Bái</option>
                                    </select>
                                </div>	
                            </div>
                            <div class="col-12">
                                <div class="form-group button">
                                    <p id="addresspre"></p>
                                    <button type="submit" class="btn btn-gradient-primary">Đăng kí</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>';
    $title = 'Mở Shop';
      $data = array('title'=>$title, 'html'=>$html);
      echo json_encode($data);
  ?>