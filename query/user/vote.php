<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
	define("IN_SITE", true);
}
require_once('../../c0nFig.php');
if ( $_SERVER['HTTP_HOST'] != HOSTT ) die ("Direct access not premitted");
$uid = (isset($_SESSION['id']) && !empty($_SESSION['id']))?$_SESSION['id']:0;
$arr = array('sts'=>0,'msg'=>'The request not found');
$id = (isset($_POST['id']) && !empty($_POST['id'])) ? intval($_POST['id']) : 0;
if($uid && $id)
{
	$sql = 'select `id` from users where id='.$uid.' and permission!=0 limit 1';
	$user = $db->db_get_row($sql);
	if(!empty($user['id'])){
		$sql = 'select `score`, `evaluate`, `created_at` from spcart where id='.$id.' limit 1';
		$cart = $db->db_get_row($sql);
		//if(!empty($cart['evaluate'])){
			//$time = strtotime($cart['created_at']);
			//echo $time.'   '.time();
?>
<div class="form-group">
    <div class="alert alert-danger" id="error"></div>
    <div class="alert alert-success" id="success"></div>
</div>
<small class="text-muted text-center">Sau khi đánh giá, đơn hàng sẽ hoàn thành và bạn không thể yêu cầu trả hàng</small>
<div class="form-group">
  <textarea class="form-control" rows="5" style="line-height: 20px" name="contentv" required cols="10"><?=str_replace("<br />","",$cart['evaluate'])?></textarea>
</div>
<ul class="ratings text-center">
  <li class="star <?=($cart['score']==5)?'selected':false?>" score="5"></li>
  <li class="star <?=($cart['score']==4)?'selected':false?>" score="4"></li>
  <li class="star <?=($cart['score']==3)?'selected':false?>" score="3"></li>
  <li class="star <?=($cart['score']==2)?'selected':false?>" score="2"></li>
  <li class="star <?=($cart['score']==1)?'selected':false?>" score="1"></li>
</ul>
<div class="form-group text-right">
  <input type="submit" class="btn btn-sm btn-info" cart-id="" id="accept" value="Đăng"/>
</div>
<?php
		//}
	}
}
?>