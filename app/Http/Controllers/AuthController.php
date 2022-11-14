<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        #menangkap inputan
        $input = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ];

        #menginsert data ke table user
        $user = User::create($input);

        $data = [
            'message' => 'user is created succesfully'
        ];

        # mengirim response json
        return response()->json($data, 200);
    }

    public function login(Request $request)
    {
        # menangkap input user
        $input = [
            'email'=>$request->email,
            'password'=>$request->password
        ];

        # Mengambil data user (DB)
        $user = User::where('email', $input['email'])->first();

        # Membandingkan data inputan dengan data user (DB)
        $isLoginSuccesfully = (
            $input['email'] == $user->email && Hash::check($input['password'], 
            $user->password)); 

        if ($isLoginSuccesfully) {
            # membuat token
            $token = $user->createToken('auth_token');
            
            $data = 
            [
                'message' => 'Login succesfully',
                'token' => $token->plainTextToken
            ];
            
            return response()->json($data, 200);
        }else{
            $data = ['message' => 'Email or password is wrong'];

            return response()->json($data, 401);
        }
    }
}
