<?php

namespace App\Http\Controllers\Admin;

// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;

use App\Models\Log;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Firebase\JWT\JWT; //memanggil library JWT
use Illuminate\Support\Facades\Validator; //panggil library validator untuk validasi inputan

class AuthController extends Controller
{
    //
    public function index()
    {

     
        return view('auth.login');

        // if (Auth::check()) {
        //     return redirect()->route('home');
        // }
            // Jika proses login berhasil
   

    }
    // $users = User::all();



    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,users_email',
            'password' => 'required|min:8',
            'confirmation_password' => 'required|same:password'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'code' => 400,
                'messages' => $validator->errors()->all()
            ], 400);
        }

        $userData = $validator->validated();

        User::createUser($userData);

        $user = User::where('users_email', $userData['email'])->first();

        $token = User::generateToken($userData['name'], $userData['email'], 'user', $user->id);

        return response()->json(
            [
                "status" => "success",
                "code" => 200,
                "message" => "Berhasil Registrasi",
                "data" => [
                    'id' => $user->id,
                    'name' => $userData['name'],
                    'email' => $userData['email'],
                    'role' => 'user',
                ],
                "token" => "Bearer {$token}"
            ],
            200
        );


    }





    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'code' => 400,
                'messages' => $validator->errors()->all()
            ], 400);
        }

        $user = User::where('users_email', $request->email)->first();

        if ($user && User::validatePassword($request->password, $user->users_password)) {
            $token = User::generateToken($user->users_name, $user->users_email, $user->users_role, $user->id);

            Log::create([
                'logs_module' => 'login',
                'logs_action' => 'login account',
                'users_id' => $user->id
            ]);

            return redirect()->route('home');

            // return response()->json([
            //     "status" => "success",
            //     "code" => 200,
            //     "message" => "Berhasil Login",
            //     "data" => [
            //         'id' => $user->id,
            //         'name' => $user->users_name,
            //         'email' => $user->users_email,
            //         'role' => $user->users_role,
            //     ],
            //     "token" => "Bearer {$token}"
            // ], 200);


        }


        return response()->json([
            'status' => 'error',
            'code' => 422,
            'message' => 'Email atau password salah'
        ], 422);
        
    }


        // return response()->json([
        //     'status' => 'error',
        //     'code' => 422,
        //     'message' => 'Email atau password salah'
        // ], 422);
    }
    

