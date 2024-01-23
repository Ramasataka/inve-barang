<?php

$title = 'KOMPUTER.CO | TAMBAH KARYAWAN';
include '../../header.php';
$check = $system->checkLogin();
$user = new User();
if(!$check)
{
   $redirectUrl = "../../index.php";
   header("Location: $redirectUrl");
   exit;
}
if (isset($_POST['simpan_data'])){
    $nama = $_POST['nama_user'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email= $_POST['email'];
    $alamat = $_POST['alamat'];
    $telp = $_POST['telp'];
    $foto = $_FILES['foto'];
    $user->tambahData($nama, $username, $password, $email, $alamat, $telp, $foto);
}

?>

<body>
    
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
                <div class="col-md-8">
                    <div class="card text-bg-dark" style="border: none; box-shadow: none; ">
                        <div class="card-body">


                            <form action="#" method="POST" enctype="multipart/form-data" class="container">
                            <h2 class="card-title text-center">Tambahkan Data Karyawan</h2>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="nama" class="form-label">Nama Karyawan</label>
                                        <input type="text" class="form-control text-bg-dark" name="nama_user">
                                    </div>

                                    <div class="mb-3">
                                        <label for="user" class="form-label">username</label>
                                        <input type="text" class="form-control text-bg-dark" name="username">
                                    </div>

                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="text" class="form-control text-bg-dark" name="password">
                                    </div>
                                </div>

                                <div class="card col-md-6 text-bg-dark">
                                    <div class="mb-3">
                                        <label for="foto" class="form-label">FOTO</label>
                                        <input type="file" id="formFile" class="form-control text-bg-dark" name="foto" onchange="prevImage()">
                                        <img id="prevImg" class="mx-auto w-25">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control text-bg-dark" name="email">
                            </div>

                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" class="form-control text-bg-dark" name="alamat">
                            </div>

                            <div class="mb-3">
                                <label for="telp" class="form-label">Telpon</label>
                                <input type="number" class="form-control text-bg-dark" name="telp">
                            </div>

<br>

                            <div class="d-grid gap-2">
                                <input type="submit" class="btn btn-primary" name="simpan_data" value="kirim">
                            </div>
                        </form>

</div>
</div>
</div>
</div>
</div>



</main>

</body>

<script>
            function prevImage() {
            const formFile = document.getElementById('formFile');
            const [file] = formFile.files;
            if (file) {
                document.getElementById('prevImg').src = URL.createObjectURL(file)
            }
        }
</script>