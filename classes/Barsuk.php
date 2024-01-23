<?php

class Barsuk extends Database
{
    private $tabel = 'barang_masuk';
    private $tabel_barang = 'barang';

    public function addBarang($jumlah, $id_barang, $user_id)
    {
        $pdo = $this->connectDB();
        $tanggal_masuk = date("Y-m-d");

        $sql = "INSERT INTO $this->tabel (`tanggal_masuk`, `jumlah`, `id_user`, `id_barang`) 
                VALUES 
                ('$tanggal_masuk',:jumlah,'$user_id','$id_barang')";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':jumlah', $jumlah);
                $insertRe = $stmt->execute();

                if ($insertRe) {
                    $query = "UPDATE $this->tabel_barang SET stok = stok + :jumlahStok WHERE id_barang = '$id_barang'";
                    $updateStok = $pdo->prepare($query);
                    $updateStok->bindParam(':jumlahStok', $jumlah );
                    $insertStock = $updateStok->execute();
                    if($insertStock){
                        Flasher::setFlasher('DATA BARANG MASUK BERHASIL', 'DITAMBAHKAN', 'success');
                        $redirectUrl = "barsuk.php";
                        header("Location: $redirectUrl");
                        exit;
                    }
                    else{
                        Flasher::setFlasher('STOK BARANG GAGAL', 'DITAMBAHKAN', 'danger');
                        $redirectUrl = "barsuk.php";
                        header("Location: $redirectUrl");
                        exit;
                    }
                } else {
                    Flasher::setFlasher('DATA BARANG MASUK GAGAL', 'DITAMBAHKAN', 'danger');
                    $redirectUrl = "barsuk.php";
                    header("Location: $redirectUrl");
                    exit;
                }
    }

    public function getDataBarangMasuk()
    {
        $sql = "SELECT *
                FROM $this->tabel
                JOIN $this->tabel_barang 
                ON 
                $this->tabel.id_barang = $this->tabel_barang.id_barang
                ORDER BY $this->tabel.tanggal_masuk DESC";
    
        $stmt = $this->connectDB()->prepare($sql);
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function deleteBarang($jumlah)
    {
        $pdo = $this->connectDB();

        $sql = "DELETE FROM $this->tabel WHERE jumlah = :jumlah";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':jumlah', $jumlah);
        
        // Ambil id_barang untuk mengurangkan stok
        $sqlGetIdBarang = "SELECT id_barang FROM $this->tabel WHERE jumlah = :jumlah";
        $stmtGetIdBarang = $pdo->prepare($sqlGetIdBarang);
        $stmtGetIdBarang->bindParam(':jumlah', $jumlah);
        $stmtGetIdBarang->execute();
        $id_barang = $stmtGetIdBarang->fetch(PDO::FETCH_ASSOC)['id_barang'];
        
        $deleteResult = $stmt->execute();

        if ($deleteResult) {
            // Kurangi stok pada tabel barang
            $query = "UPDATE $this->tabel_barang SET stok = stok - :jumlahStok WHERE id_barang = :id_barang";
            $updateStok = $pdo->prepare($query);
            $updateStok->bindParam(':jumlahStok', $jumlah);
            $updateStok->bindParam(':id_barang', $id_barang);
            $updateStockResult = $updateStok->execute();

            if ($updateStockResult) {
                Flasher::setFlasher('DATA BARANG MASUK BERHASIL', 'DIHAPUS', 'success');
            } else {
                Flasher::setFlasher('STOK BARANG GAGAL DIKURANGI', 'DIHAPUS', 'danger');
            }
        } else {
            Flasher::setFlasher('DATA BARANG MASUK GAGAL', 'DIHAPUS', 'danger');
        }

        $redirectUrl = "barsuk.php";
        header("Location: $redirectUrl");
        exit;
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

        $query = "SELECT *
                    FROM $this->tabel
                    JOIN $this->tabel_barang ON $this->tabel.id_barang = $this->tabel_barang.id_barang
                    ORDER BY $this->tabel.tanggal_masuk DESC 
                    LIMIT $awalData, $jumlahDataPerhalaman";


        $stmt_2 = $this->connectDB()->prepare($query);
        $stmt_2->execute();
            $page = $stmt_2->fetchAll(PDO::FETCH_ASSOC);
        
        return array($jumlahHalaman, $page, $halamanAktif);
    }


  

}