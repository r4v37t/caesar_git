<h1 class="page-header">Daftar Following</h1>
<div class="row">
	<div class="col-md-12">
		<div class="result-container">
			<ul class="result-list">
				<?php
				if(isset($_GET['id'])){
					$q=mysql_query("select * from follow where user='$_GET[id]'");
				}else{
					$q=mysql_query("select * from follow where user='$_SESSION[login]'");;
				}
				while($h=mysql_fetch_array($q)){
					$qq=mysql_query("select * from user where email='$h[target]'");
					$user=mysql_fetch_array($qq);
					$qq=mysql_query("select * from track where user='$user[email]'");
					$track=mysql_num_rows($qq);
					$qq=mysql_query("select * from follow where user='$user[email]'");
					$following=mysql_num_rows($qq);
					$qq=mysql_query("select * from follow where target='$user[email]'");
					$follower=mysql_num_rows($qq);
				?>
				<li>
					<div class="result-image">
						<a href="javascript:;"><img src="<?php echo $user['foto']; ?>" alt="" /></a>
					</div>
					<div class="result-info">
						<h4 class="title"><?php echo $user['nama']; ?></h4>
						<p class="desc">
							<?php echo $user['email']; ?>
							<?php
							if($_SESSION['login']!=$user['email']){
							$qq=mysql_query("select * from follow where user='$_SESSION[login]' and target='$user[email]'");
							if(mysql_num_rows($qq)>0){
							?>
							<a href="?menu=unfollow&id=<?php echo $user['email']; ?>" class="btn btn-success"><i class="fa fa-fw fa-chain-broken" ></i> Unfollow</a>
							<?php
							}else{
							?>
							<a href="#" class="btn btn-default" onclick="ikuti('<?php echo $user['email']; ?>'); return false;"><i class="fa fa-fw fa-chain"  ></i> Follow</a>
							<?php
							}
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