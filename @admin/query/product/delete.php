<?php
$result = 0;
if(isset($_SESSION['id']) && isset($_SESSION['permission'])){
    $id = $_SESSION['id'];
    $permit = $_SESSION['permission'];
    if(empty($id) || empty($permit) || $permit<3){
        echo "The request not found";
        return false;
    }
}
if(isset($_POST['id'])){
	$id = intval($_POST['id']);
	$sql = 'select `name` from `products` where `id`='.$id;
	if($db->num_rows($sql)!=0){
		if($db->delete('products', 'id='.$id) && $db->delete('types_of_products', 'product_id='.$id) && $db->delete('images', 'product_id='.$id) && $db->delete('spcart', 'product_id='.$id)){
			$img = $db->db_get_list('SELECT link from images where product_id='.$id);
			foreach($img as $media) unlink($img['link']);
			$db->delete('images', 'product_id='.$id);
			$result = 1;
		}
	}
}
echo $result;