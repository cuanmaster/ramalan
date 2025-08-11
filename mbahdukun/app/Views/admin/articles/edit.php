<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<h1 class="text-2xl font-bold mb-4">Edit Artikel</h1>
<form method="post" class="grid gap-3">
  <input name="title" value="<?= esc($article['title']) ?>" class="px-3 py-2 rounded border border-slate-300 dark:border-slate-700" placeholder="Judul" required>
  <input name="meta_description" value="<?= esc($article['meta_description']) ?>" class="px-3 py-2 rounded border border-slate-300 dark:border-slate-700" placeholder="Meta description">
  <textarea name="content" rows="12" class="px-3 py-2 rounded border border-slate-300 dark:border-slate-700" placeholder="Konten" required><?= esc($article['content']) ?></textarea>
  <div>
    <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded">Simpan</button>
    <a href="/admin/articles" class="ml-2 px-4 py-2 rounded border border-slate-300 dark:border-slate-700">Batal</a>
  </div>
</form>
<?= $this->endSection() ?>