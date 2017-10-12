<div class="box">
	<div class="box-header with-border">
		<h3 class="box-title">Edit Konten Email</h3>
	</div>
	<!-- /.box-header -->
	<div class="box-body">
		<div class="row">
			<div class="col-md-12">
			<?php
				$judul = "Tidak ada";
				$isi = "Tidak ada";
				$stmt = getDataByCollumn("mlm_konten_email","id_konten_email",$_GET['edit']);
				if($stmt->num_rows > 0){
					$data = $stmt->fetch_object();
					$judul = $data->judul_konten;
					$isi = $data->isi_konten;
				}else{
					$judul = "Tidak ada";
					$isi = "Tidak ada";
				}
				if(isset($_POST['save'])){
					$judul = $_POST['judul'];
					$isi = $_POST['editor'];
					$sql = "update mlm_konten_email set judul_konten='$judul',isi_konten='$isi' where id_konten_email=".$_GET['edit'];
					$stmt = $mysqli->query($sql);
					if($stmt){
						echo '<div class="alert alert-success alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<h4><i class="icon fa fa-check"></i> Alert!</h4>
							Konten email <b>'.$judul.'</b> sudah berhasil di ubah dan di simpan.
						  </div>
						';
						echo '<meta http-equiv="refresh" content="2; url=?page=konten-email" />';
					}else{
						echo '<div class="alert alert-danger alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<h4><i class="icon fa fa-ban"></i> Alert!</h4>
							Konten email <b>'.$judul.'</b> gagal di ubah. Silahkan coba lagi
						  </div>
						';
					}
				}
				if(isset($_POST['preview'])){
					$judul = $_POST['judul'];
					$isi = $_POST['editor'];
					
					$judul_kirim = str_replace("[nama]","Admin BelajarMLM",$judul);
					$judul_kirim = str_replace("[email]",$_POST['email'],$judul_kirim);
					$judul_kirim = str_replace("[telepon]","08123456789",$judul_kirim);
					$judul_kirim = str_replace("[affiliate]","http://admin.belajarmlm.com",$judul_kirim);
					$judul_kirim = str_replace("[saldo]",123456789,$judul_kirim);
					$judul_kirim = str_replace("[username]","adminmlm",$judul_kirim);
					
					$isi_kirim = str_replace("[nama]","Admin BelajarMLM",$isi);
					$isi_kirim = str_replace("[email]",$_POST['email'],$isi_kirim);
					$isi_kirim = str_replace("[telepon]","08123456789",$isi_kirim);
					$isi_kirim = str_replace("[affiliate]","http://admin.belajarmlm.com",$isi_kirim);
					$isi_kirim = str_replace("[saldo]",123456789,$isi_kirim);
					$isi_kirim = str_replace("[username]","adminmlm",$isi_kirim);
				
					sendEmail($_POST['email'],"[PREVIEW]".$judul_kirim,$isi_kirim);
					echo '<div class="alert alert-info alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<h4><i class="icon fa fa-check"></i> Alert!</h4>
							Email preview sudah dikirim ke <b>'.$_POST['email'].'</b>
						  </div>
					';
				}
				
			?>
			<!-- form start -->
				<form role="form" action="" method="post">
					<div class="box-body">
						<div class="form-group">
							<div class="col-md-5"  style="padding:0px;">
								<label for="exampleInputEmail1">Judul Konten</label>
								<input type="text" class="form-control" name="judul" placeholder="Judul / Subject konten" value="<?php echo $judul;?>">
							</div>
							<div class="col-md-7">
								Keterangan tag :
								<div class="col-md-12" style="padding:0px;">
									<div class="col-md-3" style="padding:0px;">
										<ul>
											<li>[nama] : Nama User</li>
											<li>[email] : Email User</li>
										</ul>
									</div>
									<div class="col-md-4" style="padding:0px;">
										<ul>
											<li>[telepon] : Telepon User</li>
											<li>[affiliate] : Link affiliate User</li>
										</ul>
									</div>
									<div class="col-md-4" style="padding:0px;">
										<ul>
											<li>[saldo] : Saldo User</li>
											<li>[username] : Username User</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1">Isi Konten Email</label><br>
							<textarea id="editor" name="editor" rows="10" cols="80">
                                     <?php echo $isi;?>
							</textarea>
						</div>
						
					</div>
					<!-- /.box-body -->
					<div class="box-footer">
						<div class="col-md-4">
							<div class="col-md-6" style="padding:0px;">
								<input type="text" class="form-control" name="email" placeholder="Email Tujuan" >
							</div>
							<div class="col-md-6" style="padding:0px;">
								<button type="submit" name="preview" class="btn btn-default">Kirim Preview Ke Email Ini</button>
							</div>
						</div>
						<div class="col-md-8">
							<button type="submit" name="save" class="btn btn-primary pull-right">Ubah dan Simpan Konten</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<!-- /.row -->
	</div>
	<!-- ./box-body -->
</div>
<!-- /.box -->
<script type="text/javascript">
  $(function () {
    // instance, using default configuration.
    CKEDITOR.replace('editor');
  });
</script>