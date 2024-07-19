<?php
include "connect.php";
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
$kode_pesanan = (isset($_POST['kode_pesanan'])) ? htmlentities($_POST['kode_pesanan']) : "";
$pelanggan = (isset($_POST['pelanggan'])) ? htmlentities($_POST['pelanggan']) : "";

if (!empty($_POST['delete_itempesanan_validate'])) {
        $query = mysqli_query($conn, "DELETE FROM tb_list_pesanan WHERE id_list = '$id'");;
        if ($query) {
            echo '<script>window.location="../?x=itempesanan&pesanan=' . $kode_pesanan . '&pelanggan=' . $pelanggan . '"</script>';
        } else {
            $error_message = mysqli_error($conn);
            $message = '<script>alert("Data gagal dimasukkan: ' . $error_message . '");
            window.location="../?x=itempesanan&pesanan=' . $kode_pesanan . '&pelanggan=' . $pelanggan . '"</script>';
            echo $message;
        }
    }
echo $message;
