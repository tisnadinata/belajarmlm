<?php 
	session_start();
	$mysqli = new mysqli("localhost","root","","db_belajarmlm");
	//$mysqli = new mysqli("localhost","yoga_belajarmlm","belajarmlm","yoga_belajarmlm");
	require_once 'library/emailLibrary/function.php';
	if (mysqli_connect_errno())
	{
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	 // getting the user IP address
	function getIpCustomer(){
	$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP'))
			$ipaddress = getenv('HTTP_CLIENT_IP');
		else if(getenv('HTTP_X_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		else if(getenv('HTTP_X_FORWARDED'))
			$ipaddress = getenv('HTTP_X_FORWARDED');
		else if(getenv('HTTP_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
		else if(getenv('HTTP_FORWARDED'))
			$ipaddress = getenv('HTTP_FORWARDED');
		else if(getenv('REMOTE_ADDR'))
			$ipaddress = getenv('REMOTE_ADDR');
		else
			$ipaddress = 'IP Tidak Dikenali';
	 
		return $ipaddress;
	}
	function enkripPassword($value){
		return sha1(md5($value));	
	}
	function sendEmail($to, $subject, $message){
		smtp_mail($to, $subject, $message, '', '', 0, 0, true);
	}
	function getRupiah($harga){
		return number_format($harga,0,",",".");
	}
	function getSetting($nama_setting){
		global $mysqli;
		$stmt = $mysqli->query("select * from mlm_setting where nama_setting='$nama_setting'");
		return $stmt->fetch_object();
	}
	function getDataByCollumn($table_name,$field_name,$value){
		global $mysqli;
		$stmt = $mysqli->query("select * from $table_name where $field_name='$value'");
		return $stmt;
	}
	function getDataAll($table_name,$order_by){
		global $mysqli;
		$stmt = $mysqli->query("select * from $table_name order by $order_by");
		return $stmt;
	}
	function user_registration($data){
		global $mysqli;
		
		$nama_user = ucfirst($data['nama_user']);
		$username = $data['username'];
		$password = $data['password'];
		$email_user = $data['email_user'];
		$affiliate_user = str_replace(".","-",$data['affiliate_user']);
		$affiliate_user = str_replace(" ","_",$data['affiliate_user']);
		$upline_user = $data['upline_user'];
		$foto_user = $data['foto_user'];
		$hybridauth_provider_name = $data['hybridauth_provider_name'];
		$hybridauth_provider_uid = $data['hybridauth_provider_uid'];
		
		if(getDataByCollumn("mlm_users","username",$username)->num_rows == 0 AND getDataByCollumn("mlm_users","email_user",$email_user)->num_rows == 0){
			$sql = "insert into mlm_users(nama_user,username,password,email_user,affiliate_user,upline_user,foto_user,hybridauth_provider_name,hybridauth_provider_uid) 
			VALUES('$nama_user','$username','$password','$email_user','$affiliate_user','$upline_user','$foto_user','$hybridauth_provider_name','$hybridauth_provider_uid')";

			$stmt = $mysqli->query($sql);
			if($stmt){
				$stmt = $mysqli->query("select * from mlm_users where username='$username' AND password ='$password'");
				$result = array(
					"status" => true,
					"data" => $stmt->fetch_object(),
					"message" => "Data user sudah berhasil di daftarkan"
				);
			}else{
				$result = array(
					"status" => false,
					"message" => "Data user gagal di daftarkan"
				);
			}
		}else{
			$result = array(
				"status" => false,
				"message" => "Username / Email sudah digunakan, silahkan gunakan yang lain"
			);
		}
		return $result;
	}
	
	function user_login($data){
		global $mysqli;
		
		$username = $data['username'];
		$password = $data['password'];
		
		$stmt = $mysqli->query("select * from mlm_users where username='$username' AND password ='$password'");
		if($stmt->num_rows != 0){
			$result = array(
				"status" => true,
				"data" => $stmt->fetch_object(),
				"message" => "Login berhasil, anda akan dialhikan..."
			);
		}else{
			$result = array(
				"status" => false,
				"message" => "Username / Password anda salah..."
			);
		}
		return $result;
	}
	
	
	
	
	
	
	
	
	
	
	
	
?>