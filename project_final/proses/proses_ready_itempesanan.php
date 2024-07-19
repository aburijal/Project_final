<?php
include "connect.php";
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";

if (!empty($_POST['pesanan_ready_validate'])) {
    $query_string = "UPDATE tb_list_pesanan SET status=2 WHERE id_list='$id'";
    $query = mysqli_query($conn, $query_string);

    if ($query) {
        echo '<script>window.location="../dapur"</script>';
    } else {
        $error_message = mysqli_error($conn);
        $message = '<script>alert("Data gagal dimasukkan: ' . $error_message . '");
        window.location="../dapur"</script>';
        echo $message;
    }

    // Debugging
    error_log("Query: " . $query_string);
    error_log("Error: " . mysqli_error($conn));
}
?>
