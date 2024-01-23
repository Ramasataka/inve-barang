<?php

include '../header.php';
$vendor = new Vendor();


$getVendor = $vendor->getVendor();

?>

<body>
    
<div class="mb-3">
    <div class="container">
        <form action="" method="POST"></form>
        
        <div class="mb-3">
                <label for="nama" class="form-label">Nama Barang</label>
                <input type="text" name="nama_barang">
        </div>

        <div class="mb-3">
                <label for="stock" class="form-label">stock</label>
                <input type="number" name="stock" value=0 disabled>
        </div>

        <label for="">SELECT VENDOR</label>
            <select name="vendor" class="js-example-basic-single form-control " title="Select the vendor" id="vendor" >  
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
    
    <div class="mb">
        <input type="submit" name="simpan_data" value="kirim">
    </div>

</div>
</body>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>
