<?php
if(isset($_SESSION['id']) && isset($_SESSION['permission'])){
    $id = $_SESSION['id'];
    $store_id = $_SESSION['store'];
    $permit = $_SESSION['permission'];
    if(empty($id) || empty($permit) || $permit<3){
        echo "The request not found";
          return false;
    }
}
$shop = $db->db_get_row('select `id` from `stores` where `user_id`='.$id);
$page = 0;
$sql = 'select `id`,`name` from `products`';
if($permit<5 and $permit > 2){
   $sql .= ' where `store_id`='.$shop['id'];
}
if(isset($_POST['search']) && !empty($_POST['search'])){
  $search = htmlspecialchars($_POST['search']);
  $sql .= ' where `id`="'.$search.'" OR `name` LIKE "%'.$search.'%" OR `description` LIKE "%'.$search.'%" OR `price`="'.$search.'" ';
}
     $sql .=' order by `id` desc';
     if(isset($_POST['rowcount'])){
      $page = intval($_POST['rowcount']);
     }
     $sql .= ' LIMIT '.$page.', 5';
     $list = $db->db_get_list($sql);

     foreach($list as $item):

  ?>

  <tr>

    <td>#<?=sprintf("%'03d",$item['id'])?></td>

    <td>

      <?=mb_substr($item['name'],0, 40, 'UTF-8')?><?=(strlen($item['name'])>40)?'...':false?>

    </td>

    <td>

      <button class="btn btn-sm btn-primary btn-fab btn-fab-mini btn-round" data-clipboard-text="<?=$item['id']?>" id="copy">
        <i class="material-icons">content_copy</i>
      </button>
      <a href="/product-detail/<?=$item['id']?>/<?=$db->filterText($item['name'])?>.html" class="btn btn-info btn-fab btn-fab-mini btn-round" title="Sửa">
          <i class="material-icons">open_in_new</i>
          </a>

    </td>

  </tr>

<?php endforeach; ?>