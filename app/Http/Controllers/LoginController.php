<?php

namespace App\Http\Controllers;

use App\Models\MUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login'); //
    }

    public function login(Request $request)
    {
        // Validasi data login
        $this->validate($request, [
            'kode_user' => 'required',
            'password' => 'required',
        ]);

        // Coba melakukan autentikasi
        if (Auth::guard('pengguna')->attempt(['kode_user' => $request->kode_user, 'password' => $request->password])) {
            // Autentikasi berhasil
            $user = Auth::guard('pengguna')->user();
            $data = ['kode_user' => $user->kode_user];

            $request->session()->regenerate();

            if ($user->role === 'Camaba') {
                return redirect()->intended('/camaba/pendaftar/listpendaftar')->with('alert-success', 'Login Berhasil!');
            } elseif ($user->role === 'Admin') {
                return redirect()->intended('/admin/pendaftar/listpendaftar')->with('alert-success', 'Login Berhasil!');
            } else {
                return redirect('/')->with($data)->with('alert-error', 'Akses Ditolak!');
            }
        } else {
            // Autentikasi gagal
            return redirect('/login')->with('alert-error', 'Username atau Password Salah!');
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('pengguna')->logout();
        $request->session()->regenerate();
        return redirect()->intended(route('login'))->with('alert-success', 'Anda Telah Logout!');
    }

    public function userRegis(Request $request)
    {
        return view('admin.register');
    }

    public function userProsesAdd(Request $request)
    {
        // Mengecek username apakah sudah ada
        $kode_user = $request->input('kode_user');
        $kode_userExists = MUser::where('kode_user', $kode_user)->exists();
        if ($kode_userExists) {
            return redirect()->route('admin.userRegis')->with('alert-error', 'OOPSSS! ID sudah ada!');
        }

        // Lanjutkan dengan proses penyimpanan data user jika username belum ada di database
        $form_kode_user = $request->post('kode_user');
        $form_nama_user = $request->post('nama_user');
        $form_password = $request->post('password');
        $form_role = $request->post('role');
        $hashedPassword = bcrypt($form_password); // Hash password sebelum menyimpannya

        // Set ke tabel
        $tblUser = new MUser();
        $tblUser->kode_user = $form_kode_user;
        $tblUser->nama_user = $form_nama_user;
        $tblUser->password = $hashedPassword;
        $tblUser->role = $form_role;

        $tblUser->save(); // Simpan data ke database

        return redirect()->route('login')->with('alert-success', 'Berhasil Menambahkan Data');
    }
}
