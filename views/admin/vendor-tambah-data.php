<?php
$title = 'KOMPUTER.CO | VENDOR';
include '../../header.php';

$vendor = new Vendor();
$dataVendor = $vendor->getVendor();

if (isset($_POST['simpan_data'])) {
    $nama = $_POST['nama_vendor'];
    $kontak = $_POST['kontak_vendor'];
    $alamat = $_POST['alamat_vendor'];
    $telp = $_POST['telp'];
    $vendor->tambahVendor($nama, $kontak, $alamat, $telp);
}


elseif (isset($_POST['simpan_edit_data'])) {
    $edit_id_vendor = $_POST['edit_id_vendor'];
    $edit_nama_vendor = $_POST['edit_nama_vendor'];
    $edit_kontak_vendor = $_POST['edit_kontak_vendor'];
    $edit_alamat_vendor = $_POST['edit_alamat_vendor'];
    $edit_telp_vendor = $_POST['edit_telp_vendor'];
    $vendor->editVendor($edit_id_vendor, $edit_nama_vendor, $edit_kontak_vendor, $edit_alamat_vendor, $edit_telp_vendor);
}


?>
<style>
    ::placeholder {
        color: #FFFFFF;
    }
</style>

<body class="text-bg-dark">
    





<main class="d-flex text-bg-dark">
    <!-- sidebar -->
    <?php
        include '../../sidebar.php';
    ?>
    <!-- sidebar -->

    <div class="container-fluid">
            <div class="flash">
            <?= Flasher::flash() ?>
            </div>
            <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
                <div class="col-md-6">
                    <div class="card text-bg-dark">
                        <div class="card-body">
                            <h2 class="card-title text-center">Tambahkan Vendor</h2>
                            <br>
                            <form action="" method="POST" enctype="multipart/form-data">

                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Vendor</label>
                                <input class="text-light bg-dark form-control col-12" placeholder="Masukkan nama vendor" type="text" name="nama_vendor" >
                            </div>

                            <div class="mb-3">
                                <label for="kontak" class="form-label">Email</label>
                                <input class="text-light bg-dark form-control col-12" placeholder="Masukkan email vendor" type="email" name="kontak_vendor">
                            </div>

                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat Vendor</label>
                                <input class="text-light bg-dark form-control col-12" placeholder="Masukkan alamat vendor" type="text" name="alamat_vendor">
                            </div>

                            <div class="mb-3">
                                <label for="Telp" class="form-label">Telephone Vendor</label>
                                <input class="text-light bg-dark form-control col-12" placeholder="Masukkan telepon vendor" type="number" name="telp">
                            </div>
                            <br>
                            <div class="mb">
                                <input class="text-light bg-dark form-control col-12"  type="submit" name="simpan_data" value="Simpan">
                            </div>

                            </form>
                        </div>
                    </div>
                </div>
                
            </div>
    </div>
        

</main>
<!-- Script JavaScript -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
