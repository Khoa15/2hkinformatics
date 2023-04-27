<?php
$title = 'Đăng Nhập';
  $html = '<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper bg-transparent d-flex align-items-center auth">
        <div class="row w-100">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left p-5">
                <div class="title">
                    <a href="/"><h4><i class="mdi mdi-home"></i>Trang chủ</h4></a>
                </div>
              <form class="pt-3" id="frm_login">
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg" required name="email" placeholder="Email...">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" required name="psw" placeholder="Password...">
                </div>
                <div class="mt-3">
                  <button type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" >SIGN IN</button>
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                    </label>
                  </div>
                  
                </div>
                <div class="text-center mt-4 font-weight-light">
                  Chưa có tài khoản? <a href="javascript:;" to="dang-ky.html" class="text-primary" single-page="true">Đăng Ký Ngay</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>';
  $data = array('title'=>$title, 'html'=>$html);
  echo json_encode($data);
?>
