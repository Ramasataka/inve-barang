<?php

class User extends Database{
    
    private $tabel = 'user';
    
    public function tambahData($nama, $username, $password, $email, $alamat, $telpon, $foto)
    {
        $gambarU = Flasher::uploadGambar($foto, 'USER');
        if(!is_numeric($gambarU)){
                    $pdo = $this->connectDB();
                    $query = "INSERT INTO $this->tabel (`nama_user`, `username`, `password`, `email`, `alamat`, `telp`, `foto`, `role`)
                            VALUES 
                            (:nama_user, :username, :password, :email, :alamat, :telp, :foto, 'KARYAWAN')";
                    $stmt = $pdo->prepare($query);
                    $stmt->bindParam(':nama_user', $nama);
                    $stmt->bindParam(':username', $username);
                    $stmt->bindParam(':password', $password);
                    $stmt->bindParam(':email', $email);
                    $stmt->bindParam(':alamat', $alamat);
                    $stmt->bindParam(':telp', $telpon);
                    $stmt->bindParam(':foto', $gambarU);

                    $insertRe = $stmt->execute();
                    if ($insertRe) {
                        Flasher::setFlasher('KARYAWAN BERHASIL', 'DITAMBAHKAN', 'success');
                        $redirectUrl = "tampil-data-user.php";
                        header("Location: $redirectUrl");
                        exit;
                    exit;
                    } else {
                        Flasher::setFlasher('KARYAWAN GAGAL', 'DITAMBAHKAN', 'danger');
                        $redirectUrl = "user-tambah.php";
                        header("Location: $redirectUrl");
                        exit;
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
            Flasher::setFlasher('KARYAWAN GAGAL', 'Ditambahkan ini' . $msg , 'danger');
            $redirectUrl = "user-tambah.php";
            header("Location: $redirectUrl");
            exit;

        }
    }

    public function getKaryawan()
    {
        $sql = 'SELECT * FROM ' . $this->tabel . ' WHERE role = "KARYAWAN" ORDER BY id_user ASC';
        $stmt = $this->connectDB()->prepare($sql);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }

    public function getTotalKaryawan() {
        $sql = 'SELECT COUNT(*) AS total_karyawan FROM ' . $this->tabel . ' WHERE role = "KARYAWAN"';
        $stmt = $this->connectDB()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['total_karyawan'];
    }

    public function getditUser($id_user){
        
        $sql = "SELECT * FROM ". $this->tabel ."  WHERE id_user = :id_user";
        $stmt = $this->connectDB()->prepare($sql);
        $stmt->bindParam(':id_user', $id_user);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function updateUser($nama, $username, $pass, $email, $alamat, $telp, $foto, $id_user)
    {
        //cek upload baru ato nga
        if (!empty($foto['name'])) {
            $profile = Flasher::uploadGambar($foto, 'USER');

            if (is_numeric($profile)) {
                //kalo ga diginiin gamau woi jirlah
                switch ($profile) {
                    case 0:
                        Flasher::setFlasher('Barang GAGAL', 'Diupdate ini Gambar tidak ada', 'danger');
                        break;
                    case 1:
                        Flasher::setFlasher('Barang GAGAL', 'Diupdate ini Gambar tidak valid', 'danger');
                        break;
                }
                $redirectUrl = "user-edit.php";
                header("Location: $redirectUrl");
                exit;
            }
        } else {
        
            $profile = $this->getditUser($id_user)->foto;
        }

    
        $gambarPath = '../../img/user_img/';
        $newImagePath = $gambarPath . $profile;
        
        if (!empty($foto['tmp_name']) && is_uploaded_file($foto['tmp_name'])) {
            if (!move_uploaded_file($foto['tmp_name'], $newImagePath)) {
                Flasher::setFlasher('Gagal menyimpan gambar', 'Diupdate ini', 'danger');
                $redirectUrl = "user-edit.php";
                header("Location: $redirectUrl");
                exit;
            }
        }

    $sql = "UPDATE " . $this->tabel . " SET nama_user=:nama_user, username=:username, password=:pass, email=:email, alamat=:alamat, telp=:telp, foto=:foto WHERE id_user=:id_user";
    $stmt = $this->connectDB()->prepare($sql);
    $stmt->bindParam(':id_user', $id_user);
    $stmt->bindParam(':nama_user', $nama);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':pass', $pass);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':alamat', $alamat);
    $stmt->bindParam(':telp', $telp);
    $stmt->bindParam(':foto', $profile);

    $update_exe = $stmt->execute();

    if ($update_exe) {
        Flasher::setFlasher('USER ' . $id_user . ' BERHASIL', 'DIUPDATE', 'success');
        $redirectUrl = "tampil-data-user.php";
        header("Location: $redirectUrl");
        exit;
    } else {
        Flasher::setFlasher('USER ' . $id_user . ' GAGAL', 'DIUPDATE', 'danger');
        $redirectUrl = "user-edit.php";
        header("Location: $redirectUrl");
        exit;
    }
}


    public function delUser($id_user){

        $sql = "DELETE FROM ". $this->tabel ." WHERE id_user = :id_user";
        $stmt = $this->connectDB()->prepare($sql);
        $stmt->bindParam(':id_user', $id_user);
        $delBarang = $stmt->execute();

        if ($delBarang) {
            Flasher::setFlasher('USER ' .$id_user. ' BERHASIL', 'DIHAPUS', 'success');
            $redirectUrl = "tampil-data-user.php";
            header("Location: $redirectUrl");
            exit;
        exit;
        } else {
            Flasher::setFlasher('USER ' .$id_user. ' GAGAL', 'DIHAPUS', 'danger');
            $redirectUrl = "tampil-data-user.php";
            header("Location: $redirectUrl");
            exit;
        }
    }
}

