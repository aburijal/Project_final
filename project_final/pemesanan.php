<?php
include "proses/connect.php";

// Inisialisasi $result sebagai array kosong
$result = array();
$kode = "";
$pelanggan = "";

date_default_timezone_set('Asia/Jakarta');
$query = mysqli_query($conn, "SELECT tb_pemesanan.*,tb_pesan.*, SUM(harga*jumlah) AS harganya FROM tb_pemesanan 
    LEFT JOIN tb_list_pesanan ON tb_list_pesanan.pesanan = tb_pemesanan.id_pesanan
    LEFT JOIN tb_menu ON tb_menu.id = tb_list_pesanan.menu
    LEFT JOIN tb_pesan ON tb_pesan.id_pesan = tb_pemesanan.id_pesanan
    GROUP BY id_pesanan ORDER BY waktu_pemesanan DESC");
while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
}
?>
<div class="col-lg-9 rounded mt-2">
    <div class="card shadow-lg">
        <div class="card-header bg-warning text-white">
            <h4 class="mb-0">Pemesanan</h4>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col d-flex justify-content-end">
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ModalTambahUser">Tambah Pesanan</button>
                </div>
            </div>
            <!-- Modal tambah Pesanan -->
            <div class="modal fade" id="ModalTambahUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md modal-fullscreen-md-down">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Buat Pesanan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="needs-validation" novalidate action="proses/proses_input_pesanan.php" method="POST">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="kode_pesanan" name="kode_pesanan" value="<?php echo date('dHi') . rand(100, 999) ?>" readonly>
                                            <label for="kode_pesanan">Kode Pesanan</label>
                                            <div class="invalid-feedback">
                                                Masukkan Kode Pesanan.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="pelanggan" placeholder="Nama Pelanggan" name="pelanggan" required>
                                            <label for="pelanggan">Nama Pelanggan</label>
                                            <div class="invalid-feedback">
                                                Masukkan Nama Pelanggan.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary" name="input_pesanan_validate" value="12345">Buat Pesanan</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- akhir Modal tambah Pesanan -->

            <?php
            foreach ($result as $row) {
            ?>

                <!-- Modal Edit-->
                <div class="modal fade" id="ModalEdit<?php echo $row['id_pesanan'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Pesanan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="needs-validation" novalidate action="proses/proses_edit_pesanan.php" method="POST">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="kode_pesanan" name="kode_pesanan" value="<?php echo $row['id_pesanan'] ?>" readonly>
                                                <label for="kode_pesanan">Kode Pesanan</label>
                                                <div class="invalid-feedback">
                                                    Masukkan Kode Pesanan.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="pelanggan" placeholder="Nama Pelanggan" name="pelanggan" required value="<?php echo $row['pelanggan'] ?>">
                                                <label for="pelanggan">Nama Pelanggan</label>
                                                <div class="invalid-feedback">
                                                    Masukkan Nama Pelanggan.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary" name="edit_pesanan_validate" value="12345">Edit</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- akhir Modal Edit-->

                <!-- Modal Delete-->
                <div class="modal fade" id="ModalDelete<?php echo $row['id_pesanan'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Delete Pesanan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="needs-validation" novalidate action="proses/proses_delete_pesanan.php" method="POST">
                                    <input type="hidden" value="<?php echo $row['id_pesanan'] ?>" name="kode_pesanan">
                                    <div class="col-lg-12">
                                        Apakah Anda ingin menghapus pesanan atas nama <b><?php echo $row['pelanggan'] ?></b> dengan kode pesanan <b><?php echo $row['id_pesanan'] ?></b>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-danger" name="delete_pesanan_validate" value="12345">Delete</button>
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
                echo "Data Daftar Menu Belum Tersedia";
            } else {
            ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kode Pesanan</th>
                                <th scope="col">Pelanggan</th>
                                <th scope="col">Total Harga</th>
                                <th scope="col">Waktu Pemesanan</th>
                                <th scope="col">Status</th>
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
                                    <td><?php echo $row['id_pesanan'] ?></td>
                                    <td><?php echo $row['pelanggan'] ?></td>
                                    <td><?php echo number_format($row['harganya'], 0, ',', '.') ?></td>
                                    <td><?php echo $row['waktu_pemesanan'] ?></td>
                                    <td><?php echo (!empty($row['id_pesan'])) ? "<span class='badge bg-success'>Dipesan</span>" : ""; ?></td>
                                    <td class="d-flex">
                                        <a class="btn btn-info btn-sm me-1" href="./?x=itempesanan&pesanan=<?php echo $row['id_pesanan'] . "&pelanggan=" . $row['pelanggan'] ?>"><i class="bi bi-eye-fill"></i></a>
                                        <button class="<?php echo (!empty($row['id_pesan'])) ? "btn btn-secondary btn-sm me-1 disabled" : "btn btn-warning btn-sm me-1"; ?>" data-bs-toggle="modal" data-bs-target="#ModalEdit<?php echo $row['id_pesanan'] ?>"><i class="bi bi-pencil-square"></i></button>
                                        <button class="<?php echo (!empty($row['id_pesan'])) ? "btn btn-secondary btn-sm me-1 disabled" : "btn btn-danger btn-sm me-1"; ?>" data-bs-toggle="modal" data-bs-target="#ModalDelete<?php echo $row['id_pesanan'] ?>"><i class="bi bi-trash-fill"></i></button>
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
</div>