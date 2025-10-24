<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Check Subscription Status</title>
    <link rel="stylesheet" href="checkSubscribe.css">
</head>
<body>
    <div class="container">
        <h2>Check Subscription Status</h2>
        <?php
        if (isset($_COOKIE["email"])) {
            echo "<p>Kamu Telah Subscribe!</p>";
            echo "<p><strong>Name:</strong> " . htmlspecialchars($_COOKIE["name"]) . "</p>";
            echo "<p><strong>Email:</strong> " . htmlspecialchars($_COOKIE["email"]) . "</p>";
            echo "<a href='index.html' class='button'>Kembali ke Halaman Subscribe</a>";
        } else {
            echo "<p>Kamu Belum Subscribe.</p>";
            echo "<a href='index.html' class='button'>Subscribe Sekarang!</a>";
        }
        ?>
    </div>
</body>
</html>
