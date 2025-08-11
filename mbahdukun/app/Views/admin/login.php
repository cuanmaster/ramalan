<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="max-w-sm mx-auto p-6 rounded border border-slate-200 dark:border-slate-800">
  <h1 class="text-xl font-semibold mb-4">Admin Login</h1>
  <?php if(session('error')): ?><div class="text-red-600 text-sm mb-2"><?= session('error') ?></div><?php endif; ?>
  <form method="post">
    <input name="email" type="email" class="w-full mb-3 px-3 py-2 rounded border border-slate-300 dark:border-slate-700" placeholder="Email" required>
    <input name="password" type="password" class="w-full mb-4 px-3 py-2 rounded border border-slate-300 dark:border-slate-700" placeholder="Password" required>
    <button class="w-full bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded">Masuk</button>
  </form>
</div>
<?= $this->endSection() ?>