<?php
include 'koneksi.php';
$q=mysql_query("select * from track where track_id=$_GET[id]");
$h=mysql_fetch_array($q);
$putar=$h['putar'];
$putar++;
mysql_query("update track set putar=$putar where track_id=$_GET[id]");
?>
<audio controls autoplay>
	<source src="<?php echo $h['file']; ?>" type="audio/mpeg" />
</audio>