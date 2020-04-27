<?php 
	require '../config/koneksi.php';
	require '../library/oop.php';
	$go = new oop();

	$table = "peserta_didik";
	$field = array(
			'nis'=> @$_POST['nis'],
			'nama'=> @$_POST['nama'],
			'jk'=> @$_POST['jk'],
			'rombel'=> @$_POST['rombel'],
			'rayon'=> @$_POST['rayon'],
			'username'=> @$_POST['username'], 
			'password'=> md5(@$_POST['password']));
	$redirect = "index.php";

	if(isset($_POST['register'])) {
		$go->simpan($con, $table, $field, $redirect);
	}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Halaman Register</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">
  <link rel="shortcut icon" href="img/logo.png" />
</head>
<body class="bg-gradient-primary">
  <div class="container">
	<!-- Outer Row -->
	<div class="row justify-content-center">
	    <div class="col-xl-5 col-lg-6 col-md-9">
	     	<div class="card o-hidden border-0 shadow-lg my-5">
	          <div class="card-body p-0">
	          	<div align="center">
					<h1>HALAMAN REGISTRASI</h1>
				</div>
				<div class="p-5">
					<form action=""  method="post">
				
							<div class="form-group">
						        <input type="text" name="nis" class="form-control form-control-user" id="exampleInputPassword" placeholder="NIS" required>
					        </div>
							<div class="form-group">
						        <input type="text" name="nama" class="form-control form-control-user" id="exampleInputPassword" placeholder="Nama" required>
					        </div>
					        <div class="form-group">
						        <input type="radio" name="jk" id="jk" value="L" required>Laki-laki
						        <input type="radio" name="jk" id="jk" value="P" required>Perempuan
						        
					        </div>
					        <div class="form-group">

					           <select name="rombel" required class="form-control form-control-user">
					                    <option></option>
					                    <?php
					                    $a = $go->tampil($con, "rombel");
					                    foreach ($a as $r) {
					                    ?>
					                        <option value="<?php echo $r['1'] ?>"><?php echo $r['1'] ?></option>
					                    <?php } ?>
					            </select>
					            
				        	</div>
				        	<div class="form-group">
					           <select name="rayon" required class="form-control form-control-user">
					                    <option></option>
					                    <?php
					                    $a = $go->tampil($con, "rayon");
					                    foreach ($a as $r) {
					                    ?>
					                        <option value="<?php echo $r['1'] ?>"><?php echo $r['1'] ?></option>
					                    <?php } ?>
					                </select>
					            
				        	</div>
							<div class="form-group">
						        <input type="text" name="username" required class="form-control form-control-user" id="exampleInputPassword" placeholder="Username">
					        </div>
							<div class="form-group">
						        <input type="password" required name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
					        </div>
					        <div class="form-group" align="center">
								<button type="submit" name="register" class="btn btn-primary">Register!</button>
							</div>
					</form>
				  </div>
				</div>
			</div>
		   </div>
		</div>
	</div>
  </div>
</body>
</html>