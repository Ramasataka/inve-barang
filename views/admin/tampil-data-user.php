<?php

$title = 'KOMPUTER.CO | TAMPIL DATA KARYAWAN';
include '../../header.php';
$check = $system->checkLogin();
$user = new User();
if (!$check) {
    $redirectUrl = "../../index.php";
    header("Location: $redirectUrl");
    exit;
}

$dataKaryawan = $user->getKaryawan();

if (isset($_POST['delete_karyawan'])){
    $id_user = $_POST['delete_karyawan'];
    $user->delUser($id_user);  
}
?>

<body class="text-bg-dark">

    
<main class="d-flex text-bg-dark">
    <!-- sidebar -->
    <?php
    include '../../sidebar.php';
    ?>
    <!-- sidebar -->

    
    
    <div class="container m-3 mt-5 text-bg-dark">    
        <div class="flash">
            <?= Flasher::flash() ?>
        </div>

        <div class="d-flex justify-content-between ">

            <h2>Data Karyawan</h2>
            <a href="user-tambah.php" class="btn btn-outline-primary m-2 ">
                Tambahkan Data
            </a>
        </div>
        <br>
        <table class="table table-dark text-bg-dark">
            <thead>
                <tr>
                    <th>ID User</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Alamat</th>
                    <th>Telp</th>
                    <th>Foto</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($dataKaryawan) {
                    foreach ($dataKaryawan as $karyawan) {
                        ?>
                        <tr>
                            <td><?= isset($karyawan['id_user']) ? $karyawan['id_user'] : 'N/A' ?></td>
                            <td><?= isset($karyawan['nama_user']) ? $karyawan['nama_user'] : 'N/A' ?></td>
                            <td><?= isset($karyawan['username']) ? $karyawan['username'] : 'N/A' ?></td>
                            <td><?= isset($karyawan['email']) ? $karyawan['email'] : 'N/A' ?></td>
                            <td><?= isset($karyawan['alamat']) ? $karyawan['alamat'] : 'N/A' ?></td>
                            <td><?= isset($karyawan['telp']) ? $karyawan['telp'] : 'N/A' ?></td>
                            <td>
                                <?php
                                if (isset($karyawan['foto'])) {
                                    $fotoPath = '../../img/user_img/' . $karyawan['foto'];
                                    echo '<img src="' . $fotoPath . '" style="width: 100px; height: auto; object-fit: cover;" class="img-thumbnail">';
                                } else {
                                    echo 'N/A';
                                }
                                ?>
                            </td>
                            <td>
                                <a href="user-edit.php?id_user=<?= $karyawan['id_user'] ?>" class="btn btn-warning">Edit</a>
                                <form action="#" method="POST" style="display: inline-block;">
                                    <button type="submit" name="delete_karyawan" value="<?= $karyawan['id_user'] ?>" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="8">Tidak ada data karyawan.</td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>

</main>

</body>
</html>
