<?php
include "../config/koneksi.php";
    
$go = new oop();

@$table = "rombel";
@$where = "id_rombel = $_GET[id]";
@$redirect = "?menu=rombel";
@$field = array('rombel' => $_POST['rombel']);

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
            <td>Rombel</td>
            <td>:</td>
            <td><input type="text" name="rombel" value="<?php echo @$edit['rombel'] ?>" class="form-control" required placeholder="Rombel"></td>
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
        <th>Rombel</th>
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
                <td><?php echo $r['rombel'] ?></td>
                <td><a href="?menu=rombel&edit&id=<?php echo $r['id_rombel'] ?>"><img src="../images/b_edit.png"></a></td>
                <td><a href="?menu=rombel&hapus&id=<?php echo $r['id_rombel'] ?>" onClick="return confirm ('Hapus Data ?')"><img src="../images/b_drop.png"></a></td>
            </tr>                                      
        <?php } } ?>
</table>
<br />	


