# 🛒KastaR (Kasir Pintar)

Projek ini adalah sebuah aplikasi kasir pintar yang dibuat untuk Uji Kompetensi Rekayasa Perangkat Lunak di SMK.

## 📃Fitur

- Custom Dashboard (Kasir, Admin)
- Pendaftaran Pengguna
- Laporan Penjualan
- Laporan Pendapatan
- Pembelian Produk (Pengeluaran)
- Penjualan Produk
- Manajemen Kategori
- Manajemen Produk
- Manajemen (Admin, Kasir, Member)
- Cetak Barcode Produk
- Cetak Nota Transaksi (Besar/Kecil)
- Cetak QRCODE Member
- Setting Toko
- Notifikasi

## 🌐Teknologi yang Digunakan

- HTML
- CSS (Bootstrap)
- JavaScript (JQuery, Notyf)
- PHP (Laravel)
- MySQL (Database)
- Laravel Breeze (Auth)
- Dompdf (Cetak PDF)
- ChartJS (Grafik)
- Barryvdh/laravel-dompdf (PDF Laravel Wrapper)
- Milon/Barcode (Cetak Barcode)

## 📩Cara Instalasi

1. Clone repositori ini:
    ```bash
    git clone https://github.com/damarsk/kasir-pintar
    ```
2. Pindah ke direktori proyek:
    ```bash
    cd kasir-pintar
    ```
3. Jalankan perintah berikut untuk menginstal dependensi:
    ```bash
    composer install
    ```
4. Salin file `.env.example` menjadi `.env` dan konfigurasi koneksi database di file `.env`.
5. Jalankan perintah berikut untuk membuat kunci aplikasi:
    ```bash
    php artisan key:generate
    ```
6. Migrasi dan seed database:
    ```bash
    php artisan migrate --seed
    ```
7. Jalankan aplikasi di server lokal Anda:
    ```bash
    php artisan serve
    ```

## 🤝Kontribusi

Jika Anda ingin berkontribusi pada proyek ini, silakan fork repositori ini dan buat pull request dengan perubahan Anda.

## 📞Kontak

Jika Anda memiliki pertanyaan atau saran, silakan hubungi saya di [damarsyahada12@gmail.com](mailto:damarsyahada12@gmail.com).
