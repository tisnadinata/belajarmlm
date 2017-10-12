<?php
	$menu[0] = "";
	$menu[1] = "";
	$menu[2] = "";
	$menu[3] = "";
	$menu[4] = "";
	$menu[5] = "";
	
	if(isset($_GET['page'])){
		switch($_GET['page']){
			case "dashboard" : $menu[0] = "active";break;
			case "member" : $menu[1] = "active";break;
			case "testimoni" :$menu[2] = "active";break;
			case "galeri" : $menu[3] = "active";break;
			case "konten-email" :$menu[4] = "active";break;
		}	
	}else{
		$menu[0] = "active";		
	}
?>
<!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="<?php echo $menu[0];?>">
          <a href="?page=dashboard">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li class="treeview <?php echo $menu[1];?>">
          <a href="#">
            <i class="fa fa-users"></i>
            <span>Kelola Member</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="?page=member&sub=free"><i class="fa fa-circle-o"></i> Free Member</a></li>
            <li><a href="?page=member&sub=premium"><i class="fa fa-circle-o"></i> Premium Member</a></li>
            <li><a href="?page=member&sub=nonaktif"><i class="fa fa-circle-o"></i> Non Aktif Member</a></li>
          </ul>
        </li>
        <li class="treeview <?php echo $menu[2];?>">
          <a href="#">
            <i class="fa fa-commenting-o"></i>
            <span>Testimoni Member</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="?page=testimoni&sub=pending"><i class="fa fa-circle-o"></i> Pending Testimoni</a></li>
            <li><a href="?page=testimoni&sub=approved"><i class="fa fa-circle-o"></i> Approved Testimoni</a></li>
            <li><a href="?page=testimoni&sub=rejected"><i class="fa fa-circle-o"></i> Rejected Testimoni</a></li>
          </ul>
        </li>
        <li class="<?php echo $menu[3];?>">
          <a href="?page=galeri">
            <i class="fa fa-photo"></i>
            <span>Galeri Website</span>
          </a>
        </li>
        <li class="<?php echo $menu[4];?>">
          <a href="?page=konten-email">
            <i class="fa fa-envelope"></i> <span>Konten Email</span>
          </a>
        </li>
      </ul>