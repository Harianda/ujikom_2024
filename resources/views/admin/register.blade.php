<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Registrasi User</title>
    <!-- Favicon -->
    <link rel="icon" href="/assets/images/favicon-32x32.png" type="image/png">
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- SweetAlert2 -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- Custom styles -->
    <style>
        .bg-login {
            background-color: #f1f5f9;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card-register {
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .card-body-register {
            padding: 3rem;
        }

        .logo {
            max-width: 150px;
        }
    </style>
</head>

<body class="bg-login">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card card-register">
                    <div class="card-body card-body-register">
                        <div class="text-center mb-4">
                            <h3 class="mt-3 mb-4 font-weight-bold">Registrasi User</h3>
                        </div>
                        <form action="{{ route('admin.userProsesAdd') }}" method="POST" class="row g-3">
                            @csrf
                            <div class="col-12">
                                <label for="kode_user" class="form-label">Id</label>
                                <input type="text" class="form-control" id="kode_user" name="kode_user"
                                    placeholder="Masukkan ID" required>
                            </div>
                            <div class="col-12">
                                <label for="nama_user" class="form-label">Nama User</label>
                                <input type="text" class="form-control" id="nama_user" name="nama_user"
                                    placeholder="Masukkan Nama User" required>
                            </div>
                            <div class="col-12">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Masukkan Password" required>
                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword"><i
                                            class="fas fa-eye-slash"></i></button>
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="role" class="form-label">Role</label>
                                <select class="form-select" id="role" name="role" required>
                                    <option value="Admin">Admin</option>
                                    <option value="Camaba">Camaba</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <button type="submit"
                                    class="btn btn-success btn-md btn-admin-gudang w-100 mt-3">Register</button>
                            </div>
                        </form>
                        <div class="col-12 text-center mt-3">
                            <a href="{{ route('login') }}" class="text-decoration-none"><i
                                    class="fas fa-chevron-left"></i> Kembali ke Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Password Show & Hide JS -->
    <script>
        document.getElementById("togglePassword").addEventListener("click", function () {
            var passwordInput = document.getElementById("password");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                this.innerHTML = '<i class="fas fa-eye"></i>';
            } else {
                passwordInput.type = "password";
                this.innerHTML = '<i class="fas fa-eye-slash"></i>';
            }
        });
    </script>

    <!-- SweetAlert2 Alerts -->
    @if(Session::has('alert-success'))
    <script>
        Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ Session::get('alert-success') }}",
            });
    </script>
    @endif

    @if(Session::has('alert-error'))
    <script>
        Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "{{ Session::get('alert-error') }}",
            });
    </script>
    @endif

</body>

</html>