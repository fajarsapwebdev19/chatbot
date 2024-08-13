<?php
header('Content-Type: text/plain');

// Informasi toko pakaian tunggal
$store = [
    'name' => 'Stone Street Shop',
    'hours' => '10:00 - 22:00',
];

$response = '';

// Daftar kata kunci dan sinonim
$keywords = [
    'hallo' => ['hai', 'hallo', 'test', 'mulai', 'hi'],
    'ukuran' => ['ukuran', 'cek ukuran', 'cek produk'],
    'bantuan' => ['bantuan', 'daftar pertanyaan'],
    'jam' => ['jam operasional', 'jam buka', 'jam', 'buka kapan'],
    'harga' => ['harga', 'cek harga'],
    'biaya' => ['biaya', 'biaya pengiriman'],
    'custom' => ['bisa custom', 'custom'],
    'kebijakan' => ['aturan', 'kebijakan', 'tanggung jawab'],
    'metode' => ['metode', 'payment method', 'pembayaran'],
    'pengiriman' => ['metode pengiriman', 'pengiriman', 'kurir'],
    'alamat' => ['alamat', 'dimana tokonya', 'lokasi toko', 'lokasi', 'tempat'],
    'hubungi' => ['menghubungi', 'hubungi', 'kontak', 'bicara', 'info lanjut'],
    'terima kasih' => ['makasih', 'terima kasih', 'thanks', 'thank you']
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
    return 'Silahkan ketik bantuan, untuk mengetahui detail pertanyaan apa saja yang bisa di tanya ke bot kami, Terima kasih';
}

// Ambil pesan dari permintaan POST
if (isset($_POST['message'])) {
    $message = strtolower(trim($_POST['message']));

    // Identifikasi jenis pertanyaan
    $keyword = matchKeyword($message, $keywords);

    if ($keyword) {
        switch ($keyword) {
            case 'bantuan':
                $response = '
                Berikut daftar perintah yang bisa di gunakan di chatbot :
                <ul>
                    <li>Ukuran : untuk mengetahui ukuran apa saja yang tersedia di toko kami</li>
                    <li>Kebijakan : untuk mengetahui aturan yang ada di toko kami</li>
                    <li>Metode : untuk mengetahui metode pembayaran apa saja yang bisa digunakan oleh toko kami</li>
                    <li>Pengiriman : untuk mengetahui layanan pengiriman apa saja yang ada di toko kami</li>
                    <li>Jam buka : untuk mengetahui jam operasional toko kami</li>
                    <li>Bisa Custom : untuk mengetahui bisa atau tidaknya jika ingin custom design</li>
                    <li>Alamat : untuk mengetahui alamat toko kami</li>
                    <li>Kontak : untuk menghubungi admin toko kami</li>
                </ul>';
                break;
            case 'alamat':
                $response = 'Silahkan klik tautan <a class="link" href="https://www.google.com/maps/place/Gg.+Kosambi+1,+Buaran+Indah,+Kec.+Tangerang,+Kota+Tangerang,+Banten+15141/@-6.1843602,106.6568651,17z/data=!3m1!4b1!4m6!3m5!1s0x2e69f91e5f60301d:0x5828f5b70ce686f8!8m2!3d-6.1843602!4d106.6568651!16s%2Fg%2F11j1btf_7p?hl=id-ID&entry=ttu" target="_blank">Berikut</a> untuk mengetahui titik lokasi ' . $store['name'].'  apabila ada pertanyaan lagi ketik bantuan';
                break;
            case 'hallo':
                $response = 'Hallo, Selamat datang di toko '.$store['name'].'  apabila ada pertanyaan ketik bantuan';
                break;
            case 'metode':
                $response = 'Metode Pembayaran Di '. $store['name'] . ' Menggunakan Transfer (Bank Bca) Dan Cash (Datang ke toko), apabila ada pertanyaan lagi ketik bantuan';
                break;
            case 'pengiriman':
                $response = 'Untuk Pengiriman Di '. $store['name'] . ' Menggunakan Jasa Go Send , apabila ada pertanyaan lagi ketik bantuan';
                break;
            case 'jam':
                $response = 'Toko '.$store['name'].' Buka Dari Jam : ' . $store['hours'] . ' apabila ada pertanyaan lagi ketik bantuan';
                break;
            case 'ukuran':
                $response = 'Ukuran yang tersedia mulai dari S-XL, Untuk mengetahui harga silahkan ketik cek harga';
                break;
            case 'harga':
                $response = 'Harga mulai dari 70-110 ribu, apabila ada pertanyaan lagi ketik bantuan';
                break;
            case 'kebijakan':
                $response = 'Bila terjadi ketidaksesuaian ukuran dan penukaran ukuran, bisa langsung dateng ke toko kami dengan alamat <a class="link" href="https://www.google.com/maps/place/Gg.+Kosambi+1,+Buaran+Indah,+Kec.+Tangerang,+Kota+Tangerang,+Banten+15141/@-6.1843602,106.6568651,17z/data=!3m1!4b1!4m6!3m5!1s0x2e69f91e5f60301d:0x5828f5b70ce686f8!8m2!3d-6.1843602!4d106.6568651!16s%2Fg%2F11j1btf_7p?hl=id-ID&entry=ttu" target="_blank">Berikut</a>,  apabila ada pertanyaan lagi ketik bantuan';
                break;
            case 'biaya':
                $response = 'Untuk pengiriman dikenakan tarif sesuai dengan dekat atau jauhnya jarak tempuh, apabila ada pertanyaan lagi ketik bantuan';
                break;
            case 'custom':
                $response = 'Bisa, silahkan kirimkan gambar ke nomer whatsapp dengan klik tautan <a class="link" href="https://wa.me/6289618488456?text=saya ingin kirim gambar custom untuk baju pesanan saya" target="_blank">Di sini</a>, apabila ada pertanyaan lagi ketik bantuan';
                break;
            case 'hubungi':
                $response = 'Untuk info lebih lanjut terkait produk yang kami jual, silahkan klik tautan <a class="link" href="https://wa.me/6289618488456?text=hallo, saya ingin bertanya seputar baju" target="_blank">Berikut</a> , apabila ada pertanyaan lagi ketik bantuan';
                break;
            case 'terima kasih':
                $response = 'Sama-sama, terima kasih sudah menghubungi chat bot kami, mohon maaf apabila ada kesalahan dari chat bot di '. $store['name']. ' Apabila ada pertanyaan lagi silahkan ketik bantuan untuk mengetahui list pertanyaan';
                break;
        }
    } else {
        $response = 'Maaf, pertanyaan anda tidak di kenali oleh bot kami. ' . provideGuidance();
    }
}

echo $response;
?>
