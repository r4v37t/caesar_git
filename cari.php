<h1 class="page-header">Pencarian Pengguna</h1>
<div class="row">
	<div class="col-md-12">
		<div class="result-container">
			<ul class="result-list">
				<?php
				$q=mysql_query("select * from user where nama like '%$_GET[q]%' and akses='user' and email<>'$_SESSION[login]'");
				while($h=mysql_fetch_array($q)){
					$qq=mysql_query("select * from track where user='$h[email]'");
					$track=mysql_num_rows($qq);
					$qq=mysql_query("select * from follow where user='$h[email]'");
					$following=mysql_num_rows($qq);
					$qq=mysql_query("select * from follow where target='$h[email]'");
					$follower=mysql_num_rows($qq);
				?>
				<li>
					<div class="result-image">
						<a href="javascript:;"><img src="<?php echo $h['foto']; ?>" alt="" /></a>
					</div>
					<div class="result-info">
						<h4 class="title"><?php echo $h['nama']; ?></h4>
						<p class="desc">
							<?php echo $h['email']; ?>
							<?php
							$qq=mysql_query("select * from follow where user='$_SESSION[login]' and target='$h[email]'");
							if(mysql_num_rows($qq)>0){
							?>
							<a href="?menu=unfollow&id=<?php echo $h['email']; ?>" class="btn btn-success"><i class="fa fa-fw fa-chain-broken" ></i> Unfollow</a>
							<?php
							}else{
							?>
							<a href="#" class="btn btn-default" onclick="ikuti('<?php echo $h['email']; ?>'); return false;"><i class="fa fa-fw fa-chain"  ></i> Follow</a>
							<?php
							}
							?>
						</p>
						<div class="btn-row">
							<i class="fa fa-fw fa-music" data-toggle="tooltip" data-container="body" data-title="<?php echo $track; ?> track"></i> <?php echo $track; ?>
							<i class="fa fa-fw fa-chain-broken" data-toggle="tooltip" data-container="body" data-title="<?php echo $following; ?> following"></i> <?php echo $following; ?>
							<i class="fa fa-fw fa-users" data-toggle="tooltip" data-container="body" data-title="<?php echo $follower; ?> followers"></i> <?php echo $follower; ?>
							
						</div>
					</div>
				</li>
				<?php
				}
				?>
			</ul>
		</div>
	</div>
</div>
<p>&nbsp;</p>
<h1 class="page-header">Pencarian Musik</h1>
<div class="row">
	<div class="col-md-12">
		<div class="result-container">
			<ul class="result-list">
				<?php
				$q=mysql_query("select * from track where judul like '%$_GET[q]%' or desk like '%$_GET[q]%'");
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
						<a href="?menu=track&track=<?php echo $h['track_id']; ?>" data-toggle="modal" class="btn btn-inverse" ><i class="fa fa-fw fa-comment" ></i> Komentar</a>
					</div>
				</li>
				<?php
				}
				?>
			</ul>
		</div>
	</div>
</div>
<p>&nbsp;</p>
<h1 class="page-header">Pencarian Hashtag</h1>
<div class="row">
	<div class="col-md-12">
		<div class="result-container">
			<ul class="result-list">
				<?php
				$q=mysql_query("select * from track where track_id in (select track_id from komentar where isi like '#%$_GET[q]%' group by track_id) or judul like '#%$_GET[q]%' or desk like '#%$_GET[q]%'");
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
						<a href="?menu=track&track=<?php echo $h['track_id']; ?>" data-toggle="modal" class="btn btn-inverse" ><i class="fa fa-fw fa-comment" ></i> Komentar</a>
					</div>
				</li>
				<?php
				}
				?>
			</ul>
		</div>
	</div>
</div>