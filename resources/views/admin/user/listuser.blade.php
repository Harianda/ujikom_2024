@extends('master.layout')

@section('custom-css')
<style>
    .hidden-column {
        display: none;
    }
</style>
@endsection

@section('title', 'List User')

@section('content')
<div class="container-fluid mt-10">
    <div class="row mb-3">
        <div class="col-md-1">
            <a href="{{ route('admin.user.create') }}">
                <button class="btn btn-primary float-end">Tambah Data</button>
            </a>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h4 class="mb-0">List User</h4>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table id="table-utama" class="table table-sm table-striped table-bordered table-hover"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama User</th>
                                    <th>ID</th>
                                    <th>Role</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $totalData = count($dataUser);
                                @endphp
                                @foreach ($dataUser as $nomor => $value)
                                <tr>
                                    <td>{{ $totalData - $nomor }}</td>
                                    <td>{{ $value['nama_user'] }}</td>
                                    <td>{{ $value['kode_user'] }}</td>
                                    <td>{{ $value['role'] }}</td>
                                    <td>
                                        <a class="btn btn-warning btn-sm m-1"
                                            href="{{ route('admin.user.edit', ['id_user' => $value->id_user]) }}">
                                            <i class="bx bx-edit"></i> Edit
                                        </a>

                                        <!-- Form for deletion -->
                                        <form action="{{ route('user.delete.proses', ['id_user' => $value->id_user]) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm m-1"
                                                onclick="return confirm('Apakah anda yakin akan menghapus data?')">
                                                <i class="bx bx-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js-content')

<script>
    $(document).ready(function() {
        // Inisialisasi DataTables pada tabel
        $('#table-utama').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: ':not(:last-child)' // Exclude the last column (Aksi)
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: ':not(:last-child)' // Exclude the last column (Aksi)
                    }
                }
            ],
            order: [0, 'asc'] // Sort by the first column (No)
        });
    });
</script>

@if (Session::has('alert-success'))
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

    Toast.fire({
        icon: 'success',
        title: '{{ Session::get('alert-success') }}'
    });
</script>
@endif

@if (Session::has('alert-error'))
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

    Toast.fire({
        icon: 'error',
        title: '{{ Session::get('alert-error') }}'
    });
</script>
@endif

@endsection