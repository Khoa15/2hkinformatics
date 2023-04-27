<?php
if(isset($_SESSION['id']) && isset($_SESSION['permission'])){
    $id = $_SESSION['id'];
    $permit = $_SESSION['permission'];
    if(empty($id) || empty($permit) || $permit<3){
        echo "The request not found";
        return false;
    }
}
$length = rand(5, 20);
$characters = 'ABCDE6789FGHIJKL345MNOPQRSTUVWXYZ012SALECOUPON2HKSHOPPRODUCTSNAKENIKEWAVEUSER102030405060708090100';
$randstring = '';
for ($i = 0; $i < $length; $i++) {
    $randstring .= $characters[rand(0, strlen($characters)-1)];
}
echo trim($randstring, ' ');