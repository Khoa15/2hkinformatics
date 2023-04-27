<?php
$uid = (int)$_SESSION['id'];
if($uid != $_SESSION['id']){
  $uid = 0;
}
$permit = $_SESSION['permission'];
if(!isset($_SESSION['permission']) || !$_SESSION['permission']>=3 || $uid == 0){
  echo json_encode(array("sts"=>0,"msg"=>"The request not found"));
  exit();
}
$sql = 'select `id` from `stores` where `user_id` = '.$uid.' limit 1';
$shop = $db->db_get_row($sql);
$sql = 'select YEAR(spcart.updated_at) as dateyear from `spcart`,`products` where products.store_id='.$shop['id'].' GROUP BY YEAR(spcart.updated_at)';
$list = $db->db_get_list($sql);
if(!empty($list)){
  foreach ($list as $item) {
    for($i = 1; $i <= 12 ; $i++){
      $sql = 'select SUM(spcart.price*spcart.amount) as total from `spcart` where Month(spcart.updated_at)='.$i.' and YEAR(spcart.updated_at)='.$item['dateyear'].' and (spcart.status=5 or spcart.status=10) and store_id='.$shop['id'];
      if($permit<5 && $permit > 2){
        $sql .= ' and `user_id`='.$uid;
      }
      $product = $db->db_get_row($sql);
      $income[$item['dateyear']][$i] = $product['total'];
    }
  }
	$income['sts'] = 1;
}


echo json_encode($income);