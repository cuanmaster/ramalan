<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<h1 class="text-2xl font-bold mb-4">Hasil Ramalan</h1>
<div class="prose prose-slate dark:prose-invert max-w-none">
  <pre class="whitespace-pre-wrap"><?= esc($result['content']) ?></pre>
</div>
<div class="mt-6 flex gap-3">
  <a class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded" href="/order/result/<?= esc($order['reference']) ?>/pdf">Unduh PDF</a>
  <form method="post" action="/order/result/<?= esc($order['reference']) ?>" onsubmit="alert('Hasil telah dikirim ke email Anda secara otomatis.'); return false;">
    <button class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded" type="submit">Kirim ke Email</button>
  </form>
</div>
<?= $this->endSection() ?>