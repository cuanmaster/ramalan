<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="text-center">
  <h1 class="text-2xl font-bold mb-2">Memproses Ramalan Anda</h1>
  <p class="opacity-80 mb-6">Mohon tunggu sebentar. Pembayaran Anda akan diverifikasi dan hasil sedang dipersiapkan oleh Ahli Spiritual Profesional.</p>
  <div class="mx-auto w-24 h-24 border-4 border-indigo-400 border-t-transparent rounded-full animate-spin"></div>
  <p class="text-sm mt-4">Ref: <span class="font-mono"><?= esc($order['reference']) ?></span></p>
</div>
<script>
async function poll(){
  const res = await fetch('/order/status/<?= esc($order['reference']) ?>');
  const json = await res.json();
  if(json.status === 'PAID'){
    window.location.href = '/order/result/<?= esc($order['reference']) ?>';
  } else {
    setTimeout(poll, 3000);
  }
}
poll();
</script>
<?= $this->endSection() ?>