<?php
if(isset($_SESSION['id']) && isset($_SESSION['permission'])){
    $id = $_SESSION['id'];
    $permit = $_SESSION['permission'];
    if(empty($id) || empty($permit) || $permit<3){
        echo "The request not found";
          return false;
    }
}
$sql = 'select `id`, `code`, `discount`,`amount`, `actived`, `died_at` from `coupon` order by `id` desc';

$list = $db->db_get_list($sql);
  /*preg_replace("/(?!^).(?!$)/", "*", */
foreach($list as $item){
?>
<tr>
	<td>#<?=sprintf("%'03d", $item['id'])?></td>
	<td onclick="view(<?=$item['id']?>)" title="Click! Để xem" style="cursor:pointer"><?=$item['code']?></td>
    <td><?=$item['discount']?></td>
	<td><?=$item['amount']?></td>
	<td><?=($item['actived'])?'Hoạt động':'Dừng'?></td>
	<td><?=$item['died_at']?></td>
    <td>
        <button class="btn btn-info btn-sm btn-fab btn-fab-mini btn-round" data-clipboard-text="<?=$item['code']?>" id="copy" onclick="shownoti()"><i class="material-icons">content_copy</i></button>
        <button class="btn btn-danger btn-sm btn-fab btn-fab-mini btn-round" id="deletecoupon" couponid="<?=$item['id']?>">
            <i class="material-icons">delete</i>
        </button>
    </td>
</tr>
<?php
}
?>
<script>
      $('button#deletecoupon').on('click', function(e){
        var cid = $(this).attr('couponid'), type='danger';
        $.post('/admin/coupon/list/delete', {cid:cid}, function(o){
          if(o.sts==1){
            type = 'success';
            onloading();
          }
          md.showNotification(type, o.msg);
        },'json');
      })
</script>
