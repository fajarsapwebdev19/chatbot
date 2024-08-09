<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chat Bot</title>
    <link href="assets/css/bootstrap.min.css?v=<?= mt_rand() ?>" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/all.min.css?v=<?= mt_rand() ?>">
    <link rel="stylesheet" href="assets/css/style.css?v=<?= mt_rand() ?>">

    <style>
        .link {
            color: #eaeaea !important;
        }
    </style>
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
    <script src="assets/js/jquery-3.7.1.slim.min.js?v=<?= mt_rand() ?>"></script>
    <script src="assets/js/bootstrap.bundle.min.js?v=<?= mt_rand() ?>"></script>
    <script src="assets/js/main.js?v=<?= mt_rand() ?>"></script>
</body>

</html>