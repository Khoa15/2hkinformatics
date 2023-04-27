<?php
if(isset($_SESSION['id']) && isset($_SESSION['permission'])){
    $id = $_SESSION['id'];
    $permit = $_SESSION['permission'];
    if(empty($id) || empty($permit) || $permit!=5){
        echo "The request not found";
        return false;
    }
}
  $sql = 'select max(`id`) as id,`address_id`, `user_id`, `status`, created_at,amount, SUM(CASE WHEN status <5 and status != 0 and status != 1  THEN price END)*`amount` as total, SUM(CASE WHEN status=5 or status=10 THEN price END) as price, COUNT(CASE WHEN status <5 and status != 0 and status != 1 THEN id END) as statuscart from `spcart` group by `user_id` order by `id` desc';
  $list = $db->db_get_list($sql);
  if(empty($list)){
    echo "Không có dữ liệu";
  }
  foreach($list as $item):
    $address = $db->db_get_row('select fullname from address where id ='.$item['address_id']);
    $user = $db->db_get_row('select `surname`,`name` from `users` where `id`='.$item['user_id']);
?>
<tr>

  <td><?=$user['surname'].' '.$user['name']?></td>

  <td><?=number_format($item['amount']*$item['price'],0,',',',');?></td>

  <td>

    <?=$item['statuscart']?>
  </td>
  <td><?=number_format($item['total'],0,',',',');?></td>
  <td>
    <?=$item['created_at']?>
  </td>
  <td>

    <a href="/admin/order/view-detail/<?=$item['user_id']?>.html" class="btn btn-info btn-sm">Xem</a>



    <button class="btn btn-danger btn-fab btn-fab-mini btn-round" title="Xóa đơn hàng" id="trashorder" order-id="<?=$item['id']?>">

    <i class="material-icons">delete</i>

    </button>

    

  </td>

</tr>
<?php endforeach; ?>