<?php
if(isset($_SESSION['id']) && isset($_SESSION['permission'])){
    $id = $_SESSION['id'];
    $permit = $_SESSION['permission'];
    if(empty($id) || empty($permit) || $permit<3){
        echo "The request not found";
        return false;
    }
}
$page = 0;
$store = $db->db_get_row('select id from stores where user_id='.$_SESSION['id']);
$sql = 'select `id`, `name`, `amount`, `price`, `store_id`, `actived`, `sale` from products  ';
if($_SESSION['permission']!=5){
  $sql .= 'where `store_id`='.$store['id'];
  if(isset($_POST['search']) && !empty($_POST['search'])){
    $sql .= '  and  ';
  }
}if($_SESSION['permission']==5 && isset($_POST['search']) && !empty($_POST['search']) && $_POST['search']!=" "){
  $sql .= ' where ';
}
if(isset($_POST['search']) && !empty($_POST['search']) && $_POST['search']!=" "){
  $search = htmlspecialchars($_POST['search']);
  $sql .= ' `name` LIKE "%'.$search.'%"';
}
$sql .=' order by id desc';
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
  $store = $db->db_get_row('select `name`, `user_id` from `stores` where `id`='.$item['store_id']);
?>
  <tr>
    <td>#<?=sprintf("%'03d",$item['id'])?></td>
    <td><?=$item['name']?></td>
    <?php if($_SESSION['permission']==5): ?>
    <td><span class="badge md badge-<?=($id==$store['user_id'])?'primary':'info'?>"><?=(!empty($store['name']))?$store['name']:'Không thuộc cửa hàng nào'?></span></td>
    <?php endif; ?>
    <td><?=$item['amount']?></td>
    <td><?=number_format($item['price'],0,',',',')?><sup>đ</sup></td>
    <td><?=$item['sale']?>%</td>
    <td>
      <button class="btn btn-sm btn-info" onclick="view(<?=$item['id']?>)">Xem</button>
      <button class="btn btn-<?=($item['actived'])?'info':'warning'?> btn-fab-mini btn-fab btn-round" title="<?=($item['actived']==0)?'Ẩn':'Hiện'?>" id="cstatus" img-id="<?=$item['id']?>" sts-view="<?=$item['actived']?>" onclick="changests(<?=$item['id']?>)">
        <i class="material-icons"><?=($item['actived'])?'visibility':'visibility_off'?></i>
      </button>
      <a href="/admin/product/edit/<?=$item['id']?>.html" class="btn btn-primary btn-fab btn-fab-mini btn-round" title="Sửa">
      <i class="material-icons">edit</i>
      </a>
      <button class="btn btn-primary btn-fab btn-fab-mini btn-round" title="Xóa" onclick="delete_product(<?=$item['id']?>)">
      <i class="material-icons">delete</i>
      </button>
      
    </td>
  </tr>
<?php endforeach; ?>