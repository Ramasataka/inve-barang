<?php
$title = 'KOMPUTER.CO | DATA BARANG';
include '../../header.php';

$barang = new Barang();
$dataBarang = $barang->getBarang();


echo '<pre>';
print_r($dataBarang);
echo '</pre>';

?>

<body>

<div class="flash">
    <?= Flasher::flash() ?>
</div>

<a href="barang-tambah-data.php" class="btn btn-primary">Kembali ke Tambah Barang</a>

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
                </tr>
            </thead>
            <tbody>
                <?php
                if ($dataBarang) {
                    foreach ($dataBarang as $item) {
                        ?>
                        <tr>
                            <td><?= isset($item['id_barang']) ? $item['id_barang'] : 'N/A' ?></td>
                            <td><?= isset($item['nama _barang']) ? $item['nama _barang'] : 'N/A' ?></td>
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
                        </tr>
                    <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="5">Tidak ada data barang.</td>
                    </tr>
                <?php
                }
                ?>

            </tbody>
        </table>
    </div>
</body>

</html>
