<?php

namespace App\Http\Controllers;

use App\Models\MUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function userShow(Request $request)
    {
        $dataUser = MUser::all(); //narik semua dari db kirim ke view
        return view('admin.user.listuser', ['dataUser' => $dataUser]);
    }

    public function userShowCreate(Request $request)
    {

        return view('admin.user.create');
    }

    public function userProsesAdd(Request $request)
    {
        // Mengecek username apakah sudah ada
        $kode_user = $request->input('kode_user');
        $kode_userExists = MUser::where('kode_user', $kode_user)->exists();
        if ($kode_userExists) {
            Session::flash('alert-error', 'OOPSSS! Id  sudah ada!');
            return redirect()->route('admin.user.create');
        }


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

        Session::flash('alert-success', 'Berhasil Menambahkan Data');

        // Redirect ke halaman selanjutnya
        return redirect()->route('admin.user.listuser');
    }


    public function userShowEdit(Request $request)
    {
        // -- ambil dari request id
        $form_id_user = $request->query('id_user', '');

        $dataUser = MUser::findOrFail($form_id_user);

        return view('admin.user.edit', compact('dataUser'));
    }

    public function userProsesEdit(Request $request)
    {
        $form_oldid = $request->post('oldid');
        $tblUser = MUser::findOrFail($form_oldid);

        $form_nama_user = $request->post('nama_user');
        $form_kode_user = $request->post('kode_user');
        $form_role = $request->post('role');
        $form_password = $request->post('password'); // Ambil password dari request

        // Update data pengguna
        $tblUser->kode_user = $form_kode_user;
        $tblUser->nama_user = $form_nama_user;
        $tblUser->role = $form_role;

        // Update password jika diberikan
        if (!empty($form_password)) {
            $tblUser->password = bcrypt($form_password);
        }

        $tblUser->save();

        // Set pesan sukses
        Session::flash('alert-success', 'Berhasil Mengubah Data');
        return redirect()->route('admin.user.listuser');
    }


    public function userProsesDelete(Request $request)
    {
        // Ambil ID user dari permintaan
        $id_user = $request->input('id_user');

        // Temukan pengguna berdasarkan ID
        $tblUser = MUser::findOrFail($id_user);

        // Hapus pengguna dari database
        $tblUser->delete();

        // Beri pesan sukses
        Session::flash('alert-success', 'Berhasil Hapus Data');

        // Redirect ke halaman daftar pengguna
        return redirect()->route('admin.user.listuser');
    }
}
