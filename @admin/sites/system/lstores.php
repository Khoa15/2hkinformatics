<?php
if(isset($_SESSION['id']) && isset($_SESSION['permission'])){
    $id = $_SESSION['id'];
    $permit = $_SESSION['permission'];
    if(empty($id) || empty($permit) || $permit<3){
        echo "The request not found";
          return false;
    }
}
$shop = $db->db_get_row('select `id` from `stores` where `user_id`='.$id);
$page = 0;
$sql = 'select `id`,`name`, `actived` from `stores`';
if(isset($_POST['search']) && !empty($_POST['search'])){
  $search = htmlspecialchars($_POST['search']);
  $sql .= ' where `name`="'.$search.'"';
}
     $sql .=' order by `id` desc';
     if(isset($_POST['rowcount'])){
      $page = intval($_POST['rowcount']);
     }
     $sql .= ' LIMIT '.$page.', 5';
    $stores = $db->db_get_list($sql);

  foreach ($stores as $item) {
?>
    <tr>
      <td><?=$item['name']?></td>
      <td>
        <button class="btn btn-sm btn-primary">Xem</button>
        <button class="btn btn-sm btn-<?=($item['actived'])?'info':'warning'?>" onclick="stop(<?=$item['id']?>)" store-id="<?=$item['id']?>"><?=(!$item['actived'])?'Dừng':'Hoạt Động'?></button>
      </td>
    </tr>
<?php
  }
?>