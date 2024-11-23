<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

class UserController extends Controller
{
    public function register(){

        return view('auth.register');

    }

    public function post_register(Request $request){

        $validated = $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'tel' => 'required|unique:users|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
            'password_confirmation'=> 'required',
        ],$message = [
            'first_name.required' =>"Vous n'avez pas saisi votre prénom",
            'last_name.required' =>"Vous n'avez pas saisi votre nom",
            'tel.required' =>"Vous n'avez pas saisi votre numéro de téléphone",
            'tel.unique' =>"Ce numéro de téléphone a déjà été utilisé ",
            'email.required' =>"Vous n'avez pas saisi votre adresse email",
            'password.unique' =>"Vous n'avez pas saisi votre mot de passe ",
            'password.confirmed' =>"Vous n'avez pas confirmé le mot de passe  ",
            'password.min' =>"Le motr de passe doit être minimum 8 caractères",
        ]);


        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'tel' => $request->tel,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        return redirect()->route('connexion');
    }

    public function login(){

        return view('auth.login');

    }

    public function post_login(Request $request){

            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ],$message = [
                'email.required'=>"Vous n'avez pas saisi votre adresse email",
                'email.email'=>"Ce champs ne doit contenir que email",
                'password.required'=>"Vous n'avez pas saisi de mot de passe",
            ]);


            if (Auth::guard('web')->attempt($credentials)) {
                $request->session()->regenerate();

                if ($request->has('remember')) {
                    $minutes = 60 * 24 * 30; // Durée de validité du cookie (ici 30 jours)
                    Cookie::queue('remember_token', Auth::user()->id, $minutes);
                }

                return redirect()->route('accueil');
            }

            if (Auth::guard('admin')->attempt($credentials)) {
                $request->session()->regenerate();

                return redirect()->route('dashboardComposant');
            }

            return back()->withErrors([
                'email' => "nom d'utilisateur ou mot de passe incorrect.",
            ])->onlyInput('email');
        }


        public function logout(Request $request)
        {
            Auth::logout(); // Déconnecte l'utilisateur

            // Si vous utilisez les sessions, vous pouvez également les effacer :
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            Cookie::queue(Cookie::forget('remember_token'));

            return redirect('/'); // Redirige après la déconnexion
        }


        public function form_forget_password(){

                return view('auth.password');

        }


        public function  forget_password(Request $request) {
            $request->validate(['email' => 'required|email']);

            //dd($request->only('email'));
            /*$response = Password::sendResetLink($request->only('email'));
            Log::info('Password reset link response: ', ['response' => $response]);*/

            $status = Password::sendResetLink(
                $request->only('email')
            );
            //dd($status);
            return $status === Password::RESET_LINK_SENT
                        ? back()->with(['status' => __($status)])
                        : back()->withErrors(['email' => __($status)]);
        }


        public function form_reset_password(string $token){
            return view('auth.reset-password', ['token' => $token]);
        }

        public function ResetPassword(Request $request) {
            $request->validate([
                'token' => 'required',
                'email' => 'required|email',
                'password' => 'required|min:8|confirmed',
            ]);


            $status = Password::reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function (User $user, string $password) {
                    $user->forceFill([
                        'password' => Hash::make($password)
                    ])->setRememberToken(Str::random(60));

                    $user->save();

                    event(new PasswordReset($user));
                }
            );

            return $status === Password::PASSWORD_RESET
                        ? redirect()->route('connexion')->with('status', __($status))
                        : back()->withErrors(['email' => [__($status)]]);
        }
}

