<?php

class crypto{
	
	private $SALT;

	public function __construct(){
		$this->SALT = '6666a666666f666ded66aaaaaa20160913aaaaf6666f6666666d666a66e6c666';//32 for AES-256
	}
	
	public function __destruct(){
	}
	
	public function ev($txt){
		$iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC), MCRYPT_RAND);
		$ciphertext = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, pack('H*', $this->SALT), $txt, MCRYPT_MODE_CBC, $iv);
		$ciphertext = $iv . $ciphertext;
		return urlencode(base64_encode($ciphertext));
	}

	public function dv($txt){
		$ciphertext_dec = base64_decode($txt);
		$iv = substr($ciphertext_dec, 0, mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC));
		$ciphertext_dec = substr($ciphertext_dec, mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC));
		return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_128, pack('H*', $this->SALT), $ciphertext_dec, MCRYPT_MODE_CBC, $iv));
	}
	
	public function ea($data){
		return $this->ev(json_encode($data,JSON_UNESCAPED_UNICODE));
	}

	public function da($data){
		return json_decode(trim($this->dv($data)), true);
	}

	public function generate_token($deviceid){
		$d = date('YmdHis');
		$token = DOMAIN_NAME.">>{$d}-{$deviceid}@InnCom";
		return $this->ev($token);
	}

	/*public function verify_token($_IN){//return true;
		$cipher = $_IN['token'];
		$plain = $this->dv($cipher);
		$regexp = '/^'.DOMAIN_NAME.'>>20\d{12}-(.+)\@InnCom$/';
		if(preg_match($regexp, $plain, $arr)){
			$deviceid = $arr[1];//機碼
		}else{
			return false;
		}

		return ($deviceid==$_IN['deviceid']);
	}*/

	public function verify_access($_IN, $fields){//return true;
		//欄位
		$data = array();
		while(list($n,$k)=each($fields)){
			$data[$k] = $_IN[$k];
		}
		//排序
		ksort($data);
		//組字串
		$str = '';
		while(list($k,$v)=each($data)){
			$v = ($k=='token')?urlencode($v):$v;//token收到時會被apache decode, 所以需encode再算
			$str .= "$k=$v&";
		}
		$str = substr($str, 0, -1);
		//加時間
		$d = date('Ymd');
		$str = "InncoM&{$str}&DianthuS&{$d}";
		//md5
		$hash = md5($str);
		//debug
		if($_IN['debug']==DEBUG_CODE){
			echo "PSTR: {$str}<br>MD5: {$hash}"; exit();
		}
		//比對
		return (strtoupper($hash)==strtoupper($_IN['access_token']));
	}//verify_access

}

?>