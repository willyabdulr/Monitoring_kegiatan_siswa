<?php
include "../config/koneksi.php";
    $ak = mysqli_query($con, "select max(kode) as kode from guru");
    $data=mysqli_fetch_array($ak);
    $kode = $data['kode'];
    $urut = (int) substr($kode,2,4);
    $urut++;
    $char = "KG";
    $auto = $char . sprintf("%03s",$urut);

if (@$tampil['jk'] == "L") {
    $l = "checked";
} else {
    $p = "checked";
}

$go = new oop();

@$table = "guru";
@$where = "id = $_GET[id]";
@$redirect = "?menu=guru";
@$field = array('kode' => $_POST['kode'],
                'nama' => $_POST['nama'],
                'jk' => $_POST['jk'],
                'g_mapel' => $_POST['g_mapel'],
                'username' => $_POST['username'],
                'pasword' => md5($_POST['password']));

if (isset($_POST['simpan'])) {
    $go->simpan($con, $table, $field, $redirect);
}

if (isset($_GET['hapus'])) {
    $go->hapus($con, $table, $where, $redirect);
}

if (isset($_GET['edit'])) {
    $edit = $go->edit($con, $table, $where);
}
if (isset($_POST['ubah'])) {
    $go->ubah($con, $table, $field, $where, $redirect);
}
?>

<form method="post">
    <table align="center">
        <tr>
            <td>Kode Guru</td>
            <td>:</td>
           <td>
                <?php if (@$_GET['id'] == "") { ?>
                    <input type="text" name="kode" value="<?= $auto ?>"  class="form-control" required readonly>
                <?php } else { ?>                    
                    <input type="text" name="kode" value="<?php echo @$edit['kode'] ?>" class="form-control" required readonly>
                <?php } ?>
            </td>
        </tr>
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td><input type="text" name="nama" value="<?php echo @$edit['nama'] ?>" class="form-control" required placeholder="Nama"></td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>:</td>
            <td>
                <input type="radio" name="jk" value="L" <?php echo @$l ?> required> Laki-laki
                <input type="radio" name="jk" value="P" <?php echo @$p ?> required> Perempuan
            </td>
        </tr>
        <tr>
            <td>Guru Mapel</td>
            <td>:</td>
            <td>                        
                <select name="g_mapel" required class="form-control form-control-user">
                    
                    <option></option>
                    <?php
                        $a = $go->tampil($con, "mapel");
                        foreach ($a as $r) {
                    ?>
                        <option value="<?php echo $r['1'] ?>"><?php echo $r['2'] ?></option>
                    <?php } ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Username</td>
            <td>:</td>
            <td><input type="text" name="username" value="<?php echo @$edit['username'] ?>" class="form-control" required placeholder="Username"></td>
        </tr>
        <tr>
            <td>Password</td>
            <td>:</td>
            <td><input type="password" name="password" value="<?php echo @$edit['pasword'] ?>" class="form-control" required placeholder="Password"></td>
        </tr>

        <tr>
            <td></td>
            <td></td>
            <td>
                <?php if (@$_GET['id'] == "") { ?>
                    <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
                <?php } else { ?>
                    <input type="submit" name="ubah" value="Ubah" class="btn btn-warning">
                <?php } ?> 
            </td>
        </tr>
    </table>
</form>
<br />
<table align="center" border="1" cellspacing="0" cellpadding="5" width="100%" class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Jenis Kelamin</th>
        <th>Guru Mapel</th>
        <th>Username</th>
        <th>Password</th>
        <th colspan="2">Aksi</th>
    </tr>
    <?php
    $a = $go->tampil($con, $table);
    $no = 0;
    if ($a == "") {
        echo "<tr><td align='center' colspan='7'>NO RECORD</td></tr>";
    } else {
        foreach ($a as $r) {
            $no++;
            ?>             
            <tr> 
                <td><?php echo $no; ?></td>
                <td><?php echo $r['nama'] ?></td>
                <td><?php echo $r['jk'] ?></td>
                <td><?php echo $r['g_mapel'] ?></td>
                <td><?php echo $r['username'] ?></td>
                <td><?php echo $r['pasword'] ?></td>
                <td><a href="?menu=guru&edit&id=<?php echo $r['id'] ?>"><img src="../images/b_edit.png"></a></td>
                <td><a href="?menu=guru&hapus&id=<?php echo $r['id'] ?>" onClick="return confirm ('Hapus Data ?')"><img src="../images/b_drop.png"></a></td>
            </tr>                                      
        <?php } } ?>
</table>
<br />	


