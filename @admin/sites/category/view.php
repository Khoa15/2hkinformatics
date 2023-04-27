<?php
if(isset($_SESSION['id']) && isset($_SESSION['permission'])){
    $id = $_SESSION['id'];
    $permit = $_SESSION['permission'];
    if(empty($id) || empty($permit) || $permit<3){
        echo "The request not found";
        return false;
    }
}
$list = $db->db_get_list('select `id`, `name`, `actived` from `categories` order by `id` desc');
if(empty($list)){
?>
<tr>
    <td colspan="3">Không có dữ liệu</td>
</tr>
<?php
}
foreach($list as $item):
?>
<div class="col-lg-2 col-md-6">
  <?=$item['name']?>
</div>
<div class="col-lg-2 col-md-6">
  
    <button class="btn btn-<?=($item['actived'])?'info':'warning'?> btn-fab-mini btn-fab btn-round" title="<?=($item['actived']==0)?'Ẩn':'Hiện'?>" id="cstatus" img-id="<?=$item['id']?>" sts-view="<?=$item['actived']?>" onclick="changests(<?=$item['id']?>)">
      <i class="material-icons"><?=($item['actived'])?'visibility':'visibility_off'?></i>
    </button>
    <button class="btn btn-primary btn-fab btn-fab-mini btn-round" title="Sửa" id="editct" sts-view="<?=$item['actived']?>" onclick="editcategory(<?=$item['id']?>)" dt-text="<?=$item['name']?>" id-categories="<?=$item['id']?>">
    <i class="material-icons">edit</i>
    </button>
    <button class="btn btn-primary btn-fab btn-fab-mini btn-round" title="Xóa" onclick="deltecategory(<?=$item['id']?>)">
    <i class="material-icons">delete</i>
    </button>
</div>
<?php endforeach; ?>