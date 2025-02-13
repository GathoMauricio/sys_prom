<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function login(Request $request)
    {
        $request->validate([
            'Usuario' => ['required', 'string'],
            'PWD' => ['required', 'string'],
        ]);

        $user = \App\Models\User::where('Usuario', $request->Usuario)->first();

        if ($user && $request->PWD === $user->PWD) {
            \Auth::login($user);
            return redirect()->intended('home');
        }

        return back()->withErrors(['Usuario' => 'Credenciales incorrectas']);
    }

    // public function login(Request $request)
    // {
    //     // Validar las credenciales del usuario (usa "username" en lugar de "email")
    //     $request->validate([
    //         'usuario' => ['required', 'string'],
    //         'password' => ['required', 'string'],
    //     ]);

    //     // Intentar autenticación con la columna "usuario"
    //     if (!\Auth::attempt(['usuario' => $request->usuario, 'password' => $request->password], $request->boolean('remember'))) {
    //         throw ValidationException::withMessages([
    //             'usuario' => __('Estas credenciales no coinciden con nuestros registros.'),
    //         ]);
    //     }

    //     // Regenerar la sesión tras iniciar sesión correctamente
    //     $request->session()->regenerate();

    //     // Redirigir al usuario autenticado
    //     return redirect()->intended('home');
    // }

    public function logout(Request $request)
    {
        \Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
