<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="grid lg:grid-cols-2 gap-10 items-start">
  <div>
    <h1 class="text-3xl font-bold mb-3">Selamat datang di Mbah Dukun</h1>
    <p class="opacity-80 mb-6">Konsultasi dan ramalan oleh Ahli Spiritual Profesional. Pilih layanan di bawah ini dan lakukan pembayaran mudah via QRIS.</p>

    <div class="grid gap-6">
      <section class="p-5 rounded-lg border border-slate-200 dark:border-slate-800">
        <h2 class="font-semibold mb-3">Ramalan Jodoh (Horoskop + Primbon Jawa)</h2>
        <form id="form-jodoh" class="grid gap-3">
          <input class="px-3 py-2 rounded border border-slate-300 dark:border-slate-700" name="name" placeholder="Nama Anda" required>
          <input class="px-3 py-2 rounded border border-slate-300 dark:border-slate-700" name="partner_name" placeholder="Nama Pasangan" required>
          <input type="email" class="px-3 py-2 rounded border border-slate-300 dark:border-slate-700" name="email" placeholder="Email" required>
          <textarea class="px-3 py-2 rounded border border-slate-300 dark:border-slate-700" name="notes" placeholder="Catatan tambahan (opsional)"></textarea>
          <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded">Pesan Rp 5.000</button>
        </form>
      </section>

      <section class="p-5 rounded-lg border border-slate-200 dark:border-slate-800">
        <h2 class="font-semibold mb-3">Tarot</h2>
        <form id="form-tarot" class="grid gap-3">
          <input class="px-3 py-2 rounded border border-slate-300 dark:border-slate-700" name="name" placeholder="Nama Anda" required>
          <input type="email" class="px-3 py-2 rounded border border-slate-300 dark:border-slate-700" name="email" placeholder="Email" required>
          <input class="px-3 py-2 rounded border border-slate-300 dark:border-slate-700" name="topic" placeholder="Topik konsultasi" required>
          <select name="depth" class="px-3 py-2 rounded border border-slate-300 dark:border-slate-700">
            <option value="umum">Umum</option>
            <option value="mendalam">Konsultasi Mendalam</option>
          </select>
          <input class="px-3 py-2 rounded border border-slate-300 dark:border-slate-700" name="cards" placeholder="Opsi kartu (opsional)">
          <button class="bg-pink-600 hover:bg-pink-700 text-white px-4 py-2 rounded">Pesan Rp 5.000</button>
        </form>
      </section>

      <section class="p-5 rounded-lg border border-slate-200 dark:border-slate-800">
        <h2 class="font-semibold mb-3">Konsultasi</h2>
        <form id="form-konsultasi" class="grid gap-3">
          <input class="px-3 py-2 rounded border border-slate-300 dark:border-slate-700" name="name" placeholder="Nama Anda" required>
          <input type="email" class="px-3 py-2 rounded border border-slate-300 dark:border-slate-700" name="email" placeholder="Email" required>
          <textarea class="px-3 py-2 rounded border border-slate-300 dark:border-slate-700" name="question" placeholder="Pertanyaan Anda" required></textarea>
          <button class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded">Pesan Rp 5.000</button>
        </form>
      </section>
    </div>
  </div>

  <div>
    <div class="p-5 rounded-lg border border-slate-200 dark:border-slate-800 mb-6">
      <h2 class="font-semibold mb-3">Testimonial</h2>
      <div class="grid gap-3">
        <?php foreach(($testimonials ?? []) as $t): ?>
        <figure class="p-4 rounded bg-slate-50 dark:bg-slate-900/50">
          <blockquote class="text-sm">“<?= esc($t['message']) ?>”</blockquote>
          <figcaption class="text-xs opacity-70 mt-1">— <?= esc($t['name']) ?></figcaption>
        </figure>
        <?php endforeach; ?>
      </div>
    </div>

    <div class="p-5 rounded-lg border border-slate-200 dark:border-slate-800">
      <h2 class="font-semibold mb-3">Artikel Terbaru</h2>
      <ul class="list-disc pl-5">
        <?php foreach(($articles ?? []) as $a): ?>
        <li><a class="hover:text-indigo-600" href="/blog/<?= esc($a['slug']) ?>"><?= esc($a['title']) ?></a></li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</div>

<script>
async function submitForm(formId, url){
  const form = document.getElementById(formId);
  form.addEventListener('submit', async (e)=>{
    e.preventDefault();
    const data = new FormData(form);
    const res = await fetch(url, { method: 'POST', body: data });
    const json = await res.json();
    if(json.redirect){ window.location.href = json.redirect; }
    else alert('Gagal memproses, coba lagi');
  });
}
submitForm('form-jodoh','/order/jodoh');
submitForm('form-tarot','/order/tarot');
submitForm('form-konsultasi','/order/konsultasi');
</script>
<?= $this->endSection() ?>