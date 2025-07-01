<?php

namespace App\Http\Controllers\Admin\MasterData;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login', [
            'title' => 'Login',
        ]);
    }

    public function authenticate(Request $request)
    {
        // dd('disini');
        $credentials = $request->validate([
            'email' => 'required|max:255',
            'password' => 'required|max:255',
        ]);
        if ($userRequestAuth = User::where('email', $credentials['email'])->OrWhere('nip', $credentials['email'])->first()) {
            // dd(Hash::check("8106323Z@plnnd", '$2y$10$qn9.mIQGIpR9QP4aFg0/ZOl/wAg1MllcRc0otyka7CXoFftaDrUde'));

            if (Auth::attempt([
                'nip' => $userRequestAuth->nip,
                'password' => $credentials['password'],
            ])) {
                $request->session()->regenerate();
                return redirect()->intended('dashboard')->with([
                    'berhasil' => 'Berhasil',
                    'infoberhasil' => 'Anda Berhasil Login'
                ]);
            } else {
                return back()->with([
                    'gagal' => 'Gagal',
                    'infogagal' => 'Email Atau Password Anda Salah'
                ]);
            }
        } else {
            return back()->with([
                'gagal' => 'Gagal',
                'infogagal' => 'Username pengguna tidak ditemukan'
            ]);
            return back()->withErrors([
                'error' =>
                'Username pengguna tidak ditemukan'
            ]);
        }


    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('login');
    }
}
