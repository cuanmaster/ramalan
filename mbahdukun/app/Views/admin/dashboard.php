<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<h1 class="text-2xl font-bold mb-4">Dashboard</h1>
<div class="mb-4 flex gap-2 text-sm">
  <a class="px-3 py-1 rounded border border-slate-300 dark:border-slate-700" href="/admin/articles">Artikel</a>
  <a class="px-3 py-1 rounded border border-slate-300 dark:border-slate-700" href="/admin/testimonials">Testimonial</a>
  <a class="px-3 py-1 rounded border border-slate-300 dark:border-slate-700" href="/admin/prices">Harga</a>
  <a class="px-3 py-1 rounded border border-slate-300 dark:border-slate-700" href="/admin/settings">Pengaturan</a>
  <a class="px-3 py-1 rounded border border-slate-300 dark:border-slate-700" href="/admin/logout">Keluar</a>
</div>
<div class="rounded border border-slate-200 dark:border-slate-800">
  <table class="w-full text-sm">
    <thead><tr class="bg-slate-50 dark:bg-slate-900/50"><th class="p-2 text-left">Ref</th><th class="p-2 text-left">Layanan</th><th class="p-2">Jumlah</th><th class="p-2">Status</th><th class="p-2">Waktu</th></tr></thead>
    <tbody>
      <?php foreach(($orders ?? []) as $o): ?>
      <tr class="border-t border-slate-200/50 dark:border-slate-800/50">
        <td class="p-2 font-mono"><?= esc($o['reference']) ?></td>
        <td class="p-2"><?= esc($o['service']) ?></td>
        <td class="p-2">Rp <?= number_format($o['amount'],0,',','.') ?></td>
        <td class="p-2"><?= esc($o['status']) ?></td>
        <td class="p-2"><?= esc($o['created_at']) ?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
<?= $this->endSection() ?>