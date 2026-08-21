<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pendaftaran Diterima</title>
<style>
  body{font-family:'Helvetica Neue',Arial,sans-serif;background:#f0f4ff;margin:0;padding:20px;color:#0f0e17;}
  .kartu{max-width:580px;margin:0 auto;background:white;border:3px solid #0f0e17;border-radius:16px;box-shadow:6px 6px 0 #0f0e17;overflow:hidden;}
  .header{background:linear-gradient(135deg,#4361ee,#7209b7);padding:32px 28px;text-align:center;}
  .header h1{font-size:28px;font-weight:900;color:white;margin:0 0 6px;letter-spacing:2px;}
  .header p{color:rgba(255,255,255,.8);font-size:14px;margin:0;}
  .isi{padding:28px;}
  .isi h2{font-size:20px;font-weight:800;margin:0 0 16px;color:#0f0e17;}
  .isi p{font-size:14px;line-height:1.7;color:#374151;margin:0 0 12px;}
  .kotak-info{background:#f0f4ff;border:2px solid #e0e7ff;border-radius:10px;padding:16px;margin:16px 0;}
  .kotak-info p{margin:4px 0;font-size:13px;color:#4361ee;font-weight:700;}
  .tombol{display:inline-block;background:#4361ee;color:white;padding:14px 28px;border-radius:10px;font-weight:800;font-size:15px;text-decoration:none;border:2px solid #0f0e17;margin:16px 0;}
  .footer{background:#f8f9ff;padding:18px 28px;text-align:center;border-top:2px solid #f0f4ff;}
  .footer p{font-size:12px;color:#94a3b8;margin:4px 0;}
</style>
</head>
<body>
<div class="kartu">
  <div class="header">
    <div style="font-size:48px;margin-bottom:10px;">🎓</div>
    <h1>GELAR.ID</h1>
    <p>Platform Kampus Virtual Indonesia</p>
  </div>
  <div class="isi">
    <h2>Selamat, {{ $pendaftaran->pengguna->nama }}!</h2>
    <p>Pendaftaran Anda pada program berikut telah <strong style="color:#06d6a0;">DITERIMA</strong> dan diaktifkan oleh tim admin GELAR.ID.</p>

    <div class="kotak-info">
      <p>📚 Program: <strong>{{ $pendaftaran->program->nama }}</strong></p>
      <p>🎓 Jenis Gelar: <strong>{{ $pendaftaran->program->jenisGelar->kode }} — {{ $pendaftaran->program->jenisGelar->nama }}</strong></p>
      <p>🔢 Nomor Pendaftaran: <strong>{{ $pendaftaran->nomor_pendaftaran }}</strong></p>
      <p>📅 Terdaftar: <strong>{{ now()->translatedFormat('d F Y') }}</strong></p>
    </div>

    <p>Sekarang Anda dapat mulai mengikuti sesi pembelajaran, pertemuan online, dan mengerjakan kuesioner melalui dasbor Anda.</p>
    <p>Jika ada pertanyaan, hubungi admin kami melalui platform.</p>

    <div style="text-align:center;">
      <a href="{{ config('app.url') }}/pengguna/dasbor" class="tombol">→ Buka Dasbor Saya</a>
    </div>
  </div>
  <div class="footer">
    <p>Email ini dikirim otomatis oleh sistem GELAR.ID.</p>
    <p>&copy; {{ date('Y') }} GELAR.ID — Platform Kampus Virtual Indonesia</p>
  </div>
</div>
</body>
</html>
