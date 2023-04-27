<?php
$arr = array('sts'=>0, 'msg'=>'Hãy điền đầy đủ thông tin');
if(isset($_POST['name']) && !empty($_POST['name'])){
    $name = $_POST['name'];
    $actived = (isset($_POST['actived'])&&!empty($_POST['actived']))?1:false;
    
    $sql = 'select `id` from `categories` where `name`="'.$name.'"';
    $row = $db->num_rows($sql);
    $arr = array('sts'=>0, 'msg'=>'Trùng tên với danh mục');
    if(empty($row)){
        if($db->insert('categories', array('name'=>$name, 'actived'=>$actived))){
            $arr = array('sts'=>1, 'msg'=>'Danh mục: '.$name.' đã được lưu');
        }
    }
}
echo json_encode($arr);
?>