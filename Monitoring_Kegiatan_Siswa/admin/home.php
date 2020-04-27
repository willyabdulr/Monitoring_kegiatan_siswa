<?php
@session_start();
include "../config/koneksi.php";

@$tampil = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM admin WHERE nama = '$_SESSION[nama]'"));

?>	
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Halaman Admin</title>
    </head>

    <body>
        <h1 align="center">Selamat Datang Admin <a href="" title="<?php echo @$tampil['nama']; ?>"><?php echo @$tampil[nama]; ?></a></h1>
        <h1 align="center">Pemantauan Peserta Didik Versi 1.0</h1>
    </body>
</html>


