<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="flex items-center justify-between mb-4">
  <h1 class="text-2xl font-bold">Testimonial</h1>
  <a class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded" href="/admin/testimonials/create">Tambah</a>
</div>
<table class="w-full text-sm rounded border border-slate-200 dark:border-slate-800">
  <thead><tr class="bg-slate-50 dark:bg-slate-900/50"><th class="p-2 text-left">Nama</th><th class="p-2 text-left">Pesan</th><th class="p-2">Aksi</th></tr></thead>
  <tbody>
  <?php foreach($items as $i): ?>
    <tr class="border-t border-slate-200/50 dark:border-slate-800/50">
      <td class="p-2"><?= esc($i['name']) ?></td>
      <td class="p-2"><?= esc($i['message']) ?></td>
      <td class="p-2 text-right"><a class="px-2 py-1 rounded border border-red-300 text-red-600" href="/admin/testimonials/delete/<?= esc($i['id']) ?>" onclick="return confirm('Hapus?')">Hapus</a></td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
<?= $this->endSection() ?>