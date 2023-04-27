<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
$time = date('H:i d/m/Y');
$date = date('d-m-Y');
$daters = date('Y-m-d');
$dater1s = date_create($daters);
date_add($dater1s, date_interval_create_from_date_string('1 days'));
class Database
{

	private $db_host = DB_HOST;
	private $db_user = DB_USER;
	private $db_psw = DB_PSW;
	private $db_name = DB_NAME;

	private $__conn;

	function getCurrentTime(){
		return date('H:i d-m-Y');
	}

	function getCurrentTimeDB(){
		return date('Y-m-d H:i:s');
	}

	function getCurrentDate(){
		return date('\N\g\à\y\ d \T\h\á\n\g\ m \N\ă\m\ Y');
	}

	function getCurrentTimeCode(){
		return date('YmdHis');
	}

	function db_connect()
    {
        if (!$this->__conn){
            $this->__conn = mysqli_connect($this->db_host, $this->db_user, $this->db_psw, $this->db_name) or die ('Lỗi kết nối');
 
            mysqli_query($this->__conn, "SET character_set_results = 'utf8mb4', character_set_client = 'utf8mb4', character_set_database = 'utf8mb4', character_set_server = 'utf8mb4',  NAMES 'UTF8MB4'");
        }

    }

    function filterText ($str){
 
	$str = trim(mb_strtolower($str));
    $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
    $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
    $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
    $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
    $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
    $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
    $str = preg_replace('/(đ)/', 'd', $str);
    $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
    $str = preg_replace('/([\s]+)/', '-', $str);
    return $str;
	 
	}
    function total($sql)
	{
		$this->db_connect();
		$result = mysqli_query($this->__conn, $sql);
       if (!$result){
            die ('Câu truy vấn bị sai'.$sql);
        }
        $data = mysqli_num_rows($result);
        return $data;
    }
 
	function generate_string( $strength = 10) {
		$input = '0123456789abcdefghijklmnopqrstuvwxyz@&%$#?';
	    $input_length = strlen($input);
	    $random_string = '';
	    for($i = 0; $i < $strength; $i++) {
	        $random_character = $input[mt_rand(0, $input_length - 1)];
	        $random_string .= $random_character;
	    }
	 
	    return $random_string;
	}
	function db_get_list($sql)
	{
		$this->db_connect();
	    $data  = array();
	    $result = mysqli_query($this->__conn, $sql);
	    if (!$result) {
	    	die('Câu truy vấn bị sai'.$sql);
	    }
	    while ($row = mysqli_fetch_assoc($result)){
	        $data[] = $row;
	    }
	    mysqli_free_result($result);
	    return $data;
	}
	function db_query($sql)
	{
		$this->db_connect();
		return mysqli_query($this->__conn, $sql);
	}
	function db_get_row($sql){
		//echo $sql."<br>";
	    $this->db_connect();
	    $result = mysqli_query($this->__conn, $sql);
	    $row = array();
	    if (mysqli_num_rows($result) > 0){
	        $row = mysqli_fetch_assoc($result);
	    } 	
	    //mysqli_free_result($result);
	    return $row;
	}
	function num_rows($sql)
	{
		$this->db_connect();
		$result = mysqli_query($this->__conn, $sql);
		return mysqli_num_rows($result);
	}
	public function insert($table, $data)
	{
		$this->db_connect();
		// Lưu trữ danh sách field
	    $field_list = '';
	    // Lưu trữ danh sách giá trị tương ứng với field
	    $value_list = '';
	 
	    // Lặp qua data
	    foreach ($data as $key => $value){
	        $field_list .= ",`$key`";
	        $value_list .= ",'".mysqli_escape_string($this->__conn, $value)."'";
	    }
	 
	    // Vì sau vòng lặp các biến $field_list và $value_list sẽ thừa một dấu , nên ta sẽ dùng hàm trim để xóa đi
	    $sql = 'INSERT INTO `'.$table. '`('.trim($field_list, ',').') VALUES ('.trim($value_list, ',').')';
		//echo $sql;
	    return mysqli_query($this->__conn, $sql);
	}
	function update($table, $data, $where)
	{
	    // Kết nối
	    $this->db_connect();
	    $sql = '';
	    // Lặp qua data
	    foreach ($data as $key => $value){
	    	if($value=='now()'){
	    		$sql.= "$key = ".mysqli_escape_string($this->__conn, $value).",";
	    	}else{
	    		$sql .= "$key = '".mysqli_escape_string($this->__conn, $value)."',";
	    	}
	    }
	    // Vì sau vòng lặp biến $sql sẽ thừa một dấu , nên ta sẽ dùng hàm trim để xóa đi
		$sql = 'UPDATE `'.$table. '` SET '.trim($sql, ',').' WHERE '.$where;
		//echo $sql;
	    return mysqli_query($this->__conn, $sql);
	}
	function delete($table, $where)
	{
		$this->db_connect();
		$sql = 'DELETE FROM '.$table.' WHERE '.$where;
		return mysqli_query($this->__conn, $sql);
	}

