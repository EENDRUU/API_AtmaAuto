<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Pegawai;
use App\Role;
use App\Http\Requests\RegisterAuthRequest;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;


class UserController extends Controller
{

    public function index()
    {
        return User::all();
    }

    public $loginAfterSignUp = true;

    public function register(RegisterAuthRequest $request)
    {
        $user = new User();
        $user->username = $request->username;
        $user->ID_PEGAWAI = $request->ID_PEGAWAI;
        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'User Created successfully'
        ]);

    }

    public function login()
    {
        $credentials = request(['username', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json([
                'error' => 'Unauthorized',
                'message' => 'username or password invalid'
            ]);
            // return $this->respondWithToken($token);
        }
        else{
            return $this->respondWithToken($token);
        }


    }

    public function logout(Request $request)
    {
        $token = JWTAuth::getToken();
        try {
            JWTAuth::invalidate($token);

            return response()->json([
                'success' => true,
                'message' => 'User logged out successfully'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, the user cannot be logged out'
            ], 500);
        }
    }

    public function getAuthUser(Request $request)
    {
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
        $pegawai=Pegawai::find($user->ID_PEGAWAI);
        $role=Role::find($pegawai->ID_ROLE);


        return response()->json([
            'ID_PEGAWAI'=>$pegawai->ID_PEGAWAI,
            'username' => $user->username,
            'NAMA_PEGAWAI' =>$pegawai->NAMA_PEGAWAI,
            'NOMORTELEPON_PEGAWAI' =>$pegawai->NOMORTELEPON_PEGAWAI,
            'ALAMAT' =>$pegawai->ALAMAT,
            'GAJI' =>$pegawai->GAJI,
            'NAMA_ROLE' =>$role->NAMA_ROLE
        ], 200);
    }

    public function changePassword(Request $request)
    {
        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);
        if (!$user) {
            return response()->json([
                'success' => false,
            ], 400);
        }
        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json([
            'success' => true,
            'data' => $user
        ], 200);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'message' => 'Login success...'
        ]);
    }
}
