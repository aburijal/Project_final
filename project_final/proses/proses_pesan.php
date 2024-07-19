<?php
include "connect.php";
$kode_pesanan = (isset($_POST['kode_pesanan'])) ? mysqli_real_escape_string($conn, $_POST['kode_pesanan']) : "";
$pelanggan = (isset($_POST['pelanggan'])) ? mysqli_real_escape_string($conn, $_POST['pelanggan']) : "";
$total = (isset($_POST['total'])) ? mysqli_real_escape_string($conn, $_POST['total']) : "";


if (!empty($_POST['pesan_validate'])) {

    $query = mysqli_query($conn, "INSERT INTO tb_pesan (id_pesan,total) VALUES ('$kode_pesanan', '$total')");
    if ($query) {
        $message = '<script>alert("Pesanan Sedang di Proses");
            window.location="../?x=itempesanan&pesanan=' . $kode_pesanan . '&pelanggan=' . $pelanggan . '"</script>';
    } else {
        $message = '<script>alert("Pesanan Gagal Diproses: ' . mysqli_error($conn) . '");
            window.location="../?x=itempesanan&pesanan=' . $kode_pesanan . '&pelanggan=' . $pelanggan . '"</script>';
    }
}
echo $message;

