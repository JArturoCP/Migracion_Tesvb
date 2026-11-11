<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\ActivationService;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $activationService;
    protected $redirectTo = '/home';

    public function __construct(ActivationService $activationService)
    {
        $this->middleware('guest');
        $this->activationService = $activationService;
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function register(Request $request)
    {
        // ✅ Nueva forma de validar (ya no se usa throwValidationException)
        $this->validate($request, [
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        // Crear usuario
        $user = $this->create($request->all());

        // Enviar correo de activación
        $this->activationService->sendActivationMail($user);

        // Redirigir con mensaje de confirmación
        return redirect('/login')->with(
            'status',
            'Te hemos enviado un código de activación. Verifica tu correo.'
        );
    }
}