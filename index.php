<?php
include 'koneksi.php';
if(isset($_GET['logout'])){
	session_destroy();
	?><script>location.href='?';</script><?php
}
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Musik</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link href="assets/plugins/jquery-ui-1.10.4/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
	<link href="assets/plugins/bootstrap-3.2.0/css/bootstrap.min.css" rel="stylesheet" />
	<link href="assets/plugins/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" />
	<link href="assets/css/animate.min.css" rel="stylesheet" />
	<link href="assets/css/style.min.css" rel="stylesheet" />
	<link href="assets/css/style-responsive.min.css" rel="stylesheet" />
	<link href="assets/css/theme/default.css" rel="stylesheet" id="theme" />
	<link href='assets/css/jquery.mentions.css' rel='stylesheet' type='text/css'>
	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="assets/plugins/jquery-jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" />
	<link href="assets/plugins/bootstrap-datepicker/css/datepicker.css" rel="stylesheet" />
	<link href="assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" />
    <link href="assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
	<link href="assets/plugins/bootstrap-wysihtml5/src/bootstrap-wysihtml5.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->
	
	<style>
		.notif{
			background-color:#AFC4E6;
		}
	</style>
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="assets/plugins/jquery-1.8.2/jquery-1.8.2.min.js"></script>
	<script src="assets/plugins/jquery-ui-1.10.4/ui/minified/jquery-ui.min.js"></script>
	<script src="assets/plugins/bootstrap-3.2.0/js/bootstrap.min.js"></script>
	<!--[if lt IE 9]>
		<script src="assets/crossbrowserjs/html5shiv.js"></script>
		<script src="assets/crossbrowserjs/respond.min.js"></script>
		<script src="assets/crossbrowserjs/excanvas.min.js"></script>
	<![endif]-->
	<script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="assets/plugins/jquery-cookie/jquery.cookie.js"></script>
	<script src="assets/js/underscore-min.js"></script>
	<!-- ================== END BASE JS ================== -->
