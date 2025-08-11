# Mbah Dukun (CodeIgniter 4)

Website ramalan jodoh (horoskop + primbon Jawa), tarot, dan konsultasi. Pembayaran Tripay QRIS. Hasil dapat diunduh PDF dan dikirim email via SMTP iCloud. Hasil disusun oleh Ahli Spiritual Profesional.

## Fitur
- Order: Jodoh, Tarot, Konsultasi
- Pembayaran: Tripay QRIS (callback otomatis)
- Proses hasil: Gemini (konfigurasi kunci di admin)
- Hasil: Halaman hasil, unduh PDF, kirim email otomatis
- Admin: Login, atur harga, atur API/SMTP, artikel/blog, testimonial
- SEO: Sitemap otomatis, blog, robots.txt
- UI: Tailwind + Alpine (Dark/Light), responsif

## Instalasi
1. PHP 8.1+, ekstensi: curl, json, mbstring, xml, zip
2. Composer
3. Clone/unggah project, lalu:

```bash
composer install
cp .env .env.local # atau sesuaikan
```

4. Konfigurasi database di `.env`, buat database, jalankan migrasi:

```bash
php spark migrate --all
```

5. Set kunci enkripsi:
```bash
php spark key:generate
```

6. Atur virtual host ke folder `public/` dan pastikan `.htaccess` aktif.

## Konfigurasi Penting
- Admin
  - `.env`: `admin.email`, `admin.passwordHash`
  - Buat hash: `php -r "echo password_hash('PASSWORD_ADMIN', PASSWORD_BCRYPT), PHP_EOL;"`
- Tripay: isi di Admin > Pengaturan (atau `.env`)
- Gemini: isi di Admin > Pengaturan (atau `.env`)
- SMTP iCloud: isi di Admin > Pengaturan (SMTP user dan app-specific password)

## Alur Pembayaran
- Order membuat transaksi Tripay (channel QRIS), menampilkan QR code
- Tripay mengirim callback ke `/payment/callback` (signature diverifikasi)
- Jika status PAID, hasil diproses dan dikirim email otomatis
- Pengguna melihat animasi menunggu di `/order/waiting/{ref}` lalu diarahkan ke hasil

## Keamanan
- Validasi input server-side
- CSRF global, callback Tripay dikecualikan
- Verifikasi signature HMAC callback
- Headers keamanan di `public/.htaccess`

## SEO
- Sitemap: `/sitemap.xml`
- Robots: `/robots.txt`

## Script build CSS (opsional)
Tailwind via CDN sudah siap. Untuk produksi, disarankan bundling mandiri.

## Lisensi
Proprietary.