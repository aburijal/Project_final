<?php
include "proses/connect.php";
$query = mysqli_query($conn, "SELECT * FROM tb_user WHERE username='$_SESSION[username_kantinkampus]'");
$records = mysqli_fetch_array($query);
?>
<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.122.0">
    <title>KantinKampus - Header</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/sign-in/">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('path-to-your-image.jpg');
            background-size: cover;
            background-position: center;
            font-family: 'Roboto', sans-serif;
        }

        .navbar {
            background-color: rgba(255, 255, 255, 0.85);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .navbar .navbar-brand {
            color: #000;
            font-weight: bold;
        }

        .navbar .navbar-brand:hover {
            color: #333;
        }

        .navbar .nav-link {
            color: #000;
        }

        .navbar .nav-link:hover {
            color: #ec971f;
        }

        .modal-header, .modal-footer {
            background-color: rgba(255, 255, 255, 0.85);
        }

        .btn-warning {
            background-color: #f0ad4e;
            border-color: #eea236;
            font-weight: bold;
        }

        .btn-warning:hover {
            background-color: #ec971f;
            border-color: #d58512;
        }
    </style>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-warning sticky-top">
    <div class="container-lg">
        <a class="navbar-brand" href="."><i class="bi bi-shop"></i> Kantin Kampus</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo $records['username']; ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end mt-2">
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#ModalUbahProfil"><i class="bi bi-person-circle"></i> Profil</a></li>
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#ModalUbahPassword"><i class="bi bi-key-fill"></i> Ubah password</a></li>
                        <li><a class="dropdown-item" href="logout"><i class="bi bi-box-arrow-left"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Modal Ubah Password-->
<div class="modal fade" id="ModalUbahPassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-fullscreen-md-down">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Password</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" novalidate action="proses/proses_ubah_password.php" method="POST">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input disabled type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="username" required value="<?php echo $_SESSION['username_kantinkampus'] ?>">
                                <label for="floatingInput">Username</label>
                                <div class="invalid-feedback">Masukan Username.</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="floatingPassword" name="passwordlama" required>
                                <label for="floatingPassword">Masukan Password Lama</label>
                                <div class="invalid-feedback">Masukan Password Lama</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="floatingInput" name="passwordbaru" required>
                                <label for="floatingInput">Masukan Password Baru</label>
                                <div class="invalid-feedback">Masukan Password Baru</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="floatingPassword" name="konfirmasipasswordbaru" required>
                                <label for="floatingPassword">Konfirmasi Password Baru</label>
                                <div class="invalid-feedback">Konfirmasi Password Baru</div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="ubah_password_validate" value="12345">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- akhir Modal Ubah Password-->

<!-- Modal Ubah Profile-->
<div class="modal fade" id="ModalUbahProfil" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-fullscreen-md-down">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Profil</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" novalidate action="proses/proses_ubah_profil.php" method="POST">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-floating mb-3">
                                <input disabled type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="username" required value="<?php echo $_SESSION['username_kantinkampus'] ?>">
                                <label for="floatingInput">Username</label>
                                <div class="invalid-feedback">Masukan Username.</div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingNama" name="nama" required value="<?php echo $records['nama'] ?>">
                                <label for="floatingInput">Nama</label>
                                <div class="invalid-feedback">Masukan Nama Anda.</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="floatingInput" name="nohp" required value="<?php echo $records['nohp'] ?>">
                                    <label for="floatingInput">Nomor Hp</label>
                                    <div class="invalid-feedback">Masukan Nomor Hp Anda.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" name="ubah_profil_validate" value="12345">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- akhir Modal Ubah Profile-->

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybGPFjV6zZZ7AjbHg5c2Xm3HlQ8zWElSkbQQfGCSyT9kzG1p6" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-OPMSKNNTxCLH0PnAL1Ockfj9r0JpEX7e+0GXOhGM4Qp15T4Cz7v0ddI6DA9pe+ie" crossorigin="anonymous"></script>
</body>
</html>
