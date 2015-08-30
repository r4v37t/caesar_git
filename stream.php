<h1 class="page-header">Stream <small>terbaru dari yang diikuti...</small></h1>
<div class="row">
	<div class="col-md-12">
		<div class="result-container">
			<form method="get">
				<div class="input-group m-b-20">
					<input type="hidden" name="menu" value="cari" />
					<input type="text" name="q" class="form-control input-white" placeholder="Cari Pengguna, musik atau hashtag" />
					<div class="input-group-btn">
						<button type="submit" class="btn btn-inverse"><i class="fa fa-search"></i> Temukan</button>
					</div>
				</div>
			</form>
			<?php
			if(isset($_GET['hal'])){
				$hal=$_GET['hal'];
			}else{
				$hal=1;
			}
			$batas=10;
			$awal=$hal-1;
			$awal*=$batas;
			if(isset($_SESSION['login'])){
				$q=mysql_query("select * from track where user in (select target from follow where user='$_SESSION[login]') order by suka desc");
			}else{
				$q=mysql_query("select * from track order by suka desc");
			}
			$h=mysql_num_rows($q);
			$jlhHalaman=ceil($h/$batas);
			?>
			<ul class="pagination pagination-without-border pull-right m-t-0">
				<?php
				for($x=0;$x<$jlhHalaman;$x++){
				?>
				<li class="<?php echo ($hal==($x+1))?'active':''; ?>"><a href="?hal=<?php echo $x+1; ?>"><?php echo $x+1; ?></a></li>
				<?php
				}
				?>
			</ul>
			<ul class="result-list">
				<?php
				if(isset($_SESSION['login'])){
					$q=mysql_query("select * from track where user in (select target from follow where user='$_SESSION[login]') order by tgl desc limit $awal,$batas");
				}else{
					$q=mysql_query("select * from track order by suka desc limit 10");
				}
				while($h=mysql_fetch_array($q)){
					$qq=mysql_query("select * from komentar where track_id=$h[track_id]");
					$jumlah=mysql_num_rows($qq);
					$qqq=mysql_query("select * from user where email='$h[user]'");
					$hhh=mysql_fetch_array($qqq);
				?>
				<li>
					<div class="result-image">
						<a href="javascript:;"><img src="<?php echo $h['sampul']; ?>" alt="" /></a>
					</div>
					<div class="result-info">
						<h4 class="title"><?php echo $h['judul']; ?></h4>
						<p class="location"><?php echo date('d F Y',strtotime($h['tgl'])); ?> - Oleh: <?php echo$hhh['nama']; ?></p>
						<p class="desc">
							<?php echo $h['desk']; ?>
						</p>
						<div class="btn-row">
							<i class="fa fa-fw fa-caret-square-o-right" data-toggle="tooltip" data-container="body" data-title="<?php echo $h['putar']; ?> kali dimainkan"></i> <?php echo $h['putar']; ?>
							<i class="fa fa-fw fa-heart" data-toggle="tooltip" data-container="body" data-title="<?php echo $h['suka']; ?> yang menyukai"></i> <?php echo $h['suka']; ?>
							<i class="fa fa-fw fa-comment" data-toggle="tooltip" data-container="body" data-title="<?php echo $jumlah; ?> komentar"></i> <?php echo $jumlah; ?>
						</div>
					</div>
					<div class="result-price">
						<a onclick="window.open('play.php?id=<?php echo $h['track_id']; ?>','Player','width=400, height=50');" class="btn btn-inverse"><i class="fa fa-fw fa-caret-square-o-right" ></i> Putar</a>
						<a href="#" class="btn btn-inverse" onclick="suka(<?php echo $h['track_id']; ?>); return false;"><i class="fa fa-fw fa-heart" ></i> Suka</a>
						<a href="#" data-toggle="modal" class="btn btn-inverse" onclick="komentar(<?php echo $h['track_id']; ?>); return false;"><i class="fa fa-fw fa-comment" ></i> Komentar</a>
					</div>
				</li>
				<?php
				}
				?>
			</ul>
			<div class="clearfix">
				<?php
				if(isset($_SESSION['login'])){
					$q=mysql_query("select * from track where user in (select target from follow where user='$_SESSION[login]') order by suka desc");
				}else{
					$q=mysql_query("select * from track order by suka desc");
				}
				$h=mysql_num_rows($q);
				$jlhHalaman=ceil($h/$batas);
				?>
				<ul class="pagination pagination-without-border pull-right">
					<?php
					for($x=0;$x<$jlhHalaman;$x++){
					?>
					<li class="<?php echo ($hal==($x+1))?'active':''; ?>"><a href="?hal=<?php echo $x+1; ?>"><?php echo $x+1; ?></a></li>
					<?php
					}
					?>
				</ul>
			</div>
		</div>
	</div>
</div>
<?php
if(isset($_SESSION['login'])){
	$q=mysql_query("select * from track where user in (select target from follow where user='$_SESSION[login]') order by tgl desc limit $awal,$batas");
}else{
	$q=mysql_query("select * from track order by suka desc limit 10");
}
while($h=mysql_fetch_array($q)){
?>
<div class="modal fade" id="modal-komentar-<?php echo $h['track_id']; ?>">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title">Komentar</h4>
			</div>
			<div class="modal-body">
				<div class="panel panel-inverse">
					<div class="panel-body">
						<div data-scrollbar="true" class="height-sm">
							<ul class="media-list media-list-with-divider media-messaging">
								<?php
								$qq=mysql_query("select * from komentar where track_id=$h[track_id] order by komentar_id desc");
								while($hh=mysql_fetch_array($qq)){
									$qqq=mysql_query("select * from user where email='$hh[user]'");
									$hhh=mysql_fetch_array($qqq);
								?>
								<li class="media media-sm">
									<a href="javascript:;" class="pull-left">
										<img src="<?php echo $hhh['foto']; ?>" alt="" class="media-object rounded-corner" />
									</a>
									<div class="media-body ">
										<h5 class="media-heading"><?php echo $hhh['nama']; ?></h5>
										<p class="textmentions"><?php echo $hh['isi']; ?></p>
									</div>
								</li>
								<?php
								}
								?>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="panel-footer">
				<form method="post">
					<div class="input-group">
						<input type="hidden" name="id" value="<?php echo $h['track_id']; ?>" />
						<textarea name="isi" style="height:35px;" class="form-control bg-silver mentions" placeholder="Tulis kometar" ></textarea>
						<span class="input-group-btn">
							<button class="btn btn-primary" type="submit" name="komentar"><i class="fa fa-pencil"></i></button>
						</span>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php
}
if(isset($_POST['komentar'])){
	$isi=$_POST['isi'];
	if(!empty($isi)){
		$q=mysql_query("select * from notif where user='$_SESSION[login]' and track_id=$_POST[id] and status='init'");
		if(mysql_num_rows($q)>0){
			//tidak ada
		}else{
			mysql_query("insert into notif values(null,$_POST[id],'$_SESSION[login]','post',now())");
		}
		$q=mysql_query("insert into komentar values(null,$_POST[id],'$_SESSION[login]','$isi')");
		?><script>location.href='<?php echo $_SERVER['REQUEST_URI']; ?>';</script><?php
	}
}
if(isset($_GET['suka'])){
	$q=mysql_query("select * from track where track_id=$_GET[suka]");
	$h=mysql_fetch_array($q);
	$suka=$h['suka'];
	$suka++;
	mysql_query("update track set suka=$suka where track_id=$_GET[suka]");
	?><script>location.href='<?php echo $_SERVER['HTTP_REFERER']; ?>';</script><?php
}
?>