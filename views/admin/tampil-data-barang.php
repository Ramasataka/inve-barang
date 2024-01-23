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

echo '<pre>';
print_r($dataBarang);
echo '</pre>';

?>

<body>

<div class="flash">
    <?= Flasher::flash() ?>
</div>

<a href="barang-tambah-data.php" class="btn btn-primary">Kembali ke Tambah Barang</a>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahBarang">
    + Tambah Barang
</button>

<!-- Modal Tambah barang -->
<div class="modal fade" id="tambahBarang" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Data Barang</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" enctype="multipart/form-data">

                <div class="mb-3">
                    <label for="img">Input Gambar</label>
                    <input type="file" name="image">
                </div>
                
                <div class="mb-3">
                        <label for="nama" class="form-label">Nama Barang</label>
                        <br>
                        <input type="text" name="nama_barang">
                </div>

                <div class="mb-3">
                        <label for="stock" class="form-label">stock</label>
                        <br>
                        <input type="number" name="stock" value="0">
                </div>

                <div class="mb-3">
                    <label for="">SELECT VENDOR</label>
                    <br>
                    <select name="vendor" class="js-example-basic-single form-select form-control " title="Select the vendor" id="vendor" >  
                        <?php
                            if($getVendor){
                                foreach($getVendor as $items){
                                    ?>
                                        <option value="<?=$items['id_vendor'] ?>"><?=$items['nama_vendor'] ?></option>
                                    <?php
                                }
                            }else{
                                echo'No data';
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" name="simpan_data" class="btn btn-primary">Understood</button>
                </form>
            </div>
        </div>
    </div>
</div>


    <div class="container mt-3">
        <h2>Data Barang</h2>
        <table class="table">
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
                if ($dataBarang) {
                    foreach ($dataBarang as $item) {
                        ?>
                        <tr>
                            <td><?= isset($item['id_barang']) ? $item['id_barang'] : 'N/A' ?></td>
                            <td><?= isset($item['nama_barang']) ? $item['nama_barang'] : 'N/A' ?></td>
                            <td><?= isset($item['stok']) ? $item['stok'] : 'N/A' ?></td>
                            <td><?= isset($item['vendor']) ? $item['vendor'] : 'N/A' ?></td>
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
                                <a href="barang-edit-data.php?id_barang=<?= $item['id_barang'] ?> "> <button> edit </button> </a>

                                <form action="#" method="POST">
                                    <button type="submit" name="delete_barang" value="<?= $item['id_barang'] ?>">Delete</button>
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
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
    $('.js-example-basic-single').select();
});
</script>
</html>