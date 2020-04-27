<?php
	@session_start();
	include "../config/koneksi.php";

	if (empty($_SESSION['nama'])) {
    	echo "<script>alert('Anda Belum Melakukan Login');document.location.href='index.php'</script>";
	}
	
	$ak = mysqli_query($con, "select max(kode_waktu) as kode from detail_jadwal");
    $data=mysqli_fetch_array($ak);
    $kode = $data['kode'];
    $urut = (int) substr($kode,2,4);
    $urut++;
    $char = "KW";
    $auto = $char . sprintf("%04s",$urut);

	@$tampil = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM peserta_didik WHERE nama = '$_SESSION[nama]'"));

	$go = new oop();

	$table = "detail_jadwal";
	$field = array(
			'kode_waktu'=> @$_POST['kode_waktu'],
			'hari'=> @$_POST['hari'],
			'tanggal'=> @$_POST['tanggal'],
			'jam_mulai'=> @$_POST['mulai'],
			'jam_akhir'=> @$_POST['akhir'],
			'aktivitas'=> @$_POST['aktivitas'],
			'kode_mapel'=> @$_POST['implementasi']);
	$redirect = "?menu=laporan_kegiatan";

	if(isset($_POST['simpan'])) {
		$_SESSION['kode_waktu'] = $_POST['kode_waktu'];
		$_SESSION['hari'] = $_POST['hari'];
		$_SESSION['tanggal'] = $_POST['tanggal'];
		$go->simpan($con, $table, $field, $redirect);
	}

?>	
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Jadwal Peserta Didik</title>
    </head>

    <body>
      <div class="card shadow mb-4">
    	<div class="card-header py-3">
			<h2 align="center">Set Jadwal Anda : </h2>
		</div>
    	<div class="table-responsive">
    	  <form method="post">
	    	<table class="table table-bordered">
	    	  <form method="post">
	       		<tr>
	       			<td>
		       			<label><b>Hari : </b></label>
		       			<select name="hari" required class="form-control">
		       				<option></option>
		       				<option>Senin</option>
		       				<option>Selasa</option>
		       				<option>Rabu</option>
		       				<option>Kamis</option>
		       				<option>Jum'at</option>
		       				<option>Sabtu</option>
		       				<option>Minggu</option>
		       			</select>
	       			</td>
	       			<td>
	       				<label><b>Tanggal :</b> </label>
	       				<input type="date" name="tanggal" required value="<?= date('Y-m-d')?>" class="form-control">
	       			</td>
	       		</tr>
	        </table>
	        <table align="center" border="1" cellspacing="0" cellpadding="5" width="100%" class="table table-bordered">
	          <thead>
    			<tr>
    				<th>Kode Waktu</th>
    				<th>Jam Mulai</th>
    				<th>Jam Akhir</th>
    				<th>Aktivitas</th>
    				<th>Implementasi</th>
    			</tr>
    			<tbody>
    				<td>
    					<input type="text" name="kode_waktu" value="<?=$auto ?>" readonly class="form-control">
    				</td>
    				<td>
    					<input type="time" name="mulai" required class="form-control">
    				</td>
    				<td>
    					<input type="time" name="akhir" required class="form-control">
    				</td>
    				<td>
    					<select name="aktivitas" required class="form-control">
		                    <option></option>
		                    <?php
		                    $a = $go->tampil($con, "aktivitas");
		                    foreach ($a as $r) {
		                    ?>
		                        <option value="<?php echo $r['2'] ?>"><?php echo $r['2'] ?></option>
	                    	<?php } ?>
	                	</select> 
    				</td>
	            	<td>
	            		<select name="implementasi" required class="form-control">
		                    <option></option>
		                    <?php
		                    $a = $go->tampil($con, "mapel");
		                    foreach ($a as $r) {
		                    ?>
		                        <option value="<?php echo $r['2'] ?>"><?php echo $r['2'] ?></option>
	                    	<?php } ?>
	                	</select>
	            	</td>
	            	<tr>
	            		<td colspan="5" align="center">
	            			<button name="simpan" class="btn btn-primary">Simpan!</button>
    					</td>
    				</tr>
    		   </tbody>
    		  </thead>
    		 </form>
    		</table>
    	</div>
    	</div>
    </body>
</html>


