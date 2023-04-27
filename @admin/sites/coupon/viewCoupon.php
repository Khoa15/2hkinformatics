<?php
$id = (isset($_POST['id'])) ? $_POST['id'] : false;
if(!$id) die ('The request not found');
$sql = 'select * from coupon where id = '.$id;
$coupon = $db->db_get_row($sql);
$lst = $db->db_get_list('select * from lstcoupon where coupon_id='.$id);
?>

<div class="table-responsive">
	<table class="table">
		<tbody>
			<tr>
				<td>Mã giảm giá:</td>
				<td><?=$coupon['code']?></td>
			</tr>
			<tr>
				<td>Giảm:</td>
				<td><?=$coupon['discount']?>%</td>
			</tr>
			<tr>
				<td>Áp dụng cho:</td>
				<td><?php
				if($coupon['forall']){
					echo '<b class="text-info">Dành cho tất cả</b>';
				}else{
					if($coupon['ship']){
						echo "<b>Phí vận chuyển</b>";
					}
					if(!empty($lst)){
						echo "<div class='row' style='overflow-y:auto;max-height:100px'>";
						foreach ($lst as $item) {
							if(!empty($item['category_id'])){
								$category = $db->db_get_row('select `name` from categories where id='.$item['category_id']);
								echo "<label class='col-md-6 col-sm-12'>".$category['name']."</label>";
							}
							if(!empty($item['product_id'])){
								$product = $db->db_get_row('select `name` from products where id='.$item['product_id']);
								$name = mb_substr($product['name'],0, 30, 'UTF-8');
								echo "<label class='col-md-6 col-sm-12'>".$name.((strlen($product['name'])>30)?'...':false)."</label>";
							}
						}
						echo "</div>";
					}
				}?></td>
			</tr>
			<tr>
				<td>Số lượng:</td>
				<td><?=($coupon['infinity'])?'<b>Vô hạn</b>':$coupon['amount']?></td>
			</tr>
			<tr>
				<td>Lượt dùng:</td>
				<td><?=$coupon['damount']?></td>
			</tr>
			<tr>
				<td>Hoạt động:</td>
				<td><?=($coupon['actived'])?'<b class="text-info">Hoạt động</b>':'<b class="text-danger">Dừng</b>'?></td>
			</tr>
			<tr>
				<td>Hạn dùng:</td>
				<td><?=$coupon['died_at']?></td>
			</tr>
			<tr>
				<td>Ngày tạo:</td>
				<td><?=$coupon['created_at']?></td>
			</tr>
		</tbody>
	</table>
</div>