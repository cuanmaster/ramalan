<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<h1 class="text-2xl font-bold mb-4">FAQ</h1>
<div class="space-y-3">
  <details class="p-4 rounded border border-slate-200 dark:border-slate-800">
    <summary class="font-semibold">Bagaimana cara memesan?</summary>
    <p>Isi formulir layanan di beranda, lakukan pembayaran QRIS, lalu hasil akan dikirim ke email Anda.</p>
  </details>
  <details class="p-4 rounded border border-slate-200 dark:border-slate-800">
    <summary class="font-semibold">Berapa harga layanan?</summary>
    <p>Setiap layanan saat ini Rp 5.000.</p>
  </details>
  <details class="p-4 rounded border border-slate-200 dark:border-slate-800">
    <summary class="font-semibold">Siapa yang memproses hasil?</summary>
    <p>Hasil disusun oleh Ahli Spiritual Profesional.</p>
  </details>
</div>
<?= $this->endSection() ?>