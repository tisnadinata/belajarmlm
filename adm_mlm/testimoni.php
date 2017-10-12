      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Testimoni <?php echo ucfirst($_GET['sub']);?></h3>
			  <?php
				$stmt_result = "nothing";
				if(isset($_GET['approve'])){
					$stmt = $mysqli->query("update mlm_testimoni set status_testimoni='approved' where id_testimoni=".$_GET['approve']);
					if($stmt){
						$stmt_result = "success";
					}else{
						$stmt_result = "fail";
					}
				}
				if(isset($_GET['reject'])){
					$stmt = $mysqli->query("update mlm_testimoni set status_testimoni='rejected' where id_testimoni=".$_GET['reject']);
					if($stmt){
						$stmt_result = "success";
					}else{
						$stmt_result = "fail";
					}					
				}
				if(isset($_GET['delete'])){
					$stmt = $mysqli->query("delete from mlm_testimoni where id_testimoni=".$_GET['delete']);
					if($stmt){
						echo '<div class="alert alert-success alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<h4><i class="icon fa fa-check"></i> Alert!</h4>
							Berhasil menghapus testimoni.
						  </div>
						';
					}else if($stmt_result == "fail"){
						echo '<div class="alert alert-danger alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<h4><i class="icon fa fa-ban"></i> Alert!</h4>
							Gagal menghapus testimoni testimoni, silahkan ulangi kembali.
						  </div>
						';
					}
				}
				if($stmt_result == "success"){
					echo '<div class="alert alert-success alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<h4><i class="icon fa fa-check"></i> Alert!</h4>
						Status testimoni berhasil diubah.
					  </div>
					';
				}else if($stmt_result == "fail"){
					echo '<div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<h4><i class="icon fa fa-ban"></i> Alert!</h4>
						Gagal mengubah status testimoni, silahkan ulangi kembali.
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
                  <th>Testimoni Dari</th>
                  <th>Isi Testimoni</th>
                  <th>Tanggal Testimoni</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
				<?php
					$status = strtolower($_GET['sub']);
					$testimoni = getDataByCollumn("mlm_testimoni","status_testimoni",$status);					
					$no = 1;
					if($testimoni->num_rows > 0){
						while($data = $testimoni->fetch_object()){
							$member = getDataByCollumn("mlm_users","id_user",$data->id_user);
							if($member->num_rows > 0){
								$member = $member->fetch_object()->nama_user;
							}else{
								$member = "Tidak Ada";
							}
							echo "
								<tr>					
								  <td>$no</td>
								  <td>".$member."</td>
								  <td>".$data->isi_testimoni."</td>
								  <td>".$data->created_at."</td>
								  <td>
							";
								if($_GET['sub'] == 'pending'){
									echo "
										<a href='?page=testimoni&sub=".$_GET['sub']."&approve=".$data->id_testimoni."' title='Setujui Testimoni Ini' class='btn btn-success btn-xs'><span class='fa fa-check'></span></a>
										<a href='?page=testimoni&sub=".$_GET['sub']."&reject=".$data->id_testimoni."' title='Tolak Testimoni Ini' class='btn btn-warning btn-xs'><span class='fa fa-close'></span></a>
									";
								}else if($_GET['sub'] == 'approved'){
									echo "
										<a href='?page=testimoni&sub=".$_GET['sub']."&reject=".$data->id_testimoni."' title='Tolak Testimoni Ini' class='btn btn-warning btn-xs'><span class='fa fa-close'></span></a>
									";
								}else if($_GET['sub'] == 'rejected'){
									echo "
										<a href='?page=testimoni&sub=".$_GET['sub']."&approve=".$data->id_testimoni."' title='Setujui Testimoni Ini' class='btn btn-success btn-xs'><span class='fa fa-check'></span></a>
									";
								}
							echo"
								  <a href='?page=testimoni&sub=".$_GET['sub']."&delete=".$data->id_testimoni."' title='Hapus Testimoni Ini' class='btn btn-danger btn-xs'><span class='fa fa-trash'></span></a>
								  </td>
								</tr>
							";
							$no ++;
						}
					}else{
						echo "<tr><td colspan='5'><h5>BELUM ADA DATA TERSEDIA</h5></td></tr>";
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