<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class AuthSanctumController extends Controller
{
    public function login (Request $request)
    {
        try {
            $request->validate([
                'email' => 'email|required',
                'password' => 'required'
            ]);

            $credentials = request(['email', 'password']);

            if (!Auth::attempt($credentials)) {
                return response()->json([
                    'status_code' => 500,
                    'message' => 'Lỗi truy cập!'
                ]);
            }

            $user = User::where('email', $request->email)->first();

            if (!Hash::check($request->password, $user->password, [])) {
                throw new \Exception('Lỗi đăng nhập!');
            }

            $tokenResult = $user->createToken('authToken')->plainTextToken;

            return response()->json([
                'status_code' => 200,
                'access_token' => $tokenResult,
                'token_type' => 'Bearer'
            ]);
        } catch (\Exception $error) {
            return response()->json([
                'status_code' => 500,
                'message' => 'Lỗi đăng nhập khác!',
                'error' => $error,
            ]);
        }
    }

    public function register (Request $request)
    {
        $data_validate = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $data_validate['password'] = Hash::make($request->password);

        $user = User::create($data_validate);

        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'status_code' => 200,
            'message' => 'Register Successfully',
            'user' => $user,
            'access_token' => $token
        ]);
    }

    public function forgotPassword (Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
                    ? response()->json(['message' => 'Reset link sent to email.'], 200)
                    : response()->json(['message' => 'Unable to send  reset link. ', 400]);
    }
}
