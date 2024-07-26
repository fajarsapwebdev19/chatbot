<?php
header('Content-Type: text/plain');

// Informasi toko kue tunggal
$store = [
    'name' => 'Toko Kue Manis A',
    'address' => 'Jalan Manis No.1, Jakarta',
    'hours' => '08:00 - 20:00',
    'contact' => 'Silahkan klik tautan berikut untuk menghubungi kami <a href="">Hubungi Kami</a>',
    'menu' => 'Kue Cokelat, Kue Keju, Kue Vanilla',
    'prices' => 'Kue Cokelat: Rp. 50.000, Kue Keju: Rp. 60.000, Kue Vanilla: Rp. 45.000'
];

$response = '';

// Daftar kata kunci dan sinonim
$keywords = [
    'nanya' => ['nanya', 'bertanya', 'mau nanya', 'ingin nanya'],
    'hallo' => ['start','mulai','selamat pagi', 'selamat siang', 'selamat malam', 'test', 'hallo', 'hello'],
    'menu' => ['menu', 'daftar kue', 'jenis kue', 'pilihan kue', 'daftar menu', 'menu kue'],
    'harga' => ['harga', 'biaya', 'tarif', 'harga kue', 'harga menu', 'biaya kue'],
    'jam buka' => ['jam buka', 'waktu buka', 'jam operasional', 'jam kerja', 'waktu operasional', 'jam toko'],
    'alamat' => ['alamat', 'lokasi', 'tempat', 'alamat toko', 'alamat kue', 'lokasi toko'],
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
            if (strpos($message, $synonym) !== false) {
                return $key;
            }
        }
    }
    return null;
}

// Ambil pesan dari permintaan POST
if (isset($_POST['message'])) {
    $message = strtolower(trim($_POST['message']));

    // Identifikasi jenis pertanyaan
    $keyword = matchKeyword($message, $keywords);

    if ($keyword) {
        switch ($keyword) {
            case 'menu':
                $response = 'Menu kue di ' . $store['name'] . ' adalah: ' . $store['menu'] . '.';
                break;
            case 'harga':
                $response = 'Harga kue di ' . $store['name'] . ' adalah: ' . $store['prices'] . '.';
                break;
            case 'jam buka':
                $response = 'Jam buka ' . $store['name'] . ' adalah dari pukul ' . $store['hours'] . '.';
                break;
            case 'alamat':
                $response = 'Alamat ' . $store['name'] . ' adalah ' . $store['address'] . '.';
                break;
            case 'kontak':
                $response = 'Untuk info lengkap dari ' . $store['name'] . ' Anda dapat menghungi kami. ' . $store['contact'] . '.';
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
            case 'nanya':
                $response = 'Silakan masukan pertanyaan anda.';
                break;
            case 'hallo';
                $response = 'Hallo, Selamat Datang Di Chatbot Toko A, ada yang bisa dibantu';
                break;
            default:
                $response = 'Pertanyaan tidak dikenali. Coba tanyakan tentang menu, harga, jam buka, alamat, atau kontak ' . $store['name'] . '.';
                break;
        }
    } else {
        $response = 'Maaf, pertanyaan Anda tidak dikenali. Silakan tanyakan tentang menu, harga, jam buka, alamat, atau kontak.';
    }
} else {
    $response = 'Maaf, data tidak lengkap.';
}

echo $response;
?>
