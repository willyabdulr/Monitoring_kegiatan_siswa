<?php
include "../config/koneksi.php";

    $ak = mysqli_query($con, "select max(kode_mapel) as kode from mapel");
    $data=mysqli_fetch_array($ak);
    $kode = $data['kode'];
    $urut = (int) substr($kode,2,4);
    $urut++;
    $char = "MP";
    $auto = $char . sprintf("%03s",$urut);
    
$go = new oop();

@$table = "mapel";
@$where = "id = $_GET[id]";
@$redirect = "?menu=mapel";
@$field = array('kode_mapel' => $_POST['kode_mapel'], 'nama_mapel' => $_POST['nama_mapel']);

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
            <td>Kode Mapel</td>
            <td>:</td>
            <td><?php if (@$_GET['id'] == "") { ?>
                    <input type="text" name="kode_mapel" value="<?= $auto ?>"  class="form-control" required readonly>
                <?php } else { ?>                    
                    <input type="text" name="kode_mapel" value="<?php echo @$edit['kode_mapel'] ?>" class="form-control" required readonly>
                <?php } ?>
            </td>
        </tr>
        <tr>
            <td>Nama Mapel</td>
            <td>:</td>
            <td><input type="text" name="nama_mapel" value="<?php echo @$edit['nama_mapel'] ?>" class="form-control" required placeholder="Mapel"></td>
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
        <th>Kode Mapel</th>
        <th>Nama Mapel</th>
        <th colspan="2">Aksi</th>
    </tr>
    <?php
    $a = $go->tampil($con, $table);
    $no = 0;
    if ($a == "") {
        echo "<tr><td align='center' colspan='4'>NO RECORD</td></tr>";
    } else {
        foreach ($a as $r) {
            $no++;
            ?>             
            <tr> 
                <td><?php echo $no; ?></td>
                <td><?php echo $r['kode_mapel'] ?></td>
                <td><?php echo $r['nama_mapel'] ?></td>
                <td><a href="?menu=mapel&edit&id=<?php echo $r['id'] ?>"><img src="../images/b_edit.png"></a></td>
                <td><a href="?menu=mapel&hapus&id=<?php echo $r['id'] ?>" onClick="return confirm ('Hapus Data ?')"><img src="../images/b_drop.png"></a></td>
            </tr>                                      
        <?php } } ?>
</table>
<br />  


