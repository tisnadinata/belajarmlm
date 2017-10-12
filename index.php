<?php
	include_once 'config/config.php';
	if(isset($_GET['affiliate'])){
		$_SESSION['affiliate'] = $_GET['affiliate'];
	}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <title>
      <?php echo getSetting("website_title")->value_setting;?>
    </title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/costum.css" rel="stylesheet">
    <style>
      hr{border: 3px solid #eee;}
      .btn-reg:hover{background: #1aabbc;}
      .embed-video{max-width: 100%; max-height: 100%; }
      iframe{width: 100%; height: 100%; position: relative;}
    </style>
    </head>
    <body>
        <div class="topbar">
            <div class="container">
                <div class="navbar-header">
                    <button aria-expanded="false" class="navbar-toggle collapsed" data-target="#bs-example-navbar-collapse-1" data-toggle="collapse" type="button">
                        <span class="sr-only">
                            Toggle navigation
                        </span>
                        <span class="icon-bar">
                        </span>
                        <span class="icon-bar">
                        </span>
                        <span class="icon-bar">
                        </span>
                    </button>
                    <a class="navbar-brand visible-xs" href="#">
                        <?php echo getSetting("website_name")->value_setting;?>
                    </a>
                    <a class="navbar-brand hidden-xs" href="#">
                        <font size="50px"><?php echo getSetting("website_name")->value_setting;?></font>
                    </a>
                </div>
               
            </div>
            <section id="desk3">
                <div class="content">
                    <div class="container">
                        <div class="text-center">
                            <h2 class="title" style="margin-bottom:15px;">
                                Gratis Video
                            </h2>
                            <p class="caption">
                                "Akhirnya, sebuah cara mudah untuk merekrut - bebas penolakan - tanpa membuang waktu & peluang, mengejar prospek tidak tertarik.."
                            </p>
                        </div>
                    </div>
                    <hr style="margin-bottom:10px !important;">
                    <div class="col-md-12" style="padding: 0px;margin-bottom: 10px;">
                        <div class="col-md-6 col-xs-12 box" style="background: #eee; padding: 1%;">
                            <h3 class="title text-center"style="letter-spacing: 3px;">
                                Dalam video bonus, anda akan belajar
                            </h3>
                            <ul class="box-ul">
                                <li>
                                    Tips jitu menggunakan internet untuk mendapatkan ratusan prospek
                                </li>
                                <li>
                                    3 cara menjadi yang 'Dikejar', bukan lagi mengejar
                                </li>
                                <li>
                                    Rahasia membuat prospek rela membayar untuk melhat peluang bisnis anda
                                </li>
                                <li>
                                    Strategi ampuh membuat prospek minta di-closing kan 1 dengan senang hati
                                </li>
                                <li>
                                    Cara menggunakan alat bantu untuk menyaring prospek seperti emas
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-5 col-xs-12 margin" style="background: #fff;">
                            <div class="embed-video box-video">
                                <iframe class="embed-responsive-item" src="<?php echo getSetting("landing_video")->value_setting;?>" frameborder="0"></iframe>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="col-md-4 col-md-offset-1">
                      <p class="text-center" style="letter-spacing: 1px;font-size: 20px;">
                        Klik tombol <b>"SAYA SIAP BELAJAR!"</b> dibawah untuk segera mendapat akses BONUS VIDEO lewat inbox pesan email anda.
                      </p>
                    </div>
					<form action="home" method="post">
						<div class="col-md-3">
						  <div class="form-group">
							<input type="text" name="name" class="form-control input" placeholder="Masukan nama anda" required>
						  </div>
						  <div class="form-group">
							<input type="email" name="email" class="form-control input" placeholder="Masukan email anda" required>
						  </div>
						</div>
						<div class="col-md-3">
						  <div class="form-group">
							<button class="btn-reg" name="btn-subs" type="submit">saya siap belajar</button>
						  </div>
						</div>
					</form>

                </div>
            </section>
            <footer class="footer" style="background: #1cbbb4; overflow: hidden;">
                <div class="container">
                    <p class="text-muted" style="color: #fff;">
                        &copy;<a href="" style="color: #fff;"><i>www.belajarmlm.com</i></a> all reserved
                    </p>
                </div>
            </footer>
            <script src="js/jquery.min.js"></script>
            <script src="js/bootstrap.min.js"></script>
        </div>
    </body>
</html>