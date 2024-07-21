<?php
session_start();
include "connect.php";
$nama = (isset($_POST['nama'])) ? htmlentities($_POST['nama']) : "";
$nohp = (isset($_POST['nohp'])) ? htmlentities($_POST['nohp']) : "";

if(!empty($_POST['ubah_profil_validate'])){
            $query = mysqli_query($conn, "UPDATE tb_user SET nama='$nama', nohp='$nohp' WHERE username = '$_SESSION[username_kantinkampus]'");
        if ($query) {  // Perbaikan: Jika query berhasil
            $message = '<script>alert("Profil Berhasil diubah"); window.history.back()</script>';
        }else{
            $message = '<script>alert("Profil Gagal diubah"); window.history.back()</script>';
        }
    }else{
            $message = '<script>alert("Terjadi Kesalahan Profil Gagal diubah"); window.history.back()</script>';
        }
echo $message;
?>
