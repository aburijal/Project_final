<?php
include "connect.php";
$kode_pesanan = (isset($_POST['kode_pesanan'])) ? mysqli_real_escape_string($conn, $_POST['kode_pesanan']) : "";
$pelanggan = (isset($_POST['pelanggan'])) ? mysqli_real_escape_string($conn, $_POST['pelanggan']) : "";
$catatan = (isset($_POST['catatan'])) ? mysqli_real_escape_string($conn, $_POST['catatan']) : "";

if (!empty($_POST['edit_pesanan_validate'])) {
    $select = mysqli_query($conn, "SELECT * FROM tb_pemesanan WHERE id_pesanan = '$kode_pesanan'");
    
        $query = mysqli_query($conn, "UPDATE tb_pemesanan SET pelanggan='$pelanggan', catatan='$catatan' WHERE id_pesanan='$kode_pesanan'");
        if ($query) {
            $message = '<script>alert("Data berhasil dimasukkan");
                        window.location="../pemesanan"</script>';
        } else {
            $message = '<script>alert("Data gagal dimasukkan: ' . mysqli_error($conn) . '")
                        window.location="../pemesanan"</script>';
        }
    echo $message;
}
?>
