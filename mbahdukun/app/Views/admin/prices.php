<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<h1 class="text-2xl font-bold mb-4">Harga Layanan</h1>
<?php if(session('success')): ?><div class="text-emerald-600 text-sm mb-3"><?= session('success') ?></div><?php endif; ?>
<form method="post" class="grid gap-4 max-w-md">
  <label class="block">
    <span class="text-sm">Jodoh</span>
    <input name="jodoh" value="<?= esc($prices['jodoh']) ?>" class="w-full px-3 py-2 rounded border border-slate-300 dark:border-slate-700">
  </label>
  <label class="block">
    <span class="text-sm">Tarot</span>
    <input name="tarot" value="<?= esc($prices['tarot']) ?>" class="w-full px-3 py-2 rounded border border-slate-300 dark:border-slate-700">
  </label>
  <label class="block">
    <span class="text-sm">Konsultasi</span>
    <input name="konsultasi" value="<?= esc($prices['konsultasi']) ?>" class="w-full px-3 py-2 rounded border border-slate-300 dark:border-slate-700">
  </label>
  <div><button class="px-4 py-2 rounded bg-indigo-600 text-white">Simpan</button></div>
</form>
<?= $this->endSection() ?>