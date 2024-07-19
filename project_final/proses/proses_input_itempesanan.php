<?php
include "connect.php";
$kode_pesanan = (isset($_POST['kode_pesanan'])) ? mysqli_real_escape_string($conn, $_POST['kode_pesanan']) : "";
$pelanggan = (isset($_POST['pelanggan'])) ? mysqli_real_escape_string($conn, $_POST['pelanggan']) : "";
$menu = (isset($_POST['menu'])) ? mysqli_real_escape_string($conn, $_POST['menu']) : "";
$jumlah = (isset($_POST['jumlah'])) ? mysqli_real_escape_string($conn, $_POST['jumlah']) : "";

if (!empty($_POST['input_itempesanan_validate'])) {
    $select = mysqli_query($conn, "SELECT * FROM tb_list_pesanan WHERE menu = '$menu' AND pesanan='$kode_pesanan'");
    if (mysqli_num_rows($select) > 0) {
        $message = '<script>alert("Item pesanan yang dimasukkan sudah ada");
                    window.location="../?x=itempesanan&pesanan=' . $kode_pesanan . '&pelanggan=' . $pelanggan . '"</script>';
    } else {
        $query = mysqli_query($conn, "INSERT INTO tb_list_pesanan (pesanan,menu, jumlah) VALUES ('$kode_pesanan', '$menu', '$jumlah')");
        if ($query) {
            // Langsung mengarahkan ke halaman tanpa alert
            echo '<script>window.location="../?x=itempesanan&pesanan=' . $kode_pesanan . '&pelanggan=' . $pelanggan . '"</script>';
        } else {
            $message = '<script>alert("Data gagal dimasukkan: ' . mysqli_error($conn) . '");
            window.location="../?x=itempesanan&pesanan=' . $kode_pesanan . '&pelanggan=' . $pelanggan . '"</script>';
        }
    }
    if (isset($message)) {
        echo $message;
    }
}
?>
