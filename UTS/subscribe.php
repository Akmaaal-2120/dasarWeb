<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Berhasil Subscribe!</title>
    <link rel="stylesheet" href="subscribeCSS.css">
</head>
<body>
    <div class="card">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = htmlspecialchars($_POST["name"]);
            $email = htmlspecialchars($_POST["email"]);

            setcookie("name", $name, time() + 3600, "/");
            setcookie("email", $email, time() + 3600, "/");

            echo "<h2>Berhasil Subscribe!</h2>";
            echo "<p>Terima Kasih, <strong>$name</strong>, sudah Subscribe.</p>";
            echo "<p>Email kami <strong>$email</strong> telah tersimpan.</p>";
            echo "<a href='check_subscribe.php?subscribe=berhasil!'>Lihat Status Subscribe</a>";
        }
        ?>
    </div>
</body>
</html>
