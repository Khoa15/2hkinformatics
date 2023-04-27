<?php
/**
 * 
 */
class Secret
{
	public function RandomString($length=10)
	{
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $randstring = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randstring .= $characters[rand(0, strlen($characters)-1)];
	    }
	    return $randstring;
	}
	public function getToken($minute=5, $session=null)
	{
		$timeout = $minute + date("i");
		if(empty($session))
		{ 
			$_SESSION['timeout'] = $timeout;
			$result = $timeout;
		}else{
			if(date("i")>$session)
			{
				$minute = $minute + date("i");
				if($minute>=60)
				{$minute = $minute - 60;}
				$_SESSION['timeout'] = $minute;
				$result = $minute; 
			}
			else
			{ $result = $session; }
		}
		$token = mt_rand(11, 44).'e.'.md5($result);
		$_SESSION['_token'] = $token;
		return $token;
	}

	public function rememberLogin($_secret)
	{
		//eyJzYWx0IjozMzQ5NiwiaGFzaCI6IkxTZm1XbGdzMVoiLCJ0aW1lIjoxNTk3NDgxNjU3fQ%3D%3D.d9d4f495e875a2e075a1a4a6e1b9770f.4
		$_secret = explode('.', $_secret);
		$token_remember = $_secret[1];
		$permit = $_secret[2];
		if($permit>3)
			{  return $token_remember;}
		return false;
	}
}