	function backtime($time){
		$year = floor($time/60/60/24/30/365);//năm
		$month = floor($time/60/60/24/30);
		$day = floor($time/60/60/24);
		$hour = floor($time/60/60);
		$minute = floor($time/60);
		$time = $year.' năm';
		if($month<13){
			$time = $month.' tháng';
		}
		if($day<31){
			$time = $day.' ngày';
		}
		if($hour<24){
			$time = $hour.' giờ';
		}
		if($minute<60){
			$time = $minute.' phút';
		}
		return $time;
	}

	function coupon($item){
		$this->db_connect();
		$system = $this->db_get_row('SELECT ship FROM system WHERE id=1 LIMIT 1');
		$ship = $system['ship'];
		$discount = 0;
		$for_ship = 0;
		$coupon = $this->db_get_row('SELECT discount, ship, forall FROM coupon WHERE id='.$item['coupon_id']);
		$type="";$id_type = 0;
		if(!empty($coupon['ship'])){
			$for_ship = $coupon['discount'];
			$ship = $system['ship'] - $system['ship']*$coupon['discount']/100;
			$type="phí vận chuyển";
			$id_type = 3;
		}
		if(!empty($coupon['forall'])){
			$discount = $coupon['discount'];
			$type="sản phẩm và phí vận chuyển";
			$id_type = 2;
		}else{
			$product = $this->db_get_row('SELECT category_id FROM products WHERE id='.$item['product_id']);
			$coupon_product = $this->db_get_row('SELECT product_id FROM lstcoupon WHERE product_id='.$item['product_id'].' AND coupon_id='.$item['coupon_id']);
			$coupon_category = $this->db_get_list('SELECT category_id FROM lstcoupon WHERE coupon_id='.$item['coupon_id'].' AND category_id='.$product['category_id']);
			if($coupon_product or $coupon_category){
				$discount = $coupon['discount'];
				$type="sản phẩm";
				$id_type = 1;
			}
		}
		return ['ship'=>$ship, 'discount'=>$discount, 'type'=>$type, 'id_type'=>$id_type, 'for_ship'=>$for_ship];
	}

	function detectStatus($val, $descrip=null){
        switch($val){
            case 0:
                $type = "Hủy";
                $reason = '<p>Lý do: <strong>'.$descrip.'</strong></p>';
                break;
            case 1:
                $type = 'Giỏ Hàng';
                break;
            case 3:
                $type = "<span class='text-info'>Đã xác nhận</span>";
                break;
            case 4:
                $type = "<span class='text-secondary'>Đang vận chuyển</span>";
                break;
            case 5:
                $type = '<span class="text-success">Đã giao thành công</span>';
                break;
            case 6:
                $type = "<span class='text-danger'>Hàng lỗi</span>";
                $reason = '<p>Lý do: <strong id="view-reason" rel="tooltip" data-placement="bottom" title="Click xem ảnh/video"  spcart-id="">'.$descrip.'</strong></p>';
                break;
            case 7:
                $type = "<span text='text-warning'>Đổi trả</span>";
                break;
            case 8:
                $type = 'Không chấp nhận đổi trả';
                $reason = '<p>Lý do: <strong>'.$descrip.'</strong></p>';
                break;
            case 9:
                $type = '<span class="text-info">Đổi trả được chấp thuận</span>';
                break;
            case 10:
                $type = '<span class="text-success">Hoàn tất đơn hàng</span>';
                break;
            default:
                $type = "<span class='text-warning'>Chưa xác nhận đơn hàng<span>";
            }
            return $type;
    }

}