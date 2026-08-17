<?php

namespace App\Http\Controllers;

use App\Models\JenisGelar;
use App\Models\Program;
use App\Models\Pengguna;
use App\Models\Sertifikat;
use App\Models\Kelas;
use App\Models\Pendaftaran;

class KontrollerBeranda extends Controller
{
    public function index()
    {
        $jenisGelar      = JenisGelar::aktif()->get();
        $programUnggulan = Program::with('jenisGelar')->unggulan()->aktif()->take(6)->get();
        $statistik = [
            'pengguna'   => Pengguna::where('peran', 'pengguna')->count(),
            'program'    => Program::aktif()->count(),
            'sertifikat' => Sertifikat::count(),
            'gelar'      => JenisGelar::aktif()->count(),
            'pengajar'   => Pengguna::where('peran', 'pengajar')->count(),
            'kelas'      => Kelas::aktif()->count(),
        ];
        return view('beranda', compact('jenisGelar', 'programUnggulan', 'statistik'));
    }

    public function program()
    {
        $jenisGelar = JenisGelar::aktif()->with(['program' => fn($q) => $q->aktif()])->get();
        $program    = Program::with('jenisGelar')->aktif()
            ->when(request('gelar'), fn($q) => $q->whereHas('jenisGelar', fn($dq) => $dq->where('kode', request('gelar'))))
            ->when(request('cari'),  fn($q) => $q->where('nama', 'like', '%'.request('cari').'%'))
            ->paginate(12);
        return view('program', compact('program', 'jenisGelar'));
    }

    public function detailProgram(Program $program)
    {
        $program->load(['jenisGelar', 'semester.sesiBelajar']);
        return view('detail-program', compact('program'));
    }

    public function gelar()
    {
        $jenisGelar = JenisGelar::aktif()->with('program')->get();
        return view('gelar', compact('jenisGelar'));
    }

    public function detailGelar(JenisGelar $gelar)
    {
        $gelar->load([
            'program' => fn($q) => $q->aktif()->withCount('pendaftaran'),
            'program.semester.sesiBelajar',
        ]);
        return view('detail-gelar', compact('gelar'));
    }

    public function verifikasiSertifikat()
    {
        $sertifikat = null;
        if (request('kode')) {
            $sertifikat = Sertifikat::with(['pengguna', 'jenisGelar', 'pendaftaran.program'])
                ->where('kode_verifikasi', strtoupper(request('kode')))
                ->where('valid', true)
                ->first();
        }
        return view('verifikasi', compact('sertifikat'));
    }

    // ===== HALAMAN BARU =====

    public function pengajar()
    {
        $pengajar = Pengguna::where('peran', 'pengajar')
            ->where('tampilkan_profil', true)
            ->where('aktif', true)
            ->orderByDesc('total_pelajar')
            ->get();
        return view('pengajar', compact('pengajar'));
    }

    public function tentang()
    {
        $statistik = [
            'pengguna'   => Pengguna::where('peran', 'pengguna')->count(),
            'program'    => Program::aktif()->count(),
            'sertifikat' => Sertifikat::count(),
            'gelar'      => JenisGelar::aktif()->count(),
            'pengajar'   => Pengguna::where('peran', 'pengajar')->count(),
            'kelas'      => Kelas::aktif()->count(),
        ];
        return view('tentang', compact('statistik'));
    }

    public function statistik()
    {
        $data = [
            'total_pengguna'   => Pengguna::where('peran', 'pengguna')->count(),
            'pengguna_aktif'   => Pengguna::where('peran', 'pengguna')->where('aktif', true)->count(),
            'total_program'    => Program::aktif()->count(),
            'total_sertifikat' => Sertifikat::count(),
            'total_gelar'      => JenisGelar::aktif()->count(),
            'total_pengajar'   => Pengguna::where('peran', 'pengajar')->count(),
            'total_kelas'      => Kelas::aktif()->count(),
            'pendaftaran_aktif'=> Pendaftaran::where('status', 'aktif')->count(),
            'pendaftaran_selesai' => Pendaftaran::where('status', 'selesai')->count(),
            'total_pertemuan'  => \App\Models\Pertemuan::count(),
            'gelar_per_kategori' => JenisGelar::aktif()
                ->selectRaw('kategori, COUNT(*) as jumlah')
                ->groupBy('kategori')
                ->get(),
            'program_populer'  => Program::with('jenisGelar')
                ->aktif()
                ->withCount(['pendaftaran' => fn($q) => $q->whereIn('status', ['aktif', 'selesai'])])
                ->orderByDesc('pendaftaran_count')
                ->take(5)
                ->get(),
            'pendaftaran_per_bulan' => Pendaftaran::selectRaw('MONTH(created_at) as bulan, COUNT(*) as jumlah')
                ->whereYear('created_at', date('Y'))
                ->groupBy('bulan')
                ->orderBy('bulan')
                ->get(),
        ];
        return view('statistik', compact('data'));
    }

    public function kelas()
    {
        $jalur = request('jalur', 'semua');

        $kelasDaftar = Kelas::with('pengajar')->aktif()
            ->when(request('tingkat'), fn($q) => $q->where('tingkat', request('tingkat')))
            ->when(request('cari'), fn($q) => $q->where('nama', 'like', '%'.request('cari').'%'))
            ->when(request('gratis'), fn($q) => $q->where('jalur_gratis', true))
            ->when($jalur === 'sekolah', fn($q) => $q->whereIn('tingkat', ['sd','smp','sma']))
            ->when($jalur === 'kuliah', fn($q) => $q->where('tingkat', 'umum'))
            ->orderByDesc('unggulan')
            ->paginate(12);

        $statistikKelas = [
            'sd'   => Kelas::aktif()->where('tingkat', 'sd')->count(),
            'smp'  => Kelas::aktif()->where('tingkat', 'smp')->count(),
            'sma'  => Kelas::aktif()->where('tingkat', 'sma')->count(),
            'umum' => Kelas::aktif()->where('tingkat', 'umum')->count(),
        ];

        return view('kelas', compact('kelasDaftar', 'statistikKelas'));
    }

    public function detailKelas(Kelas $kelas)
    {
        $kelas->load('pengajar');
        return view('detail-kelas', compact('kelas'));
    }
}
