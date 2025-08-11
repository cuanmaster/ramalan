<!DOCTYPE html>
<html lang="id" class="h-full" x-data="{dark: localStorage.getItem('dark') === '1'}" x-bind:class="{ 'dark': dark }" x-init="$watch('dark', v=> localStorage.setItem('dark', v? '1':'0'))">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= esc($title ?? 'Mbah Dukun') ?></title>
  <meta name="description" content="<?= esc($meta_description ?? 'Ramalan & konsultasi oleh Ahli Spiritual Profesional') ?>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <style>
    .magic-gradient{background:radial-gradient(ellipse at top, rgba(99,102,241,.15), transparent), radial-gradient(ellipse at bottom, rgba(236,72,153,.15), transparent)}
  </style>
</head>
<body class="h-full bg-white text-slate-800 dark:bg-slate-950 dark:text-slate-100">
  <header class="magic-gradient sticky top-0 z-40 border-b border-slate-200/50 dark:border-slate-800/50 backdrop-blur bg-white/70 dark:bg-slate-950/50">
    <div class="max-w-6xl mx-auto px-4 py-3 flex items-center justify-between">
      <a href="/" class="flex items-center gap-3">
        <svg width="36" height="36" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-indigo-500">
          <path d="M12 2l3 6 6 .5-4.5 4 1.5 6L12 16l-6 2.5 1.5-6L3 8.5 9 8l3-6z" fill="currentColor"/>
        </svg>
        <span class="font-bold text-xl">Mbah Dukun</span>
      </a>
      <nav class="flex items-center gap-5 text-sm">
        <a href="/blog" class="hover:text-indigo-500">Artikel</a>
        <a href="/faq" class="hover:text-indigo-500">FAQ</a>
        <a href="/tentang-kami" class="hover:text-indigo-500">Tentang</a>
        <a href="/privacy-policy" class="hover:text-indigo-500">Privasi</a>
        <button class="ml-2 px-3 py-1 rounded border border-slate-300 dark:border-slate-700" @click="dark=!dark">Mode <span x-text="dark? 'Terang':'Gelap'"></span></button>
      </nav>
    </div>
  </header>

  <main class="max-w-6xl mx-auto px-4 py-8">
    <?= $this->renderSection('content') ?>
  </main>

  <footer class="border-t border-slate-200/50 dark:border-slate-800/50 py-10">
    <div class="max-w-6xl mx-auto px-4 grid md:grid-cols-3 gap-6 text-sm">
      <div>
        <div class="flex items-center gap-2 mb-2">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" class="text-pink-500"><circle cx="12" cy="12" r="10"/></svg>
          <span class="font-semibold">Mbah Dukun</span>
        </div>
        <p>Ramalan & konsultasi oleh Ahli Spiritual Profesional.</p>
      </div>
      <div>
        <div class="font-semibold mb-2">Navigasi</div>
        <ul class="space-y-1">
          <li><a class="hover:text-indigo-500" href="/">Beranda</a></li>
          <li><a class="hover:text-indigo-500" href="/blog">Artikel</a></li>
          <li><a class="hover:text-indigo-500" href="/tentang-kami">Tentang Kami</a></li>
          <li><a class="hover:text-indigo-500" href="/privacy-policy">Privasi</a></li>
          <li><a class="hover:text-indigo-500" href="/sitemap.xml">Sitemap</a></li>
        </ul>
      </div>
      <div>
        <div class="font-semibold mb-2">Kontak</div>
        <p>Email: support@mbahdukun.web.id</p>
      </div>
    </div>
    <div class="text-center text-xs mt-8 opacity-70">&copy; <?= date('Y') ?> Mbah Dukun. Semua hak cipta dilindungi.</div>
  </footer>
</body>
</html>