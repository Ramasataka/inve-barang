<?php
$title = 'KOMPUTER.CO | HOMEPAGE';
include '../../header.php';
$check = $system->checkLogin();
if (!$check) {
    $redirectUrl = "../../index.php";
    header("Location: $redirectUrl");
    exit;
}

$username = "";

if (isset($_SESSION['user'])) {
    $userId = $_SESSION['user'];

    $user = new User();
    $userData = $user->getditUser($userId);

    if ($userData) {
        $_SESSION['role'] = $userData->role;
        $username = $userData->username;
    }
}



$user = new User();
$barang = new Barang();
$vendor = new Vendor();
$barkel = new Barkel();
$barsuk = new Barsuk();
$getbarang = $barang->getBarang();
$dataBarkel = $barkel->getDataBarangKeluar();
$dataBarsuk = $barsuk->getDataBarangMasuk();
$totalBarang = $barang->getTotalBarang();
$totalKaryawan = $user->getTotalKaryawan();
$totalVendor = $vendor->getTotalVendor();
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

<style>
    .scrollable-table {
        max-height: 300px;
        overflow-y: auto;
        width: 50%;
    }

    .scrollable-body {
        max-height: 200px;
        overflow-y: auto;
        overflow-x: hidden;
    }

    .scrollable-table::-webkit-scrollbar {
        width: 0;
        background-color: transparent;
    }

    .scrollable-table::-webkit-scrollbar-thumb {
        background-color: transparent;
    }

    .scrollable-table::-webkit-scrollbar-track {
        background-color: transparent;
    }

    .scrollable-body::-webkit-scrollbar {
        width: 8px;
    }

    .scrollable-body::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.1);
    }

    .scrollable-body::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.3);
    }
</style>

<body>

    <main class="d-flex text-bg-dark">
        <!-- sidebar -->
        <?php
        include '../../sidebar.php';
        ?>

        <!-- content -->
        <div class="container-fluid flex-grow-1">
            <h1 class="m-3">DASHBOARD <?= $_SESSION['role'] ?>, <?= $username ?></h1>
            <hr>
            
            <br>
            <div class="container mb-3">
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <div class="col">
                        <div class="card bg-info">
                            <!-- Your card content here -->
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div class="justify-content-start">
                                        <h1 class="ms-4" style="font-size:120px"><?= $totalBarang ?></h1>
                                        <p class="ms-4">TOTAL BARANG</p>
                                    </div>
                                    <i class="fa-solid fa-box m-4" style="font-size:100px"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card bg-info">
                            <!-- Your card content here -->
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div class="justify-content-start">
                                        <h1 class="ms-4" style="font-size:120px"><?= $totalKaryawan ?></h1>
                                        <p class="ms-4">TOTAL KARYAWAN</p>
                                    </div>
                                    <i class="fa-solid fa-users m-4" style="font-size:100px"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card bg-info">
                            <!-- Your card content here -->
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div class="justify-content-start">
                                        <h1 class="ms-4" style="font-size:120px"><?= $totalVendor ?></h1>
                                        <p class="ms-4">TOTAL VENDOR</p>
                                    </div>
                                    <i class="fa-solid fa-truck m-4" style="font-size:100px"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <hr>

            <div class="container d-flex justify-content-around">
                <h1>
                    Barang Masuk
                </h1>
                <h1>Barang Keluar</h1>
            </div>

            <div class="container d-flex">

                <div class="scrollable-table me-3 ">
                    <table class="table table-dark text-bg-dark mt-5 me-5">
                        <thead>
                            <tr>

                                <th scope="col">Tanggal keluar</th>
                                <th scope="col">Nama Barang</th>
                                <th scope="col">Jumlah</th>

                            </tr>
                        </thead>
                    </table>
                    <div class="scrollable-body" style="max-height: 200px; overflow-y: auto;">
                        <table class="table table-dark text-bg-dark">
                            <tbody>
                                <?php if ($dataBarkel) {
                                    foreach ($dataBarkel as $data) {
                                ?>
                                        <tr>
                                            <td><?= isset($data['tanggal']) ? $data['tanggal'] : 'N/A' ?></td>
                                            <td><?= isset($data['nama_barang']) ? $data['nama_barang'] : 'N/A' ?></td>
                                            <td><?= isset($data['jumlah']) ? $data['jumlah'] : 'N/A' ?></td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                ?>
                                    <tr>
                                        <td colspan="4">Tidak ada data barang keluar.</td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="scrollable-table ms-3 ">
                    <table class="table table-dark text-bg-dark mt-5 me-5">
                        <thead>
                            <tr>

                                <th scope="col">Tanggal Masuk</th>
                                <th scope="col">Nama Barang</th>
                                <th scope="col">Jumlah</th>

                            </tr>
                        </thead>
                    </table>
                    <div class="scrollable-body" style="max-height: 200px; overflow-y: auto;">
                        <table class="table table-dark text-bg-dark">
                            <tbody>
                                <?php if ($dataBarsuk) {
                                    foreach ($dataBarsuk as $data) {
                                ?>
                                        <tr>
                                            <td><?= isset($data['tanggal_masuk']) ? $data['tanggal_masuk'] : 'N/A' ?></td>
                                            <td><?= isset($data['nama_barang']) ? $data['nama_barang'] : 'N/A' ?></td>
                                            <td><?= isset($data['jumlah']) ? $data['jumlah'] : 'N/A' ?></td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                ?>
                                    <tr>
                                        <td colspan="5">Tidak ada data barang masuk.</td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
         
        </div>
        <!-- content -->
    </main>

</body>
