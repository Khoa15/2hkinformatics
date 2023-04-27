<?php
if(isset($_SESSION['id']) && isset($_SESSION['permission'])){
    $id = $_SESSION['id'];
    $permit = $_SESSION['permission'];
    if(empty($id) || empty($permit) || $permit<3){
        echo "The request not found";
        return false;
    }
}
$id = (isset($_POST['spcartid']) && !empty($_POST['spcartid']))?intval($_POST['spcartid']):false;
$sql = 'select `link` from `images` where `spcart_id`='.$id;
$list = $db->db_get_list($sql);
foreach ($list as $item) {
	$type = explode('.', $item['link']);
	if($type[1]=='mp4'){
?>

<video controls width="100%">
	<source src="<?=$item['link']?>" type="video/mp4">
</video>
<?php
	}else{
?>
<img src="<?=$item['link']?>">
<?php
}
}

?>