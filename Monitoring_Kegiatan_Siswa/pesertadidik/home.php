<?php
@session_start();
include "../config/koneksi.php";

if (empty($_SESSION['nama'])) {
    echo "<script>alert('Silahkan Login Terlebih Dahulu');document.location.href='index.php'</script>";
}

@$tampil = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM peserta_didik WHERE nama = '$_SESSION[nama]'"));

?>	
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Pemantauan Peserta Didik</title>
    </head>

    <body>
        <h1 align="center">Selamat Datang <a href="?menu=data_diri" title="<?php echo @$tampil['nama']; ?>"><?php echo @$tampil[nama]; ?></a></h1>
    </body>
</html>


