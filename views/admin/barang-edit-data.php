<?php
$title = 'KOMPUTER.CO | BARANG';
include '../../header.php';
// $check = $system->checkLogin();
// if(!$check)
// {
//    $redirectUrl = "../../index.php";
//    header("Location: $redirectUrl");
//    exit;
// }
$vendor = new Vendor();
$barang = new Barang();

$getid_barang = $_GET['id_barang'];
$geditbarang = $barang->getditBarang($getid_barang);


$getVendor = $vendor->getVendor();

if (isset($_POST['update_data'])){
    $id_barang = $_POST['id_barang'];
    $nama = $_POST['nama_barang'];
    $stock = $_POST['stock'];
    $selectVendor = $_POST['vendor'];
    $image = $_POST['oldGambar'];


    $barang->updateBarang($nama, $stock, $selectVendor, $image, $id_barang);
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
                <div class="col-md-8">
                    <div class="card text-bg-dark" >
                        <div class="card-body">

                            <form action="" method="POST" enctype="multipart/form-data">

                            <input type="hidden" name="id_barang" value="<?= $geditbarang->id_barang ?>">
                            
                                <div class="mb-3">
                                    <label class="form-label" for="img">Input Gambar</label>
                                    <input type="text" name="oldGambar" value="<?= $geditbarang->gambar ?>" hidden>
                                    <input class="form-control text-bg-dark" type="file" name="image">
                                    <br>
                                        <div class="">
                                            <?php
                                            if (isset($geditbarang->gambar)) {
                                                $gambarPath = '../../img/barang_img/' . $geditbarang->gambar;
                                                echo '<img src="' . $gambarPath . '" style="width: 100px; height: auto; object-fit: cover;">';
                                            } else {
                                                echo 'N/A';
                                            }
                                            ?>
                                        </div>
                                </div>
                           

                            <div class="mb-3">
                                    <label for="nama" class="form-label">Nama Barang</label>
                                    <input class="form-control text-bg-dark" type="text" name="nama_barang" value="<?= $geditbarang->nama_barang; ?>">
                            </div>

                            <div class="mb-3">
                                    <label for="stock" class="form-label">stock</label>
                                    <input class="form-control text-bg-dark" type="number" name="stock" value="<?= $geditbarang->stok; ?>" readonly>
                            </div>

                            <label for="">SELECT VENDOR</label>
                            <select name="vendor" class="js-example-basic-single select2 form-select text-bg-dark" title="Select the vendor" id="vendor">



                                    <?php
                                        if($getVendor){

                                        foreach($getVendor as $items){
                                            $selected = ($items['id_vendor'] == $geditbarang->vendor) ? 'selected' : '';
                                    ?>

                                            <option value="<?= $items['id_vendor'] ?>" <?= $selected ?>><?= $items['nama_vendor'] ?></option>
                                    <?php
                                            }
                                        }else{
                                            echo'No data';
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="d-grid gap-2 m-3">
                            <input class="btn btn-primary" type="submit" name="update_data" value="kirim">
                            </div>
                            </form>      


                        </div>
                    </div>
                </div>
            </div>
        </div>




<div class="mb-3">
    <div class="container">
                 
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
