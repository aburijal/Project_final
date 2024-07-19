<?php
include "proses/connect.php";

// Inisialisasi $result sebagai array kosong
$result = array();
$kode = "";
$pelanggan = "";

$query = mysqli_query($conn, "SELECT *, SUM(harga*jumlah) AS harganya FROM tb_list_pesanan 
    LEFT JOIN tb_pemesanan ON tb_pemesanan.id_pesanan = tb_list_pesanan.pesanan 
    LEFT JOIN tb_menu ON tb_menu.id = tb_list_pesanan.menu
    LEFT JOIN tb_pesan ON tb_pesan.id_pesan = tb_pemesanan.id_pesanan
    GROUP BY id_list
    HAVING tb_list_pesanan.pesanan = $_GET[pesanan]");

$kode = $_GET['pesanan'];
$pelanggan = $_GET['pelanggan'];

while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
    // $kode = $record['id_pesanan'];
    // $pelanggan = $record['pelanggan'];
}

$select_menu = mysqli_query($conn, "SELECT id,nama_menu FROM tb_menu");

?>
<div class="col-lg-9 rounded mt-2">
    <div class="card">
        <div class="card-header">
            Item Pesanan
        </div>
        <div class="card-body">
            <a href="pemesanan" class="btn btn-info mb-3"><i class="bi bi-box-arrow-left"></i></i></a>
            <div class="row">
                <div class="col-lg-3">
                    <div class="form-floating mb-3">
                        <input disabled type="text" class="form-control" id="kodepesanan" value="<?php echo $kode; ?>">
                        <label for="floatingInput">Kode Order </label>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-floating mb-3">
                    <input disabled type="text" class="form-control" id="pelanggan" value="<?php echo $pelanggan; ?>">
                    <label for="floatingInput">Pelanggan </label>
                    </div>
                </div>
                <!-- Modal tambah Item-->
                <div class="modal fade" id="tambahitem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Daftar Menu</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="needs-validation" novalidate action="proses/proses_input_itempesanan.php" method="POST">
                                    <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                                    <input type="hidden" name="kode_pesanan" value="<?php echo $kode ?>">
                                    <input type="hidden" name="pelanggan" value="<?php echo $pelanggan ?>">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" name="menu" id="">
                                                    <option selected hidden value="">Pilih Menu</option>
                                                    <?php
                                                    foreach ($select_menu as $value) {
                                                        echo "<option value=$value[id]>$value[nama_menu]</option>";
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
                                                <input type="number" class="form-control" id="floatingInput" placeholder="Jumlah Porsi" name="jumlah">
                                                <label for="floatingInput">Jumlah Porsi</label>
                                                <div class="invalid-feedback">
                                                    Masukkan Jumlah Porsi.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" name="input_itempesanan_validate" value="12345">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- akhir Modal tambah Item-->

                <?php
                foreach ($result as $row) {
                ?>

                    <!-- Modal Edit-->
                    <div class="modal fade" id="ModalEdit<?php echo $row['id_list'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Menu</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" novalidate action="proses/proses_edit_itempesanan.php" method="POST">
                                        <input type="hidden" name="id" value="<?php echo $row['id_list'] ?>">
                                        <input type="hidden" name="kode_pesanan" value="<?php echo $kode ?>">
                                        <input type="hidden" name="pelanggan" value="<?php echo $pelanggan ?>">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-floating mb-3">
                                                    <select class="form-select" name="menu" id="">
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
                                                    <input type="number" class="form-control" id="floatingInput" placeholder="Jumlah Porsi" name="jumlah" required value="<?php echo $row['jumlah'] ?>">
                                                    <label for="floatingInput">Jumlah Porsi</label>
                                                    <div class="invalid-feedback">
                                                        Masukkan Jumlah Porsi.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary" name="edit_itempesanan_validate" value="12345">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- akhir Modal Edit-->

                    <!-- Modal Delete-->
                    <div class="modal fade" id="ModalDelete<?php echo $row['id_list'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Menu</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" novalidate action="proses/proses_delete_itempesanan.php" method="POST">
                                        <input type="hidden" value="<?php echo $row['id_list'] ?>" name="id">
                                        <input type="hidden" name="kode_pesanan" value="<?php echo $kode ?>">
                                        <input type="hidden" name="pelanggan" value="<?php echo $pelanggan ?>">
                                        <div class="col-lg-12">
                                            Apakah Anda ingin menghapus menu <b><?php echo $row['nama_menu']  ?></b>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-danger" name="delete_itempesanan_validate" value="12345">Delete</button>
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
                    echo "Data Daftar Item Pesanan Tidak Ada";
                } else {
                ?>



                    <!-- Modal Pesanan Selesai-->
                    <div class="modal fade" id="pesananselesai" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Selesaikan Pesanan</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Menu</th>
                                                    <th scope="col">Harga</th>
                                                    <th scope="col">Jumlah Pesanan</th>
                                                    <th scope="col">Total Harga</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $total = 0;
                                                foreach ($result as $row) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $row['nama_menu'] ?></td>
                                                        <td><?php echo number_format($row['harga'], 0, ',', '.')  ?></td>
                                                        <td><?php echo $row['jumlah'] ?></td>
                                                        <td><?php echo number_format($row['harganya'], 0, ',', '.')  ?></td>
                                                    </tr>
                                                <?php
                                                    $total += $row['harganya'];
                                                }
                                                ?>
                                                <tr>
                                                    <td colspan="3" class="fw-bold">
                                                        Total Harga
                                                    </td>
                                                    <td class="fw-bold">
                                                        <?php echo number_format($total, 0, ',', '.')  ?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <form class="needs-validation" novalidate action="proses/proses_pesan.php" method="POST">
                                        <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                                        <input type="hidden" name="kode_pesanan" value="<?php echo $kode ?>">
                                        <input type="hidden" name="pelanggan" value="<?php echo $pelanggan ?>">
                                        <input type="hidden" name="total" value="<?php echo $total ?>">

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary" name="pesan_validate" value="12345">Pesan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- akhir Modal Pesanan Selesai-->


                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Menu</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Jumlah Pesanan</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Total Harga</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $total = 0;
                                foreach ($result as $row) {
                                ?>
                                    <tr>
                                        <td><?php echo $row['nama_menu'] ?></td>
                                        <td><?php echo number_format($row['harga'], 0, ',', '.')  ?></td>
                                        <td><?php echo $row['jumlah'] ?></td>
                                        <td><?php
                                            if ($row['status'] == 1) {
                                                echo "<span class='badge text-bg-info'>Pesanan Sedang Diproses</span>";
                                            } elseif ($row['status'] == 2) {
                                                echo "<span class='badge text-bg-success'>Pesanan Ready</span>";
                                            }
                                            ?></td>
                                        <td><?php echo number_format($row['harganya'], 0, ',', '.')  ?></td>
                                        <td class="d-flex">
                                            <button class="<?php echo (!empty($row['id_pesan'])) ? "btn btn-secondary btn-sm me-1 disabled" : "btn btn-warning btn-sm me-1"; ?>" data-bs-toggle="modal" data-bs-target="#ModalEdit<?php echo $row['id_list'] ?>"><i class="bi bi-pencil-square"></i></i></button>
                                            <button class="<?php echo (!empty($row['id_pesan'])) ? "btn btn-secondary btn-sm me-1 disabled" : "btn btn-danger btn-sm me-1"; ?>" data-bs-toggle="modal" data-bs-target="#ModalDelete<?php echo $row['id_list'] ?>"><i class="bi bi-trash-fill"></i></button>
                                        </td>
                                    </tr>
                                <?php
                                    $total += $row['harganya'];
                                }
                                ?>
                                <tr>
                                    <td colspan="4" class="fw-bold">
                                        Total Harga
                                    </td>
                                    <td class="fw-bold">
                                        <?php echo number_format($total, 0, ',', '.')  ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
            </div>
        <?php
                }
        ?><div>
            <button class="<?php echo (!empty($row['id_pesan'])) ? "btn btn-secondary disabled" : "btn btn-success "; ?>" data-bs-toggle="modal" data-bs-target="#tambahitem"><i class="bi bi-plus"></i></button>
            <button class="<?php echo (!empty($row['id_pesan'])) ? "btn btn-secondary disabled" : "btn btn-primary "; ?>" data-bs-toggle="modal" data-bs-target="#pesananselesai">Selesaikan Pesanan</button>
        </div>
        </div>
    </div>
</div>