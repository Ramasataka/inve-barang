<?php
$title = 'KOMPUTER.CO | BARANG KELUAR';
include '../../header.php';
$check = $system->checkLogin();
$barang = new Barang();
$barkel = new Barkel();
$getbarang = $barang->getBarang();
$dataBarkel = $barkel->getDataBarangKeluar();
if(!$check)
{
   $redirectUrl = "../../index.php";
   header("Location: $redirectUrl");
   exit;
}
$user_id = $_SESSION['user'];

$data = $barkel->pagenation();
$pageData = $data[1];
// var_dump($pageData) ;
$jumlahHalaman = $data[0];
$halamanAktif = $data[2];

if (isset($_POST['simpan_data'])){
    $barang = $_POST['barang'];
    $jumlah = $_POST['jumlah'];
    $barkel->kurangBarang($jumlah, $barang, $user_id);
}

if (isset($_POST['delete_data'])) {
    $jumlah_delete = $_POST['jumlah_delete'];
    $id_barang_delete = $_POST['id_barang_delete'];
    $barkel->deleteBarangKeluar($jumlah_delete, $id_barang_delete);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
</head>
<body>

<main class="d-flex text-bg-dark">
    <!-- sidebar -->
    <?php
    include '../../sidebar.php';
    ?>


    <div class="container">
      

        <div class="flash">
            <?= Flasher::flash() ?>
        </div>

        

        <!-- Tabel untuk menampilkan data barang keluar -->
        
        <div class="container m-2 mt-5 text-bg-dark">    
    <div class="d-flex justify-content-between ">

        <h2>Data Barang Keluar</h2>
        <a href="barkel-tambah.php" class="btn btn-outline-primary">Tambahkan Data</a>
            </div>
        
    </div>
    <br>
      
        <table class="table table-dark text-bg-dark">
            <thead>
                <tr>
                    
                    <th scope="col">Tanggal keluar</th>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Act</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php if ($pageData) 
                {
                    foreach ($pageData as $data)
                    {
                    ?>
                        <tr>
                            <td><?= isset($data['tanggal']) ? $data['tanggal'] : 'N/A' ?></td>
                            <td><?= isset($data['nama_barang']) ? $data['nama_barang'] : 'N/A' ?></td>
                            <td><?= isset($data['jumlah']) ? $data['jumlah'] : 'N/A' ?></td>
                            <td>
                                <form action='barkel.php' method='POST'>
                                    <input type='hidden' name='id_barkel_delete' value='<?= isset($data['id_barkel']) ? $data['id_barkel'] : '' ?>'>
                                    <input type='hidden' name='jumlah_delete' value='<?= isset($data['jumlah']) ? $data['jumlah'] : '' ?>'>
                                    <input type='hidden' name='id_barang_delete' value='<?= isset($data['id_barang']) ? $data['id_barang'] : '' ?>'>
                                    <button type='submit' class='btn btn-danger' name='delete_data'>Hapus</button>
                                </form>
                            </td>
                        
                        </tr>
                        <?php 
                    }
                }else {

            ?>
                <tr>
                    <td colspan="4">Tidak ada data barang keluar.</td>
                </tr>
                
                
            <?php } ?>
            </tbody>
        </table>

        <div class="container ">
    <nav aria-label="...">
        <ul class="pagination pagination-lg justify-content-center">
            <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
                <?php if ($i == $halamanAktif) : ?>
                    <li class="page-item active">
                        <a class="page-link" href="?halaman=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php else : ?>
                    <li class="page-item">
                        <a class="page-link" href="?halaman=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endif; ?>
            <?php endfor; ?>
        </ul>
    </nav>
</div>

    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>

    </main>

</body>
</html>
