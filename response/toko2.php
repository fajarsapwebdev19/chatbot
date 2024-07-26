<?php
header('Content-Type: text/plain');

// Informasi toko kue
$store = [
    'name' => 'Sweet Delight Bakery',
    'address' => 'Jalan Manis No. 5, Jakarta',
    'hours' => '08:00 - 22:00',
    'contact' => 'Silahkan klik tautan <a href="">Disini</a> untuk menghubungi admin kami',
    'products' => [
        'Kue Cokelat' => 'Rp. 50.000',
        'Kue Keju' => 'Rp. 60.000',
        'Kue Vanilla' => 'Rp. 45.000',
        'Kue Red Velvet' => 'Rp. 70.000',
        'Kue Tiramisu' => 'Rp. 65.000'
    ]
];

$response = '';

// Daftar kata kunci dan sinonim
$keywords = [
    'nanya' => ['nanya', 'bertanya', 'mau nanya', 'ingin nanya'],
    'hallo' => ['start', 'mulai', 'selamat pagi', 'selamat siang', 'selamat malam', 'test', 'hallo', 'hello'],
    'produk' => ['produk', 'daftar kue', 'menu kue', 'pilihan kue', 'daftar produk'],
    'harga' => ['harga', 'biaya', 'tarif', 'harga kue', 'harga menu'],
    'jam buka' => ['jam buka', 'waktu buka', 'jam operasional', 'jam kerja', 'waktu operasional', 'jam toko'],
    'alamat' => ['alamat', 'lokasi', 'tempat', 'alamat toko', 'alamat kue'],
    'kontak' => ['kontak', 'hubungi', 'email', 'nomor kontak', 'cara menghubungi', 'informasi kontak'],
    'buka' => ['buka', 'beroperasi', 'operasional', 'waktu operasional'],
    'penawaran' => ['penawaran', 'diskon', 'promo', 'penawaran khusus', 'promosi'],
    'sedia' => ['sedia', 'tersedia', 'ada', 'stok'],
    'ketersediaan' => ['ketersediaan', 'tersedia', 'stok', 'apakah ada']
];

// Fungsi untuk mencari kata kunci
function matchKeyword($message, $keywords) {
    foreach ($keywords as $key => $synonyms) {
        foreach ($synonyms as $synonym) {
            if (stripos($message, $synonym) !== false) {
                return $key;
            }
        }
    }
    return null;
}

// Fungsi untuk membuat daftar harga produk
function listProductPrices($productDetails) {
    $response = '';
    foreach ($productDetails as $product => $price) {
        $response .= $product . ': ' . $price . '\n';
    }
    return $response;
}

// Fungsi untuk memberikan petunjuk umum
function provideGuidance() {
    return 'Untuk mendapatkan informasi harga, sebutkan nama kue yang Anda inginkan, seperti "Berapa harga Kue Cokelat?"';
}

// Ambil pesan dari permintaan POST
if (isset($_POST['message'])) {
    $message = strtolower(trim($_POST['message']));

    // Identifikasi jenis pertanyaan
    $keyword = matchKeyword($message, $keywords);

    if ($keyword) {
        switch ($keyword) {
            case 'produk':
                $response = 'Daftar kue di ' . $store['name'] . ' adalah: ' . implode(', ', array_keys($store['products'])) . '.';
                break;
            case 'harga':
                // Menyaring keyword untuk produk tertentu
                $product = array_search($message, array_map('strtolower', array_keys($store['products'])));
                if ($product && isset($store['products'][$product])) {
                    $response = 'Harga ' . $product . ' adalah ' . $store['products'][$product] . '.';
                } else {
                    $response = provideGuidance();
                }
                break;
            case 'jam buka':
                $response = 'Jam buka ' . $store['name'] . ' adalah dari pukul ' . $store['hours'] . '.';
                break;
            case 'alamat':
                $response = 'Alamat ' . $store['name'] . ' adalah ' . $store['address'] . '.';
                break;
            case 'kontak':
                $response = 'Untuk info lengkap dari ' . $store['name'] . ' Anda dapat menghubungi kami. ' . $store['contact'] . '.';
                break;
            case 'buka':
                $response = 'Toko ini buka dari pukul ' . $store['hours'] . '.';
                break;
            case 'penawaran':
                $response = 'Saat ini kami tidak memiliki penawaran khusus. Cek situs kami untuk promo terbaru.';
                break;
            case 'sedia':
                $response = 'Kami memiliki berbagai macam kue yang tersedia di toko kami. Cek menu untuk detail lebih lanjut.';
                break;
            case 'ketersediaan':
                $response = 'Semua produk dalam daftar menu kami saat ini tersedia.';
                break;
            case 'nanya':
                $response = 'Silakan masukkan pertanyaan Anda.';
                break;
            case 'hallo':
                $response = 'Hallo, Selamat Datang di Chatbot Sweet Delight Bakery. Ada yang bisa dibantu?';
                break;
            default:
                $response = 'Pertanyaan tidak dikenali. Coba tanyakan tentang produk, harga, jam buka, alamat, atau kontak ' . $store['name'] . '.';
                break;
        }
    } else {
        $response = 'Maaf, data tidak lengkap. ' . provideGuidance();
    }
} else {
    $response = 'Maaf, data tidak lengkap. ' . provideGuidance();
}

echo $response;
?>
