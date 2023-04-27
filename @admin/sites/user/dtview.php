<?php
if(isset($_SESSION['id']) && isset($_SESSION['permission'])){
    $id = $_SESSION['id'];
    $permit = $_SESSION['permission'];
    if(empty($id) || empty($permit) || $permit<3){
        echo "The request not found";
        return false;
    }
}
$list = $db->db_get_list('select `id`, `surname`, `name`, `nbp`, `permission` from `users` order by `id` desc');
foreach($list as $item):
?>
<tr>
  <td>#<?=sprintf("%'03d",$item['id'])?></td>
  <td><?=$item['surname']?></td>
  <td><?=$item['name']?></td>
  <td><?=$item['nbp']?></td>
  <td>
    <?php
    echo "<strong";
      switch($item['permission']){
        case 0:
          $type = " class='text-danger'>Khóa";
          break;
        case 2:
          $type = " class='text-info'>VIP";
          break;
        case 3:
          $type = " class='text-info'>CTV";
          break;
        case 4:
          $type = " class='text-info'>CTV2";
          break;
        case 5:
          $type = " class='text-info'>Administrator";
          break;
        default:
          $type = " class='text-primary'>Thường";
      }
      echo $type.'</strong>';
    ?>
  </td>
  <td>
    <a href="/admin/user/view/<?=$item['id']?>.html" class="btn btn-info btn-sm">Xem</a>
    <a href="/admin/user/edit/<?=$item['id']?>.html" class="btn btn-primary btn-fab btn-fab-mini btn-round" title="Sửa">
    <i class="material-icons">edit</i>
    </a>
    <button class="btn btn-danger btn-fab btn-fab-mini btn-round" onclick="deleteUser(<?=$item['id']?>)" title="Xóa tài khoản này">
    <i class="material-icons">delete</i>
    </button>
    
  </td>
</tr>
<?php endforeach; ?>