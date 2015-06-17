<?php
	session_start();
	
	//mysql
	$db_user='root';
	$db_pass='';
	$db_host='localhost';
	$db_database='caesar';
	mysql_connect($db_host,$db_user,$db_pass) or die("Koneksi Gagal!!");
	mysql_select_db($db_database) or die("Database tidak bisa dibuka!!");
	
	$N=date('N');
	switch($N){
		case 1:
			$hari='Senin'; break;
		case 2:
			$hari='Selasa'; break;
		case 3:
			$hari='Rabu'; break;
		case 4:
			$hari='Kamis'; break;
		case 5:
			$hari='Jumat'; break;
		case 6:
			$hari='Sabtu'; break;
		default:
			$hari='Minggu';
	}
	$M=date('m');
	switch($M){
		case 1:
			$bulan='Januari'; break;
		case 2:
			$bulan='Februari'; break;
		case 3:
			$bulan='Maret'; break;
		case 4:
			$bulan='April'; break;
		case 5:
			$bulan='Mei'; break;
		case 6:
			$bulan='Juni'; break;
		case 7:
			$bulan='Juli'; break;
		case 8:
			$bulan='Agustus'; break;
		case 9:
			$bulan='September'; break;
		case 10:
			$bulan='Oktober'; break;
		case 11:
			$bulan='November'; break;
		default:
			$bulan='Desember';
	}
	$tanggal=date('d');
	$tahun=date('Y');
?>