<!DOCTYPE html>
<html>
<head>
    <title>Form Input dengan Validasi AJAX</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

    <h1>Form Input dengan Validasi AJAX</h1>
    <form id="validasiForm" method="post" action="proses_validasi.php">
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama">
        <span id="nama-error" style="color: red;"></span><br>
        <br>

        <label for="email">Email:</label>
        <input type="text" id="email" name="email">
        <span id="email-error" style="color: red;"></span><br>
        <br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password">
        <span id="password-error" style="color: red;"></span><br>
        <br>

        <input type="submit" value="Submit">
    </form>
    
    <div id="hasil-server">
    </div>

    <script>
    $(document).ready(function() {
        $("#validasiForm").submit(function(e) {
            e.preventDefault(); 
            
            // Ambil nilai input
            var nama = $("#nama").val();
            var email = $("#email").val();
            var password = $("#password").val(); // Ambil nilai password
            var valid = true;
            
            // RESET ERROR MESSAGES
            $("#nama-error").text("");
            $("#email-error").text("");
            $("#password-error").text(""); // Reset error password

            // Validasi Nama
            if (nama === "") {
                $("#nama-error").text("Nama harus diisi.");
                valid = false;
            } 

            // Validasi Email (Hanya cek kosong di sini untuk kesederhanaan)
            if (email === "") {
                $("#email-error").text("Email harus diisi.");
                valid = false;
            } 
            
            // Validasi Password (Minimal 8 Karakter)
            if (password === "") {
                $("#password-error").text("Password harus diisi.");
                valid = false;
            } else if (password.length < 8) {
                $("#password-error").text("Password minimal 8 karakter.");
                valid = false;
            }

            // Jika validasi klien berhasil, kirim data via AJAX
            if (valid) {
                var formData = $(this).serialize();

                $.ajax({
                    type: "POST",
                    url: "proses_validasi.php",
                    data: formData,
                    success: function(response) {
                        $("#hasil-server").html(response);
                    }
                });
            }
        });
    });
    </script>

</body>
</html>
