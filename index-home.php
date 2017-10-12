<?php
	include_once 'config/config.php';
	if(isset($_POST['btn-subs'])){
		$nama_subscribe = $_POST['name'];
		$email_subscribe = $_POST['email'];
		$sql = "INSERT INTO mlm_subscribe(nama_subscribe,email_subscribe) VALUES('$nama_subscribe','$email_subscribe')";		
		if(getDataByCollumn("mlm_subscribe","email_subscribe",$email_subscribe)->num_rows == 0){
			$stmt = $mysqli->query($sql);		
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo getSetting("website_title")->value_setting;?></title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/costum.css" rel="stylesheet">
    <style>
          
        @media screen and (min-width: 767px) { 
          .margin{margin: 0px 25%;}
        }
        @media screen and (max-width: 766px) {
          .title{width: 100%!important;}
          .nopad{padding: 0px;}
         }
    </style>
  </head>
  <body>
      <div class="topbar">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><?php echo getSetting("website_name")->value_setting;?></a>
          </div>
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="login"><i class="fa fa-facebook"></i></a></li>
            <li><a href="login"><i class="fa fa-google"></i></a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li style="border-right: 1.5px solid #1cbbb4;"><a href="login">Signup</a></li>
            <li style="border-left: 1px solid #1cbbb4;"><a href="login">Login</a></li>
          </ul>
        </div>
      </div>

      <section id="home">
        <div class="container">
          <div class="col-md-6 col-sm-12 margin">
            <div class="embed-responsive embed-responsive-16by9">
            <iframe class="embed-responsive-item" src="<?php echo getSetting("home_video")->value_setting;?>" frameborder="0"></iframe>
          </div>
          </div>
        </div>
      </section>
	  <div class="separate-white">  </div>
      <section id="join">
        <div class="container">
        <div class="text-center"><h1 class="title">LET JOIN US</h1></div>
          <div class="col-md-12 text-center">
            <p class="caption-join">
              Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type 
              and scrambled it to make a type specimen book. It has survived not only five centuries, 
              but also the leap into electronic typesetting, remaining essentially unchanged. 
              Lorem Ipsum is simply dummy text of the printing and typesetting industry. #1cbbb4
            </p><br>
            <a href="#"><img src="img/arrow_button.png" width="50"></a>
          </div>
        </div>
      </section>
	  <div class="separate-white">  </div>
      <section id="gallery">
        <div class="container">
        <div class="line text-center hidden-xs">
          <hr>
        </div>

        <div>
          <h2 class="title text-center" style="background: #1cbbb4;z-index: 9; position: relative; width:20%; margin:0 auto;">Gallery</h2>
        </div>
        <br>
          <div class="col-md-12 text-center">
            <div class="row">
				<?php
					$gallery = getDataAll("mlm_gallery","rand() LIMIT 8");
					while($get = $gallery->fetch_object()){
						?>
							<div class="col-xs-12 col-sm-6 col-md-3">
							  <a href="#" class="thumbnail" >
								<img src="<?php echo $get->foto_gallery;?>" class="img-responsive" style="width: 100%; height: auto;">
							  </a>
							</div>
						<?php
					}
				?>
			</div>
          </div>
        </div>
      </section>
	  <div class="separate-white">  </div>
      <section id="tesetimonial">
        <div class="container">
        <div class="text-center"><h2 class="title">Testimonial</h2></div>
		<?php
			$testimoni = getDataByCollumn("mlm_testimoni","status_testimoni","verified");
			if($testimoni->num_rows != 0){
				$jum_testi = $testimoni->num_rows;
		?>
			  <div class="col-md-12 text-center">
				<div class="col-md-12" data-wow-delay="0.2s">
					<div class="carousel slide" data-ride="carousel" id="quote-carousel">
						<!-- Bottom Carousel Indicators -->
						<ol class="carousel-indicators">
							<li data-target="#quote-carousel" data-slide-to="0" class="active"></li>
							<?php
								if($jum_testi > 1){
									for($i=1;$i<$jum_testi;$i++){
										echo'
											<li data-target="#quote-carousel" data-slide-to="'.$i.'"></li>
										';
									}
								}
							?>
						</ol>

						<!-- Carousel Slides / Quotes -->
						<div class="carousel-inner text-center">

							<?php
								$get = $testimoni->fetch_object();
								$data_user = getDataByCollumn("mlm_users","id_user",$get->id_user)->fetch_object();
								?>
								<!-- Quote 1 -->
								<div class="item active">
									<blockquote>
										<div class="row">
											<div class="col-md-12">
											  <div class="col-xs-12 col-md-2 nopad">
												<img src="<?php echo $data_user->foto_user;?>" class="img-responsive width="250px">
											  </div>
											  <div class="col-xs-12 col-md-10 nopad">
												  <h3 class="text-left" style="text-transform: uppercase;"><?php echo $data_user->nama_user;?></h3><br>
												  <div class="text-left">
													<?php echo $get->isi_testimoni;?>
												  </div>
											  </div>
											</div>
										</div>
									</blockquote>
								</div>
								<?php
								if($jum_testi > 1){
									while($get = $testimoni->fetch_object()){
										?>
										<!-- Quote-->
										<div class="item">
											<blockquote>
												<div class="row">
													<div class="col-md-12">
													  <div class="col-xs-12 col-md-2 nopad">
														<img src="<?php echo $data_user->foto_user;?>" class="img-responsive width="250px">
													  </div>
													  <div class="col-xs-12 col-md-10 nopad">
														  <h3 class="text-left" style="text-transform: uppercase;"><?php echo $data_user->nama_user;?></h3><br>
														  <div class="text-left">
															<?php echo $get->isi_testimoni;?>
														  </div>
													  </div>
													</div>
												</div>
											</blockquote>
										</div>
										<?php
									}
								}								
							?>
						</div>
						<!-- Carousel Buttons Next/Prev -->
						<a data-slide="prev" href="#quote-carousel" class="left carousel-control"><i class="fa fa-chevron-left"></i></a>
						<a data-slide="next" href="#quote-carousel" class="right carousel-control"><i class="fa fa-chevron-right"></i></a>
					</div>
				</div>
			  </div>
		<?php
			}else{
				echo '<div class="col-md-12 text-center">
						<p class="caption-join">
							BELUM ADA TESTIMONI UNTUK SAAT INI
						</p><br>
					  </div>
				';
			}
		?>
        </div>
      </section>
      <footer class="footer" style="padding: 10px; background: #1cbbb4; overflow: hidden;">
          <div class="container">
              <p class="text-muted" style="color: #fff;">
                  &copy;<a href="" style="color: #fff;"><i>www.belajarmlm.com</i></a> all reserved
              </p>
          </div>
      </footer>




    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>