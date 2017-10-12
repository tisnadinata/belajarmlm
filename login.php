<?php
	include_once 'config/config.php';
	if(isset($_SESSION['nama_user'])){
		header('Location: '.getSetting("base_url")->value_setting.'/member');
	}
	define('FACEBOOK_SDK_V4_SRC_DIR', __DIR__ . '/library/facebook-sdk-v5/');
	require_once __DIR__ . '/library/facebook-sdk-v5/autoload.php';
	$app_id = "116552792285869";
	$app_secret = "58383cd15b0e7dcce72bf2c8324e86fa";
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title><?php echo getSetting("website_title")->value_setting;?></title>
  
  <link rel="stylesheet" href="css/normalize.min.css">
  <link href="css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
</head>

<body>


  <div class="logmod">
  <div class="logmod__wrapper" >
	<div style="text-align:center;">
	<?php
		$fb = new Facebook\Facebook([
		  'app_id' => $app_id, // Replace {app-id} with your app id
		  'app_secret' => $app_secret,
		  'default_graph_version' => 'v2.9',
		  ]);

		$helper = $fb->getRedirectLoginHelper();

		$permissions = ['email']; // Optional permissions
		$loginUrl = $helper->getLoginUrl(getSetting("base_url")->value_setting.'/fb-callback.php', $permissions);

		if(isset($_POST['register'])){
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
				"nama_user" => $_POST['user-name'],
				"username" => $_POST['user-username'],
				"password" => enkripPassword($_POST['user-pw']),
				"email_user" => $_POST['user-email'],
				"affiliate_user" => $_POST['user-username'],
				"upline_user" => $upline,
				"foto_user" => "http://www.ruralagriventures.com/wp-content/uploads/2017/05/man-team.jpg",
				"hybridauth_provider_name" => NULL,
				"hybridauth_provider_uid" => NULL
			);
			$regis = user_registration($data);
			if($regis['status']){
				$konten = $mysqli->query("select * from mlm_konten_email where nama_konten=0")->fetch_object();
				$judul = $konten->judul_konten;
				$isi = $konten->isi_konten;
				$judul = str_replace("[nama]",$_POST['user-name'],$judul);
				$judul = str_replace("[email]",$_POST['user-email'],$judul);
				$judul = str_replace("[telepon]","-",$judul);
				$judul = str_replace("[affiliate]","http://".$_POST['user-username'].".belajarmlm.com/",$judul);
				$judul = str_replace("[saldo]",0,$judul);
				$judul = str_replace("[username]",$_POST['user-username'],$judul);
				
				$isi = str_replace("[nama]",$_POST['user-name'],$isi);
				$isi = str_replace("[email]",$_POST['user-email'],$isi);
				$isi = str_replace("[telepon]","-",$isi);
				$isi = str_replace("[affiliate]","http://".$_POST['user-username'].".belajarmlm.com/",$isi);
				$isi = str_replace("[saldo]",0,$isi);
				$isi = str_replace("[username]",$_POST['user-username'],$isi);
				
				sendEmail($_POST['user-email'],$judul,$isi);
				echo "<div class='alert-success'>".$regis['message']."</div>";
			}else{
				echo "<div class='alert-fail'>".$regis['message']."</div>";
			}
		}
		if(isset($_POST['login'])){
				
			$data = array(
				"username" => $_POST['user-username'],
				"password" => enkripPassword($_POST['user-pw'])
			);
			$login = user_login($data);
			if($login['status']){
				echo "<div class='alert-success'>".$login['message']."</div>";
				$_SESSION['id_user'] = $login['data']->id_user;
				$_SESSION['nama_user'] = $login['data']->nama_user;
				$_SESSION['created_at'] = $login['data']->created_at;
				$_SESSION['username'] = $login['data']->username;
				$_SESSION['foto_user'] = $login['data']->foto_user;
				echo '<meta http-equiv="refresh" content="0; url=member" />';
			}else{
				echo "<div class='alert-fail'>".$login['message']."</div>";
			}
		}
	?>
	</div>
    <div class="logmod__container">
      <ul class="logmod__tabs">
        <li data-tabtar="lgm-2"><a href="#">Sign In</a></li>
        <li data-tabtar="lgm-1"><a href="#">Sign Up</a></li>
      </ul>
      <div class="logmod__tab-wrapper">
      <div class="logmod__tab lgm-1">
		
        <div class="logmod__heading">
          <span class="logmod__heading-subtitle">Enter your personal details <strong>to create an acount</strong></span>
        </div>
        <div class="logmod__form">
          <form action="" method="POST" class="simform">
           <div class="sminputs">
              <div class="input full">
                <label class="string optional" for="user-name">Full Name*</label>
                <input class="string optional" maxlength="255" id="user-name" name="user-name" placeholder="Full Name" type="text" size="50" required/>
              </div>
            </div>
           <div class="sminputs">
              <div class="input full">
                <label class="string optional" for="user-name">Email*</label>
                <input class="string optional" maxlength="255" id="user-email" name="user-email" placeholder="Email" type="email" size="50" required/>
              </div>
            </div>
            <div class="sminputs">
              <div class="input full">
                <label class="string optional" for="user-name">Username*</label>
                <input class="string optional" maxlength="255" id="user-username" name="user-username" placeholder="Username" type="text" size="50" required/>
              </div>
            </div>
            <div class="sminputs">
              <div class="input full">
                <label class="string optional" for="user-pw">Password *</label>
                <input class="string optional" maxlength="255" id="user-pw" name="user-pw" placeholder="Password" type="password" size="50" required/>
                <span class="hide-password">Show</span>
              </div>
            </div>
            <div class="simform__actions">
              <input class="sumbit" name="register" type="submit" value="SIGN UP" />
            </div> 
          </form>
        </div> 
        <div class="logmod__alter">
          <div class="logmod__alter-container">
            <a href="<?php echo htmlspecialchars($loginUrl) ?>" class="connect facebook">
              <div class="connect__icon">
                <i class="fa fa-facebook"></i>
              </div>
              <div class="connect__context">
                <span>Create an account with <strong>Facebook</strong></span>
              </div>
            </a>
              
            <a href="#" class="connect googleplus">
              <div class="connect__icon">
                <i class="fa fa-google-plus"></i>
              </div>
              <div class="connect__context">
                <span>Create an account with <strong>Google+</strong></span>
              </div>
            </a>
          </div>
        </div>
      </div>
      <div class="logmod__tab lgm-2">
        <div class="logmod__heading">
          <span class="logmod__heading-subtitle">Enter your email and password <strong>to sign in</strong></span>
        </div> 
        <div class="logmod__form">
          <form action="" method="POST" class="simform">
            <div class="sminputs">
              <div class="input full">
                <label class="string optional" for="user-name">Username*</label>
                <input class="string optional" maxlength="255" id="user-username" name="user-username" placeholder="Username" type="text" size="50" required/>
              </div>
            </div>
            <div class="sminputs">
              <div class="input full">
                <label class="string optional" for="user-pw">Password *</label>
                <input class="string optional" maxlength="255" id="user-pw" name="user-pw" placeholder="Password" type="password" size="50" required/>
                <span class="hide-password">Show</span>
              </div>
            </div>
            <div class="simform__actions">
              <input class="sumbit" name="login" type="submit" value="SIGN IN" />
			  <center><a href="forgot" style="font-size:10px;text-decoration:none">Forgot Your Username or Password ?</a></center>
            </div> 
          </form>
        </div> 
        <div class="logmod__alter">
          <div class="logmod__alter-container">
            <a href="<?php echo htmlspecialchars($loginUrl) ?>" class="connect facebook">
              <div class="connect__icon">
                <i class="fa fa-facebook"></i>
              </div>
              <div class="connect__context">
                <span>Sign in with <strong>Facebook</strong></span>
              </div>
            </a>
            <a href="#" class="connect googleplus">
              <div class="connect__icon">
                <i class="fa fa-google-plus"></i>
              </div>
              <div class="connect__context">
                <span>Sign in with <strong>Google+</strong></span>
              </div>
            </a>
          </div>
        </div>
          </div>
      </div>
    </div>
  </div>
</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script src="js/index.js"></script>

</body>
</html>
