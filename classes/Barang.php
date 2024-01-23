<?php

class Barang extends Database{

    private $tabel = 'barang';

    public function tambahBarang($nama, $stock, $vendor, $gambar)
    {
        $gambarU = Flasher::uploadGambar($gambar, 'BARANG');
        if(!is_numeric($gambarU)){
            $sql = 'SELECT id_barang FROM barang order by id_barang desc';
            $result = $this->connectDB()->query($sql);
            if($result->rowCount() > 0){

                $row = $result->fetch(PDO::FETCH_ASSOC);
                $lastIdbarang = $row['id_barang'];

                $urut = substr($lastIdbarang, 3, 3);
                $tambah = (int) $urut + 1;
                if(strlen($tambah) == 1){
                    $format = "BAR00".$tambah;
                } else if(strlen($tambah) == 2){
                    $format = "BAR0".$tambah;
                    
                } else{
                    $format = "BAR".$tambah;
                }


                    $pdo = $this->connectDB();
                    $query = "INSERT INTO $this->tabel (`id_barang`, `nama_barang`, `stok`, `vendor`, `gambar`) 
                            VALUES 
                            (:id_barang, :nama_barang, :stock, :vendor, :gambar)";
                    $stmt = $pdo->prepare($query);
                    $stmt->bindParam(':id_barang', $format);
                    $stmt->bindParam(':nama_barang', $nama);
                    $stmt->bindParam(':stock', $stock);
                    $stmt->bindParam(':vendor', $vendor);
                    $stmt->bindParam(':gambar', $gambarU);

                    $insertRe = $stmt->execute();
                    if ($insertRe) {
                        Flasher::setFlasher('BARANG BERHASIL', 'DITAMBAHKAN', 'success');
                        $redirectUrl = "barang-tampil-data.php";
                        header("Location: $redirectUrl");
                        exit;
                    exit;
                    } else {
                        Flasher::setFlasher('BARANG GAGAL', 'DITAMBAHKAN', 'danger');
                        $redirectUrl = "barang-tambah-data.php";
                        header("Location: $redirectUrl");
                        exit;
                    }

                }else {
                    $formatBaru = 'BAR001';
                    $pdo = $this->connectDB();
                    $query = "INSERT INTO `$this->tabel`(`id_barang`, `nama_barang`, `stok`, `vendor`, `gambar`) 
                            VALUES 
                            (:id_barang, :nama_barang, :stock, :vendor, :gambar)";
                    $stmt = $pdo->prepare($query);
                    $stmt->bindParam(':id_barang', $formatBaru);
                    $stmt->bindParam(':nama_barang', $nama);
                    $stmt->bindParam(':stock', $stock);
                    $stmt->bindParam(':vendor', $vendor);
                    $stmt->bindParam(':gambar', $gambarU);

                    $insertRe = $stmt->execute();
                    if ($insertRe) {
                        Flasher::setFlasher('BARANG BERHASIL', 'DITAMBAHKAN', 'success');
                        $redirectUrl = "barang-tampil-data.php";
                        header("Location: $redirectUrl");
                        exit;
                    } else {
                        Flasher::setFlasher('BARANG GAGAL', 'DITAMBAHKAN', 'danger');
                        $redirectUrl = "barang-tambah-data.php";
                        header("Location: $redirectUrl");
                        exit;
                    }
                }
        }else{
            $msg ='';
            switch($gambarU){
                case 0:
                    $msg = 'Gambar tidak ada';
                    break;
                case 1:
                   $msg = 'Gambar tidak valid';
                   break;
            }
            Flasher::setFlasher('Barang GAGAL', 'Ditambahkan ini' . $msg , 'danger');
            $redirectUrl = "barang-tambah-data.php";
            header("Location: $redirectUrl");
            exit;

        }
    }

    public function getBarang()
    {
        $sql = 'SELECT * FROM ' . $this->tabel . ' INNER JOIN vendor ON barang.vendor = vendor.id_vendor ORDER BY id_barang ASC';
        $stmt = $this->connectDB()->prepare($sql);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }

    public function getTotalBarang() {
        $sql = 'SELECT COUNT(*) AS total_barang FROM ' . $this->tabel;
        $stmt = $this->connectDB()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['total_barang'];
    }

