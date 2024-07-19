<?php
include "connect.php";
$kode_pesanan = (isset($_POST['kode_pesanan'])) ? mysqli_real_escape_string($conn, $_POST['kode_pesanan']) : "";
$pelanggan = (isset($_POST['pelanggan'])) ? mysqli_real_escape_string($conn, $_POST['pelanggan']) : "";

if (!empty($_POST['input_pesanan_validate'])) {
    $select = mysqli_query($conn, "SELECT * FROM tb_pemesanan WHERE id_pesanan = '$kode_pesanan'");
    if (mysqli_num_rows($select) > 0) {
        echo '<script>alert("Pesanan yang Anda masukkan sudah ada"); window.location="../pemesanan"</script>';
    } else {
        $query = mysqli_query($conn, "INSERT INTO tb_pemesanan (id_pesanan, pelanggan) VALUES ('$kode_pesanan', '$pelanggan')");
        if ($query) {
            echo '<script>window.location="../?x=itempesanan&pesanan=' . $kode_pesanan . '&pelanggan=' . $pelanggan . '"</script>';
        } else {
            echo '<script>alert("Data gagal dimasukkan: ' . mysqli_error($conn) . '")</script>';
        }
    }
}
?>
