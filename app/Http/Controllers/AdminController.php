<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\MCamaba;
use App\Models\MKota;
use App\Models\MPropinsi;

class AdminController extends Controller
{
    public function listPendaftarShow(Request $request)
    {
        $dataSiswaMaster = MCamaba::all(); // Mengambil semua data dari tabel calon mahasiswa
        return view('admin.pendaftar.listpendaftar', ['dataSiswaMaster' => $dataSiswaMaster]);
    }

    public function pendaftarShowCreate(Request $request)
    {
        $provinsiOptions = MPropinsi::pluck('nama_provinsi', 'id_provinsi');
        $kabupatenOptions = MKota::pluck('nama_kota', 'id_kota');

        return view('admin.pendaftar.create', compact('provinsiOptions', 'kabupatenOptions'));
    }

    public function pendaftarProsesAdd(Request $request)
    {

        // Memperoleh data dari request
        $form_nama_user = $request->post('nama_user');
        $form_alamat_ktp = $request->post('alamat_ktp');
        $form_alamat_sekarang = $request->post('alamat_sekarang');
        $form_kecamatan = $request->post('kecamatan');
        $form_kabupaten = $request->post('kabupaten');
        $form_propinsi = $request->post('propinsi');
        $form_nohp = $request->post('nohp');
        $form_email = $request->post('email');
        $form_kewarganegaraan = $request->post('kewarganegaraan');
        $form_tgl_lahir = $request->post('tgl_lahir');
        $form_tempat_lahir = $request->post('tempat_lahir');
        $form_jenis_kelamin = $request->post('jenis_kelamin');
        $form_status_menikah = $request->post('status_menikah');
        $form_agama = $request->post('agama');

        // Set ke tabel
        $tblCamaba = new MCamaba();
        $tblCamaba->nama_user = $form_nama_user;
        $tblCamaba->alamat_ktp = $form_alamat_ktp;
        $tblCamaba->alamat_sekarang = $form_alamat_sekarang;
        $tblCamaba->kecamatan = $form_kecamatan;
        $tblCamaba->kabupaten = $form_kabupaten;
        $tblCamaba->propinsi = $form_propinsi;
        $tblCamaba->nohp = $form_nohp;
        $tblCamaba->email = $form_email;
        $tblCamaba->kewarganegaraan = $form_kewarganegaraan;
        $tblCamaba->tgl_lahir = $form_tgl_lahir;
        $tblCamaba->tempat_lahir = $form_tempat_lahir;
        $tblCamaba->jenis_kelamin = $form_jenis_kelamin;
        $tblCamaba->status_menikah = $form_status_menikah;
        $tblCamaba->agama = $form_agama;

        $tblCamaba->save(); // Simpan data ke database

        Session::flash('alert-success', 'Berhasil Menambahkan Data');

        // Redirect ke halaman selanjutnya
        return redirect()->route('admin.pendaftar.listpendaftar');
    }


    public function pendaftarShowEdit(Request $request, $id)
    {
        $dataSiswa = MCamaba::findOrFail($id);
        $provinsiOptions = MPropinsi::pluck('nama_provinsi', 'id_provinsi');
        $kabupatenOptions = MKota::pluck('nama_kota', 'id_kota');

        return view('admin.pendaftar.edit', compact('dataSiswa', 'provinsiOptions', 'kabupatenOptions'));
    }


    public function editProses(Request $request, $id)
    {
        $tblSiswa = MCamaba::findOrFail($id);

        // Validasi data
        $request->validate([
            'nama_user' => 'required|string|max:255',
            'alamat_ktp' => 'required|string|max:255',
            'alamat_sekarang' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kabupaten' => 'required|string|max:255',
            'propinsi' => 'required|string|max:255',
            'nohp' => 'required|numeric|digits_between:10,13',
            'email' => 'required|email|max:255',
            'kewarganegaraan' => 'required|string',
            'tgl_lahir' => 'required|date',
            'tempat_lahir' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string',
            'status_menikah' => 'required|string',
            'agama' => 'required|string',
        ]);

        // Update data pendaftar
        $tblSiswa->nama_user = $request->post('nama_user');
        $tblSiswa->alamat_ktp = $request->post('alamat_ktp');
        $tblSiswa->alamat_sekarang = $request->post('alamat_sekarang');
        $tblSiswa->kecamatan = $request->post('kecamatan');
        $tblSiswa->kabupaten = $request->post('kabupaten');
        $tblSiswa->propinsi = $request->post('propinsi');
        $tblSiswa->nohp = $request->post('nohp');
        $tblSiswa->email = $request->post('email');
        $tblSiswa->kewarganegaraan = $request->post('kewarganegaraan');
        $tblSiswa->tgl_lahir = $request->post('tgl_lahir');
        $tblSiswa->tempat_lahir = $request->post('tempat_lahir');
        $tblSiswa->jenis_kelamin = $request->post('jenis_kelamin');
        $tblSiswa->status_menikah = $request->post('status_menikah');
        $tblSiswa->agama = $request->post('agama');

        $tblSiswa->save(); // Simpan perubahan ke database

        Session::flash('alert-success', 'Berhasil Mengubah Data');
        return redirect()->route('admin.pendaftar.listpendaftar');
    }

    public function pendaftarProsesDelete($id)
    {
        // Temukan pengguna berdasarkan ID
        $tblSiswa = MCamaba::findOrFail($id);

        // Hapus pengguna dari database
        $tblSiswa->delete();

        // Beri pesan sukses
        Session::flash('alert-success', 'Berhasil Hapus Data');

        // Redirect ke halaman daftar pengguna
        return redirect()->route('admin.pendaftar.listpendaftar');
    }
}
