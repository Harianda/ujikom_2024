@extends('master.layout')

@section('title', 'Edit User')
@section('content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Edit User</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.user.listuser') }}"><i
                            class="bx bx-home-alt"></i></a></li>
                <li class="breadcrumb-item" aria-current="page">
                    <a href="{{ route('admin.user.listuser') }}">List User</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container mt-4">
    <div class="row mt-3">
        <div class="col-12">
            @if (Session::has('message'))
            <div class="alert {{ Session::get('class') }} alert-dismissible fade show alert-custom" role="alert">
                {{ Session::get('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h4 class="mb-0">Edit User</h4>
                    </div>
                    <hr />
                    <form method="POST" action="{{ route('user.edit.proses') }}" enctype="multipart/form-data">
                        @csrf

                        <input value="{{ $dataUser->id_user }}" type="hidden" name="oldid" id="oldid">

                        <div class="mb-3">
                            <label for="" class="form-label">ID</label>
                            <input type="text" value="{{ $dataUser->kode_user }}" class="form-control" id="kode_user"
                                name="kode_user">
                        </div>

                        <!-- hidden old id -->
                        <input type="hidden" value="{{ $dataUser->nama_user }}" class="form-control" id="oldnama_user"
                            name="oldnama_user">

                        <div class="mb-3">
                            <label for="" class="form-label">Nama User</label>
                            <input type="text" value="{{ $dataUser->nama_user }}" class="form-control" id="nama_user"
                                name="nama_user">
                        </div>
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="inputGroupSelect02">Role</label>
                            <select class="form-select" id="role" name="role">
                                <option value="Admin" {{ $dataUser->role == 'Admin' ? 'selected' : '' }}>Admin</option>
                                <option value="Camaba" {{ $dataUser->role == 'Camaba' ? 'selected' : '' }}>Camaba
                                </option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" value="{{ $dataUser->password }}" class="form-control" id="password"
                                name="password">
                        </div>
                        <button class="btn btn-primary" type="button" id="save-button"
                            onclick="showConfirmation()">Simpan</button>
                        <!-- Tombol Kembali -->
                        <a href="{{ route('admin.user.listuser') }}" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    function showConfirmation() {
        // Script jika user tidak melengkapi/memilih pilihan
        let allSelects = document.querySelectorAll('.select-element');
        let isValid = true;
        let validationErrors = []; // Store validation error messages

        allSelects.forEach(function(select) {
            if (select.value === '') {
                isValid = false;
                validationErrors.push('Ada input yang kosong!');
            }
        });

        if (isValid) {
            Swal.fire({
                title: 'Apakah anda yakin akan menyimpan data ini?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Simpan',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    // If the user confirms, you can submit the form or trigger the desired action
                    document.querySelector('form').submit(); // This submits the form
                }
            });
        } else {
            Swal.fire({
                title: 'Validasi Gagal',
                icon: 'error',
                html: validationErrors.join('<br>'), // Combine error messages
            });

            return false; // Prevent form submission
        }
    }
</script>
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