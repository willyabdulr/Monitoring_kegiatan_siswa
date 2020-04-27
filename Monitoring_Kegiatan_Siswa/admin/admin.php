<?php
include "../config/koneksi.php";
    
$go = new oop();

@$table = "admin";
@$where = "id = $_GET[id]";
@$redirect = "?menu=admin";
@$field = array('nama' => $_POST['nama'],
                'username' => $_POST['username'],
                'password' => md5($_POST['password']));

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
            <td>Nama</td>
            <td>:</td>
            <td><input type="text" name="nama" value="<?php echo @$edit['nama'] ?>" class="form-control" required placeholder="Nama"></td>
        </tr>
        <tr>
            <td>Username</td>
            <td>:</td>
            <td><input type="text" name="username" value="<?php echo @$edit['username'] ?>" class="form-control" required placeholder="Username"></td>
        </tr>
        <tr>
            <td>Password</td>
            <td>:</td>
            <td><input type="password" name="password" value="<?php echo @$edit['password'] ?>" class="form-control" required placeholder="Password"></td>
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
        <th>Username</th>
        <th>Password</th>
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
                <td><?php echo $r['nama'] ?></td>
                <td><?php echo $r['username'] ?></td>
                <td><?php echo $r['password'] ?></td>
                <td><a href="?menu=admin&edit&id=<?php echo $r['id'] ?>"><img src="../images/b_edit.png"></a></td>
                <td><a href="?menu=admin&hapus&id=<?php echo $r['id'] ?>" onClick="return confirm ('Hapus Data ?')"><img src="../images/b_drop.png"></a></td>
            </tr>                                      
        <?php } } ?>
</table>
<br />	


