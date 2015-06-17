<?php
if(isset($_POST['updatetutorial'])){
	mysql_query("update konten set isi='$_POST[isi]' where konten_id=2");
	?><script>location.href='<?php echo $_SERVER['REQUEST_URI']; ?>';</script><?php
}
$q=mysql_query("select * from konten where konten_id=2");
$h=mysql_fetch_array($q);
if($_SESSION['akses']=='admin'){
?>
<h1 class="page-header">Tutorial <small>tutorial website ini...</small></h1>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-inverse">
			<div class="panel-heading">
				<h4 class="panel-title">Edit Tutorial</h4>
			</div>
			<div class="panel-body panel-form">
				<form name="wysihtml5" method="POST">
					<textarea class="textarea form-control" name="isi" id="wysihtml5" placeholder="Tulis disini ..." rows="12"><?php echo $h['isi']; ?></textarea>
			</div>
			<div class="panel-footer">
					<div class="input-group">
						<span class="input-group-btn">
							<button class="btn btn-primary" type="submit" name="updatetutorial"><i class="fa fa-check"></i> Simpan Perubahan</button>
						</span>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php
}else{
?>
<h1 class="page-header">Tutorial <small>tutorial website ini...</small></h1>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-inverse">
			<div class="panel-body">
				<?php echo $h['isi']; ?>
			</div>
		</div>
	</div>
</div>
<?php
}
?>