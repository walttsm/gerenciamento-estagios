<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Providers\RouteServiceProvider;

class LoginController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }


    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect('/login');
        }
        // Verifica se o e-mail do usuário é dos domínios permitidos
        $allow = false;
        $permitted_domains = ['edu.unifil.br', 'unifil.br', 'colegiolondrinense.com.br'];
        $user_domain = explode("@", $user->email)[1];
        foreach ($permitted_domains as $permitted_domain) {
            if ($user_domain === $permitted_domain) {
                $allow = true;
                break;
            }
        }

        // Condição de teste para email pessoal como coordenador. REMOVER!!!!
        if ($user->email === 'waltmarinho@gmail.com') {
            $allow = true;
        }

        if ($allow == false) {
            return redirect()->to('/');
        }

        // Verifica se é um usuário já existente
        $existingUser = User::where('email', $user->email)->first();
        if ($existingUser) {
            // Loga o usuário
            auth()->login($existingUser, true);
        } else {
            // Cria um novo usuário
            $newUser                  = new User;
            $newUser->name            = $user->name;
            $newUser->email           = $user->email;
            $newUser->google_id       = $user->id;
            $newUser->avatar          = $user->avatar;
            $newUser->avatar_original = $user->avatar_original;
            $newUser->save();
            auth()->login($newUser, true);
        }
        return redirect()->intended(RouteServiceProvider::HOME);
    }
}
