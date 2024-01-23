<?php
$title = 'KOMPUTER.CO | VENDOR';
include '../../header.php';

$vendor = new Vendor();
$getid_vendor = $_GET['id_vendor'];
$geditvendor = $vendor->getditVendor($getid_vendor);

if (isset($_POST['simpan_edit_data'])) {
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

                                <input type="hidden" name="edit_id_vendor" id="edit-id-vendor" value="<?= $geditvendor->id_vendor ?>">
                                <div class="mb-3">
                                    <label for="edit-nama" class="form-label">Nama Vendor</label>
                                    <input type="text" name="edit_nama_vendor" value="<?= $geditvendor->nama_vendor ?>" id="edit-nama-vendor" class="form-control text-bg-dark col-12">
                                </div>
                                <div class="mb-3">
                                    <label for="edit-kontak" class="form-label">Email</label>
                                    <input type="email" name="edit_kontak_vendor" value="<?= $geditvendor->kontak_vendor ?>" id="edit-kontak-vendor" class="form-control text-bg-dark col-12">
                                </div>
                                <div class="mb-3">
                                    <label for="edit-alamat" class="form-label">Alamat Vendor</label>
                                    <input type="text" name="edit_alamat_vendor" value="<?= $geditvendor->alamat_vendor ?>" id="edit-alamat-vendor" class="form-control text-bg-dark col-12">
                                </div>
                                <div class="mb-3">
                                    <label for="edit-telp" class="form-label">Telephone Vendor</label>
                                    <input type="number" name="edit_telp_vendor" value="<?= $geditvendor->telp_vendor ?>" id="edit-telp-vendor" class="form-control text-bg-dark col-12">
                                </div>
                                <br>
                                <div class="mb">
                                    <input type="submit" name="simpan_edit_data" value="Simpan" class="btn btn-primary">
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
