<?php
if(isset($_SESSION['id']) && isset($_SESSION['permission'])){
    $user_id = $_SESSION['id'];
    $permit = $_SESSION['permission'];
    if(empty($user_id) || empty($permit) || $permit<3){
        echo "The request not found";
        return false;
    }
}
$sql = 'select `id` from `products` order by `id` desc';
$num = $db->num_rows($sql);
$cbtn = ceil($num/5);
$html = '';
for ($i=1; $i <= $cbtn; $i++) { 
	$html .= '<li class="page-item"><button class="page-link">'.$i.'</button></li>';;
}
echo $html;