<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .register-card {
            max-width: 500px;
            margin: 50px auto;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card register-card p-4">
            @if (session()->has('success'))
                <div class="alert alert-success alert-solid alert-dismissible shadow-sm p-3 mb-5 rounded" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <h2 class="text-center mb-4">Daftar Akun</h2>
            <form action= "{{ route ('register')}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama lengkap Anda">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Alamat Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="email@example.com">
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username">
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Pilih Role</label>
                    <select class="form-select" name="role" id="role" required>
                        {{-- <option value="" disabled selected>Pilih role</option> --}}
                        <option value="admin">Admin</option>
                        <option value="kasir">Kasir</option>
                        <option value="staff_dapur">Staff Dapur</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Kata Sandi</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan kata sandi">
                </div>

                <div class="mb-3">
                    <label for="confirmPassword" class="form-label">Konfirmasi Kata Sandi</label>
                    <input type="password" class="form-control" id="confirmPassword" name="password_confirmation" placeholder="Ulangi kata sandi">
                </div>

                

                <button type="submit" class="btn btn-primary w-100">Daftar</button>
                <p class="text-center mt-3">Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a></p>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
