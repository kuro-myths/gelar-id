<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Diskon;
use App\Models\Program;
use Illuminate\Http\Request;

class KontrollerDiskon extends Controller
{
    public function daftar()
    {
        $diskon = Diskon::withCount('pemakaian')->latest()->paginate(15);
        return view('admin.diskon.daftar', compact('diskon'));
    }

    public function buat()
    {
        $program = Program::aktif()->with('jenisGelar')->get();
        return view('admin.diskon.buat', compact('program'));
    }

    public function simpan(Request $request)
    {
        $data = $request->validate([
            'kode'           => 'required|unique:diskon,kode|alpha_dash|max:30',
            'nama'           => 'required|string|max:255',
            'deskripsi'      => 'nullable|string',
            'tipe'           => 'required|in:persen,nominal,gratis',
            'nilai'          => 'required|numeric|min:0',
            'maks_penggunaan'=> 'required|integer|min:0',
            'min_pembelian'  => 'required|numeric|min:0',
            'berlaku_mulai'  => 'nullable|date',
            'berlaku_hingga' => 'nullable|date|after_or_equal:berlaku_mulai',
            'program_ids'    => 'nullable|array',
        ]);
        $data['aktif'] = true;
        Diskon::create($data);
        return redirect('/admin/diskon')->with('sukses', 'Diskon berhasil dibuat!');
    }

    public function edit(Diskon $diskon)
    {
        $program = Program::aktif()->with('jenisGelar')->get();
        return view('admin.diskon.edit', compact('diskon', 'program'));
    }

    public function perbarui(Request $request, Diskon $diskon)
    {
        $data = $request->validate([
            'nama'           => 'required|string|max:255',
            'tipe'           => 'required|in:persen,nominal,gratis',
            'nilai'          => 'required|numeric|min:0',
            'maks_penggunaan'=> 'required|integer|min:0',
            'min_pembelian'  => 'required|numeric|min:0',
            'berlaku_mulai'  => 'nullable|date',
            'berlaku_hingga' => 'nullable|date',
            'program_ids'    => 'nullable|array',
        ]);
        $data['aktif'] = $request->boolean('aktif');
        $diskon->update($data);
        return redirect('/admin/diskon')->with('sukses', 'Diskon diperbarui.');
    }

    public function hapus(Diskon $diskon)
    {
        $diskon->delete();
        return back()->with('sukses', 'Diskon dihapus.');
    }

    public function toggleAktif(Diskon $diskon)
    {
        $diskon->update(['aktif' => !$diskon->aktif]);
        return back()->with('sukses', 'Status diskon diubah.');
    }

    public function validasiKode(Request $request)
    {
        $request->validate(['kode'=>'required','program_id'=>'required|exists:program,id']);
        $diskon = Diskon::aktif()->where('kode', strtoupper($request->kode))->first();
        if (!$diskon) return response()->json(['valid'=>false,'pesan'=>'Kode tidak ditemukan atau sudah kedaluwarsa.']);
        if (!$diskon->berlakuUntukProgram($request->program_id)) return response()->json(['valid'=>false,'pesan'=>'Kode tidak berlaku untuk program ini.']);
        $program = Program::findOrFail($request->program_id);
        $potongan   = $diskon->hitungPotongan((float)$program->harga);
        $hargaAkhir = $diskon->hitungHargaAkhir((float)$program->harga);
        return response()->json(['valid'=>true,'pesan'=>'Kode valid! Hemat Rp '.number_format($potongan,0,',','.'),'potongan'=>$potongan,'harga_akhir'=>$hargaAkhir,'nama_diskon'=>$diskon->nama]);
    }
}
