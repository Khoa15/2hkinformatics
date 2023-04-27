<?php
if(isset($_SESSION['id']) && isset($_SESSION['permission'])){
    $id = $_SESSION['id'];
    $permit = $_SESSION['permission'];
    if(empty($id) || empty($permit) || $permit<3){
        echo "The request not found";
        return false;
    }
}
$pid = (isset($_POST['id']) && !empty($_POST['id'])) ? (int)$_POST['id'] : false;

if($pid == $_POST['id'] && $pid){
	$sql = 'select * from `products` where `id`='.$pid.' limit 1';
	$sql2 = 'select * from `spcart` where `product_id`='.$pid.' and status >= 5';
$product = $db->db_get_row($sql);
$list2 = $db->db_get_list($sql2);
$category = $db->db_get_row('select `name`, `actived` from `categories` where `id`='.$product['category_id']);
$store = $db->db_get_row('select `name`,user_id from `stores` where `id`='.$product['store_id']);
$user = $db->db_get_row('select `name` from `users` where `id`='.$store['user_id']);
$spcart = $db->db_get_row('select AVG(CASE WHEN `score`!=0 THEN score END) as score, COUNT(CASE WHEN `score`!=0 THEN 1 END) as scorer, SUM(CASE WHEN `status`=5 OR `status`=7 THEN (price * amount) END) as totalprice, COUNT(CASE WHEN `status`=5 OR `status`=7 THEN (price * amount) END) as totalcartsuccess, COUNT(`id`) as totalcart, COUNT(CASE WHEN `status`!=5 AND `status`!=7 AND `status`!=1 THEN (id) END) as totalcarterror, COUNT(CASE WHEN evaluate!="" THEN `id` END) as countevaluate from `spcart` where `product_id`='.$pid.' limit 1');
$love = $db->db_get_row('select COUNT(`id`) as total from lstfollow where product_id='.$pid.' and `store_id`=false limit 1');
?>
<div class="table-responsive">
	<table class="table table-bordered">
		<tbody>
			<tr>
				<td>Tên:</td>
				<td><?=$product['name']?></td>
			</tr>
			<tr>
				<td>Mô Tả:</td>
				<td>
					<div style="max-height: 200px;overflow-y: auto">
						<?=$product['description']?>
					</div>
				</td>
			</tr>
			<tr>
				<td>Giá Tiền:</td>
				<td><?=number_format($product['price'],0,',',',')?>đ
					<?=(!empty($product['sale']))?'Giảm <b class="text-info">'.$product['sale'].'%</b> Còn: <b class="text-info">'.number_format(($product['price']-$product['sale']*$product['price']/100),0,',',',').'đ</b>':false?></td>
			</tr>
			<tr>
				<td>Số lượng</td>
				<td><?=$product['amount']?></td>
			</tr>
			<tr>
				<td>Danh Mục:</td>
				<td><?=$category['name']?><?=($category['actived']==1)?' - <span class="text-info">Hoạt động':' - <span class="text-warning">Tạm Dừng'?></span></td>
			</tr>
			<tr>
				<td>Trạng thái:</td>
				<td><?=($product['actived']==1)?'<span class="text-info">Hiện':'<span class="text-warning">Ẩn'?></span></td>
			</tr>
			<tr>
				<td>Người bán:</td>
				<td><b><?=$user['name']?></b> thuộc cửa hàng <b><?=$store['name']?></b></td>
			</tr>
		</tbody>
	</table>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-2 col-md-12">
			<div class="card">
				<div class="card-body">
					<p>Đánh giá: <?=number_format($spcart['score'],1,'.','.')?>/5</p>
					<p>Số lượt đánh giá: <?=$spcart['scorer']?></p>
				</div>
			</div>
		</div>
		<div class="col-lg-5 col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="container-fluid">
						<div class="row">
							<div class="col-lg-6">
								<p>Tổng thu nhập: <?=number_format($spcart['totalprice'])?></p>
								<p>Tổng số đơn hàng: <?=$spcart['totalcart']?></p>
							</div>
							<div class="col-lg-6">
								<p>Tổng số đơn hàng thành công: <?=$spcart['totalcartsuccess']?></p>
								<p>Tổng số đơn hàng không thành công: <?=$spcart['totalcarterror']?></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-5 col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="container">
						<div class="row">
							<div class="col-lg-6">
								<p>Tổng số lượt thích: <?=$love['total']?></p>
								<p>Tổng số lượt xem: <?=$product['view']?></p>
							</div>
							<div class="col-lg-6">
								<p>Tổng bình luận: <?=$spcart['countevaluate']?></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-6 col-md-12">
			<div class="container">
				<div class="row">
					<?php
						$sql = 'select `link` from `images` where `product_id`='.$pid;
						$query = $db->db_get_list($sql);
						if(empty($query)){
							echo "Không có ảnh!";
						}else{
							foreach ($query as $item) {
					?>
					<div class="col-lg-6 col-md-12">
						<img src="<?=$item['link']?>" style="width:100%" alt="">
					</div>
					<?php } } ?>
				</div>
			</div>
		</div>
		<div class="col-lg-6 col-md-12">
			<div class="container">
				<div class="row">
					<?php

			            $sql = 'select `score`, `evaluate`, `user_id` from `spcart` where `product_id`='.$pid.' and `status`>=5 and `score`!=0 order by `id` desc';
			            $list = $db->db_get_list($sql);
			            if(empty($list)){
			            	echo "Không có đánh giá";
			            }else{
						$html = '';
						foreach($list as $item){
                        $sql ='select `name` from `users` where `id`='.$item['user_id'].' limit 1';
                        $user = $db->db_get_row($sql);
                        $score = $item['score'];
                        $html.='
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
						            <div class="author">
						                <img src="/assets/imgs/avatar.jpg" alt="image" class="avatar img-raised">
						                <span>'.$user['name'].'</span>
						            </div>
                                        <div class="interfere pb-2">
                                            <div class="score md float-left">';
                                            for($i = 5; $i >= 5-(4-$score); $i--){
                                                $html .= '<span class="material-icons" score="'.$i.'">star</span>';
                                            }
                                            for($i = $score; $i >= 1; $i--){
                                                $html .= '<span class="material-icons checked" score="'.$i.'">star</span>';
                                            }
                                                
                                            $html.='</div>
                                        </div>
                                      <p class="mt-4 pt-2 text-muted">
                                      '.$item['evaluate'].'
                                      </p>                           
                                </div>
                            </div>
                        </div>';
                              }
                              echo $html;}
					?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
}
?>