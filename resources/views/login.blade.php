<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
    <!-- Favicon -->
    <link rel="icon" href="/assets/images/favicon-32x32.png" type="image/png">
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Custom styles -->
    <style>
        .bg-login {
            background-color: #f1f5f9;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card-login {
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .card-body-login {
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
                <div class="card card-login">
                    <div class="card-body card-body-login">
                        <div class="text-center mb-4">

                            <h3 class="mt-3 mb-4 font-weight-bold">Login</h3>
                        </div>

                        <!-- SweetAlert2 Script -->
                        <script>
                            // Check if session has 'success' message, then display SweetAlert2 success
                            @if(Session::has('success'))
                                Swal.fire({
                                    icon: 'success',
                                    title: '{{ Session::get('success') }}',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                            @endif

                            // Check if session has 'error' message, then display SweetAlert2 error
                            @if(Session::has('error'))
                                Swal.fire({
                                    icon: 'error',
                                    title: '{{ Session::get('error') }}',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                            @endif
                        </script>

                        <form action="{{ route('login') }}" method="POST" class="row g-3">
                            @csrf
                            <div class="col-12">
                                <label for="kode_user" class="form-label">Masukkan Kode User</label>
                                <input type="text" class="form-control" id="kode_user" name="kode_user"
                                    placeholder="Masukkan Masukkan Kode User" required>
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
                                <button type="submit"
                                    class="btn btn-success btn-md btn-admin-gudang w-100 mt-3">Login</button>
                                <a href="{{ route('admin.register') }}" class="text-decoration-none"></i> Register</a>

                            </div>

                        </form>
                        <div class="col-12 text-center mt-3">
                            <a href="/" class="text-decoration-none"><i class="fas fa-chevron-left"></i> Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

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

</body>

</html>