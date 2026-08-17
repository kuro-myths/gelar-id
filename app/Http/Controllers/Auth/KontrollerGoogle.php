<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class KontrollerGoogle extends Controller
{
    /**
     * Redirect ke halaman OAuth Google
     */
    public function redirect()
    {
        $clientId    = config('services.google.client_id');
        $redirectUri = config('services.google.redirect');

        if (!$clientId) {
            return redirect('/masuk')->with('galat', 'Login Google belum dikonfigurasi.');
        }

        $params = http_build_query([
            'client_id'     => $clientId,
            'redirect_uri'  => $redirectUri,
            'response_type' => 'code',
            'scope'         => 'openid email profile',
            'access_type'   => 'online',
            'prompt'        => 'select_account',
            'state'         => csrf_token(),
        ]);

        return redirect('https://accounts.google.com/o/oauth2/v2/auth?' . $params);
    }

    /**
     * Callback dari Google — tukar code dengan token, ambil profil, login/daftar
     */
    public function callback(Request $request)
    {
        if ($request->has('error')) {
            return redirect('/masuk')->with('galat', 'Login Google dibatalkan.');
        }

        $code         = $request->get('code');
        $clientId     = config('services.google.client_id');
        $clientSecret = config('services.google.client_secret');
        $redirectUri  = config('services.google.redirect');

        // Tukar code dengan access token
        $tokenResponse = Http::post('https://oauth2.googleapis.com/token', [
            'code'          => $code,
            'client_id'     => $clientId,
            'client_secret' => $clientSecret,
            'redirect_uri'  => $redirectUri,
            'grant_type'    => 'authorization_code',
        ]);

        if ($tokenResponse->failed()) {
            return redirect('/masuk')->with('galat', 'Gagal mendapatkan token Google.');
        }

        $accessToken = $tokenResponse->json('access_token');

        // Ambil info pengguna dari Google
        $userInfo = Http::withToken($accessToken)
            ->get('https://www.googleapis.com/oauth2/v3/userinfo')
            ->json();

        if (!isset($userInfo['email'])) {
            return redirect('/masuk')->with('galat', 'Gagal mengambil data akun Google.');
        }

        // Cari atau buat pengguna
        $pengguna = Pengguna::firstOrCreate(
            ['email' => $userInfo['email']],
            [
                'nama'          => $userInfo['name'] ?? $userInfo['email'],
                'nama_pengguna' => Str::slug($userInfo['given_name'] ?? 'user') . rand(100, 9999),
                'password'      => bcrypt(Str::random(32)),
                'avatar'        => $userInfo['picture'] ?? null,
                'peran'         => 'pengguna',
                'aktif'         => true,
                'nim'           => 'KV-' . date('Y') . '-' . str_pad(Pengguna::count() + 1, 4, '0', STR_PAD_LEFT),
            ]
        );

        if (!$pengguna->aktif) {
            return redirect('/masuk')->with('galat', 'Akun Anda tidak aktif. Hubungi admin.');
        }

        Auth::login($pengguna, true);
        $request->session()->regenerate();

        $tujuan = $pengguna->isAdmin() ? '/admin/dasbor' : '/pengguna/dasbor';
        return redirect($tujuan)->with('sukses', 'Selamat datang, ' . $pengguna->nama . '!');
    }
}
