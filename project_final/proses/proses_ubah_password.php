<?php
session_start();
include "connect.php";
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
$passwordlama = (isset($_POST['passwordlama'])) ? md5(htmlentities($_POST['passwordlama'])) : "";
$passwordbaru = (isset($_POST['passwordbaru'])) ? md5(htmlentities($_POST['passwordbaru'])) : "";
$konfirmasipasswordbaru = (isset($_POST['konfirmasipasswordbaru'])) ? md5(htmlentities($_POST['konfirmasipasswordbaru'])) : "";

if(!empty($_POST['ubah_password_validate'])){
    $query = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$_SESSION[username_kantinkampus]' && password = '$passwordlama'");
    $hasil = mysqli_fetch_array($query);
    if($hasil){
        if($passwordbaru == $konfirmasipasswordbaru){
            $query = mysqli_query($conn, "UPDATE tb_user SET password='$passwordbaru' WHERE username = '$_SESSION[username_kantinkampus]'");
        if ($query) {  // Perbaikan: Jika query berhasil
            $message = '<script>alert("Password berhasil diubah"); window.history.back()</script>';
        } else {
            $message = '<script>alert("password gagal diubah"); window.history.back()</script>';
        }
        }else{
            $message = '<script>alert("Konfirmasi password baru yang anda masukkan salah"); window.history.back()</script>';
        }
        
    }else{
            $message = '<script>alert("Password lama tidak sesuai"); window.history.back()</script>';

    }
}else{
    header('location:../home');
}
echo $message;
?>
