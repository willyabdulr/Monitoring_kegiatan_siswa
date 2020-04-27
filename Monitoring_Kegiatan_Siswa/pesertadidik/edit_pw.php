<?php
@session_start();

include "../config/koneksi.php";

if (empty($_SESSION['nama'])) {
    echo "<script>alert('Silahkan Login Terlebih Dahulu');document.location.href='index.php'</script>";
}

$tampil = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM peserta_didik WHERE nama = '$_SESSION[nama]'"));

$go = new oop();
@$table = "peserta_didik";
@$field = array('username' => $_POST['username'],
                'password' => md5($_POST['password']));
@$where = "nis = $_GET[nis]";
@$redirect = "?menu=data_diri";

if (isset($_POST['ubah'])) {
    echo $go->ubah($con, $table, $field, $where, $redirect);
}
?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h2 align="center">Edit Username dan Password : </h2>
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
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <label>Username : </label>
                            <input class="form-control" type="text" name="username" value="<?php echo $tampil['username'] ?>" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <label>Password : </label>
                            <input class="form-control" type="password" name="password" value="<?php echo $tampil['password'] ?>" required>
                        </div>
                    </div>
                </div>
                <button name="ubah" class="btn btn-primary">Ubah!</button>
            </table>
        </form>
    </div>
</div>