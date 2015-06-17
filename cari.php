<h1 class="page-header">Cari Pengguna <small>temukan idolamu...</small></h1>
<div class="row">
	<div class="col-md-12">
		<div class="result-container">
			<ul class="result-list">
				<?php
				$q=mysql_query("select * from user where nama like '%$_GET[q]%'");
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
							<a href="?menu=follow&id=<?php echo $h['email']; ?>" class="btn btn-default"><i class="fa fa-fw fa-chain" ></i> Follow</a>
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