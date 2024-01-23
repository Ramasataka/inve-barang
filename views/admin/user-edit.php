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

$user = new User();
$getid_user = $_GET['id_user'];
$getdata_user = $user->getditUser($getid_user);

if (isset($_POST['update_data'])){
    $id_user = $_POST['id_user'];
    $nama = $_POST['nama_user'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email= $_POST['email'];
    $alamat = $_POST['alamat'];
    $telp = $_POST['telp'];
    $foto = $_FILES['foto'];

    if (!empty($_FILES['foto']['name'])) {
        $foto = $_FILES['foto'];
    } else {
        // Jika tidak ada file baru, tetapkan nilai gambar ke nilai yang saat ini ada di database
        $foto = $getdata_user->foto;
    }

    $user->updateUser($nama, $username, $password, $email, $alamat, $telp, $foto, $id_user);
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
                            <h2 class="card-title text-center">Edit Data Karyawan</h2>
                            <br>
                            <div class="row">
                                <input type="hidden" name="id_user" value="<?= $getdata_user->id_user ?>">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="nama" class="form-label">Nama Karyawan</label>
                                        <input type="text" class="form-control text-bg-dark" name="nama_user" value="<?= $getdata_user->nama_user ?>">
                                    </div>

                                    <div class="mb-3">
                                        <label for="user" class="form-label">username</label>
                                        <input type="text" class="form-control text-bg-dark" name="username" value="<?= $getdata_user->username ?>">
                                    </div>

                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="text" class="form-control text-bg-dark" name="password" value="<?= $getdata_user->password ?>">
                                    </div>
                                </div>

                                <div class="card col-md-6 text-bg-dark">
                                    <div class="mb-3">
                                        <label for="foto" class="form-label">FOTO</label>
                                        <input type="file" id="formFile" class="form-control text-bg-dark" name="foto" onchange="prevImage()">
                                        <?php
                                        $gambarPath = '../../img/user_img/' . $getdata_user->foto;
                                        ?>
                                        <img id="prevImg" src="<?= $gambarPath ?>" class="mx-auto w-25">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control text-bg-dark" name="email" value="<?= $getdata_user->email ?>">
                            </div>

                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" class="form-control text-bg-dark" name="alamat" value="<?= $getdata_user->alamat ?>">
                            </div>

                            <div class="mb-3">
                                <label for="telp" class="form-label">Telpon</label>
                                <input type="number" class="form-control text-bg-dark" name="telp" value="<?= $getdata_user->telp ?>">
                            </div>

<br>

                            <div class="d-grid gap-2">
                                <input type="submit" class="btn btn-primary" name="update_data" value="kirim">
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