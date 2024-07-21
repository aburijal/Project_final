<?php
include "proses/connect.php";

// Inisialisasi $result sebagai array kosong
$result = array();
$kode = "";
$pelanggan = "";

$query = mysqli_query($conn, "SELECT * FROM tb_list_pesanan 
    LEFT JOIN tb_pemesanan ON tb_pemesanan.id_pesanan = tb_list_pesanan.pesanan 
    LEFT JOIN tb_menu ON tb_menu.id = tb_list_pesanan.menu
    LEFT JOIN tb_pesan ON tb_pesan.id_pesan = tb_pemesanan.id_pesanan ORDER BY waktu_pemesanan ASC");

while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
}

$select_menu = mysqli_query($conn, "SELECT id,nama_menu FROM tb_menu");

?>
<div class="col-lg-9 rounded mt-2">
    <div class="card shadow-lg">
        <div class="card-header bg-warning text-white">
            <h4 class="mb-0">Dapur Kantin</h4>
        </div>
        <div class="card-body">
            <?php
            foreach ($result as $row) {
            ?>

                <!-- Modal Terima-->
                <div class="modal fade" id="terima<?php echo $row['id_list'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Terima Pesanan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="needs-validation" novalidate action="proses/proses_terima_itempesanan.php" method="POST">
                                    <input type="hidden" name="id" value="<?php echo $row['id_list'] ?>">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-floating mb-3">
                                                <select disabled class="form-select" name="menu" id="">
                                                    <option selected hidden value="">Pilih Menu</option>
                                                    <?php
                                                    foreach ($select_menu as $value) {
                                                        if ($row['menu'] == $value['id']) {
                                                            echo "<option selected value=$value[id]>$value[nama_menu]</option>";
                                                        } else {
                                                            echo "<option value=$value[id]>$value[nama_menu]</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <label for="menu">Daftar Menu</label>
                                                <div class="invalid-feedback">
                                                    Pilih Menu.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-floating mb-3">
                                                <input disabled type="number" class="form-control" id="floatingInput" placeholder="Jumlah Porsi" name="jumlah" required value="<?php echo $row['jumlah'] ?>">
                                                <label for="floatingInput">Jumlah Porsi</label>
                                                <div class="invalid-feedback">
                                                    Masukkan Jumlah Porsi.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" name="terima_pesanan_validate" value="12345">Pesanan Di Terima</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- akhir Modal Terima-->

                <!-- Modal Ready-->
                <div class="modal fade" id="ready<?php echo $row['id_list'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Ready</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="needs-validation" novalidate action="proses/proses_ready_itempesanan.php" method="POST">
                                    <input type="hidden" name="id" value="<?php echo $row['id_list'] ?>">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-floating mb-3">
                                                <select disabled class="form-select" name="menu" id="">
                                                    <option selected hidden value="">Pilih Menu</option>
                                                    <?php
                                                    foreach ($select_menu as $value) {
                                                        if ($row['menu'] == $value['id']) {
                                                            echo "<option selected value=$value[id]>$value[nama_menu]</option>";
                                                        } else {
                                                            echo "<option value=$value[id]>$value[nama_menu]</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <label for="menu">Daftar Menu</label>
                                                <div class="invalid-feedback">
                                                    Pilih Menu.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-floating mb-3">
                                                <input disabled type="number" class="form-control" id="floatingInput" placeholder="Jumlah Porsi" name="jumlah" required value="<?php echo $row['jumlah'] ?>">
                                                <label for="floatingInput">Jumlah Porsi</label>
                                                <div class="invalid-feedback">
                                                    Masukkan Jumlah Porsi.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" name="pesanan_ready_validate" value="12345">Pesanan Ready</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- akhir Modal Ready-->

            <?php
            }
            if (empty($result)) {
                echo "<div class='alert alert-warning'>Data Daftar Item Pesanan Tidak Ada</div>";
            } else {
            ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kode Pesanan</th>
                                <th scope="col">Menu</th>
                                <th scope="col">Jumlah Pesanan</th>
                                <th scope="col">Waktu Pemesanan</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($result as $row) {
                                if ($row['status'] != 2) {
                            ?>
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $row['id_pesanan'] ?></td>
                                        <td><?php echo $row['nama_menu'] ?></td>
                                        <td><?php echo $row['jumlah'] ?></td>
                                        <td><?php echo $row['waktu_pemesanan'] ?></td>
                                        <td><?php
                                            if ($row['status'] == 1) {
                                                echo "<span class='badge bg-info'>Pesanan Sedang Diproses</span>";
                                            } elseif ($row['status'] == 2) {
                                                echo "<span class='badge bg-success'>Pesanan Ready</span>";
                                            }
                                            ?></td>
                                        <td class="d-flex">
                                            <button class="<?php echo (!empty($row['status'])) ? "btn btn-secondary btn-sm me-1 disabled" : "btn btn-primary btn-sm me-1"; ?>" data-bs-toggle="modal" data-bs-target="#terima<?php echo $row['id_list'] ?>"><i class="bi bi-box-arrow-in-down"></i></button>
                                            <button class="<?php echo (empty($row['status']) || $row['status'] != 1) ? "btn btn-secondary btn-sm me-1 disabled" : "btn btn-success btn-sm me-1"; ?>" data-bs-toggle="modal" data-bs-target="#ready<?php echo $row['id_list'] ?>"><i class="bi bi-bookmark-check-fill"></i></button>
                                        </td>
                                    </tr>
                            <?php
                                }
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