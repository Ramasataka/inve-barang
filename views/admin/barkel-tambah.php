<?php
$title = 'KOMPUTER.CO | TAMBAH BARANG KELUAR';
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

if (isset($_POST['simpan_data'])){
    $barang = $_POST['barang'];
    $jumlah = $_POST['jumlah'];
    $barkel->kurangBarang($jumlah, $barang, $user_id);
}
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
    <!-- Add your custom styles -->
    <style>
         .select2-container--bootstrap {
            background-color: #212529; /* Match your text-bg-dark background color */
            border: 1px solid #ced4da;
            border-radius: .25rem;
            color: #fff; /* Match your text color in text-bg-dark */
        }

        .select2-container--bootstrap .select2-selection--single {
            height: calc(2.25rem + 2px);
        }

        .select2-container--bootstrap .select2-selection--single .select2-selection__rendered {
            line-height: 1.5;
        }

        .select2-container--bootstrap .select2-selection--single .select2-selection__arrow {
            height: calc(2.25rem + 2px);
            position: absolute;
            top: 1px;
            right: 1px;
        }

        .select2-container--bootstrap .select2-dropdown {
            background-color: #212529; /* Match your text-bg-dark background color */
            border: 1px solid #ced4da;
            border-radius: .25rem;
        }

        .select2-container--bootstrap .select2-results__option {
            color: #fff; /* Match your text color in text-bg-dark */
        }
        .select2-container--bootstrap .select2-search--dropdown .select2-search__field {
            background-color: #212529; /* Match your text-bg-dark background color */
            color: #fff; /* Match your text color in text-bg-dark */
        }
        .card {
            border: none; 
            box-shadow: none; 
        }
    </style>

<body>

<main class="d-flex text-bg-dark">
    <!-- sidebar -->
    <?php
    include '../../sidebar.php';
    ?>

<div class="container-fluid">
    <div class="flash">
        <?= Flasher::flash() ?>
    </div>
            <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
                <div class="col-md-5">
                    <div class="card text-bg-dark" style="border: none; box-shadow: none; ">
                        <div class="card-body">
                        <h2 class="card-title text-center">Tambahkan Barang</h2>
                        <br>
                        <form action="barkel.php" method="POST" class="container">
                            <div class="mb-3">
                                <label class="form-label" for="">Pilih Barang</label>
                                <select name="barang" class="js-example-basic-single form-select text-bg-dark" title="Select the barang" id="barang">  
                                    <?php
                                        if($getbarang){
                                            foreach($getbarang as $items){
                                                ?>
                                                    <option value="<?=$items['id_barang'] ?>"><?=$items['nama_barang'] ?></option>
                                                <?php
                                            }
                                        } else {
                                            echo 'No data';
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Jumlah</label>
                                <input class="form-control text-bg-dark" type="number" name="jumlah" class="form-control">
                            </div>

                            <div class="d-grid gap-2">
                                <input type="submit" class="btn btn-primary" name="simpan_data" value="kirim" class="btn btn-primary">
                            </div>
                        </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- Formulir untuk menambahkan data barang keluar -->
    
                </main>
</body>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
         $(document).ready(function() {
            $('.js-example-basic-single').select2({
                theme: 'bootstrap'
            });
        });
    </script>