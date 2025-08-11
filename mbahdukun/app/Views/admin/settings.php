<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<h1 class="text-2xl font-bold mb-4">Pengaturan</h1>
<?php if(session('success')): ?><div class="text-emerald-600 text-sm mb-3"><?= session('success') ?></div><?php endif; ?>
<form method="post" class="grid md:grid-cols-2 gap-6">
  <div class="p-4 rounded border border-slate-200 dark:border-slate-800">
    <h2 class="font-semibold mb-3">API</h2>
    <label class="block text-sm mb-1">Gemini API Key</label>
    <input name="gemini_api_key" value="<?= esc($settings['gemini_api_key'] ?? '') ?>" class="w-full mb-3 px-3 py-2 rounded border border-slate-300 dark:border-slate-700">
    <label class="block text-sm mb-1">Gemini Model</label>
    <input name="gemini_model" value="<?= esc($settings['gemini_model'] ?? 'gemini-2.0-flash-exp') ?>" class="w-full mb-3 px-3 py-2 rounded border border-slate-300 dark:border-slate-700">
    <label class="block text-sm mb-1">Tripay API Key</label>
    <input name="tripay_api_key" value="<?= esc($settings['tripay_api_key'] ?? '') ?>" class="w-full mb-3 px-3 py-2 rounded border border-slate-300 dark:border-slate-700">
    <label class="block text-sm mb-1">Tripay Merchant Code</label>
    <input name="tripay_merchant_code" value="<?= esc($settings['tripay_merchant_code'] ?? '') ?>" class="w-full mb-3 px-3 py-2 rounded border border-slate-300 dark:border-slate-700">
    <label class="block text-sm mb-1">Tripay Private Key</label>
    <input name="tripay_private_key" value="<?= esc($settings['tripay_private_key'] ?? '') ?>" class="w-full px-3 py-2 rounded border border-slate-300 dark:border-slate-700">
  </div>
  <div class="p-4 rounded border border-slate-200 dark:border-slate-800">
    <h2 class="font-semibold mb-3">SMTP iCloud</h2>
    <label class="block text-sm mb-1">SMTP User (Apple ID email)</label>
    <input name="smtp_user" value="<?= esc($settings['smtp_user'] ?? '') ?>" class="w-full mb-3 px-3 py-2 rounded border border-slate-300 dark:border-slate-700">
    <label class="block text-sm mb-1">SMTP App-Specific Password</label>
    <input name="smtp_pass" value="<?= esc($settings['smtp_pass'] ?? '') ?>" class="w-full px-3 py-2 rounded border border-slate-300 dark:border-slate-700">
    <p class="text-xs opacity-70 mt-2">Gunakan app-specific password dari Apple ID.</p>
  </div>
  <div class="md:col-span-2 text-right">
    <button class="px-4 py-2 rounded bg-indigo-600 text-white">Simpan</button>
  </div>
</form>
<?= $this->endSection() ?>