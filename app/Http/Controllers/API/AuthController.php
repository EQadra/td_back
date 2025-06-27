<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $verificationCode = Str::random(6);

        $user = User::create([
            'name'               => $request->name,
            'email'              => $request->email,
            'password'           => Hash::make($request->password),
            'verification_code'  => $verificationCode,
        ]);

        Mail::raw("Tu código de verificación es: $verificationCode", function ($message) use ($user) {
            $message->to($user->email)
                    ->subject('Código de verificación');
        });

        return response()->json([
            'message' => 'Usuario registrado. Revisa tu correo para verificar tu cuenta.',
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|string|email',
            'password' => 'required|string',
        ]);
    
        if (!Auth::attempt($request->only('email', 'password'))) {
            throw ValidationException::withMessages([
                'email' => ['Credenciales incorrectas.'],
            ]);
        }
    
        $user = User::where('email', $request->email)->firstOrFail();
    
        $token = $user->createToken('auth_token')->plainTextToken;
    
        return response()->json([
            'message'      => 'Inicio de sesión exitoso',
            'access_token' => $token,
            'token_type'   => 'Bearer',
            'user'         => $user,
            'roles'        => $user->getRoleNames(),          // Devuelve una colección de roles
            'permissions'  => $user->getAllPermissions()->pluck('name'), // Devuelve solo los nombres de permisos
        ]);
    }
    

    public function verifyAccount(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'code'  => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || $user->verification_code !== $request->code) {
            return response()->json(['message' => 'Código de verificación inválido'], 400);
        }

        $user->markEmailAsVerified();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message'      => 'Cuenta verificada exitosamente',
            'access_token' => $token,
            'token_type'   => 'Bearer',
            'user'         => $user,
            'roles'        => $user->getRoleNames(),
        ]);
    }

    public function profile(Request $request)
    {
        return response()->json([
            'user'  => $request->user(),
            'roles' => $request->user()->getRoleNames(),
        ]);
    }

    public function verifyToken(Request $request)
    {
        return response()->json([
            'user'  => $request->user(),
            'roles' => $request->user()->getRoleNames(),
        ], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Sesión cerrada.']);
    }

    // ------------------------
    // 🔁 Recuperar Contraseña
    // ------------------------

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? response()->json(['message' => __($status)])
            : response()->json(['message' => __($status)], 400);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email'                 => 'required|email',
            'token'                 => 'required|string',
            'password'              => 'required|string|min:6|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? response()->json(['message' => 'Contraseña actualizada correctamente'])
            : response()->json(['message' => __($status)], 400);
    }
}


