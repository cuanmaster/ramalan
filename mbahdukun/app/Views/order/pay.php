<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<h1 class="text-2xl font-bold mb-4">Pembayaran</h1>
<div class="grid md:grid-cols-2 gap-8">
  <div class="p-5 rounded border border-slate-200 dark:border-slate-800">
    <h2 class="font-semibold mb-2">Detail Pesanan</h2>
    <ul class="text-sm space-y-1">
      <li>Ref: <span class="font-mono"><?= esc($order['reference']) ?></span></li>
      <li>Layanan: <?= esc(ucfirst($order['service'])) ?></li>
      <li>Jumlah: Rp <?= number_format($order['amount'],0,',','.') ?></li>
      <li>Status: <span class="font-semibold"><?= esc($order['status']) ?></span></li>
    </ul>
  </div>
  <div class="p-5 rounded border border-slate-200 dark:border-slate-800">
    <h2 class="font-semibold mb-3">Bayar via QRIS</h2>
    <?php if(!empty($order['payment_qr_url'])): ?>
      <img src="<?= esc($order['payment_qr_url']) ?>" alt="QRIS" class="w-64 h-64 object-contain"/>
    <?php else: ?>
      <p>Silakan buka tautan pembayaran berikut:</p>
      <a class="text-indigo-600 underline" href="<?= esc($order['payment_url']) ?>" target="_blank" rel="noopener">Buka Halaman Pembayaran</a>
    <?php endif; ?>
    <ol class="list-decimal pl-5 text-sm mt-4 space-y-1 opacity-90">
      <li>Buka aplikasi pembayaran yang mendukung QRIS</li>
      <li>Pindai QR di atas atau unggah gambar QR</li>
      <li>Periksa nominal dan konfirmasi pembayaran</li>
      <li>Tunggu hingga status berhasil, lalu klik tombol di bawah</li>
    </ol>
    <a href="/order/waiting/<?= esc($order['reference']) ?>" class="inline-block mt-4 bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded">Saya Sudah Bayar</a>
  </div>
</div>
<?= $this->endSection() ?>