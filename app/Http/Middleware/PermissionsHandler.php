<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermissionsHandler
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $url_string = $request->url();

        $req_author = Auth::user();

        if ($req_author->permissao === 1) {
            if (strpos($url_string, 'aluno/')) {
                return $next($request);
            }
        } else if ($req_author->permissao === 2) {
            if (strpos($url_string, 'orientador/')) {
                return $next($request);
            }
        } else {
            if (strpos($url_string, 'coordenador/') or strpos($url_string, 'orientador/')) {
                return $next($request);
            }
        }

        return abort(403, 'No authorization');
    }
}
