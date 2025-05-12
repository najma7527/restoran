<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RegisterController extends Controller
{

//     public function register(RegisterRequest $request)
// {
//     $data = $request->validated(); 
//     $data['password'] = Hash::make($data['password']);

//     $user = User::create($data);

//     // Login otomatis setelah registrasi
//     Auth::login($user);

//     // Redirect sesuai peran
//     if ($user->role === 'admin') {
//         return redirect()->route('admin.dashboard')->with('success', 'Selamat datang, Admin!');
//     } elseif ($user->role === 'kasir') {
//         return redirect()->route('kasir.dashboard')->with('success', 'Selamat datang, Kasir!');
//     } elseif ($user->role === 'dapur') {
//         return redirect()->route('dapur.dashboard')->with('success', 'Selamat datang, Dapur!');
//     }

//     // Default fallback
//     return redirect('/')->with('success', 'Registrasi berhasil.');
// }

    public function register (RegisterRequest $request){
        $data = $request->validated(); 
        $data['password'] = Hash::make($data['password']);
    
        User::create($data);
        
        return redirect()->back()->with('success', 'Selamat! Anda berhasil registrasi akun.');
    
        }
}
