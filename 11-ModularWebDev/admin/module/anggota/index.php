<div class="container-fluid">
    <div class="row">
        <?php
        // Memuat menu navigasi (sidebar)
        require 'template/menu.php';
        ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Anggota</h1>
            </div>

            <div class="row">
                <div class="col-lg-3">
                    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="fa fa-plus"></i> Tambah Anggota
                    </button>
                </div>
            </div>

            <?php
            // Menampilkan pesan sukses/error jika ada (dari fungsi pesan_kilat.php)
            if (isset($_SESSION['_flashdata'])) {
                echo "<br>";
                foreach ($_SESSION['_flashdata'] as $key => $val) {
                    echo get_flashdata($key);
                }
            }
            ?>

            <div class="table-responsive small">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Jabatan</th>
                            <th scope="col">Username</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        // Query JOIN untuk mengambil data anggota beserta jabatan dan username
                        $query = "SELECT a.*, j.jabatan, u.username, u.id AS user_id_data FROM anggota a 
                                  JOIN jabatan j ON a.jabatan_id = j.id
                                  JOIN users u ON a.user_id = u.id 
                                  ORDER BY a.id DESC";
                        
                        
                        $result = pg_query($koneksi, $query);
                        
                        while ($row = pg_fetch_assoc($result)) {
                        ?>
                            <tr>
                                <th scope="row"><?= $no++; ?></th>
                                <td><?= $row['nama']; ?></td>
                                <td><?= $row['jabatan']; ?></td>
                                <td><?= $row['username']; ?></td>
                                <td>
                                    <a href="index.php?page=anggota/edit&id=<?php echo $row['user_id_data']; ?>" class="btn btn-warning btn-sm">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                                    </a>
                                    <a href="fungsi/hapus.php?anggota=hapus&id=<?php echo $row['user_id_data']; ?>" 
                                       onclick="javascript:return confirm('Apakah Anda yakin ingin menghapus data anggota ini?');" 
                                       class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i> Hapus
                                    </a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Form Tambah Anggota</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        
                        <form action="fungsi/tambah.php?anggota=tambah" method="POST">
                            <div class="modal-body">
                                
                                <div class="mb-3">
                                    <label for="inputNama" class="col-form-label">Nama:</label>
                                    <input type="text" name="nama" class="form-control" id="inputNama" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="selectJabatan" class="col-form-label">Jabatan:</label>
                                    <select class="form-select" name="jabatan" id="selectJabatan" required>
                                        <option value="" selected disabled>Pilih Jabatan</option>
                                        <?php
                                        // Query untuk mengisi dropdown Jabatan
                                        $query2 = "SELECT id, jabatan FROM jabatan ORDER BY jabatan ASC";
                                        $result2 = pg_query($koneksi, $query2);
                                        while ($row2 = pg_fetch_assoc($result2)) {
                                        ?>
                                            <option value="<?= $row2['id']; ?>"><?= $row2['jabatan']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="col-form-label">Jenis Kelamin:</label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" value="L" id="jkL" checked>
                                        <label class="form-check-label" for="jkL">Laki-Laki</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" value="P" id="jkP">
                                        <label class="form-check-label" for="jkP">Perempuan</label>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="inputAlamat" class="col-form-label">Alamat:</label>
                                    <textarea class="form-control" name="alamat" id="inputAlamat" required></textarea>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="inputNoTelp" class="col-form-label">No Telepon:</label>
                                    <input type="number" name="no_telp" class="form-control" id="inputNoTelp" required>
                                </div>
                                
                                <hr class="border border-primary border-3 opacity-75">
                                
                                <div class="mb-3">
                                    <label for="inputUsername" class="col-form-label">Username:</label>
                                    <input type="text" name="username" class="form-control" id="inputUsername" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="inputPassword" class="col-form-label">Password:</label>
                                    <input type="password" name="password" class="form-control" id="inputPassword" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="selectLevel" class="col-form-label">Level:</label>
                                    <select class="form-select" name="level" id="selectLevel" required>
                                        <option value="" selected disabled>Pilih Level</option>
                                        <option value="user">User</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Close</button>
                                <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            </main>
        </div>
</div>