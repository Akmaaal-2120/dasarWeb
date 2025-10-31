<?php
    include 'auth.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo $_SESSION['csrf_token']; ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" integrity="sha384-wYfVxPpgGZ6vXQGgVXAFHSjYIHS0dhs5O2xbEwQkPxCAFIneevoeH3S5ioibVcQvNN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTMIJl8bJlyTo7mOnUtsJkcC4OpQbqy7rRnN7udJ9qRwhkMHpvLbH95m" crossorigin="anonymous">
    <title>Data Anggota</title>
</head>
<body>
    <nav class="navbar navbar-dark bg-primary">
        <a class="navbar-brand" href="index.php" style="color: #fff;">CRUD Dengan Ajax</a>
    </nav>
    <br/>
    </nav>

    <div class="container">
        <h2 align="center" style="margin: 30px;">Data Anggota</h2>
            <form method="post" class="form-data" id="form-data">
        <div class="row">
            <div class="col-sm-9">
                <div class="form-group">
                    <label>Nama</label>
                    <input type="hidden" name="id" id="id">
                    <input type="text" name="nama" id="nama" class="form-control" required="true">
                    <p class="text-danger" id="err_nama"></p>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label>Jenis Kelamin</label><br>
                    <input type="radio" name="jenis_kelamin" id="jenkel1" value="L" required="true"> Laki-laki
                    <input type="radio" name="jenis_kelamin" id="jenkel2" value="P"> Perempuan
                    <p class="text-danger" id="err_jenis_kelamin"></p>
                </div>
            </div>
        </div>
        
        <div class="form-group">
            <label>Alamat</label>
            <textarea name="alamat" id="alamat" class="form-control" required="true"></textarea>
            <p class="text-danger" id="err_alamat"></p>
        </div>

        <div class="form-group">
            <label>No Telepon</label>
            <input type="number" name="no_telp" id="no_telp" class="form-control" required="true">
            <p class="text-danger" id="err_no_telp"></p>
        </div>
        
        <div class="form-group">
            <button type="button" name="simpan" id="simpan" class="btn btn-primary">
                <i class="fa fa-save"></i> Simpan
            </button>
        </div>
    </form>
        <hr>
        <div class="data"></div>
    </div>
    
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="text-center">
                    &copy; <?php echo date('Y'); ?> Copyright: 
                    <a href="https://google.com/" target="_blank"> Desain Dan Pemrograman Web</a>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.data').load('data.php'); // Baris 75

        $.ajaxSetup({
            headers: {
                'Csrf-Token': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
    $("#simpan").click(function() {
    var data = $('#form-data').serialize();
    var jenkel1 = document.getElementById("jenkel1").checked;
    var jenkel2 = document.getElementById("jenkel2").checked;
    var nama = document.getElementById("nama").value;
    var alamat = document.getElementById("alamat").value;
    var no_telp = document.getElementById("no_telp").value;

    // VALIDASI NAMA
    if (nama == "") {
        document.getElementById("err_nama").innerHTML = "Nama Harus Diisi";
    } else {
        document.getElementById("err_nama").innerHTML = "";
    }

    // VALIDASI ALAMAT
    if (alamat == "") {
        document.getElementById("err_alamat").innerHTML = "Alamat Harus Diisi";
    } else {
        document.getElementById("err_alamat").innerHTML = "";
    }

    // VALIDASI JENIS KELAMIN
    if (document.getElementById("jenkel1").checked == false && document.getElementById("jenkel2").checked == false) {
        document.getElementById("err_jenis_kelamin").innerHTML = "Jenis Kelamin Harus Dipilih";
    } else {
        document.getElementById("err_jenis_kelamin").innerHTML = "";
    }

    // VALIDASI NO TELEPON
    if (no_telp == "") {
        document.getElementById("err_no_telp").innerHTML = "No Telepon Harus Diisi";
    } else {
        document.getElementById("err_no_telp").innerHTML = "";
    }

    // CEK SEMUA FIELD SUDAH TERISI UNTUK AJAX SUBMIT
    if (nama !== "" && alamat !== "" && (document.getElementById("jenkel1").checked == true || document.getElementById("jenkel2").checked == true) && no_telp !== "") {
        
        // PANGGIL AJAX
        $.ajax({
            type: 'POST',
            url: 'form_action.php',
            data: data,
            success: function(data) {
                // Setelah sukses:
                $('.data').load('data.php'); // 1. Muat ulang tabel data
                document.getElementById("id").value = ""; // 2. Reset ID tersembunyi
                document.getElementById("form-data").reset(); // 3. Reset semua field formulir
            },
            error: function(response) {
                console.log(response.responseText);
            }
        });
    }
});
</script>
</body>
</html>