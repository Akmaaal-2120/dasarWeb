<!DOCTYPE html>
<html>
<head>
    <title>Data Anggota</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Data Anggota</h2>
        
        <a class="btn btn-success mt-2" href="create.php">Tambah Data</a>
        <br><br>

        <?php
        include 'koneksi.php'; 

        // Query pertama untuk tabel utama
        $query = "SELECT * FROM anggota order by id desc";
        $result = pg_query($koneksi, $query);
        ?>

        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Alamat</th>
                    <th>No. Telp</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                
                while ($row = pg_fetch_assoc($result)) {
                    $kelamin = ($row['jenis_kelamin'] == 'L') ? 'Laki-Laki' : 'Perempuan';
                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $row['nama']; ?></td>
                        <td><?php echo $kelamin; ?></td>
                        <td><?php echo $row['alamat']; ?></td>
                        <td><?php echo $row['no_telp']; ?></td>
                        <td>
                            <a class="btn btn-primary" href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
                            <a class="btn btn-danger" href="#" data-toggle="modal" data-target="#hapusModal<?php echo $row['id']; ?>">Hapus</a>
                        </td>
                    </tr>
                    <?php
                }
                // *** KONEKSI TIDAK DITUTUP DI SINI AGAR BISA DIGUNAKAN UNTUK MODAL ***
                ?>
            </tbody>
        </table>
    </div>

    <?php
    // Query kedua untuk modal
    $query_modal = "SELECT id, nama FROM anggota order by id desc";
    $result_modal = pg_query($koneksi, $query_modal);

    // Looping untuk membuat modal unik untuk setiap baris data
    while ($row_modal = pg_fetch_assoc($result_modal)) {
    ?>
    <div class="modal fade" id="hapusModal<?php echo $row_modal['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus data anggota **<?php echo $row_modal['nama']; ?>**?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <a href="proses.php?aksi=hapus&id=<?php echo $row_modal['id']; ?>" class="btn btn-danger">Ya, Hapus</a>
                </div>
            </div>
        </div>
    </div>
    <?php
    }

    // *** KONEKSI DITUTUP HANYA SATU KALI DI AKHIR ***
    pg_close($koneksi); 
    ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>