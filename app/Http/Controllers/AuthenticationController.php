<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthenticationController extends Controller
{
    // public function register(Request $request)
    // {
    //     $rules = [
    //         'username' => 'required|unique:users,username',
    //         'email' => 'required|email|unique:users,email',
    //         'password' => 'required|min:8',
    //     ];

    //     $validator = Validator::make($request->all(), $rules);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'Proses Register Gagal',
    //             'data' => $validator->errors()
    //         ], 400);
    //     }

    //     $newUser = new User();
    //     $newUser->username = $request->username;
    //     $newUser->email = $request->email;
    //     $newUser->password = Hash::make($request->password);

    //     try {
    //         $newUser->save();
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'Terjadi kesalahan saat menyimpan data pengguna',
    //             'error' => $e->getMessage()
    //         ], 500);
    //     }

    //     return response()->json([
    //         'status' => true,
    //         'message' => 'Registrasi berhasil',
    //         'user' => $newUser
    //     ], 201);
    // }

    public function login(Request $request)
    {
        $rules = [
            'email' => 'required',
            'password' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Proses login Gagal',
                'data' => $validator->errors()
            ], 400);
        }

        if (!Auth::attempt($request->only(['email', 'password']))) {
            return response()->json([
                'status' => false,
                'message' => 'email dan password tidak sesuai'
            ], 401);
        }

        $user = User::where('email', $request->email)->first();
        $token = $user->createToken('api-login')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'Berhasil Login',
            'token' => $token,
            'user' => $user
        ], 200);
    }
}
