<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Pencapaian Diraih</title>
<style>
  body{font-family:'Helvetica Neue',Arial,sans-serif;background:#f0f4ff;margin:0;padding:20px;}
  .kartu{max-width:580px;margin:0 auto;background:white;border:3px solid #0f0e17;border-radius:16px;box-shadow:6px 6px 0 #0f0e17;overflow:hidden;}
  .header{padding:32px 28px;text-align:center;}
  .header h1{font-size:26px;font-weight:900;color:white;margin:8px 0 4px;letter-spacing:2px;}
  .header p{color:rgba(255,255,255,.85);font-size:14px;margin:0;}
  .isi{padding:28px;}
  .isi h2{font-size:20px;font-weight:800;margin:0 0 14px;color:#0f0e17;}
  .isi p{font-size:14px;line-height:1.7;color:#374151;margin:0 0 12px;}
  .badge{display:inline-block;padding:20px 28px;border:3px solid #0f0e17;border-radius:16px;text-align:center;margin:16px 0;}
  .badge .ikon{font-size:48px;display:block;margin-bottom:8px;}
  .badge .nama{font-size:18px;font-weight:900;color:#0f0e17;}
  .badge .poin{font-size:13px;font-weight:700;color:#4361ee;margin-top:4px;}
  .tombol{display:inline-block;background:#ffd60a;color:#0f0e17;padding:14px 28px;border-radius:10px;font-weight:800;font-size:15px;text-decoration:none;border:2px solid #0f0e17;}
  .footer{background:#f8f9ff;padding:18px 28px;text-align:center;border-top:2px solid #f0f4ff;}
  .footer p{font-size:12px;color:#94a3b8;margin:4px 0;}
</style>
</head>
<body>
<div class="kartu">
  <div class="header" style="background:linear-gradient(135deg,{{ $pencapaianPengguna->pencapaian->warna }},#0f0e17);">
    <div style="font-size:52px;">{{ $pencapaianPengguna->pencapaian->ikon }}</div>
    <h1>PENCAPAIAN BARU!</h1>
    <p>GELAR.ID — Platform Kampus Virtual Indonesia</p>
  </div>
  <div class="isi">
    <h2>Selamat, {{ $pencapaianPengguna->pengguna->nama }}! 🎊</h2>
    <p>Anda telah berhasil meraih pencapaian baru di GELAR.ID!</p>

    <div style="text-align:center;">
      <div class="badge" style="background:{{ $pencapaianPengguna->pencapaian->warna }}22;">
        <span class="ikon">{{ $pencapaianPengguna->pencapaian->ikon }}</span>
        <div class="nama">{{ $pencapaianPengguna->pencapaian->nama }}</div>
        @if($pencapaianPengguna->pencapaian->poin > 0)
        <div class="poin">+{{ $pencapaianPengguna->pencapaian->poin }} poin</div>
        @endif
      </div>
    </div>

    <p>{{ $pencapaianPengguna->pencapaian->deskripsi }}</p>

    @if($pencapaianPengguna->pencapaian->adalah_prasyarat_beasiswa)
    <div style="background:#fef9c3;border:2px solid #fbbf24;border-radius:10px;padding:14px;margin:14px 0;">
      <p style="font-weight:800;color:#92400e;margin:0;">
        ⭐ Pencapaian ini merupakan prasyarat untuk beberapa program beasiswa GELAR.ID!
        Cek halaman beasiswa untuk informasi lebih lanjut.
      </p>
    </div>
    @endif

    <div style="text-align:center;margin-top:20px;">
      <a href="{{ config('app.url') }}/pengguna/pencapaian-ku" class="tombol">→ Lihat Semua Pencapaian Saya</a>
    </div>
  </div>
  <div class="footer">
    <p>Email ini dikirim otomatis oleh sistem GELAR.ID.</p>
    <p>&copy; {{ date('Y') }} GELAR.ID — Platform Kampus Virtual Indonesia</p>
  </div>
</div>
</body>
</html>
