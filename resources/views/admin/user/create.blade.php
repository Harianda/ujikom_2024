@extends('master.layout')

@section('title', 'Tambah User Baru')

@section('content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Tambah User Baru</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="#"><i class="bx bx-home-alt"></i></a></li>
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.user.listuser') }}">List User</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Tambah</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h4 class="mb-0">Tambah Master User</h4>
                </div>
                <hr>
                <form method="POST" action="{{ route('user.add.proses') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-12">
                            <label class="form-label">Nama User:</label>
                            <input class="form-control form-control-sm" type="text" name="nama_user" id="nama_user"
                                placeholder="Masukkan Nama Lengkap" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <label class="form-label">ID:</label>
                            <input class="form-control form-control-sm" type="text" name="kode_user" id="kode_user"
                                placeholder="Masukkan ID" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <label class="form-label">Password:</label>
                            <div class="input-group">
                                <input class="form-control form-control-sm" type="password" name="password"
                                    id="password" placeholder="Masukkan Password | Contoh: Password123, Password231"
                                    required>
                                <button class="btn btn-outline-secondary" type="button"
                                    id="showPasswordBtn">Show</button>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <label class="input-group-text" for="role">Role</label>
                        <select class="form-select" id="role" name="role" required>
                            <option value="Kajur">Admin</option>
                            <option value="KPS">Camaba</option>
                        </select>
                    </div>

                    <div class="row justify-content-left">
                        <div class="col-8 text-left" style="margin-bottom: 10px; margin-left: 15px;">
                            <button class="btn btn-primary" type="button" id="save-button">Simpan</button>
                            <a href="{{ route('admin.user.listuser') }}" class="btn btn-secondary"
                                style="margin-left: 10px;">
                                <i class="bx bx-x me-1"></i>Batal
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('showPasswordBtn').addEventListener('click', function() {
        var passwordInput = document.getElementById('password');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            this.textContent = 'Hide';
        } else {
            passwordInput.type = 'password';
            this.textContent = 'Show';
        }
    });

    function showConfirmation() {
        // Script jika user tidak melengkapi/memilih pilihan
        let allInputs = document.querySelectorAll('.form-control');
        let isValid = true;
        let validationErrors = []; // Store validation error messages

        allInputs.forEach(function(input) {
            if (input.value === '') {
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
                    document.querySelector('form').submit(); // Submit the form
                }
            });
        } else {
            Swal.fire({
                title: 'Validasi Gagal',
                icon: 'error',
                html: validationErrors.join('<br>'), // Combine error messages
            });
        }
    }

    document.getElementById('save-button').addEventListener('click', showConfirmation);
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