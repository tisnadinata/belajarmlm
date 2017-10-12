<?php
	include_once 'config/config.php';	
	if(!isset($_SESSION['nama_user'])){
		header('Location: '.getSetting("base_url")->value_setting.'/login');
	}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>
            <?php echo getSetting("website_title")->value_setting;?>
        </title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <link href="css/bootstrap.min.css" media="screen" rel="stylesheet">
        <link href="css/costum.css" media="screen" rel="stylesheet">
        <link href="css/desk2.css" media="screen" rel="stylesheet">
    </head>
    <body>
        <div class="">
            <div class="panel panel-default" style="border: none;">
                <div class="panel-body nopadding">
                    <div class="container">
                        <div class="col-md-5">
                            <h1>
                                <?php echo getSetting("website_name")->value_setting;?>
                            </h1>
                        </div>
                        <div class="col-md-4">
                            <h3>
                                <?php echo $_SESSION['username']; ?>.belajarmlm.com
                            </h3>
                        </div>
                        <div class="col-md-3 details2">
                            <div class="col-md-8 col-sm-8 col-xs-8" style="text-align:right;border-right: 1px solid #ddd;">
                                <ul class="details">
                                    <li>
										<b>
                                        Welcome,
										 </b>
                                    </li>
                                    <li class="name" style="font-size:25px;line-height: 0.8;">
                                        <b>
                                            <?php echo $_SESSION['nama_user']; ?>
                                        </b>
                                    </li>
                                    <li class="date">
                                        <b>
                                            join date : <?php echo date("d F Y",strtotime($_SESSION['created_at'])); ?>
                                        </b>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-4" style="text-align:center;">
                                <a class="logout" href="logout">
                                    <h3 style="color:red;">
                                        Logout
                                    </h3>
                                </a>
                            </div>
                        </div>
                        <br>
                        </br>
                    </div>
                    <div class="col-md-12 nopadding" style="border-bottom: 15px solid #1cbbb4;margin:0px;">
                        <h3 class="text-center">
                            <img src="img/NOTIFICATIONICON.png" width="60px;" style="text-align:left;">
                                Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit..
                            </img>
                        </h3>
                    </div>
                    <div class="container">
                        <div class="col-md-12 nopadding">
                            <div class="col-md-2" style="padding-left: 0px;">
								<img src="<?php echo $_SESSION['foto_user']; ?>" class="thumbnail" width="100%" />
                                <div class="mobile">
                                    <ul class="menu">
                                        <li>
                                            <div class="dropdown">
                                                <button class="btn btn-success dropdown-toggle" data-toggle="dropdown" type="button">
                                                    DASHBOARD
                                                </button>
                                                <ul class="dropdown-menu menu">
                                                    <li class="omzet">
                                                        <a href="#">
                                                            omzet
                                                        </a>
                                                    </li>
                                                    <li class="prospek">
                                                        <a href="#">
                                                            prospek
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li>
                                            <a href="#">
                                                AFFILIATE
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                PELATIHAN
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="desktop">
                                    <ul class="menu">
                                        <li style="padding: 0;">
                                            <div class="dropdown">
                                                <button class="btn btn-success dropdown-toggle" data-target="#myNavbar" data-toggle="collapse" style="padding: 5px!important; font-size: 20px;" type="button">
                                                    DASHBOARD
                                                </button>
                                                <ul class="collapse menu" id="myNavbar" style="padding: 0;">
                                                    <li class="omzet">
                                                        <a href="#">
                                                            omzet
                                                        </a>
                                                    </li>
                                                    <li class="prospek">
                                                        <a href="#">
                                                            prospek
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li>
                                            <a href="#">
                                                AFFILIATE
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                PELATIHAN
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>
                                                Kemarin
                                            </td>
                                            <td>
                                                Seminggu
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Sebulan
                                            </td>
                                            <td>
                                                Setahun
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <hr style="border: 10px solid #1cbbb4;">
                <footer class="footer" style="padding: 10px; background: #1cbbb4; overflow: hidden;">
                  <div class="container">
                    <div class="col-md-12">
                      <p class="text-muted" style="color: #fff;">
                        &copy;<a href="" style="color: #fff;"><i>www.belajarmlm.com</i></a> all reserved
                      </p>
                    </div>
                  </div>
                </footer>
            </div>
        </div>
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>