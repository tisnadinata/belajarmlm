<?php
	include 'config/config.php';
	define('FACEBOOK_SDK_V4_SRC_DIR', __DIR__ . '/library/facebook-sdk-v5/');
	require_once __DIR__ . '/library/facebook-sdk-v5/autoload.php';
	ini_set('display_errors',1);
	$app_id = "116552792285869";
	$app_secret = "58383cd15b0e7dcce72bf2c8324e86fa";
  $fb = new Facebook\Facebook([
	'app_id' => $app_id, // Replace {app-id} with your app id
	'app_secret' => $app_secret,
	'default_graph_version' => 'v2.9',
  ]);

$helper = $fb->getRedirectLoginHelper();

try {
  $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

if (! isset($accessToken)) {
  if ($helper->getError()) {
    header('HTTP/1.0 401 Unauthorized');
    echo "Error: " . $helper->getError() . "\n";
    echo "Error Code: " . $helper->getErrorCode() . "\n";
    echo "Error Reason: " . $helper->getErrorReason() . "\n";
    echo "Error Description: " . $helper->getErrorDescription() . "\n";
  } else {
    header('HTTP/1.0 400 Bad Request');
    echo 'Bad request';
  }
  exit;
}

// Logged in
echo '<h3>Access Token</h3>';
var_dump($accessToken->getValue());

// The OAuth 2.0 client handler helps us manage access tokens
$oAuth2Client = $fb->getOAuth2Client();

// Get the access token metadata from /debug_token
$tokenMetadata = $oAuth2Client->debugToken($accessToken);
echo '<h3>Metadata</h3>';
var_dump($tokenMetadata);

// Validation (these will throw FacebookSDKException's when they fail)
$tokenMetadata->validateAppId($app_id); // Replace {app-id} with your app id
// If you know the user ID this access token belongs to, you can validate it here
//$tokenMetadata->validateUserId('123');
$tokenMetadata->validateExpiration();

if (! $accessToken->isLongLived()) {
  // Exchanges a short-lived access token for a long-lived one
  try {
    $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
  } catch (Facebook\Exceptions\FacebookSDKException $e) {
    echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
    exit;
  }

  echo '<h3>Long-lived</h3>';
  var_dump($accessToken->getValue());
}

$_SESSION['fb_access_token'] = (string) $accessToken;
$fb->setDefaultAccessToken($_SESSION['fb_access_token']);

try {
  $response = $fb->get('/me?fields=id,name,email,picture.width(300)');
  $userNode = $response->getGraphUser();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}
$stmt = $mysqli->query("select * from mlm_users where email_user = '".$userNode->getField('email')."'");
if($stmt->num_rows == 0 ){
	if($userNode->getField('email') != ''){
		$affilaite = explode("@",$userNode->getField('email'));
		$affilaite = $affilaite[0];
	}else{
		$affilaite = str_replace(" ","",$userNode->getName());
		$affilaite = substr($affilaite,2,10);
	}
	$upline = 0;
	if(isset($_SESSION['affiliate'])){
		$stmt = $mysqli->query("select * from mlm_users where affiliate_user='".$_SESSION['affiliate']."'");
		if($stmt->num_rows > 0){
			$upline = $stmt->fetch_object()->id_user;
		}else{
			$upline = 0;
		}
	}else{
		$upline = 0;
	}
	$data = array(
		"nama_user" => $userNode->getName(),
		"username" => $affilaite,
		"password" => "",
		"email_user" => $userNode->getField('email'),
		"affiliate_user" => $affilaite,
		"upline_user" => $upline,
		"foto_user" => $userNode->getField('picture')['url'],
		"hybridauth_provider_name" => "facebook",
		"hybridauth_provider_uid" => $userNode->getField('id')
	);
	$regis = user_registration($data);
	if($regis['status']){
		$_SESSION['id_user'] = $regis['data']->id_user;
		$_SESSION['nama_user'] = $regis['data']->nama_user;
		$_SESSION['created_at'] = $regis['data']->created_at;
		$_SESSION['username'] = $regis['data']->username;
		$_SESSION['foto_user'] = $regis['data']->foto_user;
		$konten = $mysqli->query("select * from mlm_konten_email where nama_konten=0")->fetch_object();
		$judul = $konten->judul_konten;
		$isi = $konten->isi_konten;
		$judul = str_replace("[nama]",$_SESSION['nama_user'],$judul);
		$judul = str_replace("[email]",$userNode->getField('email'),$judul);
		$judul = str_replace("[telepon]","-",$judul);
		$judul = str_replace("[affiliate]","http://".$_SESSION['username'].".belajarmlm.com/",$judul);
		$judul = str_replace("[saldo]",0,$judul);
		$judul = str_replace("[username]",$_SESSION['username'],$judul);
		
		$isi = str_replace("[nama]",$_SESSION['nama_user'],$isi);
		$isi = str_replace("[email]",$userNode->getField('email'),$isi);
		$isi = str_replace("[telepon]","-",$isi);
		$isi = str_replace("[affiliate]","http://".$_SESSION['username'].".belajarmlm.com/",$isi);
		$isi = str_replace("[saldo]",0,$isi);
		$isi = str_replace("[username]",$_SESSION['username'],$isi);
		
		sendEmail($userNode->getField('email'),$judul,$isi);
		header('Location: '.getSetting("base_url")->value_setting.'/member');
	}else{
		header('Location: '.getSetting("base_url")->value_setting.'/login');
	}
}else{
	$data_user = $stmt->fetch_object();
	$_SESSION['id_user'] = $data_user->id_user;
	$_SESSION['nama_user'] = $data_user->nama_user;
	$_SESSION['created_at'] = $data_user->created_at;
	$_SESSION['username'] = $data_user->username;
	$_SESSION['foto_user'] = $data_user->foto_user;
	header('Location: '.getSetting("base_url")->value_setting.'/member');
}

?>