<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title">Upload Foto Galeri Baru</h3>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
				<div class="row">
					<div class="col-md-12">
					<?php
						if(isset($_POST["upload"])) {
							$target_dir = "../img/galeri/";
							$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
							$uploadOk = 1;
							$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
							// Check if image file is a actual image or fake image
							$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
							if($check !== false) {
								$uploadOk = 1;
							} else {
								$errmessage = "File is not an image.";
								$uploadOk = 0;
							}
							// Check if file already exists
							if (file_exists($target_file)) {
								$errmessage = "Sorry, file already exists.";
								$uploadOk = 0;
							}
							// Check file size
							if ($_FILES["fileToUpload"]["size"] > 200000) {
								$errmessage = "Sorry, your file is too large.";
								$uploadOk = 0;
							}
							// Allow certain file formats
							if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
							&& $imageFileType != "gif" ) {
								$errmessage = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
								$uploadOk = 0;
								
							}
							// Check if $uploadOk is set to 0 by an error
							if ($uploadOk == 0) {
								echo '<div class="alert alert-danger alert-dismissible">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
										<h4><i class="icon fa fa-ban"></i> Alert!</h4>
										Sorry, your file was not uploaded. '.$errmessage.'
									  </div>
								';
							// if everything is ok, try to upload file
							} else {
								if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
									$stmt = $mysqli->query("insert into mlm_gallery(foto_gallery,keterangan) values('img/galeri/".$_FILES['fileToUpload']['name']."','".$_POST["keterangan"]."')");
									if($stmt){
										echo '<div class="alert alert-success alert-dismissible">
											<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
											<h4><i class="icon fa fa-check"></i> Alert!</h4>
											The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.
										  </div>
										';										
									}else{
										unlink("../img/galeri/".$_FILES['fileToUpload']['name']);
										echo "Sorry, error when saving to databse";									
									}
									
								}else{
									echo '<div class="alert alert-danger alert-dismissible">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
										<h4><i class="icon fa fa-ban"></i> Alert!</h4>
										Sorry, there was an error uploading your file.
									  </div>
									';
								}
							}
						}
					?>
						<form role="form" action="" method="post" enctype="multipart/form-data">
							<div class="box-body">
								<div class="form-group col-md-6">
									<label for="exampleInputFile">Pilih Foto (format gambar : png/jpg. Maksimal ukuran : 2MB. Resolusi : 1200x800)</label>
									<input type="file" class="form-control" name="fileToUpload">
								</div>
								<div class="form-group col-md-4">
									<label for="exampleInputEmail1">Keterangan Foto</label>
									<input type="text" class="form-control" name="keterangan" placeholder="Keterangan singkat foto">
								</div>
								<div class="form-group col-md-1">
									<label for="exampleInputFile">Upload</label>
									<input type="submit" class="btn btn-primary" name="upload" value="UPLOAD FOTO">
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
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title">Daftar Foto Galeri</h3>
			</div>
			<div class="box-body">
				<div class="row">
					<div class="col-md-12">
					<?php
						if(isset($_GET['delete'])){
							$stmt = $mysqli->query("delete from mlm_gallery where id_gallery=".$_GET['delete']);
							if($stmt){
								unlink("../".$_GET['path']);
								echo '<div class="alert alert-success alert-dismissible">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
										<h4><i class="icon fa fa-ban"></i> Alert!</h4>
										Berhasil menghapus foto.
									  </div>
									';
								echo '<meta http-equiv="refresh" content="2; url=?page=galeri" />';
							}else{
								echo '<div class="alert alert-danger alert-dismissible">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
										<h4><i class="icon fa fa-ban"></i> Alert!</h4>
										Maaf, gagal menghapus foto.
									  </div>
									';
							}
						}
					?>
					</div>
					<?php
						$galeri = getDataAll("mlm_gallery","created_at ASC");
						while($data = $galeri->fetch_object()){
					?>
							<div class="col-md-2 ">
								<div class="box">
									<div class="box-body">
										<img src="<?php echo "../".$data->foto_gallery;?>" title="<?php echo $data->keterangan;?>" class="thumbnail" width="100%"/>
										<a href="?page=galeri&delete=<?php echo $data->id_gallery;?>&path=<?php echo $data->foto_gallery;?>" onClick="return confirm('Anda yakin ingin menghapus foto ini?')" class="btn btn-danger btn-xs" style="width:100%" >HAPUS FOTO</a>
									</div>
								</div>
							
							</div>
					<?php
						}
					?>
				</div>
			</div>
			<!-- /.box-body -->
		</div>
		<!-- /.box -->
	</div>
	<!-- /.col -->
</div>
<!-- /.row -->