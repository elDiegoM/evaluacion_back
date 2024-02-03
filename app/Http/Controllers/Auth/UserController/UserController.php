<?php

namespace App\Http\Controllers\Auth\UserController;

use App\Http\Controllers\Controller;
use App\Models\LoginActivity;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except(['store']); //Exceptuamos las funciones login
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
        $existCorreo = User::where('email', $request->email)->first();
        if ($existCorreo) {
            return $this->sendError('El correo ya esta registrado en el sistema', 409);
        } else {
            $newUser = new User();
            $newUser->email = $request->email;
            $newUser->name = $request->name;
            $newUser->password = bcrypt($request->password);
            $newUser->phone = $request->phone;
            $newUser->save();
            return $this->sendResponse($newUser, 'Usuario registrado correctamente.');
        }
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

    public function getLogs()
    {
        $getLogs = LoginActivity::all();
        return $this->sendResponse($getLogs, 'Logs Encontrados');
    }
}
