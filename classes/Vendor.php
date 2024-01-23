<?php

class Vendor extends Database {

    private $tabel = 'vendor';

    public function tambahVendor($nama,$kontak,$alamat,$telp_vendor){
        $sql = 'SELECT id_vendor FROM vendor order by id_vendor desc';
        $result = $this->connectDB()->query($sql);
        if($result->rowCount() > 0){
            $row = $result->fetch(PDO::FETCH_ASSOC);
            $lastIdVendor = $row['id_vendor'];

            $urut = substr($lastIdVendor, 3, 3);
            $tambah = (int) $urut + 1;
            if(strlen($tambah) == 1){
                $format = "VEN00".$tambah;
            } else if(strlen($tambah) == 2){
                $format = "VEN0".$tambah;
                
            } else{
                $format = "VEN".$tambah;
            }

            $pdo = $this->connectDB();

            $query = "INSERT INTO `vendor`(`id_vendor`, `nama_vendor`, `kontak_vendor`, `alamat_vendor`, `telp_vendor`) 
                        VALUES 
                        (:id_vendor, :nama_vendor, :kontak_vendor, :alamat_vendor, :telp_vendor)";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id_vendor', $format);
            $stmt->bindParam(':nama_vendor', $nama);
            $stmt->bindParam(':kontak_vendor', $kontak);
            $stmt->bindParam(':alamat_vendor', $alamat);
            $stmt->bindParam(':telp_vendor', $telp_vendor);

            // 
            $insertRe = $stmt->execute();
            if ($insertRe) {
                Flasher::setFlasher('VENDOR BERHA   SIL', 'DITAMBAHKAN', 'success');
                $redirectUrl = "vendor-tambah-data.php";
                header("Location: $redirectUrl");
                exit;
            exit;
            } else {
                Flasher::setFlasher('VENDOR GAGAL', 'DITAMBAHKAN', 'danger');
                $redirectUrl = "vendor-tambah-data.php";
                header("Location: $redirectUrl");
                exit;
            }

        }else{
            $pdo = $this->connectDB();
            $formatBaru = 'VEN001';
            $query = "INSERT INTO `vendor`(`id_vendor`, `nama_vendor`, `kontak_vendor`, `alamat_vendor`, `telp_vendor`) 
                        VALUES 
                        (:id_vendor, :nama_vendor, :kontak_vendor, :alamat_vendor, :telp_vendor)";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id_vendor', $formatBaru);
            $stmt->bindParam(':nama_vendor', $nama);
            $stmt->bindParam(':kontak_vendor', $kontak);
            $stmt->bindParam(':alamat_vendor', $alamat);
            $stmt->bindParam(':telp_vendor', $telp_vendor);

            // 
            $insertRe = $stmt->execute();
            if ($insertRe) {
                Flasher::setFlasher('VENDOR BERHASIL', 'DITAMBAHKAN', 'success');
                $redirectUrl = "vendor-tambah-data.php";
                header("Location: $redirectUrl");
                exit;
            exit;
            } else {
                Flasher::setFlasher('VENDOR GAGAL', 'DITAMBAHKAN', 'danger');
                $redirectUrl = "vendor-tambah-data.php";
                header("Location: $redirectUrl");
                exit;
            }
        }
    }


    public function getVendor()
    {
        $sql = 'SELECT * FROM '. $this->tabel.' ORDER BY id_vendor ASC';
        $stmt = $this->connectDB()->prepare($sql);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            return $stmt;
        }else{
            return false;
        }
    }

    public function getTotalVendor() {
        $sql = 'SELECT COUNT(*) AS total_vendor FROM ' . $this->tabel;
        $stmt = $this->connectDB()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['total_vendor'];
    }

    public function getditVendor($id_vendor){
        
        $sql = "SELECT * FROM ". $this->tabel ."  WHERE id_vendor = :id_vendor";
        $stmt = $this->connectDB()->prepare($sql);
        $stmt->bindParam(':id_vendor', $id_vendor);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function editVendor($id_vendor, $nama, $kontak, $alamat, $telp_vendor) {
        $sql = "UPDATE vendor SET 
                nama_vendor = :nama_vendor, 
                kontak_vendor = :kontak_vendor, 
                alamat_vendor = :alamat_vendor, 
                telp_vendor = :telp_vendor 
                WHERE id_vendor = :id_vendor";

        $stmt = $this->connectDB()->prepare($sql);
        $stmt->bindParam(':id_vendor', $id_vendor);
        $stmt->bindParam(':nama_vendor', $nama);
        $stmt->bindParam(':kontak_vendor', $kontak);
        $stmt->bindParam(':alamat_vendor', $alamat);
        $stmt->bindParam(':telp_vendor', $telp_vendor);

        $updateResult = $stmt->execute();

        if ($updateResult) {
            Flasher::setFlasher('VENDOR BERHASIL', 'DIUPDATE', 'success');
        } else {
            Flasher::setFlasher('VENDOR GAGAL', 'DIUPDATE', 'danger');
        }

        $redirectUrl = "vendor-tampil-data.php"; 
        header("Location: $redirectUrl");
        exit;
    }

    public function delVendor($id_vendor){

        $sql = "DELETE FROM ". $this->tabel ." WHERE id_vendor = :id_vendor";
        $stmt = $this->connectDB()->prepare($sql);
        $stmt->bindParam(':id_vendor', $id_vendor);
        $delBarang = $stmt->execute();

        if ($delBarang) {
            Flasher::setFlasher('BARANG ' .$id_vendor. ' BERHASIL', 'DIHAPUS', 'success');
            $redirectUrl = "vendor-tambah-data.php";
            header("Location: $redirectUrl");
            exit;
        exit;
        } else {
            Flasher::setFlasher('BARANG ' .$id_vendor. ' GAGAL', 'DIHAPUS', 'danger');
            $redirectUrl = "vendor-tambah-data.php";
            header("Location: $redirectUrl");
            exit;
        }

        
    }

    public function pagenation()
    {
        $jumlahDataPerhalaman = 5;
        $sql = 'SELECT * FROM ' . $this->tabel . '';
        $stmt = $this->connectDB()->prepare($sql);
        $stmt->execute();
        $hasil = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $jumlahData = count($hasil);
        $jumlahHalaman = ceil($jumlahData / $jumlahDataPerhalaman);
        $halamanAktif = ( isset($_GET["halaman"])) ? $_GET["halaman"] : 1;

        $awalData = ( $jumlahDataPerhalaman * $halamanAktif) - $jumlahDataPerhalaman;

        $query = 'SELECT * FROM ' . $this->tabel . ' LIMIT ' . $awalData . ', ' . $jumlahDataPerhalaman . '';
        $stmt_2 = $this->connectDB()->prepare($query);
        $stmt_2->execute();
            $page = $stmt_2->fetchAll(PDO::FETCH_ASSOC);
        
        return array($jumlahHalaman, $page, $halamanAktif);
    }

}