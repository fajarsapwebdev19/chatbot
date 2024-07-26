<?php
header('Content-Type: text/plain');

// Informasi toko pakaian tunggal
$store = [
    'name' => 'Fashion Avenue',
    'address' => 'Jalan Fesyen No.1, Jakarta',
    'hours' => '10:00 - 22:00',
    'contact' => 'Silahkan klik tautan <a href="">Disini</a> Untuk terhubung dengan admin kami, untuk info lebih lanjut',
    'products' => [
        'Kaos Polos' => [
            'sizes' => [
                'S' => 'Rp. 100.000',
                'M' => 'Rp. 105.000',
                'L' => 'Rp. 110.000',
                'XL' => 'Rp. 115.000'
            ]
        ],
        'Celana Jeans' => [
            'sizes' => [
                '28' => 'Rp. 250.000',
                '30' => 'Rp. 260.000',
                '32' => 'Rp. 270.000',
                '34' => 'Rp. 280.000'
            ]
        ],
        'Jaket Kulit' => [
            'sizes' => [
                'M' => 'Rp. 500.000',
                'L' => 'Rp. 520.000',
                'XL' => 'Rp. 540.000'
            ]
        ]
    ]
];

$response = '';

// Daftar kata kunci dan sinonim
$keywords = [
    'nanya' => ['nanya', 'bertanya', 'mau nanya', 'ingin nanya'],
    'hallo' => ['start', 'mulai', 'selamat pagi', 'selamat siang', 'selamat malam', 'test', 'hallo', 'hello'],
    'produk' => ['produk', 'daftar produk', 'jenis pakaian', 'pilihan produk', 'daftar produk', 'menu produk'],
    'harga' => ['harga', 'biaya', 'tarif', 'harga pakaian', 'harga produk', 'biaya produk'],
    'jam buka' => ['jam buka', 'waktu buka', 'jam operasional', 'jam kerja', 'waktu operasional', 'jam toko'],
    'alamat' => ['alamat', 'lokasi', 'tempat', 'alamat toko', 'alamat pakaian', 'lokasi toko'],
    'kontak' => ['kontak', 'hubungi', 'terhubung', 'cara menghubungi', 'informasi kontak'],
    'buka' => ['buka', 'beroperasi', 'operasional', 'waktu operasional'],
    'metode' => ['pembayaran', 'metode', 'payment', 'bayar'],
    'pengiriman' => ['kirim', 'pengiriman', 'cek kirim', 'kurir'],
    'kaos polos' => ['kaos polos', 'kaos', 't-shirt', 'kaos'],
    'celana jeans' => ['celana jeans', 'jeans', 'celana'],
    'jaket kulit' => ['jaket kulit', 'jaket', 'jaket kulit']
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

// Fungsi untuk memberikan petunjuk umum
function provideGuidance() {
    return 'silahkan ketik produk, jam buka, kontak, alamat';
}

// Ambil pesan dari permintaan POST
if (isset($_POST['message'])) {
    $message = strtolower(trim($_POST['message']));

    // Identifikasi jenis pertanyaan
    $keyword = matchKeyword($message, $keywords);

    if ($keyword) {
        switch ($keyword) {
            case 'produk':
                $response = 'Produk di ' . $store['name'] . ' adalah: ' . implode(', ', array_keys($store['products'])) . '. Silahkan ketik salah satu dari produk kami nanti akan muncul list harga beserta ukuran dari produk kami.';
                break;
            case 'harga':
                $response = 'Produk di ' . $store['name'] . ' adalah: ' . implode(', ', array_keys($store['products'])) . '. Silahkan ketik salah satu dari produk kami nanti akan muncul list harga beserta ukuran dari produk kami.';
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
            case 'metode':
                $response = 'Toko kami melayani pembayaran via transfer dan tunai';
                break;
            case 'pengiriman':
                $response = 'Toko kami menggunakan jasa pengiriman : JNE, JNT, Sicepat, Anter aja, Shoppe Express';
                break;
            case 'kaos polos':
            case 'celana jeans':
            case 'jaket kulit':
                // Menyaring keyword untuk produk tertentu
                $productMap = [
                    'kaos polos' => 'Kaos Polos',
                    'celana jeans' => 'Celana Jeans',
                    'jaket kulit' => 'Jaket Kulit'
                ];
                
                $productName = isset($productMap[$keyword]) ? $productMap[$keyword] : null;

                if ($productName && isset($store['products'][$productName])) {
                    $sizes = $store['products'][$productName]['sizes'];
                    $response = 'Harga untuk ' . $productName . ' berdasarkan ukuran adalah : <br>';
                    foreach ($sizes as $size => $price) {
                        $response .= '  Ukuran ' . $size . ' : ' . $price . '<br>';
                    }

                    $response .= 'Jika ingin bertanya lebih lanjut silahkan ketik kontak';
                } else {
                    $response = 'Produk tidak ditemukan.';
                }
                break;
            case 'nanya':
                $response = 'Silakan masukan pertanyaan, cek produk.';
                break;
            case 'hallo':
                $response = 'Hallo, Selamat Datang Di Chatbot Toko Pakaian, ada yang bisa dibantu';
                break;
            default:
                $response = 'Pertanyaan tidak dikenali. Coba tanyakan tentang produk, jam buka, alamat, atau kontak ' . $store['name'] . '.';
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
