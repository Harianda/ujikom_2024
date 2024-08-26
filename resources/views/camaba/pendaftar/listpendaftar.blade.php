@extends('master.layout')

@section('title', 'List Pendaftar')

@section('content')

<h1 class="mb-4">List Ajuan Pendaftaran</h1>
<div class="mb-5">
    <a href="{{ route('camaba.pendaftar.create') }}" class="btn btn-primary">Tambah Data</a>
</div>
<table id="dataTable" class="table table-striped">
    <thead>
        <tr>
            <th>No.</th>
            <th>Nama User</th>
            <th>Kecamatan</th>
            <th>Kabupaten</th>
            <th>Provinsi</th>
            <th>No HP</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @php
        $totalData = count($dataSiswaMaster);
        @endphp
        @foreach ($dataSiswaMaster as $nomor => $value)
        <tr>
            <td>{{ $totalData - $nomor }}</td>
            <td>{{ $value->nama_user }}</td>
            <td>{{ $value->kecamatan }}</td>
            <td>{{ $value->kabupaten }}</td>
            <td>{{ $value->propinsi }}</td>
            <td>{{ $value->nohp }}</td>
            <td>{{ $value->email }}</td>
            <td>
                <a class="btn btn-warning btn-sm m-1"
                    href="{{ route('camaba.pendaftar.edit', ['id' => $value->id_calon_mahasiswa]) }}">
                    <i class="bx bx-edit"></i> Edit
                </a>

                <!-- Form for deletion -->
                <form action="{{ route('camaba.pendaftar.delete.proses', ['id' => $value->id_calon_mahasiswa]) }}"
                    method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm m-1"
                        onclick="return confirm('Apakah anda yakin akan menghapus data?')">
                        <i class="bx bx-trash"></i> Hapus
                    </button>
                </form>

                </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection