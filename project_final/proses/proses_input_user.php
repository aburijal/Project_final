<?php
include "connect.php";
$nama = (isset($_POST['nama'])) ? htmlentities($_POST['nama'])  : "";
$username = (isset($_POST['username'])) ? htmlentities($_POST['username'])  : "";
$level = (isset($_POST['level'])) ? htmlentities($_POST['level'])  : "";
$nohp = (isset($_POST['nohp'])) ? htmlentities($_POST['nohp'])  : "";
$password = md5('password');

if (!empty($_POST['input_user_validate'])) {
    $select = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username'");
    if (mysqli_num_rows($select) > 0) {
        $message = '<script>alert("Username yang anda masukkan sudah ada");
        window.location="../user"</script>
        </script>';
    } else {
        $query = mysqli_query($conn, "INSERT INTO tb_user (nama,username,level,nohp,password) VALUES ('$nama','$username','$level','$nohp','$password')");
        if (!$query) {
            $message = '<script>alert("Data gagal dimasukkan")</script>';
        } else {
            $message = '<script>alert("Data berhasil dimasukkan");
        window.location="../user"</script>
        </script>';
        }
    }
}
echo $message;