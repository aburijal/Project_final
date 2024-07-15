<?php
include "connect.php";
$nama_menu = (isset($_POST['nama_menu'])) ? htmlentities($_POST['nama_menu'])  : "";
$kategori = (isset($_POST['kategori'])) ? htmlentities($_POST['kategori'])  : "";
$harga = (isset($_POST['harga'])) ? htmlentities($_POST['harga'])  : "";


if (!empty($_POST['input_menu_validate'])) {
    $select = mysqli_query($conn, "SELECT * FROM tb_menu WHERE nama_menu = '$nama_menu'");
    if (mysqli_num_rows($select) > 0) {
        $message = '<script>alert("Nama menu yang anda masukkan sudah ada");
        window.location="../menu"</script>';
    } else {
        $query = mysqli_query($conn, "INSERT INTO tb_menu (nama_menu,kategori,harga) VALUES ('$nama_menu','$kategori','$harga')");
        if (!$query) {
            $message = '<script>alert("Data gagal dimasukkan");
        window.location="../menu"</script>';
        } else {
            $message = '<script>alert("Data berhasil dimasukkan");
        window.location="../menu"</script>';
        }
    }
}
echo $message;
