<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<article class="prose prose-slate dark:prose-invert max-w-none">
  <h1><?= esc($article['title']) ?></h1>
  <div><?= $article['content'] ?></div>
</article>
<?= $this->endSection() ?>