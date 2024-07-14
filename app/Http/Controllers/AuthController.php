<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login.index');
    }

    public function loginStore(Request $request)
    {
        try {
            $credentials = [
                'email' => $request->email,
                'password' => $request->password,
            ];

            if (Auth::attempt($credentials)) {
                $response = [
                    'status' => true,
                    'data' => 'success',
                    'role' => Auth()->user()->role
                ];

                return response()->json($response);
            }

            // ถ้าไม่เจอ user
            $response = [
                'status' => true,
                'data' => 'Invalid login credentials'
            ];
        } catch (\Exception $e) {
            $response = [
                'status' => false,
                'data' => $e->getMessage()
            ];
        }

        return response()->json($response);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function register(Request $request)
    {
        return view('auth.register.index');
    }

    public function store(Request $request)
    {
        try {

            $data = $request->except('confirm_password');
            $validate = Validator::make($data, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string'],
            ]);

            if ($validate->fails()) {
                $response = [
                    'status' => false,
                    'errors' => $validate->errors()
                ];

                return response()->json($response);
            }

            $user = User::create([
                'code' => Str::uuid(),
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role' => 'user'
            ]);

            auth()->login($user);

            $response = [
                'status' => true,
                'data' => 'success'
            ];
        } catch (\Exception $e) {
            $response = [
                'status' => false,
                'data' => $e->getMessage()
            ];
        }

        return response()->json($response);
    }
}
