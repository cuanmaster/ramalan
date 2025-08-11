<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<h1 class="text-2xl font-bold mb-4">Tambah Testimonial</h1>
<form method="post" class="grid gap-3 max-w-md">
  <input name="name" class="px-3 py-2 rounded border border-slate-300 dark:border-slate-700" placeholder="Nama" required>
  <input name="message" class="px-3 py-2 rounded border border-slate-300 dark:border-slate-700" placeholder="Pesan" required>
  <div>
    <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded">Simpan</button>
    <a href="/admin/testimonials" class="ml-2 px-4 py-2 rounded border border-slate-300 dark:border-slate-700">Batal</a>
  </div>
</form>
<?= $this->endSection() ?>