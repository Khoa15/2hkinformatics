<center class="bg-primary p-2">Sản Phẩm Tin Học 12 - THPT Trần Khai Nguyên - Nhóm 3</center>
<?php
$dearth = time();
$death = false;
if($dearth==1621372242){
    $death = true;
}
define("IN_SITE", true);
require_once('c0nFig.php');
require_once('model/secret.php');
$secret = new Secret();
$system = $db->db_get_row('select * from system where id = 1');
$nameShop = $system['name'];
$favicon = $system['favicon'];

$path = 'sites/home.php';
if(isset($_GET['route']) && !$death){
    $route = htmlspecialchars(addslashes($_GET['route']));
    if($route=='admin' && isset($_SESSION['permission']) && $_SESSION['permission']>2){
        if(!isset($_SESSION['store']) && !$_SESSION['store']){
            header("Location: /mo-shop.html");
            exit();
        }
        $path = '@admin/index.php';
        if(!empty($route) && isset($_GET['to']) && !empty($_GET['to']) && isset($_GET['name']) && !empty($_GET['name'])){
            if(isset($_SESSION['id'])){
                $user = $db->db_get_row('select permission from users where id='.$_SESSION['id']);
                if($user['permission']==0){
                    header("Location: /");
                }
            }
            $to = htmlspecialchars(addslashes($_GET['to']));
            $name = htmlspecialchars(addslashes($_GET['name']));
            $path = '@admin/sites/'.$to.'/'.$name.'.php';
            if(isset($_GET['query']) && !empty($_GET['query'])){
                $query = htmlspecialchars(addslashes($_GET['query']));
                $path = '@admin/query/'.$to.'/'.$query.'.php';
            }
        }
    }
}
if($system['actived']==0&&!isset($_GET['query'])){
    if(!isset($_GET['route']) || $_GET['route']!='dang-nhap'){
        if(!isset($_SESSION['permission']) || isset($_SESSION['permission']) && $_SESSION['permission']!=5){
            $path = "sites/baotri.html";
        }
    }
    //exit();
}
if(file_exists($path)){
    require_once($path);
}else{
    echo "The request not found";
}