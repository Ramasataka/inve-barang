<?php
$title = 'KOMPUTER.CO | DATA BARANG';
include '../../header.php';
$check = $system->checkLogin();
if(!$check)
{
   $redirectUrl = "../../index.php";
   header("Location: $redirectUrl");
   exit;
}

$vendor = new Vendor();
$barang = new Barang();

$getVendor = $vendor->getVendor();
$dataBarang = $barang->getBarang();

$data = $barang->pagenation();
$pageData = $data[1];
// var_dump($pageData) ;
$jumlahHalaman = $data[0];
$halamanAktif = $data[2];



if (isset($_POST['simpan_data'])){
    $nama = $_POST['nama_barang'];
    $stock = $_POST['stock'];
    $selectVendor = $_POST['vendor'];
    $image = $_FILES['image'];
    $barang->tambahBarang($nama, $stock, $selectVendor, $image);
}

if (isset($_POST['delete_barang'])){
    $id_barang = $_POST['delete_barang'];
    $barang->delBarang($id_barang);  
}



?>

<body>
<main class="d-flex text-bg-dark">
    <!-- sidebar -->
    <?php
    include '../../sidebar.php';
    ?>
    <!-- sidebar -->





<!-- Button trigger modal -->





    <div class="container m-2 mt-5 text-bg-dark">
    <div class="d-flex justify-content-between ">
    
        <h2>Data Barang </h2>
       
            <a href="barang-tambah-data.php" class="btn btn-outline-primary">Tambah Barang</a>
        
    </div>
<br>
    <div class="flash">
    <?= Flasher::flash() ?>
</div>
    
    <!-- Tabel untuk menampilkan data barang masuk -->
        <table class="table table-dark text-bg-dark">
            <thead>
                <tr>
                    <th>ID Barang</th>
                    <th>Nama Barang</th>
                    <th>Stok</th>
                    <th>Vendor</th>
                    <th>Gambar</th>
                    <th>Act</th>
                </tr>
            </thead>
            <tbody>
            <?php
    if ($pageData) {
        foreach ($pageData as $item) {
            ?>
            <tr>
                <td><?= isset($item['id_barang']) ? $item['id_barang'] : 'N/A' ?></td>
                <td><?= isset($item['nama_barang']) ? $item['nama_barang'] : 'N/A' ?></td>
                <td><?= isset($item['stok']) ? $item['stok'] : 'N/A' ?></td>
                <td><?= isset($item['nama_vendor']) ? $item['nama_vendor'] : 'N/A' ?></td>
                <td>
                    <?php
                    if (isset($item['gambar'])) {
                        $gambarPath = '../../img/barang_img/' . $item['gambar'];
                        echo '<img src="' . $gambarPath . '" style="width: 100px; height: auto; object-fit: cover;">';
                    } else {
                        echo 'N/A';
                    }
                    ?>
                </td>
                            <td>
                                <a class="btn btn-warning" href="barang-edit-data.php?id_barang=<?= $item['id_barang'] ?> ">  EDIT  </a>

                                <form action="#" method="POST" style="display: inline-block;">
                                    <button class="btn btn-danger"  type="submit" name="delete_barang" value="<?= $item['id_barang'] ?>">Delete</button>
                                </form>
                              
                            </td>
                        </tr>
                    <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="6">Tidak ada data barang.</td>
                    </tr>
                <?php
                }
                ?>

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

            </main>
</body>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
    $('.js-example-basic-single').select();
});
</script>
</html>