@extends('master.layout')

@section('title', 'Create Pendaftar')

@section('content')
<h1 class="mb-4">Create Pendaftar</h1>

<form id="pendaftarForm" action="{{ route('camaba.pendaftar.create.proses') }}" method="POST"
    enctype="multipart/form-data" onsubmit="return validateForm()">
    @csrf
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="nama_user" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" id="nama_user" name="nama_user" value="{{ $currentUserName }}"
                readonly>
        </div>
        <div class="col-md-6 mb-3">
            <label for="alamat_ktp" class="form-label">Alamat KTP</label>
            <input type="text" class="form-control" id="alamat_ktp" name="alamat_ktp" required>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="alamat_sekarang" class="form-label">Alamat Sekarang</label>
            <input type="text" class="form-control" id="alamat_sekarang" name="alamat_sekarang" required>
        </div>
        <div class="col-md-6 mb-3">
            <label for="kecamatan" class="form-label">Kecamatan</label>
            <input type="text" class="form-control" id="kecamatan" name="kecamatan" required>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 mb-3">
            <label for="propinsi" class="form-label">Provinsi</label>
            <select class="form-control" id="propinsi" name="propinsi" required>
                <option value="" disabled selected>Pilih Provinsi</option>
                @foreach($provinsiOptions as $id_provinsi => $nama_provinsi)
                <option value="{{ $id_provinsi }}">{{ $nama_provinsi }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4 mb-3">
            <label for="kabupaten" class="form-label">Kabupaten</label>
            <select class="form-control" id="kabupaten" name="kabupaten" required>
                <option value="" disabled selected>Pilih Kabupaten</option>
                @foreach($kabupatenOptions as $id_kota => $nama_kota)
                <option value="{{ $id_kota }}">{{ $nama_kota }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4 mb-3">
            <label for="nohp" class="form-label">No HP</label>
            <input type="tel" class="form-control" id="nohp" name="nohp" required pattern="\d{10,13}"
                inputmode="numeric">
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="col-md-6 mb-3">
            <label for="kewarganegaraan" class="form-label">Kewarganegaraan</label>
            <select class="form-control" id="kewarganegaraan" name="kewarganegaraan" required>
                <option value="" disabled selected>Pilih Kewarganegaraan</option>
                <option value="WNI Asli">WNI Asli</option>
                <option value="WNI Keturunan">WNI Keturunan</option>
                <option value="WNA">WNA</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
            <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" required>
        </div>
        <div class="col-md-6 mb-3">
            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" required>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="" disabled selected>Pilih Jenis Kelamin</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label for="status_menikah" class="form-label">Status Menikah</label>
            <select class="form-control" id="status_menikah" name="status_menikah" required>
                <option value="" disabled selected>Pilih Status Menikah</option>
                <option value="Belum Menikah">Belum Menikah</option>
                <option value="Menikah">Menikah</option>
                <option value="Cerai">Cerai</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 mb-3">
            <label for="agama" class="form-label">Agama</label>
            <select class="form-control" id="agama" name="agama" required>
                <option value="" disabled selected>Pilih Agama</option>
                <option value="Islam">Islam</option>
                <option value="Katolik">Katolik</option>
                <option value="Kristen">Kristen</option>
                <option value="Hindu">Hindu</option>
                <option value="Budha">Budha</option>
                <option value="Lain-lain">Lain-lain</option>
            </select>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="{{ route('camaba.pendaftar.listpendaftar') }}" class="btn btn-secondary">Kembali</a>
</form>

<script>

    function validateForm() {
        const form = document.getElementById('pendaftarForm');
        const email = form.email.value;
        const nohp = form.nohp.value;

        // Validate email format
        if (!validateEmail(email)) {
            alert('Format email tidak valid.');
            return false;
        }

        // Validate phone number
        if (!/^\d{10,13}$/.test(nohp)) {
            alert('No HP harus berisi antara 10 hingga 13 digit.');
            return false;
        }

        return confirm('Apakah Anda yakin ingin menambahkan pendaftar ini?');
    }

    function validateEmail(email) {
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return regex.test(email);
    }

    // Ensure only numbers are entered in the phone number field
    document.getElementById('nohp').addEventListener('input', function (e) {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
</script>
@endsection