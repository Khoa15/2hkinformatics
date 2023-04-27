<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
    define("IN_SITE", true);
}
require_once('../../c0nFig.php');
if ( $_SERVER['HTTP_HOST'] != HOSTT ) die ("Direct access not premitted");

$key = (isset($_POST['key']) && !empty($_POST['key']))?htmlspecialchars(addslashes($_POST['key'])):false;

$html = '';

if(!empty($key)){
	$sql = 'select products.id, products.name, products.store_id from `products`, `categories` ';
	$sql2 = 'select `id`,`name`, `actived` from `categories` ';
	$sql3 = 'select `id`,`name`,`user_id`  from `stores`';
    $sql .=  'where products.actived = 1 AND categories.actived=1 AND categories.id = products.category_id and (products.name LIKE "%'.$key.'%" OR products.price LIKE "%'.$key.'%" )';
    $sql2 .= ' where `name` LIKE "%'.$key.'%" and `actived`=1';
    $sql3 .=  ' where `name`  LIKE  "%'.$key.'%" and `actived`=1';
	$sql .= ' ORDER BY `id` desc limit 10';
	$sql2 .= ' ORDER BY `id` desc limit 5';
	$sql3 .= ' ORDER BY `id` desc limit 5';
	$list = $db->db_get_list($sql);
	$list2 = $db->db_get_list($sql2);
	$list3 = $db->db_get_list($sql3);
	$list4 = array_merge($list, $list2, $list3);
	foreach ($list4 as $item) {
		$name = mb_substr($item['name'],0, 50, 'UTF-8');
		$name .= (strlen($item['name'])>50)?'...':false;
		if(isset($item['store_id']) && !empty($item['store_id'])){
			$type = 'Sản Phẩm';
			$html .= '<li href="/product-detail.html?i='.$item['id'].'" id="product" product-id="true" >'.$name.' <span class="badge badge-primary">'.$type.'</span></li>';
		}
		if(isset($item['actived']) && !empty($item['actived'])){
			$type = 'Danh Mục';
			$html .= '<li to="/products.html" category="'.$item['name'].'">'.$name.' <span class="badge badge-primary">'.$type.'</span></li>';
		}
		if(isset($item['user_id']) && !empty($item['user_id'])){
			$type = 'Cửa Hàng';
			$html .= '<li to="/shop.html" store-id="'.$item['id'].'" >'.$name.' <span class="badge badge-primary">'.$type.'</span></li>';
		}

	}
}
echo $html;