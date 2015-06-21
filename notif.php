<h1 class="page-header">Pemberitahuan</h1>
<div class="row">
	<div class="col-md-12">
		<div class="result-container">
			<?php
			if(isset($_GET['hal'])){
				$hal=$_GET['hal'];
			}else{
				$hal=1;
			}
			$batas=10;
			$awal=$hal-1;
			$awal*=$batas;
			$q=mysql_query("select * from notif where user<>'$_SESSION[login]' and track_id in (select track_id from notif where user='$_SESSION[login]' and status='init')");
			$h=mysql_num_rows($q);
			$jlhHalaman=ceil($h/$batas);
			?>
			<ul class="pagination pagination-without-border pull-right m-t-0">
				<?php
				for($x=0;$x<$jlhHalaman;$x++){
				?>
				<li class="<?php echo ($hal==($x+1))?'active':''; ?>"><a href="?menu=notif&hal=<?php echo $x+1; ?>"><?php echo $x+1; ?></a></li>
				<?php
				}
				?>
			</ul>
			<ul class="result-list">
				<?php
				$q=mysql_query("select * from notif where user<>'$_SESSION[login]' and track_id in (select track_id from notif where user='$_SESSION[login]' and status='init') order by tgl desc limit $awal,$batas");
				while($h=mysql_fetch_array($q)){
					$status=explode(':',$h['status']);
					$qqq=mysql_query("select * from user where email='$h[user]'");
					$user=mysql_fetch_array($qqq);
					$qqq=mysql_query("select * from track where track_id=$h[track_id]");
					$track=mysql_fetch_array($qqq);
				?>
				<li style="<?php echo ($h['status']=='post')?'background-color:#AFC4E6;':''; ?>">
					<div class="result-image">
						<a href="javascript:;"><img src="<?php echo $user['foto']; ?>" alt="" /></a>
					</div>
					<div class="result-info">
						<h4 class="title"><?php echo $user['nama']; ?></h4>
						<p class="location"><?php echo date('d F Y',strtotime($h['tgl'])); ?></p>
						<p class="desc">
							Telah mengomentari track <strong><?php echo $track['judul']; ?></strong>.
							<a href="?menu=track&track=<?php echo $h['track_id']; ?>&notif=<?php echo $h['notif_id']; ?>" class="btn btn-success"><i class="fa fa-fw fa-arrow-circle-right"  ></i> Baca</a>
						</p>
					</div>
				</li>
				<?php
				}
				?>
			</ul>
			<div class="clearfix">
				<?php
				$q=mysql_query("select * from notif where user<>'$_SESSION[login]' and track_id in (select track_id from notif where user='$_SESSION[login]' and status='init')");
				$h=mysql_num_rows($q);
				$jlhHalaman=ceil($h/$batas);
				?>
				<ul class="pagination pagination-without-border pull-right">
					<?php
					for($x=0;$x<$jlhHalaman;$x++){
					?>
					<li class="<?php echo ($hal==($x+1))?'active':''; ?>"><a href="?menu=notif&hal=<?php echo $x+1; ?>"><?php echo $x+1; ?></a></li>
					<?php
					}
					?>
				</ul>
			</div>
		</div>
	</div>
</div>