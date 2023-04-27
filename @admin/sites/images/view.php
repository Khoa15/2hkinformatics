<?php
if(isset($_SESSION['id']) && isset($_SESSION['permission'])){
    $id = $_SESSION['id'];
    $permit = $_SESSION['permission'];
    if(empty($id) || empty($permit) || $permit<3){
        echo "The request not found";
        return false;
    }
}
$sql = 'select `id`, `link`, `type`, `status` from `images`';
$page = 0;
if($permit < 5 and $permit > 2){
  $sql .= ' where `user_id`='.$id;
}
if(isset($_POST['filter']) && !empty($_POST['filter'])){
  $filter = htmlspecialchars($_POST['filter']);
  if($permit==5){
    $sql .= ' where `type`="'.$filter.'" ';
  }elseif($permit < 5 and $permit > 2){
    $sql .= ' and `type` = "'.$filter.'"';
  }
}
$sql .= ' order by `id` desc';
if(isset($_POST['rowcount'])){
$page = intval($_POST['rowcount']);
}
$sql .= ' LIMIT '.$page.', 15';
$list = $db->db_get_list($sql);
if(empty($list)){
  ?>
  <tr>
      <td colspan="3">Không có dữ liệu</td>
  </tr>
  <?php
}
foreach($list as $item):
?>
  <tr>
    <td>#<?=sprintf("%'03d",$item['id'])?></td>
    <td>
      <img src="<?=$item['link']?>" width="100" alt="">
    </td>
    <td>
      <?php
        switch ($item['type']) {
          case 2:
            $type="Banner";
            break;
          case 3:
            $type='Slide Ảnh';
            break;
          case 4:
            $type='Hình website';
            break;
          
          default:
            $type = 'Sản phẩm';
            break;
        }
        echo $type;
      ?>
        
    </td>
    <td>
      <button class="btn btn-<?=($item['status'])?'info':'warning'?> btn-round" title="<?=($item['type']==0)?'Ẩn':'Hiện'?>" id="viewimg" img-id="<?=$item['id']?>" sts-view="<?=$item['status']?>" onclick="changests(<?=$item['id']?>)">
        <i class="material-icons"><?=($item['status'])?'visibility':'visibility_off'?></i>
      </button>
    </td>
    <td>
      <a href="/admin/images/edit/<?=$item['id']?>.html" class="btn btn-primary btn-fab btn-fab-mini btn-round" title="Sửa">
      <i class="material-icons">edit</i>
      </a>
      <button class="btn btn-primary btn-fab btn-fab-mini btn-round" title="Xóa" onclick="delimg(<?=$item['id']?>)">
      <i class="material-icons">delete</i>
      </button>
      
    </td>
  </tr>
<?php endforeach; ?>