<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class KontrollerAI extends Controller
{
    private string $konteks = <<<KONTEKS
Kamu adalah Asisten Gelar.id, AI dari platform Kampus Virtual Indonesia.
Info platform:
- Jenis gelar: KVT.Kom (S1 Terapan, 4 thn, 144 SKS), VT.Kom (S1 Virtual, 3 thn, 120 SKS), VTA.Kom (D4, 108 SKS), V.Com (D3, 96 SKS), K1–K6 (diploma 3–36 bln)
- K1 Literasi Digital: GRATIS untuk WNI
- Kelas Pelajar: untuk SD, SMP, SMA (tingkat sekolah)
- Kelas Kampus Virtual: untuk mahasiswa & umum (tingkat kuliah)
- Daftar: /daftar, bisa juga via Google OAuth
- Verifikasi sertifikat: /verifikasi
- Tes minat AI: /analisis-minat
- Fitur: pertemuan online, kuesioner, sertifikat otomatis, dasbor kemajuan
Jawab dalam Bahasa Indonesia, singkat (maks 3 kalimat), ramah, pakai emoji. Jika di luar topik Gelar.id, tetap bantu tapi arahkan kembali ke platform.
KONTEKS;

    public function chat(Request $request)
    {
        $request->validate(['pesan' => 'required|string|max:500']);
        $pesan   = $request->input('pesan');
        $apiKey  = config('services.gemini.key');

        if (!$apiKey) {
            return response()->json(['jawaban' => $this->jawabanLokal($pesan)]);
        }

        try {
            $response = Http::timeout(15)->post(
                "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key={$apiKey}",
                [
                    'contents' => [
                        [
                            'parts' => [
                                ['text' => $this->konteks . "\n\nPertanyaan pengguna: " . $pesan]
                            ]
                        ]
                    ],
                    'generationConfig' => [
                        'maxOutputTokens' => 256,
                        'temperature'     => 0.7,
                    ]
                ]
            );

            if ($response->successful()) {
                $jawaban = $response->json('candidates.0.content.parts.0.text') ?? $this->jawabanLokal($pesan);
                return response()->json(['jawaban' => $jawaban]);
            }
        } catch (\Exception $e) {
            // fallback ke jawaban lokal
        }

        return response()->json(['jawaban' => $this->jawabanLokal($pesan)]);
    }

    private function jawabanLokal(string $q): string
    {
        $q = mb_strtolower($q);
        $kb = [
            'gelar'       => 'Ada <strong>10 jenis gelar</strong>: KVT.Kom, VT.Kom, VTA.Kom, V.Com, dan K1–K6! 🎓 Cek <a href="/gelar" class="text-blue-500 font-bold underline">halaman Gelar</a>.',
            'daftar'      => 'Klik <a href="/daftar" class="text-blue-500 font-bold underline">Daftar Gratis</a>, isi data & bisa juga lewat Google! 🚀',
            'gratis'      => '<strong>K1 Literasi Digital</strong> <span class="text-green-600 font-black">GRATIS</span> untuk semua WNI! 🆓',
            'harga'       => 'Mulai dari <strong>Rp 0</strong> (K1 gratis) sampai <strong>Rp 3jt/semester</strong> untuk KVT.Kom. 💰',
            'sertifikat'  => 'Sertifikat terbit otomatis setelah selesai, bisa diverifikasi di <a href="/verifikasi" class="text-blue-500 underline font-bold">/verifikasi</a>. 🏆',
            'kelas sd'    => 'Kelas SD ada di <a href="/kelas?jalur=sekolah&tingkat=sd" class="text-blue-500 underline font-bold">Kelas Pelajar</a>! 🎒',
            'kelas smp'   => 'Kelas SMP tersedia di <a href="/kelas?jalur=sekolah&tingkat=smp" class="text-blue-500 underline font-bold">Kelas Pelajar</a>! 📚',
            'kelas sma'   => 'Kelas SMA ada di <a href="/kelas?jalur=sekolah&tingkat=sma" class="text-blue-500 underline font-bold">Kelas Pelajar</a>! 🔥',
            'google'      => 'Bisa login/daftar pakai Google! Klik tombol <strong>"Lanjutkan dengan Google"</strong> di halaman masuk. 🔐',
            'pengajar'    => 'Lihat semua pengajar di <a href="/pengajar" class="text-blue-500 underline font-bold">/pengajar</a>! 👨‍🏫',
            'pertemuan'   => 'Ada fitur <strong>Pertemuan Online</strong> via Zoom/Meet/Teams dari dasbor! 🎥',
        ];

        foreach ($kb as $kunci => $jawaban) {
            if (str_contains($q, $kunci)) return $jawaban;
        }

        return 'Hmm, saya belum punya info itu 🤔 Coba cek <a href="/program" class="text-blue-500 underline font-bold">Program</a> atau tanya lebih spesifik ya! 😊';
    }

    public function selesaikanOnboarding(Request $request)
    {
        session(['onboarding_selesai' => true]);
        return response()->json(['status' => 'ok']);
    }
}
