<?php
$title = 'KOMPUTER.CO | BARANG';
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

if (isset($_POST['simpan_data'])){
    $nama = $_POST['nama_barang'];
    $stock = $_POST['stock'];
    $selectVendor = $_POST['vendor'];
    $image = $_FILES['image'];
    $barang->tambahBarang($nama, $stock, $selectVendor, $image);
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
    <!-- sidebar -->

    <div class="container-fluid">
            <div class="flash">
            <?= Flasher::flash() ?>
            </div>
            <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
                <div class="col-md-6">
                    <div class="card text-bg-dark">
                        <div class="card-body">
                            <h2 class="card-title text-center">Tambahkan Barang</h2>
                            <br>

                            <form action="" method="POST" enctype="multipart/form-data">

                                <div class="mb-3">
                                    <label for="img">Input Gambar</label>
                                    <input class="text-light bg-dark form-control col-12" type="file" name="image">
                                </div>

                                <div class="mb-3">
                                        <label for="nama" class="form-label">Nama Barang</label>
                                        <input class="text-light bg-dark form-control col-12" type="text" name="nama_barang">
                                </div>

                                <div class="mb-3">
                                        <label for="stock" class="form-label">stock</label>
                                        <input class="text-light bg-dark form-control col-12" type="number" name="stock" value="0" readonly>
                                </div>

                                <label class="form-label" for="">Pilih Vendor</label>
                                    <select name="vendor" class="js-example-basic-single form-select text-bg-dark" title="Select the vendor" id="vendor" >  
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
<br>
                                <div class="m-3 d-grid gap-2">
                                <input class="btn btn-primary" type="submit" name="simpan_data" value="kirim">
                                </div>
                            </form>   

                        </div>
                    </div>
                </div>
            </div>
    </div>


                    

</main>

</body>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
            $('.js-example-basic-single').select2({
                theme: 'bootstrap'
            });
        });
</script>
