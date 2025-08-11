<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<h1 class="text-2xl font-bold mb-4">Artikel</h1>
<div class="space-y-4">
  <?php foreach($articles as $a): ?>
    <article class="p-4 rounded border border-slate-200 dark:border-slate-800">
      <a class="text-xl font-semibold hover:text-indigo-600" href="/blog/<?= esc($a['slug']) ?>"><?= esc($a['title']) ?></a>
      <p class="text-sm opacity-80 mt-1"><?= esc($a['meta_description'] ?? '') ?></p>
    </article>
  <?php endforeach; ?>
</div>
<div class="mt-6">
  <?= $pager->links() ?>
</div>
<?= $this->endSection() ?>