</head>
<body>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	<div class="modal fade" id="modal-signin">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title">Sign In</h4>
				</div>
				<div class="modal-body">
					<form action="?" method="POST">
						<fieldset>
							<div class="form-group">
								<label for="email">Alamat Email</label>
								<input type="email" name="email" class="form-control" id="email" placeholder="Alamat email anda" />
							</div>
							<div class="form-group">
								<label for="pass">Password</label>
								<input type="password" name="pass" class="form-control" id="pass" placeholder="Password anda" />
							</div>
							<button type="submit" name="signin" class="btn btn-sm btn-primary m-r-5">Sign In</button>
							<button type="button" data-dismiss="modal" class="btn btn-sm btn-default">Cancel</button>
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</div>
	<script>
	function suka(id){
		if(<?php echo (isset($_SESSION['login']))?'true':'false'; ?>){
			location.href='<?php echo $_SERVER['REQUEST_URI']; ?>&suka='+id;
		}else{
			$('#modal-signin').modal('show');
		}
	}
	function komentar(id){
		if(<?php echo (isset($_SESSION['login']))?'true':'false'; ?>){
			var link;
			link='#modal-komentar-'+id;
			$(link).modal('show');
		}else{
			$('#modal-signin').modal('show');
		}
	}
	function ikuti(id){
		if(<?php echo (isset($_SESSION['login']))?'true':'false'; ?>){
			location.href='?menu=follow&id='+id;
		}else{
			$('#modal-signin').modal('show');
		}
	}
	</script>
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
		<!-- begin #header -->
		<div id="header" class="header navbar navbar-default navbar-fixed-top">
			<!-- begin container-fluid -->
			<div class="container-fluid">
				<!-- begin mobile sidebar expand / collapse button -->
				<div class="navbar-header">
					<a href="?" class="navbar-brand"><span class="navbar-logo"></span> Musik</a>
					<button type="button" class="navbar-toggle" data-click="sidebar-toggled">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<!-- end mobile sidebar expand / collapse button -->
				
				<!-- begin header navigation right -->
				<ul class="nav navbar-nav navbar-right">
					<li>
						<form class="navbar-form full-width" method="get">
							<div class="form-group">
								<input type="hidden" name="menu" value="cari" />
								<input type="text" name="q" class="form-control" placeholder="Cari Pengguna, musik atau hashtag" />
								<button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
							</div>
						</form>
					</li>
					<?php
					if(isset($_SESSION['login'])){
						$q=mysql_query("select * from user where email='$_SESSION[login]'");
						$h=mysql_fetch_array($q);
						$qq=mysql_query("select * from notif where user<>'$_SESSION[login]' and track_id in (select track_id from notif where user='$_SESSION[login]' and status='init')");
						$jumlah=0;
						while($hh=mysql_fetch_array($qq)){
							if($hh['status']=='post'){
								$jumlah++;
							}
						}
					?>
					<li class="dropdown">
						<a href="javascript:;" data-toggle="dropdown" class="dropdown-toggle f-s-14">
							<i class="fa fa-bell-o"></i>
							<?php
							if($jumlah>0){
							?>
							<span class="label"><?php echo $jumlah; ?></span>
							<?php
							}
							?>
						</a>
						<ul class="dropdown-menu media-list pull-right animated fadeInDown">
                            <li class="dropdown-header">Pemberitahuan <?php echo ($jumlah>0)?"($jumlah)":''; ?></li>
							<?php
							$qq=mysql_query("select * from notif where user<>'$_SESSION[login]' and track_id in (select track_id from notif where user='$_SESSION[login]' and status='init') order by tgl desc limit 5");
							while($hh=mysql_fetch_array($qq)){
								$qqq=mysql_query("select * from user where email='$hh[user]'");
								$user=mysql_fetch_array($qqq);
								$qqq=mysql_query("select * from track where track_id=$hh[track_id]");
								$track=mysql_fetch_array($qqq);
							?>
                            <li class="media <?php echo ($hh['status']=='post')?'notif':''; ?>">
                                <a href="?menu=track&track=<?php echo $hh['track_id']; ?>&notif=<?php echo $hh['notif_id']; ?>">
                                    <div class="pull-left"><img src="<?php echo $user['foto']; ?>" class="media-object" alt="" /></div>
                                    <div class="media-body">
                                        <h6 class="media-heading"><?php echo $user['nama']; ?></h6>
                                        <p>Telah mengomentari track <strong><?php echo $track['judul']; ?></strong>.</p>
                                        <div class="text-muted"><?php echo date('d F Y',strtotime($hh['tgl'])); ?></div>
                                    </div>
                                </a>
                            </li>
							<?php
							}
							?>
                            <li class="dropdown-footer text-center">
                                <a href="?menu=notif">Buka Pemberitahuan</a>
                            </li>
						</ul>
					</li>
					<li class="dropdown navbar-user">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
							<img src="<?php echo $h['foto']; ?>" alt="" /> 
							<span class="hidden-xs"><?php echo $h['nama']; ?></span> <b class="caret"></b>
						</a>
						<ul class="dropdown-menu animated fadeInLeft">
							<li class="arrow"></li>
							<li><a href="?menu=profil">Profil</a></li>
							<li><a href="#modal-uploadtrack" data-toggle="modal">Upload</a></li>
							<li class="divider"></li>
							<li><a href="?logout">Sign Out</a></li>
						</ul>
					</li>
					<?php
					}else{
					?>
					<li class="dropdown navbar-user">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
							<img src="assets/img/user.png" alt="" /> 
							<span class="hidden-xs">Pengunjung</span> <b class="caret"></b>
						</a>
						<ul class="dropdown-menu animated fadeInLeft">
							<li class="arrow"></li>
							<li><a href="#modal-signup" data-toggle="modal">Sign Up</a></li>
							<li class="divider"></li>
							<li><a href="#modal-signin" data-toggle="modal">Sign In</a></li>
						</ul>
					</li>
					<?php
					}
					?>
				</ul>
				<!-- end header navigation right -->
			</div>
			<!-- end container-fluid -->
		</div>
		<!-- end #header -->
		
		<!-- begin #sidebar -->
		<?php include 'sidebar.php'; ?>
		<!-- end #sidebar -->
		
		<!-- begin #content -->
		<div id="content" class="content">
			<?php 
			if(isset($_GET['menu'])){
				if($_GET['menu']=='peraturan'){
					include 'peraturan.php';
				}else if($_GET['menu']=='tutorial'){
					include 'tutorial.php';
				}else if($_GET['menu']=='aboutus'){
					include 'aboutus.php';
				}else if($_GET['menu']=='profil'){
					include 'profil.php';
				}else if($_GET['menu']=='cari'){
					include 'cari.php';
				}else if($_GET['menu']=='follow'){
					mysql_query("insert into follow values(null,'$_SESSION[login]','$_GET[id]')");
					?><script>location.href='?';</script><?php
				}else if($_GET['menu']=='unfollow'){
					mysql_query("delete from follow where user='$_SESSION[login]' and target='$_GET[id]'");
					?><script>location.href='?';</script><?php
				}else if($_GET['menu']=='track'){
					include 'track.php';
				}else if($_GET['menu']=='notif'){
					include 'notif.php';
				}else if($_GET['menu']=='following'){
					include 'following.php';
				}else if($_GET['menu']=='follower'){
					include 'follower.php';
				}else{
					include 'stream.php';
				}
			}else{
				include 'stream.php'; 
			}
			?>
			<div class="modal fade" id="modal-signup">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h4 class="modal-title">Sign Up</h4>
						</div>
						<div class="modal-body">
							<form action="?" method="POST">
								<fieldset>
									<div class="form-group">
										<label for="email">Alamat Email</label>
										<input type="email" name="email" class="form-control" id="email" placeholder="Alamat email anda" />
									</div>
									<div class="form-group">
										<label for="pass">Password</label>
										<input type="password" name="pass" class="form-control" id="pass" placeholder="Password anda" />
									</div>
									<div class="form-group">
										<label for="pass">Konfirmasi</label>
										<input type="password" name="passu" class="form-control" id="pass" placeholder="Ulangi password anda" />
									</div>
									<button type="submit" name="signup" class="btn btn-sm btn-primary m-r-5">Sign Up</button>
									<button type="button" data-dismiss="modal" class="btn btn-sm btn-default">Cancel</button>
								</fieldset>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="modal fade" id="modal-uploadtrack">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h4 class="modal-title">Upload Track</h4>
						</div>
						<div class="modal-body">
							<form method="POST" enctype="multipart/form-data">
								<fieldset>
									<div class="form-group">
										<label for="judul">Judul Track</label>
										<input type="text" name="judul" class="form-control" id="judul" placeholder="Judul Track" />
									</div>
									<div class="form-group">
										<label for="desk">Deskripsi Track</label>
										<textarea name="desk" class="form-control" id="desk" placeholder="Deskripsi Track"></textarea>
									</div>
									<div class="form-group">
										<label for="sampul">Sampul Track</label>
										<input type="file" name="sampul" class="form-control" id="sampul" placeholder="Sampul Track" />
									</div>
									<div class="form-group">
										<label for="track">File Track</label>
										<input type="file" name="track" class="form-control" id="track" placeholder="File Track" />
									</div>
									<button type="submit" name="upload" class="btn btn-sm btn-primary m-r-5">Upload</button>
									<button type="button" data-dismiss="modal" class="btn btn-sm btn-default">Cancel</button>
								</fieldset>
							</form>
						</div>
					</div>
				</div>
			</div>
			
			<div class="modal fade" id="modal-passsama">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h4 class="modal-title">ERROR</h4>
						</div>
						<div class="modal-body">
							<div class="alert alert-danger m-b-0">
								<h4><i class="fa fa-times-circle"></i> Password tidak sama.</h4>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal fade" id="modal-emailada">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h4 class="modal-title">ERROR</h4>
						</div>
						<div class="modal-body">
							<div class="alert alert-danger m-b-0">
								<h4><i class="fa fa-times-circle"></i> Email sudah digunakan.</h4>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal fade" id="modal-signupok">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h4 class="modal-title">SUKSES</h4>
						</div>
						<div class="modal-body">
							<div class="alert alert-success m-b-0">
								<h4><i class="fa fa-check-circle"></i> Sign Up berhasil.</h4>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal fade" id="modal-signinok">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h4 class="modal-title">SUKSES</h4>
						</div>
						<div class="modal-body">
							<div class="alert alert-success m-b-0">
								<h4><i class="fa fa-check-circle"></i> Sign In berhasil.</h4>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal fade" id="modal-signingagal">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h4 class="modal-title">ERROR</h4>
						</div>
						<div class="modal-body">
							<div class="alert alert-danger m-b-0">
								<h4><i class="fa fa-times-circle"></i> Email atau Password salah.</h4>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal fade" id="modal-uploadsukses">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h4 class="modal-title">SUKSES</h4>
						</div>
						<div class="modal-body">
							<div class="alert alert-success m-b-0">
								<h4><i class="fa fa-check-circle"></i> Upload berhasil.</h4>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal fade" id="modal-uploaddberror">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h4 class="modal-title">ERROR</h4>
						</div>
						<div class="modal-body">
							<div class="alert alert-danger m-b-0">
								<h4><i class="fa fa-times-circle"></i> Kesalahan database.</h4>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal fade" id="modal-uploadfileerror">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h4 class="modal-title">ERROR</h4>
						</div>
						<div class="modal-body">
							<div class="alert alert-danger m-b-0">
								<h4><i class="fa fa-times-circle"></i> File gagal di upload.</h4>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal fade" id="modal-uploadisianerror">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h4 class="modal-title">ERROR</h4>
						</div>
						<div class="modal-body">
							<div class="alert alert-danger m-b-0">
								<h4><i class="fa fa-times-circle"></i> Ada isian kosong.</h4>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end #content -->
		
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
	<!-- end page container -->
	
	
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="assets/plugins/gritter/js/jquery.gritter.js"></script>
	<script src="assets/plugins/flot/jquery.flot.min.js"></script>
	<script src="assets/plugins/flot/jquery.flot.time.min.js"></script>
	<script src="assets/plugins/flot/jquery.flot.resize.min.js"></script>
	<script src="assets/plugins/flot/jquery.flot.pie.min.js"></script>
	<script src="assets/plugins/sparkline/jquery.sparkline.js"></script>
	<script src="assets/plugins/bootstrap-wysihtml5/lib/js/wysihtml5-0.3.0.js"></script>
	<script src="assets/plugins/bootstrap-wysihtml5/src/bootstrap-wysihtml5.js"></script>
	<script src="assets/plugins/jquery-jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
	<script src="assets/plugins/jquery-jvectormap/jquery-jvectormap-world-mill-en.js"></script>
	<script src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script src='assets/js/jquery.events.input.js'></script>
	<script src='assets/js/jquery.elastic.js'></script>
	<script src='assets/js/jquery.mentions.js'></script>
	<script src="assets/js/ui-modal-notification.demo.min.js"></script>
	<script src="assets/js/dashboard.min.js"></script>
	<script src="assets/js/apps.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	<?php
	$q=mysql_query("select * from user where akses='user' and email<>'$_SESSION[login]'");
	$data=array();
	while($h=mysql_fetch_array($q)){
		$data[]="{value: '$h[nama]', uid: '$h[email]'}";
	}
	$data=implode(',',$data);
	?>
	<script>
		var Dashboard=function(){
			"use strict";
			return{init:function(){
				handleInteractiveChart();
				handleDashboardSparkline();
				handleDonutChart();
				handleDashboardTodolist();
				handleVectorMap();
				handleDashboardDatepicker()
			}}
		}()
		$(document).ready(function() {
			App.init();
			Dashboard.init();
			$("#wysihtml5").wysihtml5();
			$('.mentions').mentionsInput({
				source: [
					<?php echo $data; ?>
				], 
				showAtCaret: true
			});
			var mask;
			var mask2;
			mask = /@\[([^\]]+)\]\(([^ \)]+)\)/g;
			mask2 = /#([^\]]+)/g;
			$('.textmentions').each(function(){
				$(this).html(function(){
					return $(this).text().replace(mask,'<a href="?menu=profil&id=$2">$1</a>').replace(mask2,'<a href="?menu=cari&q=$1">#$1</a>');
				});
			});
			
		});
	</script>
	<?php
	if(isset($_POST['signup'])){
		$email=$_POST['email'];
		$pass=md5($_POST['pass']);
		$passu=md5($_POST['passu']);
		if($pass==$passu){
			$nama=explode('@',$email);
			$nama=$nama[0];
			$q=mysql_query("insert into user values('$email','$pass','$nama','assets/img/new.jpg','user')");
			if($q){
				?><script>$('#modal-signupok').modal('show'); setTimeout(function(){location.href='?';},1000);</script><?php
			}else{
				?><script>$('#modal-emailada').modal('show'); setTimeout(function(){location.href='?';},1000);</script><?php
			}
		}else{
			?><script>$('#modal-passsama').modal('show'); setTimeout(function(){location.href='?';},1000);</script><?php
		}
	}
	if(isset($_POST['signin'])){
		$email=$_POST['email'];
		$pass=md5($_POST['pass']);
		$q=mysql_query("select * from user where email='$email' and password='$pass'");
		if(mysql_num_rows($q)>0){
			$h=mysql_fetch_array($q);
			$_SESSION['login']=$h['email'];
			$_SESSION['akses']=$h['akses'];
			?><script>
				$('#modal-signinok').modal('show'); 
				setTimeout(function(){location.href='?';},1000);
			</script><?php
		}else{
			?><script>$('#modal-signingagal').modal('show'); setTimeout(function(){location.href='?';},1000);</script><?php
		}
	}
	if(isset($_POST['update'])){
		$email=$_POST['email'];
		$lama=md5($_POST['pass_lama']);
		$baru=md5($_POST['pass_baru']);
		$nama=$_POST['nama'];
		$foto=$_FILES['foto']['name'];
		$error=0;
		if(!empty($_POST['pass_lama'])||!empty($_POST['pass_baru'])){
			$q=mysql_query("select * from user where email='$_SESSION[login]'");
			$h=mysql_fetch_array($q);
			if($lama==$h['password']){
				$q=mysql_query("update user set password='$baru',nama='$nama' where email='$_SESSION[login]'");
			}else{
				$error=1;
			}
		}
		if(!empty($foto)){
			$lokasi="assets/profil/$foto";
			if(move_uploaded_file($_FILES['foto']['tmp_name'],$lokasi)){
				$q=mysql_query("update user set nama='$nama',foto='$lokasi' where email='$_SESSION[login]'");
			}else{
				$error=2;
			}
		}
		if(!empty($nama)){
			mysql_query("update user set nama='$nama' where email='$_SESSION[login]'");
		}
		if($error==1){
			?><script>
				$('#modal-passlamasalah').modal('show'); 
				setTimeout(function(){location.href='?menu=profil';},1000);
			</script><?php
		}else if($error==2){
			?><script>
				$('#modal-uploadfotogagal').modal('show'); 
				setTimeout(function(){location.href='?menu=profil';},1000);
			</script><?php
		}else if($error==0){
			?><script>
				$('#modal-updatesukses').modal('show'); 
				setTimeout(function(){location.href='?menu=profil';},1000);
			</script><?php
		}
	}
	if(isset($_POST['upload'])){
		$judul=$_POST['judul'];
		$desk=$_POST['desk'];
		$sampul=$_FILES['sampul']['name'];
		$track=$_FILES['track']['name'];
		$tgl=date('Y-m-d');
		if(!empty($judul)&&!empty($desk)&&!empty($sampul)&&!empty($track)){
			$lokasi_sampul="assets/track/sampul/$sampul";
			$lokasi_file="assets/track/file/$track";
			if(move_uploaded_file($_FILES['sampul']['tmp_name'],$lokasi_sampul)){
				if(move_uploaded_file($_FILES['track']['tmp_name'],$lokasi_file)){
					$q=mysql_query("insert into track values(null,'$_SESSION[login]','$judul','$desk','$lokasi_sampul','$lokasi_file','$tgl',0,0)");
					if($q){
						?><script>
							$('#modal-uploadsukses').modal('show'); 
							setTimeout(function(){location.href='?menu=track';},1000);
						</script><?php
					}else{
						?><script>
							$('#modal-uploaddberror').modal('show'); 
							setTimeout(function(){location.href='?';},1000);
						</script><?php
					}
				}else{
					echo 'errr'.$_FILES['track']['error'];
				}
			}else{
				?><script>
					$('#modal-uploadfileerror').modal('show'); 
					setTimeout(function(){location.href='?';},1000);
				</script><?php
			}
		}else{
			?><script>
				$('#modal-uploadisianerror').modal('show'); 
				setTimeout(function(){location.href='?';},1000);
			</script><?php
		}
	}
	?>
</body>
</html>
