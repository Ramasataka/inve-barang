<?php

class Flasher {

    public static function setFlasher($pesan, $aksi, $tipe){
        $_SESSION['flash'] = [
            'pesan' => $pesan,
            'aksi' => $aksi,
            'tipe' => $tipe
        ];
    }

    public static function flash()
    {
        if ( isset($_SESSION['flash'])){
            echo'<div class="alert alert-' . $_SESSION['flash']['tipe']  .' alert-dismissible fade show" role="alert">
                <strong>DATA '. $_SESSION['flash']['pesan'] .'</strong> '. $_SESSION['flash']['aksi'].'
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
                
                unset($_SESSION['flash']);
        }
    }

    public static function uploadGambar($foto, $kode){
    $fileName = $foto['name'];
    $error = $foto['error'];
    $tmpName = $foto['tmp_name'];

    if ($error === 4) {
        return 'Gambar tidak ada';
    }

    $validImageExtensions = ['jpg', 'jpeg', 'png'];
    $imageExtension = explode('.', $fileName);
    $imageExt = strtolower(end($imageExtension));

    if (!in_array($imageExt, $validImageExtensions)) {
        return 'Gambar tidak valid';
    }

    $imageName = time() . '-' . $fileName;

    switch($kode) {
        case 'BARANG':
            if (move_uploaded_file($tmpName, '../../img/barang_img/' . $imageName)) {
                return $imageName; // Successful upload
            } else {
                return 'Gagal mengunggah gambar'; // Failed upload
            }
            break;
        case 'USER':
            if (move_uploaded_file($tmpName, '../../img/user_img/' . $imageName)) {
                return $imageName; // Successful upload
            } else {
                return 'Gagal mengunggah gambar'; // Failed upload
            }
            break;
        default:
            return 'Kode tidak valid';
    }
}

    
}