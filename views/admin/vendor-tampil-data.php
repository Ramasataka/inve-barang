<?php
$title = 'KOMPUTER.CO | VENDOR';
include '../../header.php';

$vendor = new Vendor();
$dataVendor = $vendor->getVendor();

$data_page = $vendor->pagenation();
$pageData = $data_page[1];
$jumlahHalaman = $data_page[0];
$halamanAktif = $data_page[2];
if (isset($_POST['delete_vendor'])){
    $id_vendor = $_POST['delete_vendor'];
    $vendor->delVendor($id_vendor);  
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

        <h2>Data Vendor</h2>
        <a href="vendor-tambah-data.php" class="btn btn-outline-primary m-2 ">
            Tambahkan Data
        </a>
    </div>
    <br>
    <table class="table table-dark text-bg-dark">
        <thead>
            <tr>
                <th>ID Vendor</th>
                <th>Nama Vendor</th>
                <th>Kontak Vendor</th>
                <th>Alamat Vendor</th>
                <th>No Telepon Vendor</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($pageData) {
                foreach ($pageData as $item) {
                    ?>
                    <tr>
                        <td><?= isset($item['id_vendor']) ? $item['id_vendor'] : 'N/A' ?></td>
                        <td><?= isset($item['nama_vendor']) ? $item['nama_vendor'] : 'N/A' ?></td>
                        <td><?= isset($item['kontak_vendor']) ? $item['kontak_vendor'] : 'N/A' ?></td>
                        <td><?= isset($item['alamat_vendor']) ? $item['alamat_vendor'] : 'N/A' ?></td>
                        <td><?= isset($item['telp_vendor']) ? $item['telp_vendor'] : 'N/A' ?></td>
                        <td>
                            <a href="vendor-edit-data.php?id_vendor=<?= $item['id_vendor'] ?>" class="btn btn-warning"> Edit </a>
                            <form action="#" method="POST" style="display:inline-block;">
                                <button type="submit" name="delete_vendor" value="<?= $item['id_vendor'] ?>" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="6">Tidak ada data vendor.</td>
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
<!-- Script JavaScript -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
   
</script>
</body>

</html>
