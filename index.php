<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Selamat Datang di UMKM Kota Tangerang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
    <?php require 'nav.php' ?>
    <div class="container mt-4 mb-4">
        <?php
            // Ambil parameter 'page' dari URL
            $page = isset($_GET['page']) ? $_GET['page'] : 'home';
    
            // Tentukan file yang akan dimuat
            $file = 'view/' . $page . '.php';
    
            // Periksa apakah file ada dan kemudian termasuk file tersebut
            if (file_exists($file)) {
                require($file);
            } else {
                echo '<h1>Halaman Tidak Ditemukan</h1>';
                echo '<p>Maaf, halaman yang Anda cari tidak ditemukan.</p>';
            }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>