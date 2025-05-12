<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Form Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css">
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-md">
        @if ($errors->any())
            <div class="mb-4 bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-lg">
                <ul class="list-disc list-inside text-sm space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session()->has('success'))
            <div class="mb-5 p-4 rounded-lg shadow-sm bg-green-100 border border-green-300 text-green-800 relative">
                <span>{{ session('success') }}</span>
                <button type="button" class="absolute top-2 right-3 text-green-600 hover:text-green-800"
                    onclick="this.parentElement.remove()">
                    &times;
                </button>
            </div>
        @endif


        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Login</h2>

        <form action="{{ route ('login')}}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" placeholder="email@example.com"
                    class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Kata Sandi</label>
                <input type="password" id="password" name="password" placeholder="Masukkan kata sandi"
                    class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>
            


            <button type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition duration-300 font-semibold">
                Login
            </button>

            <p class="text-center text-sm text-gray-600 mt-3">
                Belum punya akun?
                <a href="{{ route('register')}}" class="text-blue-600 hover:underline">Daftar di sini</a>
            </p>
        </form>
    </div>

</body>

</html>
