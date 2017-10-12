      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Member <?php echo ucfirst($_GET['sub']);?></h3>
			  <?php
				$stmt_result = "nothing";
				if(isset($_GET['free'])){
					$stmt = $mysqli->query("update mlm_users set status_user='free' where id_user=".$_GET['free']);
					if($stmt){
						$stmt_result = "success";
					}else{
						$stmt_result = "fail";
					}
				}
				if(isset($_GET['premium'])){
					$stmt = $mysqli->query("update mlm_users set status_user='premium' where id_user=".$_GET['premium']);
					if($stmt){
						$stmt_result = "success";
					}else{
						$stmt_result = "fail";
					}					
				}
				if(isset($_GET['nonaktif'])){
					$stmt = $mysqli->query("update mlm_users set status_user='nonaktif' where id_user=".$_GET['nonaktif']);
					if($stmt){
						$stmt_result = "success";
					}else{
						$stmt_result = "fail";
					}
				}
				if($stmt_result == "success"){
					echo '<div class="alert alert-success alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<h4><i class="icon fa fa-check"></i> Alert!</h4>
						Status user berhasil diubah.
					  </div>
					';
				}else if($stmt_result == "fail"){
					echo '<div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<h4><i class="icon fa fa-ban"></i> Alert!</h4>
						Gagal mengubah status user, silahkan ulangi kembali.
					  </div>
					';
				}
			  ?>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="table-member" class="table table-bordered table-striped table-member">
                <thead>
                <tr>
                  <th>NO</th>
                  <th>Nama Lengkap</th>
                  <th>Username</th>
                  <th>Email User</th>
                  <th>Link Affiliate</th>
                  <th>UPLINE</th>
                  <th>Saldo</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
				<?php
					$status = strtolower($_GET['sub']);
					$member = getDataByCollumn("mlm_users","status_user",$status);					
					$no = 1;
					if($member->num_rows > 0){
						while($data = $member->fetch_object()){
							$upline = getDataByCollumn("mlm_users","id_user",$data->upline_user);
							if($upline->num_rows > 0){
								$upline = $upline->fetch_object()->nama_user;
							}else{
								$upline = "Tidak Ada";
							}
							echo "
								<tr>					
								  <td>$no</td>
								  <td>".$data->nama_user."</td>
								  <td>".$data->username."</td>
								  <td>".$data->email_user."</td>
								  <td>".$data->affiliate_user."</td>
								  <td><span class='label label-info'>".$upline."</span></td>
								  <td>Rp".getRupiah($data->saldo_user)."</td>
								  <td>
							";
								if($_GET['sub'] == 'free' OR $_GET['sub'] == 'nonaktif'){
									echo "
										<a href='?page=member&sub=".$_GET['sub']."&premium=".$data->id_user."' title='Ubah Status Menjadi Premium' class='btn btn-primary btn-xs'><span class='fa fa-level-up'></span></a>
									";
								}
								if($_GET['sub'] == 'premium' OR $_GET['sub'] == 'nonaktif'){
									echo "
										<a href='?page=member&sub=".$_GET['sub']."&free=".$data->id_user."' title='Ubah Status Menjadi Free' class='btn btn-info btn-xs'><span class='fa fa-level-down'></span></a>
									";
								}
								if($_GET['sub'] != 'nonaktif'){
									echo "
										<a href='?page=member&sub=".$_GET['sub']."&nonaktif=".$data->id_user."' title='NON Aktifkan Member' class='btn btn-danger btn-xs'><span class='fa fa-power-off'></span></a>
									";
								}
							echo"
								  </td>
								</tr>
							";
							$no ++;
						}
					}else{
						echo "<tr><td colspan='9'><h5>BELUM ADA MEMBER YANG TERDAFTAR DENGAN STATUS ".strtoupper($status)."</h5></td></tr>";
					}
				?>
                </tbody>                
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->