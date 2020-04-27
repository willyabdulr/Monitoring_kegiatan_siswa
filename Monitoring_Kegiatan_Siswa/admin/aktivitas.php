<?php
include "../config/koneksi.php";

    $ak = mysqli_query($con, "select max(kode_aktivitas) as kode from aktivitas");
    $data=mysqli_fetch_array($ak);
    $kode = $data['kode'];
    $urut = (int) substr($kode,2,4);
    $urut++;
    $char = "AK";
    $auto = $char . sprintf("%03s",$urut);
    
$go = new oop();

@$table = "aktivitas";
@$where = "id = $_GET[id]";
@$redirect = "?menu=aktivitas";
@$field = array('kode_aktivitas' => $_POST['kode_aktivitas'], 'aktivitas' => $_POST['aktivitas']);

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
            <td>Kode Aktivitas</td>
            <td>:</td>
            <td>
                <?php if (@$_GET['id'] == "") { ?>
                    <input type="text" name="kode_aktivitas" value="<?= $auto ?>"  class="form-control" required readonly>
                <?php } else { ?>                    
                    <input type="text" name="kode_aktivitas" value="<?php echo @$edit['kode_aktivitas'] ?>" class="form-control" required readonly>
                <?php } ?>
            </td>
        </tr>
        <tr>
            <td>Aktivitas</td>
            <td>:</td>
            <td><input type="text" name="aktivitas" value="<?php echo @$edit['aktivitas'] ?>" class="form-control" required placeholder="Aktivitas"></td>
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
        <th>Kode Aktivitas</th>
        <th>Aktivitas</th>
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
                <td><?php echo $r['kode_aktivitas'] ?></td>
                <td><?php echo $r['aktivitas'] ?></td>
                <td><a href="?menu=aktivitas&edit&id=<?php echo $r['id'] ?>"><img src="../images/b_edit.png"></a></td>
                <td><a href="?menu=aktivitas&hapus&id=<?php echo $r['id'] ?>" onClick="return confirm ('Hapus Data ?')"><img src="../images/b_drop.png"></a></td>
            </tr>                                      
        <?php } } ?>
</table>
<br />	


