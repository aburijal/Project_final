<?php
include "proses/connect.php";
$query = mysqli_query($conn, "SELECT * FROM tb_menu");
while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
}
?>
<div class="col-lg-9 rounded mt-2">
    <div class="card shadow-lg">
        <div class="card-header bg-warning text-white">
            <h4 class="mb-0">Daftar Menu Kantin Kampus</h4>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col d-flex justify-content-end">
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ModalTambahUser">Tambah Menu</button>
                </div>
            </div>
            <!-- Modal tambah Daftar Menu-->
            <div class="modal fade" id="ModalTambahUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md modal-fullscreen-md-down">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Daftar Menu</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="needs-validation" novalidate action="proses/proses_input_menu.php" method="POST">
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="namaMenu" placeholder="Nama Menu" name="nama_menu" required>
                                        <label for="namaMenu">Nama Menu</label>
                                        <div class="invalid-feedback">Masukkan Nama Menu.</div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <select class="form-select" id="kategoriMenu" name="kategori" required>
                                            <option selected hidden value="">Pilih Kategori Menu</option>
                                            <option value="Makanan">Makanan</option>
                                            <option value="Minuman">Minuman</option>
                                        </select>
                                        <label for="kategoriMenu">Kategori Menu</label>
                                        <div class="invalid-feedback">Pilih Kategori Menu.</div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <input type="number" class="form-control" id="hargaMenu" placeholder="Harga" name="harga" required>
                                        <label for="hargaMenu">Harga</label>
                                        <div class="invalid-feedback">Masukkan Harga.</div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary" name="input_menu_validate" value="12345">Tambah</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- akhir Modal tambah Daftar Menu-->

            <?php
            foreach ($result as $row) {
            ?>
                <!-- Modal view-->
                <div class="modal fade" id="ModalView<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Detail Menu</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="needs-validation" novalidate action="proses/proses_input_menu.php" method="POST">
                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <input disabled type="text" class="form-control" id="namaMenu" value="<?php echo $row['nama_menu'] ?>" name="nama_menu">
                                            <label for="namaMenu">Nama Menu</label>
                                            <div class="invalid-feedback">Masukkan Nama Menu.</div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <select disabled class="form-select" id="kategoriMenu" name="kategori_menu">
                                                <option hidden value="">Pilih Kategori Menu</option>
                                                <option value="Makanan" <?php echo $row['kategori'] == 'Makanan' ? 'selected' : ''; ?>>Makanan</option>
                                                <option value="Minuman" <?php echo $row['kategori'] == 'Minuman' ? 'selected' : ''; ?>>Minuman</option>
                                            </select>
                                            <label for="kategoriMenu">Kategori Menu</label>
                                            <div class="invalid-feedback">Pilih Kategori Menu.</div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <input disabled type="number" class="form-control" id="hargaMenu" value="<?php echo $row['harga'] ?>" name="harga">
                                            <label for="hargaMenu">Harga</label>
                                            <div class="invalid-feedback">Masukkan Harga.</div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- akhir Modal view-->

                <!-- Modal Edit-->
                <div class="modal fade" id="ModalEdit<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Daftar Menu</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="needs-validation" novalidate action="proses/proses_edit_menu.php" method="POST">
                                    <input type="hidden" value="<?php echo $row['id'] ?>" name="id">
                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="namaMenu" placeholder="Nama Menu" name="nama_menu" required value="<?php echo $row['nama_menu'] ?>">
                                            <label for="namaMenu">Nama Menu</label>
                                            <div class="invalid-feedback">Masukkan Nama Menu.</div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <select class="form-select" id="kategoriMenu" name="kategori" required>
                                                <option hidden value="">Pilih Kategori Menu</option>
                                                <option value="Makanan" <?php echo $row['kategori'] == 'Makanan' ? 'selected' : ''; ?>>Makanan</option>
                                                <option value="Minuman" <?php echo $row['kategori'] == 'Minuman' ? 'selected' : ''; ?>>Minuman</option>
                                            </select>
                                            <label for="kategoriMenu">Kategori Menu</label>
                                            <div class="invalid-feedback">Pilih Kategori Menu.</div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <input type="number" class="form-control" id="hargaMenu" placeholder="Harga" name="harga" required value="<?php echo $row['harga'] ?>">
                                            <label for="hargaMenu">Harga</label>
                                            <div class="invalid-feedback">Masukkan Harga.</div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary" name="input_menu_validate" value="12345">Edit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- akhir Modal Edit-->

                <!-- Modal Delete-->
                <div class="modal fade" id="ModalDelete<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Delete Daftar Menu</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="needs-validation" novalidate action="proses/proses_delete_menu.php" method="POST">
                                    <input type="hidden" value="<?php echo $row['id'] ?>" name="id">
                                    <div class="mb-3">
                                        Apakah Anda ingin menghapus daftar menu <b><?php echo $row['nama_menu'] ?></b>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-danger" name="input_user_validate" value="12345">Delete</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- akhir Modal Delete-->
            <?php
            }
            if (empty($result)) {
                echo "Data menu tidak ada";
            } else {
            ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Menu</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($result as $row) {
                            ?>
                                <tr>
                                    <th scope="row"><?php echo $no++ ?></th>
                                    <td><?php echo $row['nama_menu'] ?></td>
                                    <td><?php echo $row['kategori'] ?></td>
                                    <td><?php echo $row['harga'] ?></td>
                                    <td class="d-flex">
                                        <button class="btn btn-info btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalView<?php echo $row['id'] ?>"><i class="bi bi-eye-fill"></i></button>
                                        <button class="btn btn-warning btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalEdit<?php echo $row['id'] ?>"><i class="bi bi-pencil-square"></i></button>
                                        <button class="btn btn-danger btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalDelete<?php echo $row['id'] ?>"><i class="bi bi-trash-fill"></i></button>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
        </div>
    <?php
            }
    ?>
    </div>
</div>
