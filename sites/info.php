<?php
define('IN_SITE', true);
require_once('../c0nFig.php');
$uid = (isset($_SESSION['id'])) ? $_SESSION['id'] : 0;
$sql = 'select `surname`, `name`, `email`, `nbp`, `gender`, `dob` from `users` where `id`='.$uid;
$user = $db->db_get_row($sql);
$nam = ($user['gender']==0)?'checked':false;
$nu = ($user['gender']==1)?'checked':false;
$other = (!$nam && !$nu)?'checked':false;
$html = '<div class="container mt-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                      <ul class="nav user nav-pills nav-pills-vertical nav-pills-info" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <li class="nav-item">
                          <a class="nav-link active show" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-account" role="tab" aria-controls="account">
                            <i class="mdi mdi-account-outline"></i>
                            Tài Khoản
                          </a>                          
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-address" role="tab" aria-controls="address">
                            <i class="mdi mdi-home-outline"></i>
                            Địa Chỉ
                          </a>                          
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-order" role="tab" aria-controls="order">
                            <i class="mdi mdi-cart-outline"></i>
                            Đơn Hàng
                          </a>                          
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="v-pills-love-tab" data-toggle="pill" href="#v-pills-love" role="tab" aria-controls="love">
                            <i class="mdi mdi-heart-outline"></i>
                            Yêu Thích
                          </a>                          
                        </li>
                      </ul>
                    </div>
                    <div class="col-8">
                      <div class="tab-content tab-content-vertical" id="v-pills-tabContent">
                        <div class="tab-pane fade active show" id="v-pills-account" role="tabpanel" aria-labelledby="v-pills-account-tab">
                          <div class="media">
                            <form class="form-row" id="boxchanginfouser">
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label>Họ<span>*</span></label>
                                            <input name="fullname" class="form-control" type="text" value="'.$user['surname'].'">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label>Tên<span>*</span></label>
                                            <input name="name" class="form-control" type="text" value="'.$user['name'].'">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label>Email<span>*</span></label>
                                            <input class="form-control" type="email" value="'.str_pad(substr($user['email'], strlen($user['email'])/2), strlen($user['email']), "*", STR_PAD_LEFT).'" disabled>
                                        </div>  
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label>Số điện thoại<span>*</span></label>
                                            <input type="number" class="form-control" name="nbp" value="'.$user['nbp'].'" required>
                                        </div>  
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="form-check cs">
                                            <label>Giới tính<span>*</span></label>
                                            <div class="form-check">
                                                <label>
                                                  <input required type="radio" '.$nam.' name="sex" value="0" checked>
                                                  Nam
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <label>
                                                  <input required type="radio" '.$nu.' name="sex" id="optionsRadios1" value="1">
                                                  Nữ
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <label>
                                                  <input required type="radio" '.$other.' name="sex" id="optionsRadios1" value="2">
                                                  Khác
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="form-group">
                                            <label>Ngày sinh <span>*</span></label>
                                            <input type="date" class="form-control" value="'.$user['dob'].'" name="dob">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group button">
                                            <p id="addresspre"></p>
                                            <button type="submit" class="btn btn-gradient-primary" id="changeinfouser">Lưu</button>
                                            <a href="javascript:;" class="text-primary" data-toggle="modal" data-target="#changepsw">Đổi mật khẩu?</a>
                                        </div>
                                    </div>
                            </form>
                          </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-address" role="tabpanel" aria-labelledby="v-pills-address-tab">
                            <div class="media">
                                <div class="media-body">
                                  <div class="container">
                                      <div class="row" id="infoshow"> 
                                          
                                      </div>
                                  </div>

                                </div>
                            </div>
                          </div>
                      </div>
                    </div>
                  </div>
            </div>
        </div>
    </div>
                  <div class="modal fade" id="changepsw" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Đổi Mật Khẩu</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form id="boxchangepsw">
                            <div class="form-group">
                                <div class="alert alert-danger" id="error"></div>
                                <div class="alert alert-success" id="success"></div>
                            </div>
                            <div class="form-group">
                              <label>Mật khẩu cũ:<span class="text-danger">*</span></label>
                              <input type="password" name="oldpsw" class="form-control"/> 
                            </div>
                            <div class="form-group">
                              <label>Mật khẩu mới:<span class="text-danger">*</span></label>
                              <input type="password" name="psw" class="form-control"/> 
                            </div>
                            <div class="form-group">
                              <label>Nhập lại mật khẩu mới:<span class="text-danger">*</span></label>
                              <input type="password" name="repsw" class="form-control"/> 
                            </div>
                            </ul>
                            <div class="form-group text-right">
                              <input type="submit" class="btn btn-sm btn-info" id="accpsw" value="Lưu"/>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal fade" id="formcallback" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Yêu cầu trả hàng:</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form id="mainback">
                            <div class="form-group">
                                <div class="alert alert-danger" id="error"></div>
                                <div class="alert alert-success" id="success"></div>
                            </div>
                            <div class="form-group">
                              <textarea class="form-control" id="contentReason" rows="5" style="line-height: 20px" name="content" required cols="10" placeholder="Lý do"></textarea>
                            </div>
                            <div class="form-group">
                              <label>Ảnh/video:</label>
                              <input type="file" id="files" class="form-control" accept=".jpg,.jpeg,.png,.mp4,.mkv" multiple/>

                            </div>
                            <div class="form-group text-right">
                              <input type="submit" class="btn btn-sm btn-info" cart-id="" id="send" value="Gửi"/>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal fade" id="formvote" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Đánh Giá</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form id="mainvote">
                            <div class="form-group">
                                <div class="alert alert-danger" id="error"></div>
                                <div class="alert alert-success" id="success"></div>
                            </div>
                            <small class="text-muted text-center">Sau khi đánh giá, đơn hàng sẽ hoàn thành và bạn không thể yêu cầu trả hàng</small>
                            <div class="form-group">
                              <textarea class="form-control" rows="5" style="line-height: 20px" name="contentv" required cols="10"></textarea>
                            </div>
                            <ul class="ratings text-center">
                              <li class="star selected" score="5"></li>
                              <li class="star" score="4"></li>
                              <li class="star" score="3"></li>
                              <li class="star" score="2"></li>
                              <li class="star" score="1"></li>
                            </ul>
                            <div class="form-group text-right">
                              <input type="submit" class="btn btn-sm btn-info" cart-id="" id="accept" value="Đăng"/>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>';
    $title = 'Thông Tin Tài Khoản';
    $data = array('html'=>$html, 'title'=>$title);
    echo json_encode($data);
?>

