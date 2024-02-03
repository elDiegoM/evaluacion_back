<?php

namespace App\Http\Controllers\LoginController;

use App\Http\Controllers\Controller;
use App\Models\LoginActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except(['login']); //Exceptuamos las funciones login
    }

    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $success['token'] =  $user->createToken('Session Succesfull')->accessToken;
            $success['usuario'] =  $user;

            LoginActivity::create([
                'user_id' => auth()->user()->id,
                'ip_address' => $request->ip(),
                'user_agent' => $request->header('User-Agent'),
            ]);

            return $this->sendResponse($success, 'Login Exitoso');
        } else {
            return $this->sendError('Sin Autorizacion.', 401);
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
