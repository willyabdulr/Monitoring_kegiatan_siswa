<?php
@session_start();

include "../config/koneksi.php";

if (empty($_SESSION['nama'])) {
    echo "<script>alert('Anda Belum Melakukan Login');document.location.href='index.php'</script>";
}

@$tampil = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM peserta_didik WHERE nama = '$_SESSION[nama]'"));

?>
<title>Data Diri</title>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h2 align="center"> Data Diri Anda : </h2>
    </div>
    <div class="card-body">
        <form method="post">
            <table align="center">
                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <label>NIS : </label>
                            <input class="form-control" type="text" name="nis" value="<?php echo $tampil['nis'] ?>" required readonly>
                        </div>
                        <div class="col">
                            <label>Nama : </label>
                            <input class="form-control" type="text" name="nama" value="<?php echo $tampil['nama'] ?>" required readonly>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                   <div class="row">
                        <div class="col">
                            <label>Jenis Kelamin : </label>
                            <input class="form-control" type="text" name="jk" value="<?php echo $tampil['jk'] ?>" required readonly>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                   <div class="row">
                        <div class="col">
                            <label>Rombel : </label>
                            <input class="form-control" type="text" name="rombel" value="<?php echo $tampil['rombel'] ?>" required readonly>
                        </div>
                        <div class="col">
                            <label>Rayon : </label>
                            <input class="form-control" type="text" name="rayon" value="<?php echo $tampil['rayon'] ?>" required readonly>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                   <div class="row">
                        <div class="col">
                            <label>Username : </label>
                            <input class="form-control" type="text" name="username" value="<?php echo $tampil['username'] ?>" required readonly>
                        </div>
                        <div class="col">
                            <label>Password : </label>
                            <input class="form-control" type="password" name="password" value="<?php echo $tampil['password'] ?>" required readonly>
                        </div>
                    </div>
                </div>
            </table>
        </form>
    </div>
</div>
