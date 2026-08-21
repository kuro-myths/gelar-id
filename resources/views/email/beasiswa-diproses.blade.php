<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Update Status Beasiswa</title>
<style>
  body{font-family:'Helvetica Neue',Arial,sans-serif;background:#f0f4ff;margin:0;padding:20px;color:#0f0e17;}
  .kartu{max-width:580px;margin:0 auto;background:white;border:3px solid #0f0e17;border-radius:16px;box-shadow:6px 6px 0 #0f0e17;overflow:hidden;}
  .header-diterima{background:linear-gradient(135deg,#06d6a0,#4361ee);padding:32px 28px;text-align:center;}
  .header-ditolak{background:linear-gradient(135deg,#f72585,#7209b7);padding:32px 28px;text-align:center;}
  .header-diproses{background:linear-gradient(135deg,#4361ee,#7209b7);padding:32px 28px;text-align:center;}
  .header h1{font-size:26px;font-weight:900;color:white;margin:0 0 6px;letter-spacing:2px;}
  .header p{color:rgba(255,255,255,.85);font-size:14px;margin:0;}
  .isi{padding:28px;}
  .isi h2{font-size:20px;font-weight:800;margin:0 0 14px;}
  .isi p{font-size:14px;line-height:1.7;color:#374151;margin:0 0 12px;}
  .kotak-info{background:#f0f4ff;border:2px solid #e0e7ff;border-radius:10px;padding:16px;margin:16px 0;}
  .kotak-info p{margin:4px 0;font-size:13px;font-weight:700;}
  .kotak-catatan{background:#fef9c3;border:2px solid #fbbf24;border-radius:10px;padding:14px;margin:14px 0;}
  .tombol{display:inline-block;background:#4361ee;color:white;padding:14px 28px;border-radius:10px;font-weight:800;font-size:15px;text-decoration:none;border:2px solid #0f0e17;margin:16px 0;}
  .footer{background:#f8f9ff;padding:18px 28px;text-align:center;border-top:2px solid #f0f4ff;}
  .footer p{font-size:12px;color:#94a3b8;margin:4px 0;}
</style>
</head>
<body>
<div class="kartu">
  @if($statusBaru === 'diterima')
  <div class="header header-diterima">
    <div style="font-size:48px;margin-bottom:10px;">🎉</div>
    <h1 class="header">BEASISWA DITERIMA!</h1>
    <p>GELAR.ID — Platform Kampus Virtual Indonesia</p>
  </div>
  <div class="isi">
    <h2>Selamat, {{ $pendaftarBeasiswa->pengguna->nama }}! 🎊</h2>
    <p>Kami dengan bangga memberitahukan bahwa pendaftaran beasiswa Anda telah <strong style="color:#06d6a0;">DITERIMA</strong>.</p>
    <div class="kotak-info">
      <p>🏅 Beasiswa: <strong>{{ $pendaftarBeasiswa->beasiswa->nama }}</strong></p>
      <p>🎁 Manfaat: <strong>{{ $pendaftarBeasiswa->beasiswa->label_manfaat }}</strong></p>
      <p>🔢 No. Pendaftaran: <strong>{{ $pendaftarBeasiswa->nomor_pendaftaran_beasiswa }}</strong></p>
    </div>
    @if($pendaftarBeasiswa->catatan_admin)
    <div class="kotak-catatan">
      <p style="font-weight:800;margin-bottom:6px;">📝 Pesan dari Admin:</p>
      <p style="color:#374151;">{{ $pendaftarBeasiswa->catatan_admin }}</p>
    </div>
    @endif
    <p>Silakan masuk ke dasbor Anda untuk melihat detail dan mendaftarkan diri ke program studi.</p>
    <div style="text-align:center;">
      <a href="{{ config('app.url') }}/pengguna/dasbor" class="tombol">→ Buka Dasbor Saya</a>
    </div>
  </div>

  @elseif($statusBaru === 'ditolak')
  <div class="header header-ditolak">
    <div style="font-size:48px;margin-bottom:10px;">📋</div>
    <h1 class="header">UPDATE BEASISWA</h1>
    <p>GELAR.ID — Platform Kampus Virtual Indonesia</p>
  </div>
  <div class="isi">
    <h2>Halo, {{ $pendaftarBeasiswa->pengguna->nama }}</h2>
    <p>Setelah melalui proses seleksi, dengan menyesal kami memberitahukan bahwa pendaftaran beasiswa Anda <strong style="color:#f72585;">belum dapat diterima</strong> pada periode ini.</p>
    <div class="kotak-info">
      <p>🏅 Beasiswa: <strong>{{ $pendaftarBeasiswa->beasiswa->nama }}</strong></p>
      <p>🔢 No. Pendaftaran: <strong>{{ $pendaftarBeasiswa->nomor_pendaftaran_beasiswa }}</strong></p>
    </div>
    @if($pendaftarBeasiswa->catatan_admin)
    <div class="kotak-catatan">
      <p style="font-weight:800;margin-bottom:6px;">📝 Catatan dari Admin:</p>
      <p style="color:#374151;">{{ $pendaftarBeasiswa->catatan_admin }}</p>
    </div>
    @endif
    <p>Jangan menyerah! Anda tetap bisa mendaftar pada periode beasiswa berikutnya atau melengkapi pencapaian yang dipersyaratkan.</p>
    <div style="text-align:center;">
      <a href="{{ config('app.url') }}/beasiswa" class="tombol" style="background:#7209b7;">→ Lihat Beasiswa Lain</a>
    </div>
  </div>

  @else
  <div class="header header-diproses">
    <div style="font-size:48px;margin-bottom:10px;">🔍</div>
    <h1 class="header">BEASISWA SEDANG DIPROSES</h1>
    <p>GELAR.ID — Platform Kampus Virtual Indonesia</p>
  </div>
  <div class="isi">
    <h2>Halo, {{ $pendaftarBeasiswa->pengguna->nama }}</h2>
    <p>Pendaftaran beasiswa Anda sedang dalam tahap <strong style="color:#4361ee;">review oleh tim admin</strong>.</p>
    <div class="kotak-info">
      <p>🏅 Beasiswa: <strong>{{ $pendaftarBeasiswa->beasiswa->nama }}</strong></p>
      <p>🔢 No. Pendaftaran: <strong>{{ $pendaftarBeasiswa->nomor_pendaftaran_beasiswa }}</strong></p>
    </div>
    <p>Kami akan menginformasikan hasilnya melalui email ini. Pantau juga status di dasbor Anda.</p>
  </div>
  @endif

  <div class="footer">
    <p>Email ini dikirim otomatis oleh sistem GELAR.ID.</p>
    <p>&copy; {{ date('Y') }} GELAR.ID — Platform Kampus Virtual Indonesia</p>
  </div>
</div>
</body>
</html>
