      <div class="row">
        <div class="col-xs-12">
		  <?php
			if(isset($_GET['edit'])){
				include_once 'konten_email_edit.php';				
			}
		  ?>
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Konten Email</h3>			  
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="table-member" class="table table-bordered table-striped table-member">
                <thead>
                <tr>
                  <th>NO</th>
                  <th>Konten Untuk</th>
                  <th>Judul Konten</th>
                  <th>Isi Konten</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
				<?php
					$konten = getDataAll("mlm_konten_email","nama_konten ASC");					
					$no = 1;
					if($konten->num_rows > 0){
						while($data = $konten->fetch_object()){
							switch($data->nama_konten){
								case 0 : $hari='Pendaftaran';break;
								case 1 : $hari='Hari Pertama';break;
								case 2 : $hari='Hari Kedua';break;
								case 3 : $hari='Hari Ketiga';break;
								case 4 : $hari='Hari Keempat';break;
								case 5 : $hari='Hari Kelima';break;
								case 6 : $hari='Hari Keenam';break;
								case 7 : $hari='Hari Ketujuh';break;
							}
							echo "
								<tr>					
								  <td>$no</td>
								  <td>".$hari."</td>
								  <td>".substr($data->judul_konten,0,250)."</td>
								  <td>".$data->isi_konten."</td>
								  <td>
								  <a href='?page=konten-email&edit=".$data->id_konten_email."' title='Edit konten Ini' class='btn btn-info btn-xs'><span class='fa fa-pencil'></span></a>
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