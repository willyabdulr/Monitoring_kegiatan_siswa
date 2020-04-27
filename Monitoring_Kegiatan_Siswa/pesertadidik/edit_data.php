<?php
@session_start();

include "../config/koneksi.php";

if (empty($_SESSION['nama'])) {
    echo "<script>alert('Anda Belum Melakukan Login');document.location.href='index.php'</script>";
}

$tampil = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM peserta_didik WHERE nama = '$_SESSION[nama]'"));

if ($tampil['jk'] == "L") {
    $l = "checked";
} else {
    $p = "checked";
}

$go = new oop();
@$table = "peserta_didik";
@$field = array('nis' => $_POST['nis'],
                'nama' => $_POST['nama'],
                'jk' => $_POST['jk'],
                'rombel' => $_POST['rombel'],
                'rayon' => $_POST['rayon']);
@$where = "nis = $_GET[nis]";
@$redirect = "?menu=data_diri";

if (isset($_POST['ubah'])) {
    echo $go->ubah($con, $table, $field, $where, $redirect);
}
?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h2 align="center">Edit Data Anda : </h2>
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
                            <label>Nama : </label>
                            <input class="form-control" type="text" name="nama" value="<?php echo $tampil['nama'] ?>" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <label>Jenis Kelamin : </label>
                            <br>
                            <input type="radio" name="jk" value="L" <?php echo @$l ?> />Laki-laki | |
                            <input type="radio" name="jk" value="P" <?php echo @$p ?> />Perempuan
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <label>Rombel : </label>
                            
                            <select name="rombel" required class="form-control form-control-user">
                                <option><?php echo $tampil['rombel'] ?></option>
                                    <?php
                                        $a = $go->tampil($con, "rombel");
                                        foreach ($a as $r) {
                                    ?>
                                        <option value="<?php echo $r['1'] ?>"><?php echo $r['1'] ?></option>
                                    <?php } ?>
                            </select>
                        </div>
                        <div class="col">
                            <label>Rayon : </label>
                            <select name="rayon" required class="form-control form-control-user">
                                <option><?php echo $tampil['rayon'] ?></option>
                                <?php
                                    $a = $go->tampil($con, "rayon");
                                    foreach ($a as $r) {
                                ?>
                                    <option value="<?php echo $r['1'] ?>"><?php echo $r['1'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <button name="ubah" class="btn btn-primary">Ubah!</button>
            </table>
        </form>
    </div>
</div>