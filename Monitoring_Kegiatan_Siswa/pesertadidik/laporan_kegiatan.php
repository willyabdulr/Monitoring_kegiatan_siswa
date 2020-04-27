<?php
	@session_start();
	include "../config/koneksi.php";

	if (empty($_SESSION['nama'])) {
   		 echo "<script>alert('Anda Belum Melakukan Login');document.location.href='index.php'</script>";
	}

	$ak = mysqli_query($con, "select max(kode_laporan) as kode from pembuktian");
    $data=mysqli_fetch_array($ak);
    $kode = $data['kode'];
    $urut = (int) substr($kode,2,4);
    $urut++;
    $char = "KL";
    $auto = $char . sprintf("%04s",$urut);
  

	@$tampil = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM peserta_didik WHERE nama = '$_SESSION[nama]'"));
	@$muncul = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM detail_jadwal WHERE kode_waktu = '$_SESSION[kode_waktu]'"));

	if (isset($_POST['simpan'])) {
		$name = @$_FILES['bukti1']['name'];
		$file = @$_FILES['bukti1']['tmp_name'];
		move_uploaded_file($file, '../foto/'.$name);

		$sql = mysqli_query($con, "INSERT INTO pembuktian VALUES('$_SESSION[nis]','$_SESSION[nama]','$_POST[kode_laporan]','$_SESSION[hari]','$_SESSION[tanggal]','$_POST[mulai]','$_POST[akhir]','$_POST[aktivitas]','$_POST[kode_mapel]','$name')");
		if ($sql) {
			echo "<script>alert('Succes');document.location.href='?menu=home';</script>";
		}else{
			echo mysqli_error($con);
		}
	}


?>	
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Laporan Peserta Didik</title>
    </head>

    <body>
    	<div class="card shadow mb-4 table-responsive">
    		<div class="card-header py-3">
				<h2 align="center">Laporan Kegiatan Anda : </h2>
			</div>
			<form method="post" enctype="multipart/form-data">
	  	        <table align="center" border="1" cellspacing="0" cellpadding="5" width="100%" class="table table-bordered">
	    			<tr>
	    				<th>Kode Laporan</th>
	    				<th>Jam Mulai</th>
	    				<th>Jam Akhir</th>
	    				<th>Aktivitas</th>
	    				<th>Mapel</th>
	    				<th>Bukti</th>
	    			</tr>
	    			<tr>
	    				<td>
	    					<input class="form-control" type="text" name="kode_laporan" value="<?=$auto ?>" readonly>
	    				</td>
	    				<td>
	    					<input class="form-control" type="time" name="mulai" value="<?php echo @$muncul[jam_mulai]; ?>" readonly>
	    				</td>
	    				<td>
	    					<input class="form-control" type="time" name="akhir" value="<?php echo @$muncul[jam_akhir]; ?>" readonly>
	    				</td>
	    				<td>
	    					<input class="form-control" type="text" name="aktivitas" value="<?php echo @$muncul[aktivitas]; ?>" readonly>
	    				</td>
	    				<td>
	    					<input class="form-control" type="text" name="kode_mapel" value="<?php echo @$muncul[kode_mapel]; ?>" readonly>
	    				</td>
		            	<td>
		            		<input class="form-control" type="file" name="bukti1" required>
		            	</td>
	    			</tr>
	    			<tr>
	    				<td colspan="6" align="center">
	    					<button name="simpan" class="btn btn-primary">Simpan!</button>
	    				</td>
	    			</tr>
	    		</table>
	    	</form>
    	</div>
    </body>
</html>


