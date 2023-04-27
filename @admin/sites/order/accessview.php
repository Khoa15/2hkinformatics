<?php
if(isset($_SESSION['id']) && isset($_SESSION['permission'])){
    $id = $_SESSION['id'];
    $permit = $_SESSION['permission'];
    if(empty($id) || empty($permit) || $permit<3){
        echo "The request not found";
        return false;
    }
}
$plik = '404.php';
if(isset($_POST['type'])){
	$type = $_POST['type'];
	if($type == 'list' && $permit==5){
		$plik = 'viewlist.php';
	}
	if($type == 'orders' && $permit != 5){
		$plik = 'vieworder.php';
	}
}
require_once($plik);
?>