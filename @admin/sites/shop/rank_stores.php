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
$sql_score = "SELECT spcart.store_id as id, stores.name as name, COUNT(spcart.STATUS=5)+COUNT(spcart.status=10)+AVG(spcart.score)+COUNT(CASE WHEN lstfollow.store_id!=0 AND lstfollow.store_id!=NULL Then lstfollow.store_id END) AS score FROM spcart,lstfollow, stores WHERE stores.id=spcart.store_id";
// if(isset($_POST['search']) && !empty($_POST['search'])){
//     $search = htmlspecialchars($_POST['search']);
//     $sql_score .= ' AND `name`="'.$search.'"';
// }
$sql_score .= ' GROUP BY spcart.store_id ORDER BY score desc';
if(isset($_POST['rowcount'])){
 $page = intval($_POST['rowcount']);
}
$i=1*$page;
$sql_score .= ' LIMIT '.$page.', 5';  
$list = $db->db_get_list($sql_score );
foreach($list as $store){
    $i++;
?>
<tr class="<?=($store['id']==$_SESSION['store'])?"bg-info text-light":false?>">
    <td><?=$i?></td>
    <td><?=$store['name']?></td>
    <td><?=number_format($store['score'],0,',',',')?></td>
</tr>

<?php
}
?>