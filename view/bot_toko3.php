<div class="chat-container">
    <h4 class="text-left mb-4"><a href="?page=kontak"><em class="fas fa-arrow-left"></em></a> Warung Juriah</h4>
    <div id="chat-box" class="chat-box mb-4">
        <!-- Pesan chat akan ditampilkan di sini -->
    </div>
    <div id="welcome-message">
        Selamat datang di layanan chatbot Warung Juriah! Silakan ketikkan pertanyaan berikut : <br>.
        <ul>
            <li>Produk : untuk mengetahui produk apa saja yang tersedia di toko kami</li>
            <li>Metode : untuk mengetahui metode pembayaran apa saja yang bisa digunakan oleh toko kami</li>
            <li>Pengiriman : untuk mengetahui layanan pengiriman apa saja yang ada di toko kami</li>
            <li>Jam buka : untuk mengetahui jam operasional toko kami</li>
            <li>Alamat : untuk mengetahui alamat toko kami</li>
            <li>Kontak : untuk menghubungi admin toko kami</li>
        </ul>
    </div>
    <form id="chat-form" autocomplete="off">
        <input type="hidden" class="chat_control" value="3">
        <input type="text" id="user-input" class="form-control" placeholder="Ketikkan pertanyaan Anda..." required>
        <button type="submit" class="btn btn-primary">Kirim</button>
    </form>
</div>