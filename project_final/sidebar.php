<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.122.0">
    <title>KantinKampus - Sidebar</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/sign-in/">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .sidebar .nav-pills .nav-link.active {
            background-color: #f0ad4e !important;
            color: white !important;
        }

        .sidebar .nav-pills .nav-link {
            color: #000;
        }

        .sidebar .nav-pills .nav-link:hover {
            color: #ec971f;
        }
    </style>
</head>

<body>

<div class="col-lg-3 sidebar">
    <nav class="navbar navbar-expand-lg bg-body-tertiary rounded border mt-2">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel" style="width: 250px;">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav nav-pills flex-column justify-content-end flex-grow-1">
                        <li class="nav-item">
                            <a class="nav-link ps-2 <?php echo ((isset($_GET['x']) && $_GET['x'] == 'home') || !isset($_GET['x'])) ? 'active link-light' : 'link-dark'; ?>" aria-current="page" href="home"><i class="bi bi-house-door"></i> Beranda</a>
                        </li>

                        <?php if ($hasil['level'] == 1 || $hasil['level'] == 2) { ?>
                        <li class="nav-item">
                            <a class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x'] == 'menu') ? 'active link-light' : 'link-dark'; ?>" href="menu"><i class="bi bi-menu-button-wide"></i> Daftar Menu</a>
                        </li>
                        <?php } ?>

                        <?php if ($hasil['level'] == 1 || $hasil['level'] == 2 || $hasil['level'] == 3 || $hasil['level'] == 4) { ?>
                        <li class="nav-item">
                            <a class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x'] == 'pemesanan') ? 'active link-light' : 'link-dark'; ?>" href="pemesanan"><i class="bi bi-cart"></i> Pemesanan</a>
                        </li>
                        <?php } ?>
                        
                        <?php if ($hasil['level'] == 1 || $hasil['level'] == 2) { ?>
                        <li class="nav-item">
                            <a class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x'] == 'dapur') ? 'active link-light' : 'link-dark'; ?>" href="dapur"><i class="bi bi-person-workspace"></i> Dapur</a>
                        </li>
                        <?php } ?>

                        <?php if ($hasil['level'] == 1) { ?>
                            <li class="nav-item">
                                <a class="nav-link ps-2 <?php echo (isset($_GET['x']) && $_GET['x'] == 'user') ? 'active link-light' : 'link-dark'; ?>" href="user"><i class="bi bi-people"></i> Pengguna</a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBogGzOg9F4lYyyLFyUFO3a4QlIdBPTz8vbhnKcI0I/r1KcE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-ZkCGoY8FzI10Xo6T/r0F0GQjuK2MpHfD4E9nBVgmb7D9zO/j2FPDLKAudMSTm2xE" crossorigin="anonymous"></script>

</body>
</html>
