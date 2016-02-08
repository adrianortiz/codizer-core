<?php

namespace App\Http\Middleware;

use Closure;

class LangMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /**
         * Preguntamos por la existencia de la var lang
         * En caso se que no exista se utiliza la definida
         * en la configuración de la App
         */
        if (!empty(session('lang'))) {
            \App::setLocale(session('lang'));
        }
        return $next($request);
    }
}