    public function getditBarang($id_barang){
        
        $sql = "SELECT * FROM ". $this->tabel ." INNER JOIN vendor ON barang.vendor = vendor.id_vendor WHERE id_barang = :id_barang";
        $stmt = $this->connectDB()->prepare($sql);
        $stmt->bindParam(':id_barang', $id_barang);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function updateBarang($nama, $stock, $vendor, $oldGambar, $id_barang)
    {
        $redirectUrl = "barang-edit-data.php?id_barang=$id_barang";
        if (file_exists($_FILES['image']['tmp_name']) || is_uploaded_file($_FILES['image']['tmp_name'])) {
            $fileName   = $_FILES['image']['name'];
            $exts       = array('png', 'jpg', 'jpeg');
            $ext        = pathinfo($fileName, PATHINFO_EXTENSION);

            if (!in_array($ext, $exts)) {
                Flasher::setFlasher('BARANG ' . $id_barang . ' GAGAL', 'DIUPDATE GAMBAR TIDAK SESUAI', 'success');
                header("Location: $redirectUrl");
                exit();
            }

            $finalFIle  = time() . '_' . $fileName;
            move_uploaded_file($_FILES['image']['tmp_name'], '../../img/barang_img/' . $finalFIle);
            unlink('../../img/barang_img/' . $oldGambar);
        }
        $file       = $finalFIle ?? $oldGambar;

    $sql = "UPDATE " . $this->tabel . " SET nama_barang=:nama_barang, stok=:stock, vendor=:vendor, gambar=:gambar WHERE id_barang=:id_barang";
    $stmt = $this->connectDB()->prepare($sql);
    $stmt->bindParam(':id_barang', $id_barang);
    $stmt->bindParam(':nama_barang', $nama);
    $stmt->bindParam(':stock', $stock);
    $stmt->bindParam(':vendor', $vendor);
    $stmt->bindParam(':gambar', $file);

    $update_exe = $stmt->execute();

    if ($update_exe) {
        Flasher::setFlasher('BARANG ' . $id_barang . ' BERHASIL', 'DIUPDATE', 'success');
        $redirectUrl = "barang-tampil-data.php";
        header("Location: $redirectUrl");
        exit;
    } else {
        Flasher::setFlasher('BARANG ' . $id_barang . ' GAGAL', 'DIUPDATE', 'danger');
        header("Location: $redirectUrl");
        exit;
    }
}


    public function delBarang($id_barang){

        $sql = "DELETE FROM ". $this->tabel ." WHERE id_barang = :id_barang";
        $stmt = $this->connectDB()->prepare($sql);
        $stmt->bindParam(':id_barang', $id_barang);
        $delBarang = $stmt->execute();

        if ($delBarang) {
            Flasher::setFlasher('BARANG ' .$id_barang. ' BERHASIL', 'DIHAPUS', 'success');
            $redirectUrl = "barang-tampil-data.php";
            header("Location: $redirectUrl");
            exit;
        exit;
        } else {
            Flasher::setFlasher('BARANG ' .$id_barang. ' GAGAL', 'DIHAPUS', 'danger');
            $redirectUrl = "barang-tampil-data.php";
            header("Location: $redirectUrl");
            exit;
        }
    }

    public function pagenation()
    {
        $jumlahDataPerhalaman = 4;
        $sql = 'SELECT * FROM ' . $this->tabel . '';
        $stmt = $this->connectDB()->prepare($sql);
        $stmt->execute();
        $hasil = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $jumlahData = count($hasil);
        $jumlahHalaman = ceil($jumlahData / $jumlahDataPerhalaman);
        $halamanAktif = ( isset($_GET["halaman"])) ? $_GET["halaman"] : 1;

        $awalData = ( $jumlahDataPerhalaman * $halamanAktif) - $jumlahDataPerhalaman;

        $query = 'SELECT * FROM ' . $this->tabel . ' INNER JOIN vendor ON barang.vendor = vendor.id_vendor LIMIT ' . $awalData . ', ' . $jumlahDataPerhalaman . '';
        $stmt_2 = $this->connectDB()->prepare($query);
        $stmt_2->execute();
            $page = $stmt_2->fetchAll(PDO::FETCH_ASSOC);
        
        return array($jumlahHalaman, $page, $halamanAktif);
    }
}