<?php
include "connect.php";
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
$kode_pesanan = (isset($_POST['kode_pesanan'])) ? htmlentities($_POST['kode_pesanan']) : "";
$pelanggan = (isset($_POST['pelanggan'])) ? htmlentities($_POST['pelanggan']) : "";
$menu = (isset($_POST['menu'])) ? htmlentities($_POST['menu']) : "";
$jumlah = (isset($_POST['jumlah'])) ? htmlentities($_POST['jumlah']) : "";

if (!empty($_POST['edit_itempesanan_validate'])) {
    $query_string = "UPDATE tb_list_pesanan SET menu='$menu', jumlah='$jumlah' WHERE id_list='$id'";
    $query = mysqli_query($conn, $query_string);

    if ($query) {
        echo '<script>window.location="../?x=itempesanan&pesanan=' . $kode_pesanan . '&pelanggan=' . $pelanggan . '"</script>';
    } else {
        $error_message = mysqli_error($conn);
        $message = '<script>alert("Data gagal dimasukkan: ' . $error_message . '");
        window.location="../?x=itempesanan&pesanan=' . $kode_pesanan . '&pelanggan=' . $pelanggan . '"</script>';
        echo $message;
    }

    // Debugging
    error_log("Query: " . $query_string);
    error_log("Error: " . mysqli_error($conn));
}
?>
