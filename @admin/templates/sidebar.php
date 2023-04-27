<div class="sidebar" data-color="purple" data-background-color="white" data-image="../assets/img/sidebar-1.jpg">
    <div class="logo"><a href="/" class="simple-text logo-normal">
        2HK
      </a></div>
    <div class="sidebar-wrapper">
      <ul class="nav">
        <?php
        if($_SESSION['permission']==5){
        ?>
        <li class="nav-item <?=(!isset($to) && $_SESSION['permission'])?'active':0;?>">
          <a class="nav-link" href="/admin.html">
            <i class="material-icons">dashboard</i>
            <p>Dashboard</p>
          </a>
        </li>

        <li class="nav-item <?=(isset($to)&&$to=='coupon')?'active':0?>">
          <a class="nav-link" href="/admin/coupon/list.html">
            <i class="material-icons">line_style</i>
            <p>Mã Giảm Giá</p>
          </a>
        </li>
        <li class="nav-item <?=(isset($to)&&$to=='category')?'active':0?>">
          <a class="nav-link" href="/admin/category/list.html">
            <i class="material-icons">bookmark</i>
            <p>Danh Mục</p>
          </a>
        </li>
        <li class="nav-item <?=(isset($to)&&$to=='user')?'active':0?>">
          <a class="nav-link" href="/admin/user/list.html">
            <i class="material-icons">person</i>
            <p>Thành Viên</p>
          </a>
        </li>
      <?php } ?>
        <li class="nav-item <?=(isset($to)&&$to=='product')?'active':0?>">
          <a class="nav-link" href="/admin/product/list.html">
            <i class="material-icons">view_module</i>
            <p>Sản Phẩm</p>
          </a>
        </li>
        <li class="nav-item <?=(isset($to)&&$to=='images')?'active':0?>">
          <a href="/admin/images/list.html" class="nav-link">
            <i class="material-icons">photo</i>
            <p>Hình Ảnh</p>
          </a>
        </li>
        <li class="nav-item <?=(isset($to)&&$to=='order')?'active':0?>">
          <a class="nav-link" href="/admin/order/list.html">
            <i class="material-icons">shopping_cart</i>
            <p>Đơn Hàng</p>
          </a>
        </li>
        <li class="nav-item <?=(isset($to)&&$to=='shop')?'active':0?>">
          <a class="nav-link" href="/admin/shop/setting.html">
            <i class="material-icons">settings</i>
            <p>Cửa Hàng</p>
          </a>
        </li>
        <?php
        if($_SESSION['permission']==5){
        ?>
        <li class="nav-item <?=(isset($to)&&$to=='system')?'active':0?>">
          <a class="nav-link" href="/admin/system/setting.html">
            <i class="material-icons">desktop_windows</i>
            <p>Hệ Thống Admin</p>
          </a>
        </li>

        <?php
          }
        ?>
      </ul>
    </div>
  </div>