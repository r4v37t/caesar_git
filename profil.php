<?php
$q=mysql_query("select * from user where email='$_SESSION[login]'");
$h=mysql_fetch_array($q);
?>
<div class="col-md-12">
	<div class="panel panel-inverse">
		<div class="panel-heading">
			<h4 class="panel-title">Profil</h4>
		</div>
		<div class="panel-body">
			<ul class="media-list media-list-with-divider">
				<li class="media media-md">
					<a class="pull-left" href="javascript:;">
						<img src="<?php echo $h['foto']; ?>" alt="" class="media-object rounded-corner" />
					</a>
					<div class="media-body">
						<h4 class="media-heading"><?php echo $h['nama']; ?></h4>
						<p><?php echo $h['email']; ?></p>
						<p>&nbsp;</p>
						<p>
							<a href="#modal-editprofil" data-toggle="modal" class="btn btn-sm btn-danger m-r-5">Edit Profil</a>
						</p>
					</div>
				</li>
			</ul>
		</div>
	</div>
</div>
<?php
$qq=mysql_query("select * from track where user='$_SESSION[login]'");
$track=mysql_num_rows($qq);
$qq=mysql_query("select * from follow where user='$h[email]'");
$following=mysql_num_rows($qq);
$qq=mysql_query("select * from follow where target='$h[email]'");
$follower=mysql_num_rows($qq);
?>
<div class="row">
	<div class="col-md-4 col-sm-12">
		<div class="widget widget-state bg-green">
			<div class="state-icon"><i class="fa fa-music"></i></div>
			<div class="state-info">
				<h4>TRACKS</h4>
				<p><?php echo $track; ?></p>	
			</div>
			<div class="state-link">
				<a href="?menu=track">Detail <i class="fa fa-arrow-circle-o-right"></i></a>
			</div>
		</div>
	</div>
	<div class="col-md-4 col-sm-12">
		<div class="widget widget-state bg-blue">
			<div class="state-icon"><i class="fa fa-chain-broken"></i></div>
			<div class="state-info">
				<h4>FOLLOWING</h4>
				<p><?php echo $following; ?></p>	
			</div>
			<div class="state-link">
				<a href="javascript:;">Detail <i class="fa fa-arrow-circle-o-right"></i></a>
			</div>
		</div>
	</div>
	<div class="col-md-4 col-sm-12">
		<div class="widget widget-state bg-purple">
			<div class="state-icon"><i class="fa fa-users"></i></div>
			<div class="state-info">
				<h4>FOLLOWERS</h4>
				<p><?php echo $follower; ?></p>	
			</div>
			<div class="state-link">
				<a href="javascript:;">Detail <i class="fa fa-arrow-circle-o-right"></i></a>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modal-editprofil">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title">Edit Profil</h4>
			</div>
			<div class="modal-body">
				<form method="POST" enctype="multipart/form-data">
					<fieldset>
						<div class="form-group">
							<label for="email">Alamat Email</label>
							<input type="email" name="email" class="form-control" id="email" placeholder="Alamat email anda" value="<?php echo $h['email']; ?>" readonly />
						</div>
						<div class="form-group">
							<label for="nama">Nama Lengkap</label>
							<input type="text" name="nama" class="form-control" id="nama" placeholder="Nama lengkap anda" value="<?php echo $h['nama']; ?>" />
						</div>
						<div class="form-group">
							<label for="pass">Password Lama</label>
							<input type="password" name="pass_lama" class="form-control" id="pass" placeholder="Password anda saat ini" />
						</div>
						<div class="form-group">
							<label for="pass">Password Baru</label>
							<input type="password" name="pass_baru" class="form-control" id="pass" placeholder="Password baru anda" />
						</div>
						<div class="form-group">
							<label for="foto">Foto Profil</label>
							<img src="<?php echo $h['foto']; ?>" width="128" />
							<input type="file" name="foto" class="form-control" id="foto" placeholder="Foto profil anda" />
						</div>
						<button type="submit" name="update" class="btn btn-sm btn-primary m-r-5">Update</button>
						<button type="button" data-dismiss="modal" class="btn btn-sm btn-default">Cancel</button>
					</fieldset>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modal-updatesukses">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title">SUKSES</h4>
			</div>
			<div class="modal-body">
				<div class="alert alert-success m-b-0">
					<h4><i class="fa fa-check-circle"></i> Update profil berhasil.</h4>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modal-passlamasalah">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title">ERROR</h4>
			</div>
			<div class="modal-body">
				<div class="alert alert-danger m-b-0">
					<h4><i class="fa fa-times-circle"></i> Password lama yang dimasukkan salah.</h4>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modal-uploadfotogagal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title">ERROR</h4>
			</div>
			<div class="modal-body">
				<div class="alert alert-danger m-b-0">
					<h4><i class="fa fa-times-circle"></i> Foto gagal di upload.</h4>
				</div>
			</div>
		</div>
	</div>
</div>