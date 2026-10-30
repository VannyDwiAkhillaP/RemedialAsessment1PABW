/* AgriVision Garut - interaksi sisi klien */
document.addEventListener('DOMContentLoaded', () => {

  /* 1. Menu navigasi mobile */
  const toggle = document.getElementById('navToggle');
  const menu = document.getElementById('navMenu');
  if (toggle && menu) {
    toggle.addEventListener('click', () => {
      const open = menu.classList.toggle('open');
      toggle.setAttribute('aria-expanded', open);
    });
  }

  /* 2. Animasi muncul saat di-scroll */
  const reveals = document.querySelectorAll('.reveal');
  if ('IntersectionObserver' in window) {
    const io = new IntersectionObserver((entries) => {
      entries.forEach((e) => {
        if (e.isIntersecting) { e.target.classList.add('visible'); io.unobserve(e.target); }
      });
    }, { threshold: 0.12 });
    reveals.forEach((el) => io.observe(el));
  } else {
    reveals.forEach((el) => el.classList.add('visible'));
  }

  /* 3. Hitung naik (count-up) pada angka statistik */
  document.querySelectorAll('.count').forEach((el) => {
    const target = parseInt(el.dataset.count || '0', 10);
    const duration = 900;
    const start = performance.now();
    const tick = (now) => {
      const p = Math.min((now - start) / duration, 1);
      el.textContent = Math.round(target * p);
      if (p < 1) requestAnimationFrame(tick);
    };
    requestAnimationFrame(tick);
  });

  /* 4. Form deteksi: sinkron slider <-> angka + pratinjau status */
  const score = document.getElementById('confidence_score');
  const scoreRange = document.getElementById('scoreRange');
  const damage = document.getElementById('tingkat_kerusakan');
  const damageRange = document.getElementById('damageRange');

  if (score && scoreRange && damage && damageRange) {
    const statusEl = document.getElementById('previewStatus');
    const recoEl = document.getElementById('previewReco');
    const gauge = document.getElementById('gaugeFill');
    const scoreLabel = document.getElementById('previewScore');
    const damageLabel = document.getElementById('previewDamage');
    const damageFill = document.getElementById('damageFill');

    const clamp = (v) => Math.min(100, Math.max(0, isNaN(v) ? 0 : v));

    const klasifikasi = (s) => {
      if (s < 50)  return { t: 'Tidak Pasti', r: 'Perlu verifikasi manual oleh petugas', c: 'neutral', color: '#55657a' };
      if (s <= 80) return { t: 'Indikasi Hama', r: 'Lakukan pemantauan intensif', c: 'warning', color: '#c77d0a' };
      return { t: 'Hama Terkonfirmasi', r: 'Segera lakukan pengendalian hama', c: 'danger', color: '#d6453d' };
    };

    const update = () => {
      const s = clamp(parseFloat(score.value));
      const d = clamp(parseFloat(damage.value));
      const k = klasifikasi(s);
      statusEl.textContent = k.t;
      statusEl.className = 'badge badge-lg badge-' + k.c;
      recoEl.textContent = k.r;
      gauge.style.width = s + '%';
      gauge.style.background = k.color;
      scoreLabel.textContent = s;
      damageLabel.textContent = d + '%';
      damageFill.style.width = d + '%';
    };

    scoreRange.addEventListener('input', () => { score.value = scoreRange.value; update(); });
    score.addEventListener('input', () => { scoreRange.value = clamp(parseFloat(score.value)); update(); });
    damageRange.addEventListener('input', () => { damage.value = damageRange.value; update(); });
    damage.addEventListener('input', () => { damageRange.value = clamp(parseFloat(damage.value)); update(); });
    update();

    /* Validasi ringan + indikator proses saat submit */
    const form = document.getElementById('formDeteksi');
    const btn = document.getElementById('btnSubmit');
    form.addEventListener('submit', (e) => {
      if (!form.checkValidity()) {
        e.preventDefault();
        form.reportValidity();
        return;
      }
      btn.disabled = true;
      btn.textContent = '⏳ Memproses…';
    });
  }

  /* 5. Riwayat: filter pencarian + status */
  const cari = document.getElementById('filterCari');
  const status = document.getElementById('filterStatus');
  const rows = document.querySelectorAll('#tabelRiwayat tbody tr[data-status]');
  const kosong = document.getElementById('barisKosong');

  if (cari && status && rows.length) {
    const filter = () => {
      const q = cari.value.trim().toLowerCase();
      const st = status.value;
      let tampil = 0;
      rows.forEach((tr) => {
        const cocok = (!st || tr.dataset.status === st) && (!q || tr.dataset.search.includes(q));
        tr.hidden = !cocok;
        if (cocok) tampil++;
      });
      if (kosong) kosong.hidden = tampil !== 0;
    };
    cari.addEventListener('input', filter);
    status.addEventListener('change', filter);
  }
});
