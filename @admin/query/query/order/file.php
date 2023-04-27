<?php
$path = 'assets/file/vendor/autoload.php';
require_once($path);
if(isset($_SESSION['id']) && isset($_SESSION['permission'])){
    $id = $_SESSION['id'];
    $permit = $_SESSION['permission'];
    if(empty($id) || empty($permit) || $permit<3){
        echo "The request not found";
        return false;
    }
}
$arr = array('sts'=>0, 'msg'=>'The request not found');
$id = (isset($_POST['cartid']) && !empty($_POST['cartid'])) ? intval($_POST['cartid']) : false;
if($id){
	$sql = 'select * from spcart where id = '.$id.' limit 1';
	$cart = $db->db_get_row($sql);
	if(!empty($cart['id'])){
		$sql = 'select `fullname`, `street`, `city`, `nbp` from address where id = '.$cart['address_id'].' limit 1';
		$address = $db->db_get_row($sql);
		$sql = 'select `name` from products where id='.$cart['product_id'].' limit 1';
		$product = $db->db_get_row($sql);
		$sql = 'select ship from system where id = 1 limit 1';
		$system = $db->db_get_row($sql);
		$sql = 'select discount,code from coupon where id='.$cart['coupon_id'].' limit 1';
		$coupon = $db->db_get_row($sql);
		$discount = (!empty($coupon['discount'])) ? $coupon['discount'] : 0;
		if(!empty($system['ship']) && !empty($product['name']) && !empty($address['fullname'])){
			$zip = new ZipArchive();

			$user = $address['fullname'];
			$nbp = $address['nbp'];
			$address = $address['street'].', '.$address['city'];
			$name2 = $product['name'];
			$price = number_format($cart['price'],0,',',',').'đ';
			$amount = $cart['amount'];
			$ship = number_format($system['ship'],0,',',',').'đ';
			$total1 = $cart['price'] * $amount;
			$total1 = $total1 - $total1*$discount/100;
			$total1 = $total1 * $amount + $system['ship'];
			$total = number_format($total1,0,',',',').'đ';
			$coupon2 = null;
			if(!empty($coupon['code'])){
				$code = $coupon['code'];
				$coupon2 = 'Có mã giảm giá được giảm '.$discount.'%';
			}

			$filename_goc = 'assets/file/bill.docx';
			$name = 'cbill'.time();
			$filename = 'assets/file/'.$name.'.docx';
			// Copy một bản sao từ file gốc
			copy($filename_goc, $filename);
			 
			// Mở file đã copy
			if ($zip->open($filename, ZipArchive::CREATE)!==TRUE) {
			    echo "Cannot open $filename :( "; die;
			}
			// Lấy nội dung text trong file
			$xml = $zip->getFromName('word/document.xml');
			 
			// Dùng hàm str_replace để thay đổi text trong file
			$xml = str_replace('{user}', $user, $xml);
			$xml = str_replace('{nbp}', $nbp, $xml);
			$xml = str_replace('{address}', $address, $xml);
			$xml = str_replace('{name}', $name2, $xml);
			$xml = str_replace('{price}', $price, $xml);
			$xml = str_replace('{amount}', $amount, $xml);
			$xml = str_replace('{ship}', $ship, $xml);
			$xml = str_replace('{coupon}', $coupon2, $xml);
			$xml = str_replace('{total2}', $total, $xml);

			// Ghi lại nội dung đã được đổi vào file
			if ($zip->addFromString('word/document.xml', $xml)) { $arr['sts']=1;$arr['msg']='Đã lưu file';$arr['name'] = $name; }
			else { $arr['sts']=0; }
			 
			//Đóng file
			/*$zip->close();
			 
			header('Location: '.$filename);*/
		}
	}
}
echo json_encode($arr);