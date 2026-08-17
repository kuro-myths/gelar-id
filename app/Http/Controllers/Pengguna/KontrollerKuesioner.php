<?php

namespace App\Http\Controllers\Pengguna;

use App\Http\Controllers\Controller;
use App\Models\Kuesioner;
use App\Models\ResponsKuesioner;
use App\Models\Jawaban;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KontrollerKuesioner extends Controller
{
    public function daftar()
    {
        $pengguna   = Auth::user();
        $programIds = $pengguna->pendaftaran()
            ->whereIn('status', ['aktif', 'selesai'])
            ->pluck('program_id');

        $kuesioner = Kuesioner::with(['program.jenisGelar'])
            ->whereIn('program_id', $programIds)
            ->where('aktif', true)
            ->withCount('pertanyaan')
            ->latest()
            ->paginate(10);

        $sudahIsi = ResponsKuesioner::where('pengguna_id', $pengguna->id)
            ->where('selesai', true)
            ->pluck('kuesioner_id')
            ->toArray();

        return view('pengguna.kuesioner.daftar', compact('kuesioner', 'sudahIsi'));
    }

    public function isi(Kuesioner $kuesioner)
    {
        $pengguna = Auth::user();

        if ($kuesioner->sudahDiisi($pengguna->id)) {
            return redirect('/pengguna/kuesioner')->with('galat', 'Anda sudah mengisi kuesioner ini.');
        }

        if ($kuesioner->status === 'ditutup') {
            return redirect('/pengguna/kuesioner')->with('galat', 'Kuesioner sudah ditutup.');
        }

        $pertanyaan = $kuesioner->acak_soal
            ? $kuesioner->pertanyaan()->inRandomOrder()->get()
            : $kuesioner->pertanyaan;

        // Buat/ambil sesi respons
        $respons = ResponsKuesioner::firstOrCreate(
            ['kuesioner_id' => $kuesioner->id, 'pengguna_id' => $pengguna->id],
            ['mulai_pada' => now()]
        );

        return view('pengguna.kuesioner.isi', compact('kuesioner', 'pertanyaan', 'respons'));
    }

    public function kirim(Request $request, Kuesioner $kuesioner)
    {
        $pengguna = Auth::user();

        if ($kuesioner->sudahDiisi($pengguna->id)) {
            return redirect('/pengguna/kuesioner')->with('galat', 'Anda sudah mengisi kuesioner ini.');
        }

        $respons = ResponsKuesioner::where('kuesioner_id', $kuesioner->id)
            ->where('pengguna_id', $pengguna->id)
            ->firstOrFail();

        $nilaiTotal = 0;

        foreach ($kuesioner->pertanyaan as $pertanyaan) {
            $jawabanTeks = $request->input('jawaban.' . $pertanyaan->id);

            if ($pertanyaan->wajib && empty($jawabanTeks)) {
                return back()->withInput()
                    ->with('galat', 'Pertanyaan "' . $pertanyaan->teks_pertanyaan . '" wajib diisi.');
            }

            $nilai = null;
            // Hitung nilai untuk pilihan ganda
            if ($pertanyaan->tipe === 'pilihan_ganda' && $pertanyaan->opsi) {
                $opsiBenar = collect($pertanyaan->opsi)->first(fn($o) => str_starts_with($o, '[BENAR]'));
                if ($opsiBenar) {
                    $jawBersih = str_replace('[BENAR]', '', $opsiBenar);
                    $nilai = trim($jawBersih) === trim($jawabanTeks) ? $pertanyaan->bobot : 0;
                    $nilaiTotal += $nilai;
                }
            }

            if (!empty($jawabanTeks)) {
                Jawaban::updateOrCreate(
                    ['respons_id' => $respons->id, 'pertanyaan_id' => $pertanyaan->id],
                    ['jawaban' => $jawabanTeks, 'nilai' => $nilai]
                );
            }
        }

        $respons->update([
            'nilai_total'  => $nilaiTotal,
            'selesai_pada' => now(),
            'selesai'      => true,
        ]);

        return redirect('/pengguna/kuesioner')->with('sukses', '✅ Kuesioner berhasil dikirim!');
    }

    public function hasil(Kuesioner $kuesioner)
    {
        $pengguna = Auth::user();
        $respons  = ResponsKuesioner::with(['jawaban.pertanyaan'])
            ->where('kuesioner_id', $kuesioner->id)
            ->where('pengguna_id', $pengguna->id)
            ->where('selesai', true)
            ->firstOrFail();

        $kuesioner->load('pertanyaan');
        return view('pengguna.kuesioner.hasil', compact('kuesioner', 'respons'));
    }
}
