<div id="sidebar" class="sidebar">
	<!-- begin sidebar scrollbar -->
	<div data-scrollbar="true" data-height="100%">
		<!-- begin sidebar user -->
		<ul class="nav">
			<?php
			if(isset($_SESSION['login'])){
				$q=mysql_query("select * from user where email='$_SESSION[login]'");
				$h=mysql_fetch_array($q);
			?>
			<li class="nav-profile">
				<div class="image">
					<a href="javascript:;"><img src="<?php echo $h['foto']; ?>" alt="" /></a>
				</div>
				<div class="info">
					<?php echo $h['nama']; ?>
					<small><?php echo $h['email']; ?></small>
				</div>
			</li>
			<?php
			}else{
			?>
			<li class="nav-profile">
				<div class="image">
					<a href="javascript:;"><img src="assets/img/user.png" alt="" /></a>
				</div>
				<div class="info">
					Pengunjung
					<small>Silahkan Sign In Dulu</small>
				</div>
			</li>
			<?php
			}
			?>
		</ul>
		<!-- end sidebar user -->
		<!-- begin sidebar nav -->
		<ul class="nav">
			<li class="<?php echo (!isset($_GET['menu']))?'active':''; ?>">
				<a href="?"><i class="fa fa-headphones"></i> <span>Stream</span></a>
			</li>
			<li class="<?php echo ($_GET['menu']=='peraturan')?'active':''; ?>">
				<a href="?menu=peraturan"><i class="fa fa-shield"></i> <span>Peraturan</span></a>
			</li>
			<li class="<?php echo ($_GET['menu']=='tutorial')?'active':''; ?>">
				<a href="?menu=tutorial"><i class="fa fa-life-ring"></i> <span>Tutorial</span></a>
			</li>
			<li class="<?php echo ($_GET['menu']=='aboutus')?'active':''; ?>">
				<a href="?menu=aboutus"><i class="fa fa-laptop"></i> <span>About Us</span></a>
			</li>
			
			<!-- begin sidebar minify button -->
			<li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
			<!-- end sidebar minify button -->
		</ul>
		<!-- end sidebar nav -->
	</div>
	<!-- end sidebar scrollbar -->
</div>
<div class="sidebar-bg"></div>