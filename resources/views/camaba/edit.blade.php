@extends('master.layout')

@section('title', 'Edit Pendaftar')

@section('content')
<h1 class="mb-4">Edit Pendaftar</h1>
<form id="pendaftarForm" method="POST"
    action="{{ route('camaba.edit.proses', ['id' => $dataSiswa->id_calon_mahasiswa]) }}" enctype="multipart/form-data"
    onsubmit="return validateForm()">

    @csrf

    <input type="hidden" name="oldid" value="{{ $dataSiswa->id_calon_mahasiswa }}">

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="nama_user" class="form-label">Nama User</label>
            <input type="text" class="form-control" id="nama_user" name="nama_user" value="{{ $dataSiswa->nama_user }}"
                required>
        </div>

        <div class="col-md-6 mb-3">
            <label for="alamat_ktp" class="form-label">Alamat KTP</label>
            <input type="text" class="form-control" id="alamat_ktp" name="alamat_ktp"
                value="{{ $dataSiswa->alamat_ktp }}" required>
        </div>

        <div class="col-md-6 mb-3">
            <label for="alamat_sekarang" class="form-label">Alamat Sekarang</label>
            <input type="text" class="form-control" id="alamat_sekarang" name="alamat_sekarang"
                value="{{ $dataSiswa->alamat_sekarang }}" required>
        </div>

        <div class="col-md-6 mb-3">
            <label for="kecamatan" class="form-label">Kecamatan</label>
            <input type="text" class="form-control" id="kecamatan" name="kecamatan" value="{{ $dataSiswa->kecamatan }}"
                required>
        </div>

        <div class="col-md-6 mb-3">
            <label for="kabupaten" class="form-label">Kabupaten</label>
            <select class="form-control" id="kabupaten" name="kabupaten" required>
                <option value="" disabled selected>Pilih Kabupaten</option>
                @foreach($kabupatenOptions as $id_kabupaten => $nama_kabupaten)
                <option value="{{ $id_kabupaten }}" {{ $dataSiswa->kabupaten == $id_kabupaten ? 'selected' : '' }}>
                    {{ $nama_kabupaten }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6 mb-3">
            <label for="propinsi" class="form-label">Provinsi</label>
            <select class="form-control" id="propinsi" name="propinsi" required>
                <option value="" disabled selected>Pilih Provinsi</option>
                @foreach($provinsiOptions as $id_provinsi => $nama_provinsi)
                <option value="{{ $id_provinsi }}" {{ $dataSiswa->propinsi == $id_provinsi ? 'selected' : '' }}>
                    {{ $nama_provinsi }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6 mb-3">
            <label for="nohp" class="form-label">No HP</label>
            <input type="text" class="form-control" id="nohp" name="nohp" value="{{ $dataSiswa->nohp }}" required>
        </div>

        <div class="col-md-6 mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $dataSiswa->email }}" required>
        </div>

        <div class="col-md-6 mb-3">
            <label for="kewarganegaraan" class="form-label">Kewarganegaraan</label>
            <select class="form-control" id="kewarganegaraan" name="kewarganegaraan" required>
                <option value="WNI Asli" {{ $dataSiswa->kewarganegaraan == 'WNI Asli' ? 'selected' : '' }}>WNI Asli
                </option>
                <option value="WNI Keturunan" {{ $dataSiswa->kewarganegaraan == 'WNI Keturunan' ? 'selected' : '' }}>WNI
                    Keturunan</option>
                <option value="WNA" {{ $dataSiswa->kewarganegaraan == 'WNA' ? 'selected' : '' }}>WNA</option>
            </select>
        </div>

        <div class="col-md-6 mb-3">
            <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir"
                value="{{ $dataSiswa->tempat_lahir }}" required>
        </div>

        <div class="col-md-6 mb-3">
            <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
            <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir"
                value="{{ date('Y-m-d', strtotime($dataSiswa->tgl_lahir)) }}" required>
        </div>

        <div class="col-md-6 mb-3">
            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="Laki-laki" {{ $dataSiswa->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                </option>
                <option value="Perempuan" {{ $dataSiswa->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan
                </option>
            </select>
        </div>

        <div class="col-md-6 mb-3">
            <label for="status_menikah" class="form-label">Status Menikah</label>
            <select class="form-control" id="status_menikah" name="status_menikah" required>
                <option value="Belum Menikah" {{ $dataSiswa->status_menikah == 'Belum Menikah' ? 'selected' : ''
                    }}>Belum Menikah</option>
                <option value="Menikah" {{ $dataSiswa->status_menikah == 'Menikah' ? 'selected' : '' }}>Menikah</option>
                <option value="Cerai" {{ $dataSiswa->status_menikah == 'Cerai' ? 'selected' : '' }}>Cerai</option>
            </select>
        </div>

        <div class="col-md-6 mb-3">
            <label for="agama" class="form-label">Agama</label>
            <select class="form-control" id="agama" name="agama" required>
                <option value="Islam" {{ $dataSiswa->agama == 'Islam' ? 'selected' : '' }}>Islam</option>
                <option value="Katolik" {{ $dataSiswa->agama == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                <option value="Kristen" {{ $dataSiswa->agama == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                <option value="Hindu" {{ $dataSiswa->agama == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                <option value="Budha" {{ $dataSiswa->agama == 'Budha' ? 'selected' : '' }}>Budha</option>
                <option value="Konghucu" {{ $dataSiswa->agama == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
            </select>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
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

        return confirm('Apakah Anda yakin ingin memperbarui pendaftar ini?');
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