<?php
include "connect.php";
$kode_pesanan = (isset($_POST['kode_pesanan'])) ? htmlentities($_POST['kode_pesanan']) : "";

if (!empty($_POST['delete_pesanan_validate'])) {
    $select = mysqli_query($conn, "SELECT pesanan FROM tb_list_pesanan WHERE pesanan = '$kode_pesanan'");
    if (mysqli_num_rows($select) > 0) {
        $message = '<script>alert("Pesanan ini sudah diproses, pesanan ini tidak dapat dihapus");
        window.location="../pemesanan";</script>';
    } else {
        $query = mysqli_query($conn, "DELETE FROM tb_pemesanan WHERE id_pesanan = '$kode_pesanan'");;
        if ($query) {  // Perbaikan: Jika query berhasil
            $message = '<script>alert("Data berhasil dihapus");
        window.location="../pemesanan";</script>';
        } else {
            $message = '<script>alert("Data gagal dihapus");
        window.location="../pemesanan";</script>';
        }
    }
}
echo $message;
