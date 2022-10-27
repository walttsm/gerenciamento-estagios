<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Aluno;
use App\Models\Orientador;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Providers\AuthServiceProvider;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

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
        try {
            $existingUser = User::where('email', $user->email)->first();
            if ($existingUser) {
                // Loga o usuário
                if ($existingUser->google_id == null) {
                    $existingUser->google_id = $user->id;
                    $existingUser->avatar = $user->avatar;
                    $existingUser->avatar_original = $user->avatar_original;
                    $existingUser->save();
                }
                auth()->login($existingUser, true);
            } else {
                switch ($user_domain) {
                    case 'unifil.br' or 'colegiolondrinense.com.br':
                        $user_permission = 2;
                        break;
                    default:
                        $user_permission = 1;
                        break;
                }
                // Cria um novo usuário
                $newUser                  = new User;
                $newUser->name            = $user->name;
                $newUser->email           = $user->email;
                $newUser->google_id       = $user->id;
                $newUser->avatar          = $user->avatar;
                $newUser->avatar_original = $user->avatar_original;
                $newUser->permissao      = $user_permission;
                $newUser->password        = Hash::make('password');  //REMOVER!!! FALHA DE SEGURANÇA
                $newUser->save();

                switch ($user_domain) {
                    case 'unifil.br' or 'colegiolondrinense.com.br':
                        $entity = Orientador::where('email', 'like', $user->email)->get()->first();
                        break;
                    default:
                        $entity = Aluno::where('email', 'like', $user->email)->get()->first();
                        break;
                }

                $created_user = User::select('id')->where('email', 'like', $user->email)->get()->first();
                $entity->user_id = $created_user->id;
                $entity->save();
                auth()->login($newUser, true);
            }

            $logged_user = Auth::user();
            $prefix = '';

            if ($logged_user->permissao == 1) {
                $prefix = 'aluno';
            } else {
                $prefix = 'orientador';
            }
            return redirect()->intended($prefix . RouteServiceProvider::HOME);
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
            // return throw ValidationException::withMessages(['email' => 'Conta não encontrada em nossos registros, entre em contato com o coordenador.']);
            return back()->with('status', 'Usuário não encontrado.');
        }
    }
}
