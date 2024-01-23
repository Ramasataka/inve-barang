<?php

class Barkel extends Database
{
    private $tabel = 'barang_keluar';
    private $tabel_barang = 'barang';

    public function kurangBarang($jumlah, $id_barang, $user_id)
    {   
        $redirectUrl = "barkel.php";
        $pdo = $this->connectDB();
        $tanggal_masuk = date("Y-m-d");

        $sql = "INSERT INTO $this->tabel (`id_user`, `id_barang`, `tanggal`, `jumlah`)
                VALUES 
                ('$user_id', '$id_barang', '$tanggal_masuk',:jumlah )";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':jumlah', $jumlah);
                $insertRe = $stmt->execute();

                if ($insertRe) {
                    $query = "UPDATE $this->tabel_barang SET stok = stok - :jumlahStok WHERE id_barang = '$id_barang'";
                    $updateStok = $pdo->prepare($query);
                    $updateStok->bindParam(':jumlahStok', $jumlah );
                    $insertStock = $updateStok->execute();
                    if($insertStock){
                        Flasher::setFlasher('STOCK BERHASIL', 'DIKURANGI', 'success');
                        header("Location: $redirectUrl");
                        exit;
                    }
                    else{
                        Flasher::setFlasher('STOK BARANG GAGAL', 'DIKURANGI', 'danger');
                        header("Location: $redirectUrl");
                        exit;
                    }
                } else {
                    Flasher::setFlasher('DATA BARANG MASUK GAGAL', 'DITAMBAHKAN', 'danger');
                    header("Location: $redirectUrl");
                    exit;
                }
    }

    public function getDataBarangKeluar()
    {
    $sql = "SELECT *
            FROM $this->tabel
            JOIN $this->tabel_barang 
            ON 
            $this->tabel.id_barang = $this->tabel_barang.id_barang
            ORDER BY $this->tabel.tanggal DESC"; 
    
    $stmt = $this->connectDB()->prepare($sql);
    $stmt->execute();
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteBarangKeluar($jumlah, $id_barkel)
    {
    $pdo = $this->connectDB();

    $sql = "DELETE FROM $this->tabel WHERE id_barkel = :id_barkel AND jumlah = :jumlah";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_barkel', $_POST['id_barkel_delete']);
    $stmt->bindParam(':jumlah', $_POST['jumlah_delete']);

    $deleteResult = $stmt->execute();

    if ($deleteResult) {
        $query = "UPDATE $this->tabel_barang SET stok = stok + :jumlahStok WHERE id_barang = :id_barang";
        $updateStok = $pdo->prepare($query);
        $updateStok->bindParam(':jumlahStok', $jumlah);
        $updateStok->bindParam(':id_barang', $id_barkel); 
        $updateStock = $updateStok->execute();

        if ($updateStock) {
            Flasher::setFlasher('STOCK BERHASIL', 'DITAMBAHKAN KEMBALI', 'success');
        } else {
            Flasher::setFlasher('STOK BARANG GAGAL', 'DITAMBAHKAN KEMBALI', 'danger');
        }
    } else {
        Flasher::setFlasher('DATA BARANG KELUAR GAGAL', 'DIHAPUS', 'danger');
    }

    $redirectUrl = "barkel.php";
    header("Location: $redirectUrl");
    exit;
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

        $query = "SELECT *
        FROM $this->tabel
        JOIN $this->tabel_barang 
        ON 
        $this->tabel.id_barang = $this->tabel_barang.id_barang
        ORDER BY $this->tabel.tanggal DESC
        LIMIT $awalData, $jumlahDataPerhalaman"; 

        $stmt_2 = $this->connectDB()->prepare($query);
        $stmt_2->execute();
            $page = $stmt_2->fetchAll(PDO::FETCH_ASSOC);
        
        return array($jumlahHalaman, $page, $halamanAktif);
    }

}
